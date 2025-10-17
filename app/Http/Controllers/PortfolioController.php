<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        $items = Portfolio::where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('created_at','desc')
            ->paginate(12);
        return view('portfolio.index', compact('items'));
    }

    public function show(Portfolio $portfolio)
    {
        abort_unless($portfolio->is_active, 404);
        return view('portfolio.show', compact('portfolio'));
    }
}


