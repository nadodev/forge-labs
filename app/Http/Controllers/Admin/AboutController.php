<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $stack = StackItem::orderBy('sort_order')->get();
        $certificates = Certificate::orderBy('sort_order')->get();
        $timeline = TimelineItem::orderBy('sort_order')->get();
        return view('admin.about.index', compact('about','stack','certificates','timeline'));
    }

    public function saveProfile(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo_url' => 'nullable|url',
        ]);
        $about = About::first();
        if ($about) { $about->update($data); } else { $about = About::create($data); }
        return back()->with('success', 'Perfil atualizado.');
    }

    public function storeStack(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'level' => 'nullable|integer|min:0|max:100',
            'sort_order' => 'nullable|integer'
        ]);
        if (!isset($data['sort_order'])) {
            $data['sort_order'] = (int) (StackItem::max('sort_order') ?? 0) + 1;
        }
        StackItem::create($data);
        return back()->with('success', 'Stack adicionada.');
    }

    public function updateStack(Request $request, StackItem $stackItem)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'level' => 'nullable|integer|min:0|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean'
        ]);
        if (!isset($data['sort_order'])) {
            $data['sort_order'] = $stackItem->sort_order ?? ((int) (StackItem::max('sort_order') ?? 0) + 1);
        }
        $stackItem->update($data);
        return back()->with('success', 'Stack atualizada.');
    }

    public function destroyStack(StackItem $stackItem)
    {
        $stackItem->delete();
        return back()->with('success', 'Stack removida.');
    }

    public function storeCertificate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:10',
            'url' => 'nullable|url',
            'issued_at' => 'nullable|date',
            'sort_order' => 'nullable|integer'
        ]);
        Certificate::create($data);
        return back()->with('success', 'Certificado adicionado.');
    }

    public function updateCertificate(Request $request, Certificate $certificate)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:10',
            'url' => 'nullable|url',
            'issued_at' => 'nullable|date',
            'sort_order' => 'nullable|integer'
        ]);
        $certificate->update($data);
        return back()->with('success', 'Certificado atualizado.');
    }

    public function destroyCertificate(Certificate $certificate)
    {
        $certificate->delete();
        return back()->with('success', 'Certificado removido.');
    }

    public function storeTimeline(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'icon' => 'nullable|string|max:10',
            'sort_order' => 'nullable|integer'
        ]);
        TimelineItem::create($data);
        return back()->with('success', 'Item da linha do tempo adicionado.');
    }

    public function updateTimeline(Request $request, TimelineItem $timelineItem)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'icon' => 'nullable|string|max:10',
            'sort_order' => 'nullable|integer'
        ]);
        $timelineItem->update($data);
        return back()->with('success', 'Item da linha do tempo atualizado.');
    }

    public function destroyTimeline(TimelineItem $timelineItem)
    {
        $timelineItem->delete();
        return back()->with('success', 'Item da linha do tempo removido.');
    }
}


