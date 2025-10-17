<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimelineItem;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index()
    {
        $timeline = TimelineItem::orderBy('sort_order')->get();
        return view('admin.timeline.index', compact('timeline'));
    }

    public function create()
    {
        return view('admin.timeline.create');
    }

    public function store(Request $request)
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
        return redirect()->route('admin.timeline.index')->with('success', 'Marco adicionado com sucesso!');
    }

    public function show(TimelineItem $timeline)
    {
        return view('admin.timeline.show', compact('timeline'));
    }

    public function edit(TimelineItem $timeline)
    {
        return view('admin.timeline.edit', compact('timeline'));
    }

    public function update(Request $request, TimelineItem $timeline)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'icon' => 'nullable|string|max:10',
            'sort_order' => 'nullable|integer'
        ]);

        $timeline->update($data);
        return redirect()->route('admin.timeline.index')->with('success', 'Marco atualizado com sucesso!');
    }

    public function destroy(TimelineItem $timeline)
    {
        $timeline->delete();
        return redirect()->route('admin.timeline.index')->with('success', 'Marco removido com sucesso!');
    }
}