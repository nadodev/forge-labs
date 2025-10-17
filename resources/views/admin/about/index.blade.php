@extends('admin.layout')

@section('title', 'Admin - Sobre')

@section('admin')
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold mb-2">Gerenciar Página Sobre</h1>
        <p class="text-white/60">Configure as informações exibidas na página pública "Sobre"</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('about') }}" target="_blank" class="btn secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                <polyline points="15,3 21,3 21,9"/>
                <line x1="10" y1="14" x2="21" y2="3"/>
            </svg>
            Ver Página
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-green-500/20 border border-green-500/30 text-green-200">
    {{ session('success') }}
</div>
@endif

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
            <div>
                <h2 class="text-xl font-semibold mb-1">Stack Tecnológica</h2>
                <p class="text-sm text-white/60">Tecnologias e ferramentas que você domina</p>
            </div>
            <span class="text-xs text-white/60 bg-white/10 px-2 py-1 rounded">{{ $stack->count() }} itens</span>
        </div>
        
        <form method="POST" action="{{ route('admin.about.stack.store') }}" class="bg-white/5 rounded-xl p-6 mb-6">
            @csrf
            <h3 class="text-lg font-medium mb-4">Adicionar Nova Tecnologia</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm text-white/70 mb-2">Nome da Tecnologia</label>
                    <input type="text" name="name" placeholder="Ex: Laravel" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40" required>
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-2">Ícone</label>
                    <x-icon-selector name="icon" placeholder="Selecione um ícone" />
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-2">Nível de Conhecimento</label>
                    <select name="level" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
                        <option value="">Selecione</option>
                        <option value="Iniciante">Iniciante</option>
                        <option value="Intermediário">Intermediário</option>
                        <option value="Avançado">Avançado</option>
                        <option value="Expert">Expert</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-2">Ordem de Exibição</label>
                    <input type="number" name="sort_order" placeholder="1" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" class="btn primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Adicionar Tecnologia
                </button>
            </div>
        </form>
        @if($stack->count() > 0)
        <div class="space-y-3">
            @foreach($stack as $item)
            <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/10">
                <div class="flex items-center gap-4">
                    <div class="text-2xl">{{ $item->icon ?: '🔧' }}</div>
                    <div>
                        <h4 class="font-medium">{{ $item->name }}</h4>
                        <p class="text-sm text-white/60">{{ $item->level ?: 'Nível não definido' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs text-white/50 bg-white/10 px-2 py-1 rounded">Ordem: {{ $item->sort_order ?: 'N/A' }}</span>
                    <form method="POST" action="{{ route('admin.about.stack.destroy', $item) }}" onsubmit="return confirm('Remover {{ $item->name }}?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn danger small">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                            Remover
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8 text-white/60">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" class="mx-auto mb-4 opacity-50">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14,2 14,8 20,8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
                <polyline points="10,9 9,9 8,9"/>
            </svg>
            <p>Nenhuma tecnologia adicionada ainda</p>
            <p class="text-sm">Use o formulário acima para adicionar suas tecnologias</p>
        </div>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="rounded-2xl border border-white/10 bg-white/5 p-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold mb-1">Certificados</h2>
                <p class="text-sm text-white/60">Conquistas e formações profissionais</p>
            </div>
            <span class="text-xs text-white/60 bg-white/10 px-2 py-1 rounded">{{ $certificates->count() }} itens</span>
        </div>
        
        <form method="POST" action="{{ route('admin.about.certificates.store') }}" class="bg-white/5 rounded-xl p-6 mb-6">
            @csrf
            <h3 class="text-lg font-medium mb-4">Adicionar Novo Certificado</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/70 mb-2">Título do Certificado</label>
                    <input type="text" name="title" placeholder="Ex: Laravel Certified Developer" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40" required>
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-2">Emissor</label>
                    <input type="text" name="issuer" placeholder="Ex: Laravel LLC" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-2">Ícone</label>
                    <x-icon-selector name="icon" placeholder="Selecione um ícone" />
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-2">Data de Emissão</label>
                    <input type="date" name="issued_at" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-2">URL do Certificado</label>
                    <input type="url" name="url" placeholder="https://..." class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-2">Ordem de Exibição</label>
                    <input type="number" name="sort_order" placeholder="1" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" class="btn primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Adicionar Certificado
                </button>
            </div>
        </form>
        @if($certificates->count() > 0)
        <div class="space-y-3">
            @foreach($certificates as $cert)
            <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/10">
                <div class="flex items-center gap-4">
                    <div class="text-2xl">{{ $cert->icon ?: '🏆' }}</div>
                    <div>
                        <h4 class="font-medium">{{ $cert->title }}</h4>
                        <p class="text-sm text-white/60">{{ $cert->issuer }}</p>
                        @if($cert->issued_at)
                            <p class="text-xs text-white/50">{{ $cert->issued_at->format('d/m/Y') }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    @if($cert->url)
                        <a href="{{ $cert->url }}" target="_blank" class="btn secondary small">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                <polyline points="15,3 21,3 21,9"/>
                                <line x1="10" y1="14" x2="21" y2="3"/>
                            </svg>
                            Ver
                        </a>
                    @endif
                    <form method="POST" action="{{ route('admin.about.certificates.destroy', $cert) }}" onsubmit="return confirm('Remover {{ $cert->title }}?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn danger small">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                            Remover
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8 text-white/60">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" class="mx-auto mb-4 opacity-50">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <p>Nenhum certificado adicionado ainda</p>
            <p class="text-sm">Use o formulário acima para adicionar seus certificados</p>
        </div>
        @endif
    </div>

    <div class="rounded-2xl border border-white/10 bg-white/5 p-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold mb-1">Linha do Tempo</h2>
                <p class="text-sm text-white/60">Marcos importantes da sua trajetória</p>
            </div>
            <span class="text-xs text-white/60 bg-white/10 px-2 py-1 rounded">{{ $timeline->count() }} itens</span>
        </div>
        
        <form method="POST" action="{{ route('admin.about.timeline.store') }}" class="bg-white/5 rounded-xl p-6 mb-6">
            @csrf
            <h3 class="text-lg font-medium mb-4">Adicionar Novo Marco</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/70 mb-2">Título do Marco</label>
                    <input type="text" name="title" placeholder="Ex: Primeiro emprego como desenvolvedor" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40" required>
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-2">Subtítulo</label>
                    <input type="text" name="subtitle" placeholder="Ex: Empresa XYZ" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-2">Data</label>
                    <input type="date" name="date" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-2">Ícone</label>
                    <x-icon-selector name="icon" placeholder="Selecione um ícone" />
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/70 mb-2">Descrição</label>
                    <textarea name="description" rows="3" placeholder="Descreva o que aconteceu neste marco..." class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40"></textarea>
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-2">Ordem de Exibição</label>
                    <input type="number" name="sort_order" placeholder="1" class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/40">
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" class="btn primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Adicionar Marco
                </button>
            </div>
        </form>
        @if($timeline->count() > 0)
        <div class="space-y-3">
            @foreach($timeline as $item)
            <div class="flex items-start justify-between p-4 rounded-xl bg-white/5 border border-white/10">
                <div class="flex items-start gap-4">
                    <div class="text-2xl mt-1">{{ $item->icon ?: '📅' }}</div>
                    <div class="flex-1">
                        <h4 class="font-medium">{{ $item->title }}</h4>
                        @if($item->subtitle)
                            <p class="text-sm text-white/60">{{ $item->subtitle }}</p>
                        @endif
                        @if($item->description)
                            <p class="text-sm text-white/70 mt-2">{{ $item->description }}</p>
                        @endif
                        @if($item->date)
                            <p class="text-xs text-white/50 mt-2">{{ $item->date->format('d/m/Y') }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs text-white/50 bg-white/10 px-2 py-1 rounded">Ordem: {{ $item->sort_order ?: 'N/A' }}</span>
                    <form method="POST" action="{{ route('admin.about.timeline.destroy', $item) }}" onsubmit="return confirm('Remover {{ $item->title }}?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn danger small">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                            Remover
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8 text-white/60">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" class="mx-auto mb-4 opacity-50">
                <path d="M3 3h18v18H3zM9 9h6v6H9z"/>
                <path d="M9 1v6M15 1v6M9 17v6M15 17v6M1 9h6M17 9h6M1 15h6M17 15h6"/>
            </svg>
            <p>Nenhum marco adicionado ainda</p>
            <p class="text-sm">Use o formulário acima para adicionar marcos da sua trajetória</p>
        </div>
        @endif
    </div>
</div>
@endsection


