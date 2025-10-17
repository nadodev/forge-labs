@extends('layouts.app')

@section('title', 'Entrar - Geja Systems')

@push('head')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: {} } }
    </script>
@endpush

@section('content')
<section class="py-10">
    <div class="max-w-7xl mx-auto px-6">
        <div class="max-w-md mx-auto rounded-2xl border border-white/10 bg-white/5 p-8 shadow-xl">
            <h1 class="text-2xl font-bold mb-6">Entrar</h1>

            @if($errors->any())
            <div class="mb-6 rounded-lg border border-red-500/20 bg-red-500/10 text-red-200 p-4 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm text-white/70 mb-1">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full rounded-lg bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/50">
                </div>
                <div>
                    <label for="password" class="block text-sm text-white/70 mb-1">Senha</label>
                    <input id="password" type="password" name="password" required class="w-full rounded-lg bg-white/5 border border-white/10 px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500/50">
                </div>
                <label class="inline-flex items-center gap-2 text-sm text-white/70">
                    <input type="checkbox" name="remember" value="1" class="rounded border-white/20 bg-white/5">
                    <span>Lembrar-me</span>
                </label>
                <button type="submit" class="w-full px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">Entrar</button>
            </form>
        </div>
    </div>
 </section>
@endsection


