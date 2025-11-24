<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with(['category', 'brand'])
            ->latest()
            ->take(8)
            ->get();

        $latestProducts = Product::where('is_active', true)
            ->with(['category', 'brand'])
            ->latest()
            ->take(12)
            ->get();

        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->orderBy('name')
            ->take(8)
            ->get();

        $brands = Brand::where('is_active', true)
            ->orderBy('name')
            ->take(10)
            ->get();

        return view('home', compact('featuredProducts', 'latestProducts', 'categories', 'brands'));
    }
}
