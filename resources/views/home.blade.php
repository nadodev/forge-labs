@extends('layouts.app')

@section('title', 'Geja Labs - Transformando ideias em sistemas inteligentes')

@section('content')
<section class="hero">
    <div class="container hero-container">
        <div class="hero-content">
            <div class="hero-badge">
                <span class="badge-text">Novos sistemas disponíveis</span>
            </div>
            <h1 class="headline">Transformando ideias em sistemas inteligentes.</h1>
            <p class="subhead">Soluções em <span id="typing" class="typing-text"></span></p>
            <div class="hero-actions">
                <a class="btn primary" href="{{ route('systems.index') }}">
                    <span>Ver meus sistemas</span>
                    <svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
                <a class="btn secondary" href="{{ route('contact') }}">
                    <span>Solicitar projeto personalizado</span>
                </a>
            </div>
            <a href="#featured" class="scroll-down" aria-label="Ir para a próxima seção">
                <span class="scroll-dot"></span>
            </a>
        </div>
        <div class="hero-visual" aria-hidden="true">
            <div class="hero-grid">
                <div class="grid-item grid-item-1"></div>
                <div class="grid-item grid-item-2"></div>
                <div class="grid-item grid-item-3"></div>
                <div class="grid-item grid-item-4"></div>
            </div>
            <div class="floating-elements">
                <div class="floating-element element-1">💻</div>
                <div class="floating-element element-2">🚀</div>
                <div class="floating-element element-3">⚡</div>
                <div class="floating-element element-4">🎯</div>
            </div>
            <div class="mockup">
                <div class="mockup-window">
                    <div class="mockup-titlebar"><span></span><span></span><span></span></div>
                    <div class="mockup-screen">
                        <div class="mockup-nav"></div>
                        <div class="mockup-hero"></div>
                        <div class="mockup-cards">
                            <div class="mock-card"></div>
                            <div class="mock-card"></div>
                            <div class="mock-card"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container section" id="more">
    <h2 class="section-title">Mais sistemas</h2>
    <div class="cards grid" id="moreCards" data-initial="6" data-step="6">
        @foreach($featuredSystems as $system)
        <div class="card system-card loadable" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
            <div class="card-image">
                <div class="card-image-placeholder">
                    <span class="card-icon">{{ $system->icon }}</span>
                </div>
                <div class="card-overlay">
                    <a href="{{ route('systems.show', $system->slug) }}" class="btn primary small">Ver detalhes</a>
                </div>
            </div>
            <div class="card-content">
                <div class="card-header">
                    <div class="card-badge">{{ $system->category->name }}</div>
                    <h3 class="card-title">{{ $system->name }}</h3>
                </div>
                <p class="card-description">{{ $system->description }}</p>
                <div class="card-footer">
                    <div class="rating">
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="star {{ $i <= $system->rating ? 'filled' : '' }}">⭐</span>
                            @endfor
                        </div>
                        <span class="rating-value">{{ $system->rating }}</span>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('systems.show', $system->slug) }}" class="btn ghost small">Ver mais</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="pager">
        <button class="btn ghost" id="loadMoreHome">Carregar mais</button>
    </div>
</section>

<section id="featured" class="container section">
    <h2 class="section-title">Sistemas em destaque</h2>
    <div class="cards" id="featuredCards">
        @foreach($featuredSystems as $system)
        <div class="card featured-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="card-image">
                <div class="card-image-placeholder">
                    <span class="card-icon">{{ $system->icon }}</span>
                </div>
                <div class="card-overlay">
                    <a href="{{ route('systems.show', $system->slug) }}" class="btn primary small">
                        <span>Ver detalhes</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card-content">
                <div class="card-header">
                    <div class="card-badge">{{ $system->category->name }}</div>
                    <h3 class="card-title">{{ $system->name }}</h3>
                </div>
                <p class="card-description">{{ $system->description }}</p>
                <div class="card-footer">
                    <div class="rating">
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="star {{ $i <= $system->rating ? 'filled' : '' }}">⭐</span>
                            @endfor
                        </div>
                        <span class="rating-value">{{ $system->rating }}</span>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('systems.show', $system->slug) }}" class="btn ghost small">Ver mais</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="container section">
    <h2 class="section-title">Categorias</h2>
    <div class="chip-row">
        <a class="chip" href="{{ route('systems.index', ['categoria' => 'gestao']) }}">🧾 Gestão</a>
        <a class="chip" href="{{ route('systems.index', ['categoria' => 'ia']) }}">🧠 Inteligência Artificial</a>
        <a class="chip" href="{{ route('systems.index', ['categoria' => 'escolar']) }}">🏫 Escolar</a>
        <a class="chip" href="{{ route('systems.index', ['categoria' => 'negocios']) }}">💈 Negócios Locais</a>
        <a class="chip" href="{{ route('systems.index', ['categoria' => 'financeiro']) }}">💳 Financeiro</a>
    </div>
</section>

@php $feedback = true; @endphp
@if ($feedback != true) 
<section class="container section">
    <h2 class="section-title">Feedbacks</h2>
    <div class="testimonials" id="testimonials">
        @foreach($testimonials as $testimonial)
        <div class="testimonial" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
            <div class="testimonial-content">
                <p class="testimonial-text">"{{ $testimonial->comment }}"</p>
                <div class="testimonial-rating">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star {{ $i <= $testimonial->rating ? 'filled' : '' }}">⭐</span>
                    @endfor
                </div>
            </div>
            <div class="testimonial-author">
                <div class="testimonial-avatar">
                    <span>{{ substr($testimonial->author_name, 0, 1) }}</span>
                </div>
                <div class="testimonial-info">
                    <h4 class="testimonial-name">{{ $testimonial->author_name }}</h4>
                    <p class="testimonial-business">{{ $testimonial->system->name }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Typing effect
    const words = ['SaaS', 'IA', 'Finanças', 'Agendamento', 'Escolar', 'Gestão'];
    let wordIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    const typingElement = document.getElementById('typing');
    
    function typeWriter() {
        const currentWord = words[wordIndex];
        
        if (isDeleting) {
            typingElement.textContent = currentWord.substring(0, charIndex - 1);
            charIndex--;
        } else {
            typingElement.textContent = currentWord.substring(0, charIndex + 1);
            charIndex++;
        }
        
        let typeSpeed = isDeleting ? 50 : 100;
        
        if (!isDeleting && charIndex === currentWord.length) {
            typeSpeed = 2000;
            isDeleting = true;
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            wordIndex = (wordIndex + 1) % words.length;
            typeSpeed = 500;
        }
        
        setTimeout(typeWriter, typeSpeed);
    }
    
    typeWriter();
    
    // Particles animation
    createParticles();
    
    // Theme toggle
    setupThemeToggle();
});

function createParticles() {
    const particlesContainer = document.getElementById('particles');
    const particleCount = 50;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 3 + 's';
        particle.style.animationDuration = (Math.random() * 3 + 2) + 's';
        particlesContainer.appendChild(particle);
    }
}

function setupThemeToggle() {
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;
    
    // Load saved theme
    const savedTheme = localStorage.getItem('theme') || 'dark';
    body.className = `theme-${savedTheme}`;
    themeToggle.textContent = savedTheme === 'dark' ? '🌙' : '☀️';
    
    themeToggle.addEventListener('click', function() {
        const currentTheme = body.classList.contains('theme-dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        body.className = `theme-${newTheme}`;
        themeToggle.textContent = newTheme === 'dark' ? '🌙' : '☀️';
        localStorage.setItem('theme', newTheme);
    });
}
</script>
@endsection
