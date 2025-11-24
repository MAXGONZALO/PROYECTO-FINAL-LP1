@extends('layouts.app')

@section('title', 'Productos - Compunexo Tecnologías')

@section('content')
<div class="bg-gray-50 py-8">
    <div class="container mx-auto px-4 lg:px-6">
        <!-- Header -->
        <div class="mb-8">
            <nav class="text-sm text-gray-600 mb-4">
                <a href="{{ route('home') }}" class="hover:text-green-600">Inicio</a> / 
                <span class="text-gray-900">Productos</span>
            </nav>
            <h1 class="section-title mb-2">Nuestros Productos</h1>
            <p class="text-gray-600">Encuentra el producto perfecto para ti</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filtros -->
            <aside class="w-full lg:w-72 flex-shrink-0">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                    <h3 class="text-xl font-bold mb-6 text-gray-900">Filtros</h3>
                    
                    <!-- Búsqueda -->
                    <form action="{{ route('products.index') }}" method="GET" class="mb-6">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Buscar productos..." 
                                   class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 text-sm"
                                   value="{{ request('search') }}">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </form>

                    <!-- Categorías -->
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <h4 class="font-semibold mb-4 text-gray-900">Categorías</h4>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('products.index') }}" 
                                   class="block px-3 py-2 rounded-lg transition-colors {{ !request('category') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-green-600' }}">
                                    Todas las categorías
                                </a>
                            </li>
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ route('products.index', ['category' => $category->id]) }}" 
                                   class="block px-3 py-2 rounded-lg transition-colors {{ request('category') == $category->id ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-green-600' }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Marcas -->
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <h4 class="font-semibold mb-4 text-gray-900">Marcas</h4>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('products.index') }}" 
                                   class="block px-3 py-2 rounded-lg transition-colors {{ !request('brand') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-green-600' }}">
                                    Todas las marcas
                                </a>
                            </li>
                            @foreach($brands as $brand)
                            <li>
                                <a href="{{ route('products.index', ['brand' => $brand->id]) }}" 
                                   class="block px-3 py-2 rounded-lg transition-colors {{ request('brand') == $brand->id ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-green-600' }}">
                                    {{ $brand->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Ordenar -->
                    <div>
                        <h4 class="font-semibold mb-4 text-gray-900">Ordenar por</h4>
                        <form id="sort-form" method="GET" action="{{ route('products.index') }}">
                            @foreach(request()->except('sort') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            <select name="sort" onchange="this.form.submit()" 
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 text-sm">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Más recientes</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Precio: menor a mayor</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Precio: mayor a menor</option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nombre A-Z</option>
                            </select>
                        </form>
                    </div>
                </div>
            </aside>

            <!-- Productos -->
            <div class="flex-1">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Resultados</h2>
                        <p class="text-gray-600 text-sm mt-1">{{ $products->total() }} productos encontrados</p>
                    </div>
                </div>

                @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($products as $product)
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

                <!-- Paginación -->
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
                @else
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">No se encontraron productos</h3>
                        <p class="text-gray-600 mb-6">Intenta ajustar tus filtros de búsqueda</p>
                        <a href="{{ route('products.index') }}" class="btn-primary inline-block">
                            Ver todos los productos
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
