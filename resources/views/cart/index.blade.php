@extends('layouts.app')

@section('title', 'Carrito de Compras - Compunexo Tecnologías')

@section('content')
<div class="bg-gray-50 py-10">
    <div class="container mx-auto px-4 lg:px-6">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-900">Carrito de Compras</h1>
            <a href="{{ route('products.index') }}" class="text-red-600 hover:underline">← Seguir comprando</a>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if(empty($cart))
            <div class="bg-white p-10 rounded-xl shadow-lg text-center">
                <p class="text-xl text-gray-600 mb-6">Tu carrito está vacío.</p>
                <a href="{{ route('products.index') }}" class="btn-primary inline-flex items-center">
                    Explorar productos
                </a>
            </div>
        @else

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-4">
                @foreach($cart as $item)
                    <div class="bg-white rounded-xl shadow-md p-5 flex flex-col sm:flex-row gap-4">
                        <div class="w-full sm:w-32 h-32 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                            @if($item['image'])
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="object-contain w-full h-full">
                            @else
                                <span class="text-4xl">🛒</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start gap-3">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900">
                                        <a href="{{ route('products.show', $item['slug']) }}" class="hover:text-red-600">
                                            {{ $item['name'] }}
                                        </a>
                                    </h2>
                                    <p class="text-sm text-gray-500">Precio: S/{{ number_format($item['price'], 2) }}</p>
                                </div>
                                <form method="POST" action="{{ route('cart.remove', $item['slug']) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Eliminar</button>
                                </form>
                            </div>

                            <div class="mt-4 flex flex-col sm:flex-row gap-4 items-center">
                                <form method="POST" action="{{ route('cart.update', $item['slug']) }}" class="flex items-center space-x-2">
                                    @csrf
                                    @method('PATCH')
                                    <label for="qty-{{ $item['product_id'] }}" class="text-sm text-gray-600">Cantidad</label>
                                    <input id="qty-{{ $item['product_id'] }}" type="number" name="quantity" min="1" max="{{ $item['stock'] }}"
                                           value="{{ $item['quantity'] }}"
                                           class="w-20 border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500">
                                    <button type="submit" class="btn-secondary text-sm px-4">Actualizar</button>
                                </form>
                                <p class="ml-auto text-lg font-semibold text-gray-900">
                                    Total: S/{{ number_format($item['price'] * $item['quantity'], 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div>
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Resumen</h3>
                    <div class="space-y-3 text-gray-700">
                        <div class="flex justify-between">
                            <span>Productos ({{ $summary['items'] }})</span>
                            <span>S/{{ number_format($summary['subtotal'], 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Envío</span>
                            <span class="text-green-600 font-semibold">Gratis</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between text-lg font-bold text-gray-900">
                            <span>Total</span>
                            <span>S/{{ number_format($summary['subtotal'], 2) }}</span>
                        </div>
                    </div>

                    <button class="btn-primary w-full mt-6 py-3 text-lg">
                        Proceder al pago
                    </button>
                    <p class="text-xs text-gray-500 mt-3 text-center">
                        * El pago se completará en el paso siguiente. Aún no realizamos cobros en línea.
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

