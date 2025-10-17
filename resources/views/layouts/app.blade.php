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
    @stack('styles')
    <!-- Scripts -->
</head>
<body class="theme-dark">
    <header class="header">
        <div class="container header-content">
           <div class="logo-container">
            <img src="{{ asset("logo.png") }}" alt="logo" width="50"/>
            <a href="{{ route('home') }}" class="logo">GEJA LABS</a>
           </div>
           
           <!-- Desktop Navigation -->
            <nav class="nav desktop-nav">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('systems.index') }}" class="{{ request()->routeIs('systems.*') ? 'active' : '' }}">Sistemas</a>
                <a href="https://www.leonardogeja.com.br" target="_blank" rel="noopener noreferrer" class="{{ request()->routeIs('portfolio.*') ? 'active' : '' }}">Portfólio</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Sobre</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contato</a>
                <a href="{{ route('cart.index') }}" class="btn ghost {{ request()->routeIs('cart.*') ? 'active' : '' }}" style="position: relative;">
                    @php
                        $cart = session('cart', []);
                        $cartCount = collect($cart)->sum('quantity');
                    @endphp
                    <span class="inline-flex items-center gap-2">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        Carrinho
                    </span>
                    @if($cartCount > 0)
                        <span class="cart-badge" aria-label="Itens no carrinho">{{ $cartCount }}</span>
                    @endif
                </a>
                @auth
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" class="btn ghost">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn ghost {{ request()->routeIs('login') ? 'active' : '' }}">Entrar</a>
                @endauth
            </nav>
            
            <!-- Mobile Menu Button -->
            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Abrir menu">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>
        
        <!-- Mobile Navigation -->
        <nav class="mobile-nav" id="mobileNav">
            <div class="mobile-nav-content">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('systems.index') }}" class="{{ request()->routeIs('systems.*') ? 'active' : '' }}">Sistemas</a>
                <a href="{{ route('portfolio.index') }}" class="{{ request()->routeIs('portfolio.*') ? 'active' : '' }}">Portfólio</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Sobre</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contato</a>
                
                <div class="mobile-nav-actions">
                    <a href="{{ route('cart.index') }}" class="mobile-cart-btn {{ request()->routeIs('cart.*') ? 'active' : '' }}">
                        @php
                            $cart = session('cart', []);
                            $cartCount = collect($cart)->sum('quantity');
                        @endphp
                        <span class="inline-flex items-center gap-2">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                            Carrinho
                        </span>
                        @if($cartCount > 0)
                            <span class="cart-badge" aria-label="Itens no carrinho">{{ $cartCount }}</span>
                        @endif
                    </a>
                    
                    
                    @auth
                        <form method="POST" action="{{ route('logout') }}" style="display:inline">
                            @csrf
                            <button type="submit" class="mobile-logout-btn">Sair</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="mobile-login-btn {{ request()->routeIs('login') ? 'active' : '' }}">Entrar</a>
                    @endauth
                </div>
            </div>
        </nav>
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
    
    <script>
    // Mobile Menu Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileNav = document.getElementById('mobileNav');
        const mobileThemeToggle = document.getElementById('mobileThemeToggle');
        const desktopThemeToggle = document.getElementById('themeToggle');
        
        // Toggle mobile menu
        if (mobileMenuToggle && mobileNav) {
            mobileMenuToggle.addEventListener('click', function() {
                mobileMenuToggle.classList.toggle('active');
                mobileNav.classList.toggle('active');
                
                // Prevent body scroll when menu is open
                if (mobileNav.classList.contains('active')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            });
            
            // Close menu when clicking on a link
            const mobileNavLinks = mobileNav.querySelectorAll('a');
            mobileNavLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenuToggle.classList.remove('active');
                    mobileNav.classList.remove('active');
                    document.body.style.overflow = '';
                });
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenuToggle.contains(event.target) && !mobileNav.contains(event.target)) {
                    mobileMenuToggle.classList.remove('active');
                    mobileNav.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        }
        
        // Sync theme toggle between desktop and mobile
        if (mobileThemeToggle && desktopThemeToggle) {
            mobileThemeToggle.addEventListener('click', function() {
                desktopThemeToggle.click();
            });
            
            desktopThemeToggle.addEventListener('click', function() {
                const currentTheme = document.body.classList.contains('theme-dark') ? 'dark' : 'light';
                mobileThemeToggle.textContent = currentTheme === 'dark' ? '🌙' : '☀️';
            });
        }
    });
    </script>
</body>
</html>
