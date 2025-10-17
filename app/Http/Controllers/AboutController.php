<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\StackItem;
use App\Models\Certificate;
use App\Models\TimelineItem;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        $stack = StackItem::where('is_active', true)->orderBy('sort_order')->get();
        $certificates = Certificate::orderBy('sort_order')->get();
        $timeline = TimelineItem::orderBy('sort_order')->get();
        return view('about', compact('about','stack','certificates','timeline'));
    }
}
