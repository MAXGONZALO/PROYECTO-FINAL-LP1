@extends('admin.layout')

@section('title', 'Ver Producto')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Detalles del Producto</h1>
        <div class="flex space-x-4">
            <a href="{{ route('admin.products.edit', $product) }}" class="btn-secondary">
                Editar
            </a>
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Volver
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
            <!-- Imagen -->
            <div>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-contain bg-gray-50 rounded-lg p-4">
                @else
                    <div class="w-full h-96 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center rounded-lg">
                        <span class="text-8xl">🖥️</span>
                    </div>
                @endif
                
                @if($product->gallery && count($product->gallery) > 0)
                <div class="mt-4">
                    <h3 class="font-semibold mb-2">Galería</h3>
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($product->gallery as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Gallery" class="w-full h-20 object-cover rounded border border-gray-200">
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Información -->
            <div>
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h2>
                    
                    <div class="flex items-center space-x-4 mb-4">
                        @if($product->is_active)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-danger">Inactivo</span>
                        @endif
                        @if($product->is_featured)
                            <span class="badge badge-success">Destacado</span>
                        @endif
                    </div>
                </div>

                <div class="space-y-4 mb-6">
                    <div>
                        <span class="text-sm text-gray-500">SKU:</span>
                        <span class="ml-2 font-mono text-gray-900">{{ $product->sku ?? 'N/A' }}</span>
                    </div>
                    
                    <div>
                        <span class="text-sm text-gray-500">Categoría:</span>
                        <span class="ml-2 font-semibold text-gray-900">{{ $product->category->name ?? 'Sin categoría' }}</span>
                    </div>
                    
                    <div>
                        <span class="text-sm text-gray-500">Marca:</span>
                        <span class="ml-2 font-semibold text-gray-900">{{ $product->brand->name ?? 'Sin marca' }}</span>
                    </div>
                    
                    <div>
                        <span class="text-sm text-gray-500">Precio:</span>
                        <span class="ml-2 text-2xl font-bold text-green-600">S/{{ number_format($product->price, 2) }}</span>
                        @if($product->compare_price)
                            <span class="ml-2 text-lg text-gray-400 line-through">S/{{ number_format($product->compare_price, 2) }}</span>
                        @endif
                    </div>
                    
                    <div>
                        <span class="text-sm text-gray-500">Stock:</span>
                        <span class="ml-2 font-semibold text-gray-900">{{ $product->stock }} unidades</span>
                    </div>
                    
                    <div>
                        <span class="text-sm text-gray-500">Vistas:</span>
                        <span class="ml-2 font-semibold text-gray-900">{{ $product->views }}</span>
                    </div>
                </div>

                @if($product->short_description)
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h3 class="font-semibold mb-2">Descripción Corta</h3>
                    <p class="text-gray-700">{{ $product->short_description }}</p>
                </div>
                @endif

                @if($product->description)
                <div class="mb-6">
                    <h3 class="font-semibold mb-2">Descripción Completa</h3>
                    <div class="text-gray-700 prose max-w-none">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
                @endif

                <div class="pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Creado:</span>
                            <span class="ml-2 text-gray-900">{{ $product->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Actualizado:</span>
                            <span class="ml-2 text-gray-900">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

