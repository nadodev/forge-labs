<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\System;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index()
    {
        $systems = System::with('category')->orderBy('created_at', 'desc')->paginate(12);
        return view('admin.systems.index', compact('systems'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('admin.systems.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'license_type' => 'required|in:free,paid,saas,open_source',
            'status' => 'required|in:active,development,beta,hidden',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'sometimes|boolean',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $system = System::create($data);
        if ($request->filled('tags')) {
            $system->tags()->sync($request->input('tags', []));
        }

        return redirect()->route('admin.systems.index')->with('success', 'Sistema criado com sucesso.');
    }

    public function edit(System $system)
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $selectedTags = $system->tags()->pluck('tags.id')->toArray();
        return view('admin.systems.edit', compact('system', 'categories', 'tags', 'selectedTags'));
    }

    public function update(Request $request, System $system)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'license_type' => 'required|in:free,paid,saas,open_source',
            'status' => 'required|in:active,development,beta,hidden',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'sometimes|boolean',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $system->update($data);
        $system->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.systems.index')->with('success', 'Sistema atualizado com sucesso.');
    }

    public function destroy(System $system)
    {
        $system->delete();
        return redirect()->route('admin.systems.index')->with('success', 'Sistema removido.');
    }
}


