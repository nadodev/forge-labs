<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('sort_order')->get();
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
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
        return redirect()->route('admin.certificates.index')->with('success', 'Certificado adicionado com sucesso!');
    }

    public function show(Certificate $certificate)
    {
        return view('admin.certificates.show', compact('certificate'));
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
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
        return redirect()->route('admin.certificates.index')->with('success', 'Certificado atualizado com sucesso!');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return redirect()->route('admin.certificates.index')->with('success', 'Certificado removido com sucesso!');
    }
}