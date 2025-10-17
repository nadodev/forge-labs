<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StackItem;
use Illuminate\Http\Request;

class StackController extends Controller
{
    public function index()
    {
        $stack = StackItem::orderBy('sort_order')->get();
        return view('admin.stack.index', compact('stack'));
    }

    public function create()
    {
        return view('admin.stack.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:10',
            'level' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer'
        ]);

        // Automatically set sort_order if not provided
        if (!isset($data['sort_order'])) {
            $data['sort_order'] = StackItem::max('sort_order') + 1;
        }

        StackItem::create($data);
        return redirect()->route('admin.stack.index')->with('success', 'Tecnologia adicionada com sucesso!');
    }

    public function show(StackItem $stack)
    {
        return view('admin.stack.show', compact('stack'));
    }

    public function edit(StackItem $stack)
    {
        return view('admin.stack.edit', compact('stack'));
    }

    public function update(Request $request, StackItem $stack)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:10',
            'level' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer'
        ]);

        $stack->update($data);
        return redirect()->route('admin.stack.index')->with('success', 'Tecnologia atualizada com sucesso!');
    }

    public function destroy(StackItem $stack)
    {
        $stack->delete();
        return redirect()->route('admin.stack.index')->with('success', 'Tecnologia removida com sucesso!');
    }
}