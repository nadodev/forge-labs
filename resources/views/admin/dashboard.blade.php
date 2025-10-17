@extends('admin.layout')

@section('title', 'Admin - Dashboard')

@section('admin')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Dashboard</h1>
    <a href="{{ route('admin.systems.create') }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">Novo Sistema</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
    <div class="rounded-xl p-4 border border-white/10 bg-white/5">
        <div class="text-white/60 text-sm">Sistemas</div>
        <div class="text-3xl font-semibold">{{ $kpis['systems'] }}</div>
    </div>
    <div class="rounded-xl p-4 border border-white/10 bg-white/5">
        <div class="text-white/60 text-sm">Destaques</div>
        <div class="text-3xl font-semibold">{{ $kpis['featured'] }}</div>
    </div>
    <div class="rounded-xl p-4 border border-white/10 bg-white/5">
        <div class="text-white/60 text-sm">Reviews pendentes</div>
        <div class="text-3xl font-semibold">{{ $kpis['reviewsPending'] }}</div>
    </div>
    <div class="rounded-xl p-4 border border-white/10 bg-white/5">
        <div class="text-white/60 text-sm">Mensagens não lidas</div>
        <div class="text-3xl font-semibold">{{ $kpis['messagesUnread'] }}</div>
    </div>
    <div class="rounded-xl p-4 border border-white/10 bg-white/5">
        <div class="text-white/60 text-sm">Downloads</div>
        <div class="text-3xl font-semibold">{{ $kpis['downloads'] }}</div>
    </div>
    <div class="rounded-xl p-4 border border-white/10 bg-white/5">
        <div class="text-white/60 text-sm">Views</div>
        <div class="text-3xl font-semibold">{{ $kpis['views'] }}</div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
        <h3 class="font-semibold mb-3">Últimos sistemas</h3>
        <ul class="space-y-2">
            @foreach($latestSystems as $s)
            <li class="flex items-center justify-between text-white/90">
                <span>{{ $s->name }}</span>
                <span class="text-xs px-2 py-1 rounded bg-white/10">{{ $s->category->name }}</span>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
        <h3 class="font-semibold mb-3">Últimas avaliações</h3>
        <ul class="space-y-2">
            @foreach($latestReviews as $r)
            <li class="flex items-center justify-between text-white/90">
                <span>{{ $r->author_name }} — {{ $r->system->name }}</span>
                <span class="text-xs px-2 py-1 rounded bg-white/10">{{ $r->rating }}</span>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
        <h3 class="font-semibold mb-3">Mensagens recentes</h3>
        <ul class="space-y-2">
            @foreach($latestMessages as $m)
            <li class="flex items-center justify-between text-white/90">
                <span>{{ $m->name }}</span>
                <span class="text-xs px-2 py-1 rounded bg-white/10">{{ $m->contact_reason }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection


