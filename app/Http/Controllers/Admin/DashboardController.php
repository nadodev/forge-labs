<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\System;
use App\Models\Review;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        $kpis = [
            'systems' => System::count(),
            'featured' => System::where('is_featured', true)->count(),
            'reviewsPending' => Review::where('is_approved', false)->count(),
            'messagesUnread' => Message::where('is_read', false)->count(),
            'downloads' => System::sum('downloads_count'),
            'views' => System::sum('views_count'),
        ];

        $latestSystems = System::orderBy('created_at', 'desc')->limit(5)->get();
        $latestReviews = Review::orderBy('created_at', 'desc')->limit(5)->get();
        $latestMessages = Message::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('kpis', 'latestSystems', 'latestReviews', 'latestMessages'));
    }
}


