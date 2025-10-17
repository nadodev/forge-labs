<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = About::first();
        return view('admin.profile.index', compact('profile'));
    }

    public function create()
    {
        return view('admin.profile.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'bio' => 'required|string',
            'photo_url' => 'nullable|url',
        ]);

        About::create($data);
        return redirect()->route('admin.profile.index')->with('success', 'Perfil criado com sucesso!');
    }

    public function show(About $profile)
    {
        return view('admin.profile.show', compact('profile'));
    }

    public function edit(About $profile)
    {
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request, About $profile)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'bio' => 'required|string',
            'photo_url' => 'nullable|url',
        ]);

        $profile->update($data);
        return redirect()->route('admin.profile.index')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function destroy(About $profile)
    {
        $profile->delete();
        return redirect()->route('admin.profile.index')->with('success', 'Perfil removido com sucesso!');
    }
}