@extends('layouts.app')

@section('title', 'Compunexo Tecnologías - Tu tienda de tecnología')

@section('content')
<!-- Hero Banner -->
<section class="hero-gradient text-white py-20 lg:py-32 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="container mx-auto px-4 lg:px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                ¡NUEVO INGRESO!
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-green-100">
                Los mejores productos tecnológicos al mejor precio
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}" class="btn-primary inline-flex items-center justify-center space-x-2">
                    <span>Ver Productos</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <a href="#categorias" class="btn-secondary inline-flex items-center justify-center space-x-2 bg-white text-green-600 border-white">
                    <span>Explorar Categorías</span>
                </a>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#FDFDFC"/>
        </svg>
    </div>
</section>

<div class="container mx-auto px-4 lg:px-6 py-12 lg:py-16">
    <!-- Categorías -->
    @if($categories->count() > 0)
    <section id="categorias" class="mb-20">
        <div class="text-center mb-12">
            <h2 class="section-title mb-4">Nuestras Categorías</h2>
            <p class="text-gray-600 text-lg">Encuentra lo que buscas en nuestras categorías</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-4 lg:gap-6">
            @foreach($categories as $category)
            <a href="{{ route('products.category', $category->slug) }}" class="group">
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-green-200 text-center">
                    @if($category->image)
                        <div class="w-16 h-16 mx-auto mb-4 rounded-lg overflow-hidden bg-gray-50 group-hover:scale-110 transition-transform duration-300">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-3xl">📦</span>
                        </div>
                    @endif
                    <p class="text-sm font-semibold text-gray-800 group-hover:text-green-600 transition-colors">{{ $category->name }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Productos Destacados -->
    @if($featuredProducts->count() > 0)
    <section class="mb-20">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-12 gap-4">
            <div>
                <h2 class="section-title mb-2">Productos Destacados</h2>
                <p class="text-gray-600">Los productos más populares de nuestra tienda</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-green-600 hover:text-green-700 font-semibold inline-flex items-center space-x-2 transition-colors">
                <span>Ver todos</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
            @foreach($featuredProducts as $product)
            <div class="product-card">
                <a href="{{ route('products.show', $product->slug) }}">
                    <div class="relative overflow-hidden bg-gray-100">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <span class="text-6xl">🖥️</span>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3 flex flex-col gap-2">
                            @if($product->has_discount)
                                <span class="badge badge-danger">
                                    -{{ $product->discount_percentage }}%
                                </span>
                            @endif
                            @if($product->is_featured)
                                <span class="badge badge-success">
                                    ⭐ Destacado
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="mb-2">
                            @if($product->brand)
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">{{ $product->brand->name }}</p>
                            @endif
                            <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2 min-h-[3.5rem]">{{ $product->name }}</h3>
                        </div>
                        <div class="mb-4">
                            <div class="flex items-baseline gap-2">
                                <p class="text-2xl font-bold text-green-600">S/{{ number_format($product->price, 2) }}</p>
                                @if($product->compare_price)
                                    <p class="text-sm text-gray-400 line-through">S/{{ number_format($product->compare_price, 2) }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="mb-4">
                            <span class="text-sm text-gray-600">
                                Stock: 
                                @if($product->stock > 10)
                                    <span class="badge badge-success">>10 disponibles</span>
                                @elseif($product->stock > 0)
                                    <span class="badge badge-warning">{{ $product->stock }} disponibles</span>
                                @else
                                    <span class="badge badge-danger">Agotado</span>
                                @endif
                            </span>
                        </div>
                        <button class="btn-primary w-full text-center">
                            Ver Detalles →
                        </button>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Últimos Productos -->
    @if($latestProducts->count() > 0)
    <section class="mb-20">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-12 gap-4">
            <div>
                <h2 class="section-title mb-2">Últimos Productos</h2>
                <p class="text-gray-600">Recién llegados a nuestra tienda</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-green-600 hover:text-green-700 font-semibold inline-flex items-center space-x-2 transition-colors">
                <span>Ver todos</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
            @foreach($latestProducts as $product)
            <div class="product-card">
                <a href="{{ route('products.show', $product->slug) }}">
                    <div class="relative overflow-hidden bg-gray-100">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <span class="text-6xl">🖥️</span>
                            </div>
                        @endif
                        @if($product->has_discount)
                            <span class="absolute top-3 right-3 badge badge-danger">
                                -{{ $product->discount_percentage }}%
                            </span>
                        @endif
                    </div>
                    <div class="p-5">
                        <div class="mb-2">
                            @if($product->brand)
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">{{ $product->brand->name }}</p>
                            @endif
                            <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2 min-h-[3.5rem]">{{ $product->name }}</h3>
                        </div>
                        <div class="mb-4">
                            <div class="flex items-baseline gap-2">
                                <p class="text-2xl font-bold text-green-600">S/{{ number_format($product->price, 2) }}</p>
                                @if($product->compare_price)
                                    <p class="text-sm text-gray-400 line-through">S/{{ number_format($product->compare_price, 2) }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="mb-4">
                            <span class="text-sm text-gray-600">
                                Stock: 
                                @if($product->stock > 10)
                                    <span class="badge badge-success">>10 disponibles</span>
                                @elseif($product->stock > 0)
                                    <span class="badge badge-warning">{{ $product->stock }} disponibles</span>
                                @else
                                    <span class="badge badge-danger">Agotado</span>
                                @endif
                            </span>
                        </div>
                        <button class="btn-primary w-full text-center">
                            Ver Detalles →
                        </button>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Marcas -->
    @if($brands->count() > 0)
    <section class="mb-20">
        <div class="text-center mb-12">
            <h2 class="section-title mb-4">Nuestras Marcas</h2>
            <p class="text-gray-600 text-lg">Trabajamos con las mejores marcas del mercado</p>
        </div>
        <div class="bg-white rounded-2xl p-8 lg:p-12 shadow-lg border border-gray-100">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 lg:gap-8">
                @foreach($brands as $brand)
                <div class="flex items-center justify-center p-4 bg-gray-50 rounded-xl hover:bg-green-50 transition-colors border border-gray-100 hover:border-green-200">
                    @if($brand->logo)
                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="h-12 w-auto object-contain max-w-full">
                    @else
                        <p class="font-bold text-gray-700 text-center">{{ $brand->name }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Call to Action -->
    <section class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-8 lg:p-12 text-white text-center mb-20">
        <h2 class="text-3xl lg:text-4xl font-bold mb-4">¿Buscas algo específico?</h2>
        <p class="text-lg text-green-100 mb-8 max-w-2xl mx-auto">
            Explora nuestro catálogo completo y encuentra exactamente lo que necesitas
        </p>
        <a href="{{ route('products.index') }}" class="btn-primary bg-white text-green-600 hover:bg-gray-100 inline-flex items-center space-x-2">
            <span>Ver Catálogo Completo</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
        </a>
    </section>
</div>
@endsection
