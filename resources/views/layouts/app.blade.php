<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Compunexo Tecnologías')</title>
    <meta name="description" content="@yield('description', 'Compunexo Tecnologías - Tu tienda de tecnología de confianza')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary-color: #22c55e;
            --primary-dark: #16a34a;
            --primary-light: #86efac;
            --text-dark: #1b1b18;
            --text-light: #706f6c;
            --bg-light: #FDFDFC;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        * {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        
        body {
            color: var(--text-dark);
            background-color: var(--bg-light);
            line-height: 1.6;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            box-shadow: var(--shadow-md);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(34, 197, 94, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px -2px rgba(34, 197, 94, 0.4);
        }
        
        .btn-secondary {
            background: white;
            color: var(--primary-color);
            padding: 0.75rem 2rem;
            border: 2px solid var(--primary-color);
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: var(--primary-color);
            color: white;
        }
        
        .product-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }
        
        .product-card img {
            transition: transform 0.5s ease;
        }
        
        .product-card:hover img {
            transform: scale(1.05);
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--text-dark) 0%, var(--primary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 50%, #15803d 100%);
        }
        
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .mobile-menu.open {
            transform: translateX(0);
        }
        
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.875rem;
            }
        }
        
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Navbar -->
    <nav class="navbar sticky top-0 z-50" id="navbar">
        <div class="container mx-auto px-4 lg:px-6">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-700 rounded-lg flex items-center justify-center transform group-hover:scale-110 transition-transform">
                        <span class="text-white font-bold text-xl">C</span>
                    </div>
                    <div class="hidden sm:block">
                        <div class="text-xl font-bold text-gray-900">COMPUNEXO</div>
                        <div class="text-xs text-gray-500 -mt-1">TECNOLOGÍAS</div>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-gray-700 hover:text-green-600 font-medium transition-colors rounded-lg hover:bg-green-50">
                        Inicio
                    </a>
                    <a href="{{ route('products.index') }}" class="px-4 py-2 text-gray-700 hover:text-green-600 font-medium transition-colors rounded-lg hover:bg-green-50">
                        Productos
                    </a>
                    @if(isset($navCategories) && $navCategories->count() > 0)
                    <div class="relative group">
                        <button class="px-4 py-2 text-gray-700 hover:text-green-600 font-medium transition-colors rounded-lg hover:bg-green-50 flex items-center space-x-1">
                            <span>Categorías</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="p-2">
                                @foreach($navCategories as $cat)
                                <a href="{{ route('products.category', $cat->slug) }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-colors">
                                    {{ $cat->name }}
                                </a>
                                @endforeach
                                <a href="{{ route('products.index') }}" class="block px-4 py-2 text-green-600 font-semibold hover:bg-green-50 rounded-lg mt-2 border-t border-gray-200 pt-2">
                                    Ver todas →
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(isset($navBrands) && $navBrands->count() > 0)
                    <div class="relative group">
                        <button class="px-4 py-2 text-gray-700 hover:text-green-600 font-medium transition-colors rounded-lg hover:bg-green-50 flex items-center space-x-1">
                            <span>Marcas</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="p-2">
                                @foreach($navBrands as $brand)
                                <a href="{{ route('products.brand', $brand->slug) }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg transition-colors">
                                    {{ $brand->name }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Search & Actions -->
                <div class="hidden md:flex items-center space-x-4 flex-1 max-w-md mx-6">
                    <form action="{{ route('products.index') }}" method="GET" class="flex-1">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Buscar productos..." 
                                   class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 text-sm"
                                   value="{{ request('search') }}">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </form>
                </div>

                <!-- User Actions -->
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-green-600 font-medium transition-colors">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="btn-secondary text-sm py-2 px-4">
                            Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600 font-medium transition-colors">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary text-sm py-2 px-4">
                            Registrarse
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu lg:hidden fixed inset-y-0 left-0 w-64 bg-white shadow-xl z-50 p-6">
            <div class="flex justify-between items-center mb-8">
                <div class="text-xl font-bold text-gray-900">Menú</div>
                <button id="close-menu-btn" class="p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg font-medium transition-colors">
                    Inicio
                </a>
                <a href="{{ route('products.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg font-medium transition-colors">
                    Productos
                </a>
                @if(isset($navCategories) && $navCategories->count() > 0)
                <div class="px-4 py-2 text-gray-500 text-sm font-semibold uppercase tracking-wide">Categorías</div>
                @foreach($navCategories as $cat)
                <a href="{{ route('products.category', $cat->slug) }}" class="block px-8 py-2 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg font-medium transition-colors text-sm">
                    {{ $cat->name }}
                </a>
                @endforeach
                @endif
                @if(isset($navBrands) && $navBrands->count() > 0)
                <div class="px-4 py-2 text-gray-500 text-sm font-semibold uppercase tracking-wide mt-4">Marcas</div>
                @foreach($navBrands as $brand)
                <a href="{{ route('products.brand', $brand->slug) }}" class="block px-8 py-2 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg font-medium transition-colors text-sm">
                    {{ $brand->name }}
                </a>
                @endforeach
                @endif
                <div class="pt-4 border-t border-gray-200">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg font-medium transition-colors">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg font-medium transition-colors">
                            Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded-lg font-medium transition-colors">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="block px-4 py-3 bg-green-600 text-white rounded-lg font-medium text-center">
                            Registrarse
                        </a>
                    @endauth
                </div>
            </nav>
        </div>
        <div id="mobile-menu-overlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="container mx-auto px-4 lg:px-6 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-700 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-xl">C</span>
                        </div>
                        <div>
                            <div class="text-lg font-bold">COMPUNEXO</div>
                            <div class="text-xs text-gray-400 -mt-1">TECNOLOGÍAS</div>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Tu tienda de tecnología de confianza. Los mejores productos al mejor precio.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 text-lg">Enlaces Rápidos</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Inicio</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Productos</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Sobre Nosotros</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contacto</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Términos y Condiciones</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 text-lg">Categorías</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Laptops</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Computadoras</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Componentes</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Accesorios</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Periféricos</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 text-lg">Contacto</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start space-x-2">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>+51 999 999 999</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>info@compunexo.com</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Lunes - Sábado: 10am - 8pm</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Compunexo Tecnologías. Todos los derechos reservados.</p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

        function openMobileMenu() {
            mobileMenu.classList.add('open');
            mobileMenuOverlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            mobileMenu.classList.remove('open');
            mobileMenuOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        }

        mobileMenuBtn?.addEventListener('click', openMobileMenu);
        closeMenuBtn?.addEventListener('click', closeMobileMenu);
        mobileMenuOverlay?.addEventListener('click', closeMobileMenu);

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            lastScroll = currentScroll;
        });
    </script>
</body>
</html>
