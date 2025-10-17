@extends('admin.layout')

@section('title', 'Admin - Sobre')

@section('admin')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Sobre mim</h1>
</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-10">
    <div class="rounded-2xl border border-white/10 bg-white/5 p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold">Perfil</h2>
            <span class="text-xs text-white/60">Informações exibidas na página Sobre</span>
        </div>
        <form method="POST" action="{{ route('admin.about.profile.save') }}" class="grid grid-cols-1 lg:grid-cols-5 gap-5">
            @csrf
            <div class="lg:col-span-3 space-y-5">
                <div>
                    <label class="block text-sm text-white/70 mb-1">Título</label>
                    <input type="text" name="title" value="{{ old('title', $about->title ?? '') }}" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
                    <p class="text-xs text-white/50 mt-1">Ex.: Desenvolvedor Full‑Stack</p>
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-1">Subtítulo</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $about->subtitle ?? '') }}" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
                    <p class="text-xs text-white/50 mt-1">Ex.: Especialista em Laravel, Vue e IA</p>
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-1">Bio</label>
                    <textarea name="bio" rows="6" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40" placeholder="Escreva um resumo curto sobre você...">{{ old('bio', $about->bio ?? '') }}</textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">Salvar</button>
                </div>
            </div>
            <div class="lg:col-span-2 space-y-4">
                <div>
                    <label class="block text-sm text-white/70 mb-1">Foto (URL)</label>
                    <input type="url" name="photo_url" value="{{ old('photo_url', $about->photo_url ?? '') }}" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40" placeholder="https://...">
                </div>
                <div class="rounded-xl border border-white/10 bg-white/5 p-4 flex items-center gap-4">
                    <div class="w-20 h-20 rounded-lg overflow-hidden border border-white/10 bg-white/10 flex items-center justify-center">
                        @if(($about->photo_url ?? null))
                            <img src="{{ $about->photo_url }}" alt="Foto" class="w-full h-full object-cover">
                        @else
                            <span class="text-2xl">👤</span>
                        @endif
                    </div>
                    <div class="text-sm text-white/70">
                        <div>Pré-visualização</div>
                        <div class="text-white/50">Use uma imagem quadrada para melhor resultado.</div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="rounded-2xl border border-white/10 bg-white/5 p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold">Stack</h2>
            <span class="text-xs text-white/60">Tecnologias principais</span>
        </div>
        <form method="POST" action="{{ route('admin.about.stack.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-5">
            @csrf
            <input type="text" name="name" placeholder="Nome" class="md:col-span-2 rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40" required>
            <input type="text" name="icon" placeholder="Ícone (emoji)" class="rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
            <input type="text" name="level" placeholder="Nível" class="rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
            <input type="number" name="sort_order" placeholder="Ordem" class="rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
            <div class="md:col-span-4 flex justify-end gap-3">
                <button class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/15">Adicionar</button>
            </div>
        </form>
        <div class="overflow-hidden rounded-xl border border-white/10">
            <table class="min-w-full divide-y divide-white/10">
                <thead class="bg-white/5">
                    <tr>
                        <th class="px-3 py-2 text-left text-sm">Nome</th>
                        <th class="px-3 py-2 text-left text-sm">Ícone</th>
                        <th class="px-3 py-2 text-left text-sm">Nível</th>
                        <th class="px-3 py-2 text-right text-sm">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach($stack as $item)
                    <tr>
                        <td class="px-3 py-2">{{ $item->name }}</td>
                        <td class="px-3 py-2">{{ $item->icon }}</td>
                        <td class="px-3 py-2">{{ $item->level }}</td>
                        <td class="px-3 py-2">
                            <div class="flex justify-end gap-2">
                                <form method="POST" action="{{ route('admin.about.stack.update', $item) }}">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $item->name }}">
                                    <input type="hidden" name="icon" value="{{ $item->icon }}">
                                    <input type="hidden" name="level" value="{{ $item->level }}">
                                    <input type="hidden" name="sort_order" value="{{ $item->sort_order }}">
                                    <button class="px-3 py-1 rounded-lg bg-white/10 hover:bg-white/15">Salvar</button>
                                </form>
                                <form method="POST" action="{{ route('admin.about.stack.destroy', $item) }}" onsubmit="return confirm('Remover?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 rounded-lg bg-red-500/20 text-red-200 hover:bg-red-500/30">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="rounded-2xl border border-white/10 bg-white/5 p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold">Certificados</h2>
            <span class="text-xs text-white/60">Adicione conquistas e formações</span>
        </div>
        <form method="POST" action="{{ route('admin.about.certificates.store') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-5">
            @csrf
            <input type="text" name="title" placeholder="Título" class="md:col-span-2 rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40" required>
            <input type="text" name="issuer" placeholder="Emissor" class="rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
            <input type="text" name="icon" placeholder="Ícone" class="rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
            <input type="url" name="url" placeholder="URL" class="md:col-span-2 rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
            <input type="date" name="issued_at" class="rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
            <input type="number" name="sort_order" placeholder="Ordem" class="rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
            <div class="md:col-span-6 flex justify-end gap-3">
                <button class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/15">Adicionar</button>
            </div>
        </form>
        <div class="overflow-hidden rounded-xl border border-white/10">
            <table class="min-w-full divide-y divide-white/10">
                <thead class="bg-white/5">
                    <tr>
                        <th class="px-3 py-2 text-left text-sm">Título</th>
                        <th class="px-3 py-2 text-left text-sm">Emissor</th>
                        <th class="px-3 py-2 text-left text-sm">Data</th>
                        <th class="px-3 py-2 text-right text-sm">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach($certificates as $c)
                    <tr>
                        <td class="px-3 py-2">{{ $c->icon }} {{ $c->title }}</td>
                        <td class="px-3 py-2">{{ $c->issuer }}</td>
                        <td class="px-3 py-2">{{ optional($c->issued_at)->format('d/m/Y') }}</td>
                        <td class="px-3 py-2">
                            <div class="flex justify-end gap-2">
                                <a href="{{ $c->url }}" target="_blank" class="px-3 py-1 rounded-lg bg-white/10 hover:bg-white/15">Ver</a>
                                <form method="POST" action="{{ route('admin.about.certificates.update', $c) }}">
                                    @csrf
                                    <input type="hidden" name="title" value="{{ $c->title }}">
                                    <input type="hidden" name="issuer" value="{{ $c->issuer }}">
                                    <input type="hidden" name="icon" value="{{ $c->icon }}">
                                    <input type="hidden" name="url" value="{{ $c->url }}">
                                    <input type="hidden" name="issued_at" value="{{ optional($c->issued_at)->format('Y-m-d') }}">
                                    <input type="hidden" name="sort_order" value="{{ $c->sort_order }}">
                                    <button class="px-3 py-1 rounded-lg bg-white/10 hover:bg-white/15">Salvar</button>
                                </form>
                                <form method="POST" action="{{ route('admin.about.certificates.destroy', $c) }}" onsubmit="return confirm('Remover?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 rounded-lg bg-red-500/20 text-red-200 hover:bg-red-500/30">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="rounded-2xl border border-white/10 bg-white/5 p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold">Linha do tempo</h2>
            <span class="text-xs text-white/60">Marcos da sua trajetória</span>
        </div>
        <form method="POST" action="{{ route('admin.about.timeline.store') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-5">
            @csrf
            <input type="text" name="title" placeholder="Título" class="md:col-span-2 rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40" required>
            <input type="text" name="subtitle" placeholder="Subtítulo" class="md:col-span-2 rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
            <input type="date" name="date" class="rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
            <input type="text" name="icon" placeholder="Ícone" class="rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
            <textarea name="description" rows="3" placeholder="Descrição" class="md:col-span-5 rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40"></textarea>
            <input type="number" name="sort_order" placeholder="Ordem" class="rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
            <div class="md:col-span-6 flex justify-end gap-3">
                <button class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/15">Adicionar</button>
            </div>
        </form>
        <div class="overflow-hidden rounded-xl border border-white/10">
            <table class="min-w-full divide-y divide-white/10">
                <thead class="bg-white/5">
                    <tr>
                        <th class="px-3 py-2 text-left text-sm">Título</th>
                        <th class="px-3 py-2 text-left text-sm">Data</th>
                        <th class="px-3 py-2 text-right text-sm">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach($timeline as $t)
                    <tr>
                        <td class="px-3 py-2">{{ $t->icon }} {{ $t->title }} <span class="text-white/60">— {{ $t->subtitle }}</span></td>
                        <td class="px-3 py-2">{{ optional($t->date)->format('d/m/Y') }}</td>
                        <td class="px-3 py-2">
                            <div class="flex justify-end gap-2">
                                <form method="POST" action="{{ route('admin.about.timeline.update', $t) }}">
                                    @csrf
                                    <input type="hidden" name="title" value="{{ $t->title }}">
                                    <input type="hidden" name="subtitle" value="{{ $t->subtitle }}">
                                    <input type="hidden" name="description" value="{{ $t->description }}">
                                    <input type="hidden" name="date" value="{{ optional($t->date)->format('Y-m-d') }}">
                                    <input type="hidden" name="icon" value="{{ $t->icon }}">
                                    <input type="hidden" name="sort_order" value="{{ $t->sort_order }}">
                                    <button class="px-3 py-1 rounded-lg bg-white/10 hover:bg-white/15">Salvar</button>
                                </form>
                                <form method="POST" action="{{ route('admin.about.timeline.destroy', $t) }}" onsubmit="return confirm('Remover?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 rounded-lg bg-red-500/20 text-red-200 hover:bg-red-500/30">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


