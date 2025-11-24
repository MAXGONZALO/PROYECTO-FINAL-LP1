<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Compartir categorías y marcas con todas las vistas
        View::composer('layouts.app', function ($view) {
            $view->with('navCategories', Category::where('is_active', true)
                ->orderBy('order')
                ->orderBy('name')
                ->take(6)
                ->get());
            
            $view->with('navBrands', Brand::where('is_active', true)
                ->orderBy('name')
                ->take(5)
                ->get());
        });
    }
}
