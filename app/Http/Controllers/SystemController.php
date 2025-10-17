<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Review;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index(Request $request)
    {
        $query = System::with(['category', 'tags'])
            ->active();

        // Aplicar filtros
        if ($request->filled('q')) {
            $query->search($request->q);
        }

        if ($request->filled('categoria')) {
            $category = Category::where('slug', $request->categoria)->first();
            if ($category) {
                $query->byCategory($category->id);
            }
        }

        if ($request->filled('licenca')) {
            $query->where('license_type', $request->licenca);
        }

        if ($request->filled('linguagem')) {
            $tag = Tag::where('slug', $request->linguagem)->first();
            if ($tag) {
                $query->byTag($tag->id);
            }
        }

        // Aplicar ordenação
        $sort = $request->get('sort', 'date');
        switch ($sort) {
            case 'popular':
                $query->orderBy('downloads_count', 'desc');
                break;
            case 'price':
                $query->orderBy('price');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'date':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $systems = $query->paginate(12);

        // Buscar categorias e tags para filtros
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $licenses = [
            'free' => 'Gratuito',
            'paid' => 'Pago',
            'saas' => 'SaaS',
            'open_source' => 'Código Aberto'
        ];


        $languages = Tag::where('is_active', true)
            ->orderBy('name')
            ->pluck('name', 'slug');

        return view('systems.index', compact('systems', 'categories', 'licenses', 'languages'));
    }

    public function show($slug)
    {

        $system = System::where('slug', $slug)->first();
        if (!$system) {
            abort(404);
        }

        // Incrementar contador de visualizações
        $system->incrementViews();

        // Buscar reviews aprovados
        $reviews = $system->approvedReviews()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Buscar sistemas relacionados (mesma categoria)
        $relatedSystems = System::with(['category', 'tags'])
            ->active()
            ->where('category_id', $system->category_id)
            ->where('id', '!=', $system->id)
            ->orderBy('rating', 'desc')
            ->limit(3)
            ->get();

        return view('systems.show', compact('system', 'reviews', 'relatedSystems'));
    }
}