<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Geja Systems')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @stack('head')
    <!-- Scripts -->
</head>
<body class="theme-dark">
    <header class="header">
        <div class="container header-content">
           <div class="logo-container">
            <img src="{{ asset("logo.png") }}" alt="logo" width="50"/>
            <a href="{{ route('home') }}" class="logo">GEJA LABS</a>
           </div>
            <nav class="nav">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('systems.index') }}" class="{{ request()->routeIs('systems.*') ? 'active' : '' }}">Sistemas</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Sobre</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contato</a>
                <a href="{{ route('cart.index') }}" class="btn ghost {{ request()->routeIs('cart.*') ? 'active' : '' }}" style="position: relative;">
                    <span class="inline-flex items-center gap-2">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        Carrinho
                    </span>
                    @php($cartCount = count(session('cart', [])))
                    @if($cartCount)
                        <span class="badge" style="position:absolute;top:-6px;right:-6px;">{{ $cartCount }}</span>
                    @endif
                </a>
                <button id="themeToggle" class="btn ghost" aria-label="Alternar tema">🌙</button>
                @auth
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" class="btn ghost">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn ghost {{ request()->routeIs('login') ? 'active' : '' }}">Entrar</a>
                @endauth
            </nav>
        </div>
    </header>
    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container footer-grid">
            <div>
                <div class="logo">GEJA LABS</div>
                <p class="muted">© {{ date('Y') }} Geja Labs. Todos os direitos reservados.</p>
            </div>
            <nav class="footer-links">
                <a href="{{ route('systems.index') }}">Sistemas</a>
                <a href="{{ route('about') }}">Sobre</a>
                <a href="{{ route('contact') }}">Contato</a>
            </nav>
            <div class="socials">
                <a href="#" aria-label="GitHub">GitHub</a>
                <a href="#" aria-label="LinkedIn">LinkedIn</a>
                <a href="#" aria-label="YouTube">YouTube</a>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
