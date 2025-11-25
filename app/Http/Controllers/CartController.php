<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Mostrar el carrito actual.
     */
    public function index(): View
    {
        $cart = session('cart', []);

        $summary = [
            'items' => array_sum(array_column($cart, 'quantity')),
            'subtotal' => array_reduce($cart, fn ($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0),
        ];

        return view('cart.index', compact('cart', 'summary'));
    }

    /**
     * Agregar un producto al carrito.
     */
    public function add(Request $request, Product $product): RedirectResponse
    {
        $quantity = max(1, (int) $request->input('quantity', 1));

        $this->addProductToCart($product, $quantity);

        return redirect()
            ->back()
            ->with('success', 'Producto agregado al carrito correctamente.');
    }

    /**
     * Comprar ahora: limpia el carrito y redirige al resumen.
     */
    public function buyNow(Request $request, Product $product): RedirectResponse
    {
        session()->forget('cart');
        $this->addProductToCart($product, max(1, (int) $request->input('quantity', 1)));

        return redirect()
            ->route('cart.index')
            ->with('success', 'Producto agregado. Completa tu compra.');
    }

    /**
     * Actualizar cantidad de un producto.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $quantity = max(1, (int) $request->input('quantity', 1));
        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Cantidad actualizada.');
    }

    /**
     * Eliminar un producto del carrito.
     */
    public function remove(Product $product): RedirectResponse
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }

    /**
     * Guardar/actualizar un producto en sesión.
     */
    private function addProductToCart(Product $product, int $quantity): void
    {
        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => (float) $product->price,
                'quantity' => $quantity,
                'image' => $product->image_url,
                'stock' => $product->stock,
            ];
        }

        session()->put('cart', $cart);
    }
}

