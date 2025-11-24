@extends('layouts.app')

@section('title', $product->name . ' - Compunexo Tecnologías')

@section('content')
<div class="bg-gray-50 py-8">
    <div class="container mx-auto px-4 lg:px-6">
        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-600 mb-6">
            <a href="{{ route('home') }}" class="hover:text-green-600">Inicio</a> / 
            @if($product->category)
                <a href="{{ route('products.category', $product->category->slug) }}" class="hover:text-green-600">{{ $product->category->name }}</a> / 
            @endif
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 mb-12">
            <!-- Imágenes -->
            <div>
                <div class="bg-white rounded-xl shadow-lg p-6 mb-4 sticky top-24">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-contain">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center rounded-lg">
                            <span class="text-8xl">🖥️</span>
                        </div>
                    @endif
                </div>
                @if($product->gallery && count($product->gallery) > 0)
                <div class="grid grid-cols-4 gap-3">
                    @foreach($product->gallery as $image)
                    <div class="bg-white rounded-lg shadow-md p-2 cursor-pointer hover:shadow-lg transition-shadow border-2 border-transparent hover:border-green-500">
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" class="w-full h-20 object-cover rounded">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Información del Producto -->
            <div>
                <div class="bg-white rounded-xl shadow-lg p-8">
                    @if($product->brand)
                        <div class="mb-4">
                            <span class="text-sm text-gray-500 uppercase tracking-wide">Marca:</span>
                            <span class="ml-2 font-semibold text-gray-900">{{ $product->brand->name }}</span>
                        </div>
                    @endif

                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                    @if($product->sku)
                        <p class="text-sm text-gray-500 mb-6">SKU: <span class="font-mono">{{ $product->sku }}</span></p>
                    @endif

                    <!-- Precio -->
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        @if($product->has_discount)
                            <div class="flex items-center gap-4 mb-3">
                                <span class="text-4xl font-bold text-green-600">S/{{ number_format($product->price, 2) }}</span>
                                <span class="text-2xl text-gray-400 line-through">S/{{ number_format($product->compare_price, 2) }}</span>
                                <span class="badge badge-danger text-base px-4 py-2">
                                    -{{ $product->discount_percentage }}% OFF
                                </span>
                            </div>
                            <p class="text-sm text-gray-600">Ahorras S/{{ number_format($product->compare_price - $product->price, 2) }}</p>
                        @else
                            <span class="text-4xl font-bold text-green-600">S/{{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>

                    <!-- Stock -->
                    <div class="mb-6">
                        <p class="text-lg mb-2">
                            <span class="font-semibold text-gray-700">Disponibilidad:</span>
                            @if($product->stock > 10)
                                <span class="badge badge-success text-base ml-2">>10 unidades disponibles</span>
                            @elseif($product->stock > 0)
                                <span class="badge badge-warning text-base ml-2">{{ $product->stock }} unidades disponibles</span>
                            @else
                                <span class="badge badge-danger text-base ml-2">Agotado</span>
                            @endif
                        </p>
                    </div>

                    @if($product->short_description)
                    <div class="mb-6 p-4 bg-green-50 rounded-lg border border-green-100">
                        <p class="text-gray-700 leading-relaxed">{{ $product->short_description }}</p>
                    </div>
                    @endif

                    <!-- Botones de Acción -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <button class="btn-primary flex-1 text-lg py-4 flex items-center justify-center space-x-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span>Comprar Ahora</span>
                        </button>
                        <button class="btn-secondary flex-1 text-lg py-4 flex items-center justify-center space-x-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>Agregar al Carrito</span>
                        </button>
                    </div>

                    <!-- Información Adicional -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">Envío Gratis</p>
                                    <p class="text-sm text-gray-600">En compras mayores a S/200</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">Garantía</p>
                                    <p class="text-sm text-gray-600">1 año de garantía oficial</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">Soporte 24/7</p>
                                    <p class="text-sm text-gray-600">Atención al cliente disponible</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Descripción -->
        @if($product->description)
        <div class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Descripción del Producto</h2>
            <div class="prose max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
        @endif

        <!-- Productos Relacionados -->
        @if($relatedProducts->count() > 0)
        <section>
            <h2 class="section-title mb-8">Productos Relacionados</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                @foreach($relatedProducts as $related)
                <div class="product-card">
                    <a href="{{ route('products.show', $related->slug) }}">
                        <div class="relative overflow-hidden bg-gray-100">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <span class="text-4xl">🖥️</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2">{{ $related->name }}</h3>
                            <p class="text-2xl font-bold text-green-600 mb-4">S/{{ number_format($related->price, 2) }}</p>
                            <button class="btn-primary w-full text-center text-sm py-2">
                                Ver Detalles →
                            </button>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>
@endsection
