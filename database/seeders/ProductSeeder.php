<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear Categorías
        $categories = [
            ['name' => 'Laptops', 'description' => 'Laptops y notebooks para trabajo y gaming', 'order' => 1],
            ['name' => 'Computadoras', 'description' => 'PCs de escritorio y todo-en-uno', 'order' => 2],
            ['name' => 'Impresoras', 'description' => 'Impresoras láser, inkjet y multifuncionales', 'order' => 3],
            ['name' => 'Monitores', 'description' => 'Monitores LED, LCD y gaming', 'order' => 4],
            ['name' => 'Componentes', 'description' => 'Procesadores, tarjetas gráficas, RAM, etc.', 'order' => 5],
            ['name' => 'Accesorios', 'description' => 'Teclados, mouse, audífonos y más', 'order' => 6],
            ['name' => 'Almacenamiento', 'description' => 'Discos duros, SSDs y unidades externas', 'order' => 7],
            ['name' => 'Redes', 'description' => 'Routers, switches y equipos de red', 'order' => 8],
        ];

        $categoryModels = [];
        foreach ($categories as $cat) {
            $categoryModels[$cat['name']] = Category::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'],
                    'is_active' => true,
                    'order' => $cat['order'],
                ]
            );
        }

        // Crear Marcas
        $brands = [
            'HP', 'Dell', 'Lenovo', 'ASUS', 'Acer', 'MSI', 'Apple', 'Samsung',
            'LG', 'Epson', 'Canon', 'Brother', 'Intel', 'AMD', 'NVIDIA',
            'Corsair', 'Logitech', 'Razer', 'Kingston', 'Western Digital', 'Seagate', 'TP-Link'
        ];

        $brandModels = [];
        foreach ($brands as $brandName) {
            $brandModels[$brandName] = Brand::firstOrCreate(
                ['slug' => Str::slug($brandName)],
                [
                    'name' => $brandName,
                    'is_active' => true,
                ]
            );
        }

        // Crear Productos - Laptops
        $laptops = [
            [
                'name' => 'Laptop HP Pavilion 15.6" Intel Core i5 8GB RAM 512GB SSD',
                'description' => 'Laptop HP Pavilion con procesador Intel Core i5 de 11va generación, 8GB de RAM DDR4, almacenamiento SSD de 512GB, pantalla Full HD de 15.6 pulgadas. Perfecta para trabajo y estudio.',
                'short_description' => 'Laptop HP con Intel Core i5, 8GB RAM, 512GB SSD',
                'category' => 'Laptops',
                'brand' => 'HP',
                'price' => 2499.00,
                'compare_price' => 2899.00,
                'sku' => 'HP-PAV-15-I5-001',
                'stock' => 15,
                'is_featured' => true,
            ],
            [
                'name' => 'Laptop Dell Inspiron 15 3000 Intel Core i7 16GB RAM 1TB SSD',
                'description' => 'Laptop Dell Inspiron con procesador Intel Core i7, 16GB de RAM, almacenamiento SSD de 1TB, pantalla Full HD de 15.6 pulgadas. Ideal para profesionales y estudiantes exigentes.',
                'short_description' => 'Laptop Dell con Intel Core i7, 16GB RAM, 1TB SSD',
                'category' => 'Laptops',
                'brand' => 'Dell',
                'price' => 3499.00,
                'compare_price' => 3999.00,
                'sku' => 'DELL-INS-15-I7-001',
                'stock' => 8,
                'is_featured' => true,
            ],
            [
                'name' => 'Laptop ASUS VivoBook 14" AMD Ryzen 5 8GB RAM 256GB SSD',
                'description' => 'Laptop ASUS VivoBook ultraportable con procesador AMD Ryzen 5, 8GB de RAM, SSD de 256GB, pantalla Full HD de 14 pulgadas. Diseño delgado y ligero.',
                'short_description' => 'Laptop ASUS ultraportable con AMD Ryzen 5',
                'category' => 'Laptops',
                'brand' => 'ASUS',
                'price' => 2199.00,
                'compare_price' => null,
                'sku' => 'ASUS-VIV-14-R5-001',
                'stock' => 12,
                'is_featured' => false,
            ],
            [
                'name' => 'Laptop Lenovo ThinkPad E14 Intel Core i5 8GB RAM 256GB SSD',
                'description' => 'Laptop Lenovo ThinkPad E14 con procesador Intel Core i5, 8GB de RAM, SSD de 256GB, pantalla de 14 pulgadas. Diseñada para profesionales que buscan confiabilidad.',
                'short_description' => 'Laptop Lenovo ThinkPad para profesionales',
                'category' => 'Laptops',
                'brand' => 'Lenovo',
                'price' => 2699.00,
                'compare_price' => 2999.00,
                'sku' => 'LEN-THP-E14-I5-001',
                'stock' => 10,
                'is_featured' => false,
            ],
            [
                'name' => 'Laptop Gaming MSI Katana GF66 Intel Core i7 RTX 3050 16GB RAM 512GB SSD',
                'description' => 'Laptop Gaming MSI Katana con procesador Intel Core i7, tarjeta gráfica NVIDIA RTX 3050, 16GB de RAM, SSD de 512GB, pantalla Full HD de 15.6 pulgadas 144Hz. Potencia para gaming.',
                'short_description' => 'Laptop Gaming MSI con RTX 3050, 16GB RAM',
                'category' => 'Laptops',
                'brand' => 'MSI',
                'price' => 5499.00,
                'compare_price' => 5999.00,
                'sku' => 'MSI-KAT-GF66-001',
                'stock' => 5,
                'is_featured' => true,
            ],
        ];

        // Crear Productos - Computadoras
        $computers = [
            [
                'name' => 'PC Gamer AMD Ryzen 5 5600X RTX 3060 16GB RAM 1TB SSD',
                'description' => 'PC Gamer completa con procesador AMD Ryzen 5 5600X, tarjeta gráfica NVIDIA RTX 3060, 16GB de RAM DDR4, SSD de 1TB, fuente de poder 650W 80 Plus Bronze, gabinete con RGB.',
                'short_description' => 'PC Gamer con AMD Ryzen 5 y RTX 3060',
                'category' => 'Computadoras',
                'brand' => 'AMD',
                'price' => 4999.00,
                'compare_price' => 5499.00,
                'sku' => 'PC-GAM-R5-3060-001',
                'stock' => 6,
                'is_featured' => true,
            ],
            [
                'name' => 'PC de Escritorio Intel Core i5 8GB RAM 256GB SSD',
                'description' => 'PC de escritorio para oficina y hogar con procesador Intel Core i5, 8GB de RAM, SSD de 256GB, Windows 11 incluido. Ideal para trabajo y uso doméstico.',
                'short_description' => 'PC de escritorio Intel Core i5 para oficina',
                'category' => 'Computadoras',
                'brand' => 'Intel',
                'price' => 1999.00,
                'compare_price' => null,
                'sku' => 'PC-OFF-I5-001',
                'stock' => 20,
                'is_featured' => false,
            ],
            [
                'name' => 'PC Todo-en-Uno HP 24" Intel Core i3 8GB RAM 256GB SSD',
                'description' => 'PC Todo-en-Uno HP con pantalla táctil de 24 pulgadas, procesador Intel Core i3, 8GB de RAM, SSD de 256GB. Diseño elegante y compacto.',
                'short_description' => 'PC Todo-en-Uno HP 24" táctil',
                'category' => 'Computadoras',
                'brand' => 'HP',
                'price' => 2499.00,
                'compare_price' => 2799.00,
                'sku' => 'HP-AIO-24-I3-001',
                'stock' => 8,
                'is_featured' => false,
            ],
        ];

        // Crear Productos - Impresoras
        $printers = [
            [
                'name' => 'Impresora HP LaserJet Pro M404dn Láser Monocromática',
                'description' => 'Impresora láser HP LaserJet Pro M404dn, impresión monocromática, velocidad de hasta 38 ppm, conectividad USB y Ethernet, ideal para oficinas pequeñas.',
                'short_description' => 'Impresora láser HP para oficina',
                'category' => 'Impresoras',
                'brand' => 'HP',
                'price' => 899.00,
                'compare_price' => 1099.00,
                'sku' => 'HP-LJ-M404-001',
                'stock' => 15,
                'is_featured' => false,
            ],
            [
                'name' => 'Impresora Multifuncional Epson EcoTank L325 WiFi',
                'description' => 'Impresora multifuncional Epson EcoTank L325 con sistema de tanques de tinta, impresión, escaneo y copia, conectividad WiFi, ideal para hogar y pequeña oficina.',
                'short_description' => 'Impresora Epson EcoTank multifuncional WiFi',
                'category' => 'Impresoras',
                'brand' => 'Epson',
                'price' => 1299.00,
                'compare_price' => null,
                'sku' => 'EPS-ET-L325-001',
                'stock' => 12,
                'is_featured' => true,
            ],
            [
                'name' => 'Impresora Canon PIXMA G3110 Multifuncional WiFi',
                'description' => 'Impresora multifuncional Canon PIXMA G3110 con sistema de tanques de tinta, impresión, escaneo y copia, conectividad WiFi, bajo costo por página.',
                'short_description' => 'Impresora Canon PIXMA multifuncional',
                'category' => 'Impresoras',
                'brand' => 'Canon',
                'price' => 799.00,
                'compare_price' => 999.00,
                'sku' => 'CAN-PIX-G3110-001',
                'stock' => 18,
                'is_featured' => false,
            ],
        ];

        // Crear Productos - Monitores
        $monitors = [
            [
                'name' => 'Monitor LG 24" Full HD IPS 75Hz',
                'description' => 'Monitor LG de 24 pulgadas, resolución Full HD 1920x1080, panel IPS, frecuencia de actualización 75Hz, tiempo de respuesta 5ms, ideal para trabajo y entretenimiento.',
                'short_description' => 'Monitor LG 24" Full HD IPS',
                'category' => 'Monitores',
                'brand' => 'LG',
                'price' => 599.00,
                'compare_price' => 699.00,
                'sku' => 'LG-MON-24-001',
                'stock' => 25,
                'is_featured' => false,
            ],
            [
                'name' => 'Monitor ASUS VG248QE 24" Full HD 144Hz Gaming',
                'description' => 'Monitor ASUS VG248QE de 24 pulgadas, resolución Full HD, frecuencia de actualización 144Hz, tiempo de respuesta 1ms, ideal para gaming competitivo.',
                'short_description' => 'Monitor ASUS Gaming 24" 144Hz',
                'category' => 'Monitores',
                'brand' => 'ASUS',
                'price' => 899.00,
                'compare_price' => 1099.00,
                'sku' => 'ASUS-VG-24-001',
                'stock' => 10,
                'is_featured' => true,
            ],
            [
                'name' => 'Monitor Samsung 27" QHD IPS 75Hz',
                'description' => 'Monitor Samsung de 27 pulgadas, resolución QHD 2560x1440, panel IPS, frecuencia de actualización 75Hz, diseño sin bordes, ideal para productividad.',
                'short_description' => 'Monitor Samsung 27" QHD IPS',
                'category' => 'Monitores',
                'brand' => 'Samsung',
                'price' => 1299.00,
                'compare_price' => null,
                'sku' => 'SAM-MON-27-001',
                'stock' => 8,
                'is_featured' => false,
            ],
        ];

        // Crear Productos - Componentes
        $components = [
            [
                'name' => 'Procesador Intel Core i7-12700K 12va Generación',
                'description' => 'Procesador Intel Core i7-12700K de 12va generación, 12 núcleos (8P+4E), 20 hilos, frecuencia base 3.6GHz, turbo hasta 5.0GHz, socket LGA1700, sin cooler incluido.',
                'short_description' => 'Procesador Intel Core i7-12700K',
                'category' => 'Componentes',
                'brand' => 'Intel',
                'price' => 1899.00,
                'compare_price' => 2099.00,
                'sku' => 'INT-I7-12700K-001',
                'stock' => 12,
                'is_featured' => true,
            ],
            [
                'name' => 'Procesador AMD Ryzen 7 5800X 8 Núcleos',
                'description' => 'Procesador AMD Ryzen 7 5800X, 8 núcleos, 16 hilos, frecuencia base 3.8GHz, turbo hasta 4.7GHz, socket AM4, sin cooler incluido, ideal para gaming y productividad.',
                'short_description' => 'Procesador AMD Ryzen 7 5800X',
                'category' => 'Componentes',
                'brand' => 'AMD',
                'price' => 1699.00,
                'compare_price' => null,
                'sku' => 'AMD-R7-5800X-001',
                'stock' => 15,
                'is_featured' => true,
            ],
            [
                'name' => 'Tarjeta Gráfica NVIDIA GeForce RTX 4060 8GB',
                'description' => 'Tarjeta gráfica NVIDIA GeForce RTX 4060 con 8GB de memoria GDDR6, arquitectura Ada Lovelace, soporte para ray tracing y DLSS 3, ideal para gaming en 1080p y 1440p.',
                'short_description' => 'Tarjeta gráfica NVIDIA RTX 4060 8GB',
                'category' => 'Componentes',
                'brand' => 'NVIDIA',
                'price' => 2499.00,
                'compare_price' => 2799.00,
                'sku' => 'NVD-RTX-4060-001',
                'stock' => 8,
                'is_featured' => true,
            ],
            [
                'name' => 'Memoria RAM Corsair Vengeance 16GB DDR4 3200MHz',
                'description' => 'Kit de memoria RAM Corsair Vengeance de 16GB (2x8GB), DDR4, frecuencia 3200MHz, latencia CL16, disipador de calor, compatible con Intel y AMD.',
                'short_description' => 'RAM Corsair 16GB DDR4 3200MHz',
                'category' => 'Componentes',
                'brand' => 'Corsair',
                'price' => 299.00,
                'compare_price' => 349.00,
                'sku' => 'COR-RAM-16-3200-001',
                'stock' => 30,
                'is_featured' => false,
            ],
        ];

        // Crear Productos - Accesorios
        $accessories = [
            [
                'name' => 'Teclado Mecánico Logitech G Pro X RGB',
                'description' => 'Teclado mecánico Logitech G Pro X con switches intercambiables, iluminación RGB, diseño compacto, ideal para gaming profesional.',
                'short_description' => 'Teclado mecánico Logitech G Pro X RGB',
                'category' => 'Accesorios',
                'brand' => 'Logitech',
                'price' => 599.00,
                'compare_price' => 699.00,
                'sku' => 'LOG-TEC-GPX-001',
                'stock' => 20,
                'is_featured' => false,
            ],
            [
                'name' => 'Mouse Gaming Razer DeathAdder V3',
                'description' => 'Mouse gaming Razer DeathAdder V3 con sensor óptico de 30,000 DPI, diseño ergonómico, 5 botones programables, cable flexible, ideal para gaming.',
                'short_description' => 'Mouse gaming Razer DeathAdder V3',
                'category' => 'Accesorios',
                'brand' => 'Razer',
                'price' => 399.00,
                'compare_price' => null,
                'sku' => 'RAZ-MOU-DAV3-001',
                'stock' => 25,
                'is_featured' => false,
            ],
            [
                'name' => 'Audífonos Logitech G733 Lightspeed Inalámbricos',
                'description' => 'Audífonos gaming Logitech G733 Lightspeed inalámbricos, sonido surround 7.1, iluminación RGB, batería de hasta 29 horas, micrófono desmontable.',
                'short_description' => 'Audífonos gaming Logitech G733 inalámbricos',
                'category' => 'Accesorios',
                'brand' => 'Logitech',
                'price' => 799.00,
                'compare_price' => 899.00,
                'sku' => 'LOG-AUD-G733-001',
                'stock' => 15,
                'is_featured' => true,
            ],
        ];

        // Crear Productos - Almacenamiento
        $storage = [
            [
                'name' => 'SSD Kingston NV2 1TB M.2 NVMe PCIe 4.0',
                'description' => 'SSD Kingston NV2 de 1TB, formato M.2, interfaz NVMe PCIe 4.0, velocidades de lectura hasta 3500MB/s y escritura hasta 2100MB/s, ideal para gaming y productividad.',
                'short_description' => 'SSD Kingston NV2 1TB M.2 NVMe',
                'category' => 'Almacenamiento',
                'brand' => 'Kingston',
                'price' => 399.00,
                'compare_price' => 449.00,
                'sku' => 'KIN-SSD-NV2-1TB-001',
                'stock' => 35,
                'is_featured' => false,
            ],
            [
                'name' => 'Disco Duro Externo Western Digital 2TB USB 3.0',
                'description' => 'Disco duro externo Western Digital de 2TB, interfaz USB 3.0, diseño compacto y portátil, compatible con PC y Mac, ideal para respaldos y almacenamiento.',
                'short_description' => 'Disco duro externo WD 2TB USB 3.0',
                'category' => 'Almacenamiento',
                'brand' => 'Western Digital',
                'price' => 299.00,
                'compare_price' => null,
                'sku' => 'WD-HDD-EXT-2TB-001',
                'stock' => 40,
                'is_featured' => false,
            ],
            [
                'name' => 'SSD Seagate BarraCuda 500GB SATA III',
                'description' => 'SSD Seagate BarraCuda de 500GB, interfaz SATA III 2.5", velocidades de lectura hasta 560MB/s y escritura hasta 540MB/s, ideal para actualizar laptops y PCs antiguas.',
                'short_description' => 'SSD Seagate BarraCuda 500GB SATA',
                'category' => 'Almacenamiento',
                'brand' => 'Seagate',
                'price' => 199.00,
                'compare_price' => 249.00,
                'sku' => 'SEA-SSD-500-001',
                'stock' => 50,
                'is_featured' => false,
            ],
        ];

        // Más productos - Laptops
        $laptops = array_merge($laptops, [
            [
                'name' => 'Laptop Acer Aspire 5 Intel Core i3 8GB RAM 256GB SSD',
                'description' => 'Laptop Acer Aspire 5 con procesador Intel Core i3, 8GB de RAM, SSD de 256GB, pantalla Full HD de 15.6 pulgadas. Excelente relación calidad-precio.',
                'short_description' => 'Laptop Acer Aspire 5 Intel Core i3',
                'category' => 'Laptops',
                'brand' => 'Acer',
                'price' => 1799.00,
                'compare_price' => null,
                'sku' => 'ACR-ASP-5-I3-001',
                'stock' => 18,
                'is_featured' => false,
            ],
            [
                'name' => 'Laptop Apple MacBook Air M2 13" 8GB RAM 256GB SSD',
                'description' => 'Laptop Apple MacBook Air con chip M2, 8GB de RAM unificada, SSD de 256GB, pantalla Retina de 13.3 pulgadas, diseño ultra delgado, batería de hasta 18 horas.',
                'short_description' => 'MacBook Air M2 13" 8GB 256GB',
                'category' => 'Laptops',
                'brand' => 'Apple',
                'price' => 6999.00,
                'compare_price' => 7499.00,
                'sku' => 'APP-MBA-M2-001',
                'stock' => 4,
                'is_featured' => true,
            ],
        ]);

        // Más productos - Impresoras
        $printers = array_merge($printers, [
            [
                'name' => 'Impresora Brother HL-L2350DW Láser Monocromática WiFi',
                'description' => 'Impresora láser Brother HL-L2350DW, impresión monocromática, velocidad de hasta 32 ppm, conectividad WiFi y USB, ideal para oficina en casa.',
                'short_description' => 'Impresora láser Brother WiFi',
                'category' => 'Impresoras',
                'brand' => 'Brother',
                'price' => 799.00,
                'compare_price' => null,
                'sku' => 'BRO-HL-L2350-001',
                'stock' => 14,
                'is_featured' => false,
            ],
        ]);

        // Más productos - Monitores
        $monitors = array_merge($monitors, [
            [
                'name' => 'Monitor Dell UltraSharp 27" 4K UHD IPS',
                'description' => 'Monitor Dell UltraSharp de 27 pulgadas, resolución 4K UHD 3840x2160, panel IPS, 99% sRGB, diseño sin bordes, ideal para diseño y edición.',
                'short_description' => 'Monitor Dell 27" 4K UHD IPS',
                'category' => 'Monitores',
                'brand' => 'Dell',
                'price' => 2499.00,
                'compare_price' => 2799.00,
                'sku' => 'DELL-ULT-27-4K-001',
                'stock' => 6,
                'is_featured' => true,
            ],
        ]);

        // Más productos - Componentes
        $components = array_merge($components, [
            [
                'name' => 'Tarjeta Gráfica AMD Radeon RX 7600 8GB',
                'description' => 'Tarjeta gráfica AMD Radeon RX 7600 con 8GB de memoria GDDR6, arquitectura RDNA 3, soporte para ray tracing, ideal para gaming en 1080p y 1440p.',
                'short_description' => 'Tarjeta gráfica AMD RX 7600 8GB',
                'category' => 'Componentes',
                'brand' => 'AMD',
                'price' => 2199.00,
                'compare_price' => 2399.00,
                'sku' => 'AMD-RX-7600-001',
                'stock' => 10,
                'is_featured' => false,
            ],
            [
                'name' => 'Memoria RAM Kingston Fury 32GB DDR4 3200MHz',
                'description' => 'Kit de memoria RAM Kingston Fury de 32GB (2x16GB), DDR4, frecuencia 3200MHz, latencia CL16, disipador de calor RGB, compatible con Intel y AMD.',
                'short_description' => 'RAM Kingston 32GB DDR4 3200MHz RGB',
                'category' => 'Componentes',
                'brand' => 'Kingston',
                'price' => 599.00,
                'compare_price' => null,
                'sku' => 'KIN-RAM-32-3200-001',
                'stock' => 20,
                'is_featured' => false,
            ],
        ]);

        // Más productos - Accesorios
        $accessories = array_merge($accessories, [
            [
                'name' => 'Teclado y Mouse Inalámbricos Logitech MK270',
                'description' => 'Combo teclado y mouse inalámbricos Logitech MK270, alcance de hasta 10 metros, batería de larga duración, diseño ergonómico, ideal para oficina.',
                'short_description' => 'Combo teclado y mouse Logitech inalámbrico',
                'category' => 'Accesorios',
                'brand' => 'Logitech',
                'price' => 149.00,
                'compare_price' => 199.00,
                'sku' => 'LOG-COM-MK270-001',
                'stock' => 45,
                'is_featured' => false,
            ],
            [
                'name' => 'Webcam Logitech C920 HD Pro 1080p',
                'description' => 'Webcam Logitech C920 HD Pro con resolución Full HD 1080p, micrófono estéreo integrado, enfoque automático, ideal para videollamadas y streaming.',
                'short_description' => 'Webcam Logitech C920 HD 1080p',
                'category' => 'Accesorios',
                'brand' => 'Logitech',
                'price' => 399.00,
                'compare_price' => null,
                'sku' => 'LOG-WEB-C920-001',
                'stock' => 22,
                'is_featured' => false,
            ],
        ]);

        // Más productos - Almacenamiento
        $storage = array_merge($storage, [
            [
                'name' => 'SSD Samsung 980 PRO 1TB M.2 NVMe PCIe 4.0',
                'description' => 'SSD Samsung 980 PRO de 1TB, formato M.2, interfaz NVMe PCIe 4.0, velocidades de lectura hasta 7000MB/s y escritura hasta 5000MB/s, ideal para gaming y profesionales.',
                'short_description' => 'SSD Samsung 980 PRO 1TB PCIe 4.0',
                'category' => 'Almacenamiento',
                'brand' => 'Samsung',
                'price' => 599.00,
                'compare_price' => 699.00,
                'sku' => 'SAM-SSD-980-1TB-001',
                'stock' => 15,
                'is_featured' => true,
            ],
        ]);

        // Productos - Redes
        $networking = [
            [
                'name' => 'Router WiFi 6 ASUS RT-AX3000 Dual Band',
                'description' => 'Router WiFi 6 ASUS RT-AX3000 con tecnología AX3000, banda dual 2.4GHz y 5GHz, velocidad hasta 3000Mbps, cobertura amplia, ideal para hogares y oficinas pequeñas.',
                'short_description' => 'Router WiFi 6 ASUS RT-AX3000',
                'category' => 'Redes',
                'brand' => 'ASUS',
                'price' => 899.00,
                'compare_price' => 1099.00,
                'sku' => 'ASUS-ROU-AX3000-001',
                'stock' => 12,
                'is_featured' => false,
            ],
            [
                'name' => 'Switch TP-Link TL-SG108 8 Puertos Gigabit',
                'description' => 'Switch TP-Link TL-SG108 de 8 puertos Gigabit, velocidad de hasta 1000Mbps por puerto, diseño compacto, plug and play, ideal para redes domésticas y pequeñas oficinas.',
                'short_description' => 'Switch TP-Link 8 puertos Gigabit',
                'category' => 'Redes',
                'brand' => 'TP-Link',
                'price' => 199.00,
                'compare_price' => null,
                'sku' => 'TPL-SWI-8-001',
                'stock' => 30,
                'is_featured' => false,
            ],
        ];

        // Combinar todos los productos
        $allProducts = array_merge($laptops, $computers, $printers, $monitors, $components, $accessories, $storage, $networking);

        // Crear productos en la base de datos
        foreach ($allProducts as $productData) {
            Product::firstOrCreate(
                ['sku' => $productData['sku']],
                [
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => $productData['description'],
                'short_description' => $productData['short_description'],
                'category_id' => $categoryModels[$productData['category']]->id,
                'brand_id' => $brandModels[$productData['brand']]->id,
                'price' => $productData['price'],
                'compare_price' => $productData['compare_price'] ?? null,
                'sku' => $productData['sku'],
                'stock' => $productData['stock'],
                'is_featured' => $productData['is_featured'] ?? false,
                'is_active' => true,
                ]
            );
        }

        $this->command->info('✅ Categorías, marcas y productos creados exitosamente!');
    }
}
