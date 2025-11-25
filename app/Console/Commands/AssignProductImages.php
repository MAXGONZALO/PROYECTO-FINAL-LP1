<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AssignProductImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:assign-images {--force : Forzar actualización de todas las imágenes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Descarga y asigna imágenes a productos basándose en su categoría y descripción';

    /**
     * Mapeo de categorías a palabras clave para imágenes
     */
    protected $categoryImageMap = [
        'Laptops' => ['laptop', 'notebook', 'computer'],
        'Computadoras' => ['desktop', 'computer', 'pc'],
        'Impresoras' => ['printer', 'office'],
        'Monitores' => ['monitor', 'display', 'screen'],
        'Componentes' => ['computer', 'hardware', 'component'],
        'Accesorios' => ['keyboard', 'mouse', 'accessory'],
        'Almacenamiento' => ['hard-drive', 'ssd', 'storage'],
        'Redes' => ['router', 'network', 'wifi'],
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🖼️  Descargando y asignando imágenes a productos...');
        
        // Asegurar que el directorio existe
        if (!Storage::disk('public')->exists('products')) {
            Storage::disk('public')->makeDirectory('products');
        }
        
        // Obtener productos según la opción force
        if ($this->option('force')) {
            $products = Product::all();
            $this->info('Forzando actualización de todas las imágenes...');
        } else {
            $products = Product::whereNull('image')->orWhere('image', '')->get();
        }
        
        if ($products->isEmpty()) {
            $this->warn('No se encontraron productos para procesar.');
            return;
        }

        $bar = $this->output->createProgressBar($products->count());
        $bar->start();

        $updated = 0;
        $failed = 0;
        
        foreach ($products as $product) {
            try {
                $imagePath = $this->downloadImageForProduct($product);
                
                if ($imagePath) {
                    // Si el producto ya tenía una imagen local, eliminarla
                    if ($product->image && !filter_var($product->image, FILTER_VALIDATE_URL)) {
                        Storage::disk('public')->delete($product->image);
                    }
                    
                    $product->image = $imagePath;
                    $product->save();
                    $updated++;
                } else {
                    $failed++;
                }
            } catch (\Exception $e) {
                $this->newLine();
                $this->error("Error procesando producto {$product->id}: " . $e->getMessage());
                $failed++;
            }
            
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("✅ Se descargaron y asignaron imágenes a {$updated} productos.");
        if ($failed > 0) {
            $this->warn("⚠️  Fallaron {$failed} productos.");
        }
    }

    /**
     * Descarga una imagen apropiada para el producto y la guarda localmente
     */
    protected function downloadImageForProduct(Product $product)
    {
        $category = $product->category;
        $categoryName = $category ? $category->name : 'Computer';
        
        // Obtener palabras clave del nombre y descripción
        $keywords = $this->extractKeywords($product->name, $product->description);
        
        // Determinar el término de búsqueda
        $searchTerm = $this->getSearchTerm($categoryName, $keywords, $product->name);
        
        // Generar nombre único para el archivo
        $fileName = 'product-' . $product->id . '-' . time() . '.jpg';
        $filePath = 'products/' . $fileName;
        
        // Intentar descargar desde múltiples fuentes
        $imageUrls = [
            $this->getUnsplashImageUrl($categoryName, $product->id),
            "https://picsum.photos/seed/{$product->id}" . crc32($product->name) . "/800/600",
            "https://placehold.co/800x600/DC2626/FFFFFF?text=" . urlencode(substr($product->name, 0, 20)),
        ];
        
        foreach ($imageUrls as $imageUrl) {
            try {
                $response = Http::timeout(5)->get($imageUrl);
                
                if ($response->successful()) {
                    $contentType = $response->header('Content-Type', '');
                    // Verificar que sea una imagen
                    if (str_contains($contentType, 'image/') || 
                        (strlen($response->body()) > 1000 && !str_contains($response->body(), '<html'))) {
                        Storage::disk('public')->put($filePath, $response->body());
                        return $filePath;
                    }
                }
            } catch (\Exception $e) {
                continue; // Intentar siguiente URL
            }
        }
        
        // Si todo falla, crear una imagen placeholder SVG
        $svgPath = $filePath . '.svg';
        $svg = $this->createSvgPlaceholder($product->name, $categoryName);
        Storage::disk('public')->put($svgPath, $svg);
        return $svgPath;
    }
    
    /**
     * Obtiene URL de imagen de Unsplash
     */
    protected function getUnsplashImageUrl($categoryName, $productId)
    {
        $categorySlug = strtolower(str_replace(' ', '-', $categoryName));
        
        $unsplashTerms = [
            'laptops' => 'laptop-computer',
            'computadoras' => 'desktop-computer',
            'impresoras' => 'printer-office',
            'monitores' => 'computer-monitor',
            'componentes' => 'computer-hardware',
            'accesorios' => 'computer-keyboard',
            'almacenamiento' => 'hard-drive',
            'redes' => 'router-network',
        ];
        
        $term = $unsplashTerms[$categorySlug] ?? 'computer-technology';
        
        return "https://source.unsplash.com/800x600/?{$term}&sig={$productId}";
    }
    
    
    /**
     * Crea un placeholder SVG
     */
    protected function createSvgPlaceholder($productName, $categoryName)
    {
        $colors = ['#DC2626', '#991b1b', '#7f1d1d', '#000000'];
        $color = $colors[crc32($productName) % count($colors)];
        $text = htmlspecialchars(substr($productName, 0, 40));
        
        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600">
    <rect fill="{$color}" width="800" height="600"/>
    <text fill="#FFFFFF" font-family="Arial, sans-serif" font-size="24" font-weight="bold" 
          x="400" y="300" text-anchor="middle" dominant-baseline="middle">{$text}</text>
</svg>
SVG;
    }

    /**
     * Extrae palabras clave relevantes del nombre y descripción
     */
    protected function extractKeywords($name, $description)
    {
        $text = strtolower($name . ' ' . $description);
        
        // Palabras clave importantes
        $importantKeywords = [
            'gaming', 'gamer', 'office', 'professional', 'ultra', 'pro',
            'wireless', 'bluetooth', 'rgb', 'mechanical', 'gaming',
            'laptop', 'desktop', 'monitor', 'printer', 'keyboard', 'mouse',
            'ssd', 'hard drive', 'ram', 'processor', 'graphics', 'router'
        ];
        
        $found = [];
        foreach ($importantKeywords as $keyword) {
            if (str_contains($text, $keyword)) {
                $found[] = $keyword;
            }
        }
        
        return $found;
    }

    /**
     * Determina el término de búsqueda para la imagen
     */
    protected function getSearchTerm($categoryName, $keywords, $productName)
    {
        // Mapeo de categorías a términos de búsqueda
        $categoryTerms = [
            'Laptops' => 'laptop',
            'Computadoras' => 'desktop-computer',
            'Impresoras' => 'printer',
            'Monitores' => 'computer-monitor',
            'Componentes' => 'computer-hardware',
            'Accesorios' => 'computer-accessories',
            'Almacenamiento' => 'hard-drive',
            'Redes' => 'router',
        ];
        
        $baseTerm = $categoryTerms[$categoryName] ?? 'computer';
        
        // Si hay palabras clave relevantes, usarlas
        if (!empty($keywords)) {
            $keyword = str_replace(' ', '-', $keywords[0]);
            return $keyword;
        }
        
        // Intentar extraer marca o modelo del nombre
        $nameLower = strtolower($productName);
        $brands = ['hp', 'dell', 'lenovo', 'asus', 'acer', 'msi', 'apple', 'samsung', 'lg', 'epson', 'canon', 'brother', 'intel', 'amd', 'nvidia', 'corsair', 'logitech', 'razer', 'kingston', 'western-digital', 'seagate', 'tp-link'];
        
        foreach ($brands as $brand) {
            if (str_contains($nameLower, $brand)) {
                return $baseTerm . '-' . $brand;
            }
        }
        
        return $baseTerm;
    }
}
