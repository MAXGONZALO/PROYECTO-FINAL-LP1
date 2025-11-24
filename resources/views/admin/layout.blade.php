<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Compunexo Tecnologías')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .btn-primary {
            background-color: #22c55e;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #16a34a;
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('admin.products.index') }}" class="text-xl font-bold text-green-600">
                        Admin - Compunexo
                    </a>
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.products.index') }}" class="text-gray-700 hover:text-green-600">Productos</a>
                        <a href="{{ route('admin.categories.index') }}" class="text-gray-700 hover:text-green-600">Categorías</a>
                        <a href="{{ route('admin.brands.index') }}" class="text-gray-700 hover:text-green-600">Marcas</a>
                    </div>
                </div>
                <div>
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-600">Volver al sitio</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>
</body>
</html>


