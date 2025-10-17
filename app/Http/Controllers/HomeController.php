<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Buscar sistemas em destaque
        $featuredSystems = System::with(['category', 'tags'])
            ->featured()
            ->active()
            ->orderBy('rating', 'desc')
            ->limit(6)
            ->get();

        // Buscar depoimentos aprovados
        $testimonials = Review::with('system')
            ->approved()
            ->orderBy('rating', 'desc')
            ->limit(3)
            ->get();

        // Buscar categorias para filtros
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('home', compact('featuredSystems', 'testimonials', 'categories'));
    }
}
