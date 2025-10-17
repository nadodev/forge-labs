@extends('layouts.app')

@push('head')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          darkMode: 'class',
          theme: {extend: {}}
        }
    </script>
@endpush

@section('content')
<section class="py-8">
    <div class="container mx-auto px-6 grid grid-cols-12 gap-6">
        <aside class="col-span-12 md:col-span-3 lg:col-span-2 bg-white/5 dark:bg-white/5 backdrop-blur rounded-xl border border-white/10 p-4 sticky top-6 h-max">
            <nav class="space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-white/80' }}">Dashboard</a>
                <a href="{{ route('admin.systems.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.systems.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Sistemas</a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.categories.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Categorias</a>
                <a href="{{ route('admin.tags.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.tags.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Tags</a>
                <a href="{{ route('admin.about.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.about.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Sobre</a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.orders.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Pedidos</a>
                <a href="{{ route('admin.reviews.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.reviews.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Avaliações</a>
                <a href="{{ route('admin.messages.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.messages.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Mensagens</a>
            </nav>
        </aside>
        <div class="col-span-12 md:col-span-9 lg:col-span-10">
            @if(session('success'))
                <div class="mb-4 rounded-lg border border-emerald-500/20 bg-emerald-500/10 text-emerald-200 p-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-4 rounded-lg border border-red-500/20 bg-red-500/10 text-red-200 p-3 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
                @yield('admin')
            </div>
        </div>
    </div>
 </section>
@endsection


