@extends('layouts.app')

@section('title', $category->name . ' - Compunexo Tecnologías')

@section('content')
<div class="bg-gray-50 py-8">
    <div class="container mx-auto px-4 lg:px-6">
        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-600 mb-6">
            <a href="{{ route('home') }}" class="hover:text-red-600">Inicio</a> / 
            <a href="{{ route('products.index') }}" class="hover:text-red-600">Productos</a> / 
            <span class="text-gray-900">{{ $category->name }}</span>
        </nav>

        <!-- Header de Categoría -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="section-title mb-2">{{ $category->name }}</h1>
                    @if($category->description)
                        <p class="text-gray-600 text-lg">{{ $category->description }}</p>
                    @endif
                </div>
                <div class="text-sm text-gray-600">
                    {{ $products->total() }} productos encontrados
                </div>
            </div>
        </div>

        @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
            @foreach($products as $product)
            <div class="product-card">
                <a href="{{ route('products.show', $product->slug) }}">
                    <div class="relative overflow-hidden bg-gray-100">
                        @if($product->image)
                            @php
                                $imageUrl = (str_starts_with($product->image, 'http://') || str_starts_with($product->image, 'https://')) 
                                    ? $product->image 
                                    : asset('storage/' . $product->image);
                            @endphp
                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full h-64 object-cover" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'800\' height=\'600\'%3E%3Crect fill=\'%23DC2626\' width=\'800\' height=\'600\'/%3E%3Ctext fill=\'%23FFFFFF\' font-family=\'Arial\' font-size=\'24\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dominant-baseline=\'middle\'%3E{{ $product->name }}%3C/text%3E%3C/svg%3E'">
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
                                <p class="text-2xl font-bold text-red-600">S/{{ number_format($product->price, 2) }}</p>
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
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No hay productos en esta categoría</h3>
                <p class="text-gray-600 mb-6">Pronto agregaremos más productos</p>
                <a href="{{ route('products.index') }}" class="btn-primary inline-block">
                    Ver todos los productos
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection



