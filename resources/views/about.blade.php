@extends('layouts.app')

@section('title', 'Sobre - Geja Systems')

@section('content')
<!-- Hero Section -->
<section class="hero about-hero">
    <div class="container">
        <div class="hero-content">
            <div class="profile-section">
                <div class="profile-image">
                    @if($about && $about->photo_url)
                        <img src="{{ $about->photo_url }}" alt="Foto do desenvolvedor" class="profile-photo">
                    @else
                        <div class="profile-placeholder">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                    @endif
                    <div class="profile-status">
                        <div class="status-dot"></div>
                        <span>Disponível para projetos</span>
                    </div>
                </div>
                <div class="profile-info">
                    <div class="profile-badge">
                        <span class="badge-icon">👨‍💻</span>
                        <span class="badge-text">{{ $about->title ?? 'Desenvolvedor Full-Stack' }}</span>
                    </div>
                    <h1 class="profile-title">{{ $about->subtitle ?? 'Sobre mim' }}</h1>
                    @if($about && $about->bio)
                        <p class="profile-description">{{ $about->bio }}</p>
                    @else
                        <p class="profile-description">Desenvolvedor focado em criar produtos digitais com qualidade e impacto. Especializado em Laravel, Vue.js e desenvolvimento de sistemas web modernos.</p>
                    @endif
                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-number">3+</span>
                            <span class="stat-label">Anos de experiência</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Projetos concluídos</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Satisfação do cliente</span>
                        </div>
                    </div>
                    <div class="profile-actions">
                        <a href="{{ route('contact') }}" class="btn primary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                            Entre em contato
                        </a>
                        <a href="{{ route('systems.index') }}" class="btn ghost">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                <line x1="8" y1="21" x2="16" y2="21"/>
                                <line x1="12" y1="17" x2="12" y2="21"/>
                            </svg>
                            Ver sistemas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-decoration">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
    </div>
</section>

@if($timeline && $timeline->count() > 0)
<!-- Timeline Section -->
<section class="section timeline-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Minha Jornada</h2>
            <p class="section-subtitle">Marcos importantes da minha trajetória profissional</p>
        </div>
        <div class="timeline-container">
            @foreach($timeline as $item)
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="timeline-marker">
                    @if($item->icon)
                        <span class="timeline-icon">{{ $item->icon }}</span>
                    @else
                        <div class="timeline-dot"></div>
                    @endif
                </div>
                <div class="timeline-content">
                    <div class="timeline-card">
                        @if($item->date)
                            <div class="timeline-date">{{ $item->date->format('Y') }}</div>
                        @endif
                        <h3 class="timeline-title">{{ $item->title }}</h3>
                        @if($item->subtitle)
                            <p class="timeline-subtitle">{{ $item->subtitle }}</p>
                        @endif
                        @if($item->description)
                            <p class="timeline-description">{{ $item->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($stack && $stack->count() > 0)
<!-- Stack Section -->
<section class="section stack-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Stack Tecnológica</h2>
            <p class="section-subtitle">Tecnologias e ferramentas que domino</p>
        </div>
        <div class="stack-grid">
            @foreach($stack as $tech)
            <div class="tech-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="tech-icon">{{ $tech->icon ?: '🔧' }}</div>
                <div class="tech-content">
                    <h3 class="tech-name">{{ $tech->name }}</h3>
                    @if($tech->level)
                        <span class="tech-level">{{ $tech->level }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($certificates && $certificates->count() > 0)
<!-- Certificates Section -->
<section class="section certificates-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Certificações</h2>
            <p class="section-subtitle">Conquistas e formações profissionais</p>
        </div>
        <div class="certificates-grid">
            @foreach($certificates as $cert)
            <div class="certificate-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="certificate-icon">{{ $cert->icon ?: '🏆' }}</div>
                <div class="certificate-content">
                    <h3 class="certificate-title">{{ $cert->title }}</h3>
                    @if($cert->issuer)
                        <p class="certificate-issuer">{{ $cert->issuer }}</p>
                    @endif
                    @if($cert->issued_at)
                        <span class="certificate-date">{{ $cert->issued_at->format('d/m/Y') }}</span>
                    @endif
                    @if($cert->url)
                        <a href="{{ $cert->url }}" target="_blank" class="certificate-link">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                <polyline points="15,3 21,3 21,9"/>
                                <line x1="10" y1="14" x2="21" y2="3"/>
                            </svg>
                            Ver certificado
                        </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
<style>
/* Fallback styles in case external CSS doesn't load */
.about-hero {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(147, 51, 234, 0.1) 100%);
    padding: 1rem 0;
    position: relative;
    overflow: hidden;
}

.profile-section {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 1.5rem;
    align-items: center;
    max-width: 1000px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}



.profile-photo {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #374151;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
}

.profile-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #374151, #1f2937);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 4px solid #374151;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
    color: #9ca3af;
}



.status-dot {
    width: 8px;
    height: 8px;
    background: #10b981;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.profile-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 2rem;
    padding: 0.5rem 1rem;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    color: #3b82f6;
}

.profile-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    background: linear-gradient(135deg, #ffffff 0%, #3b82f6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.2;
}

.profile-description {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #9ca3af;
    max-width: 600px;
    margin-bottom: 1.5rem;
}

.profile-stats {
    display: flex;
    gap: 2rem;
    margin-bottom: 1.5rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: #3b82f6;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.8rem;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.profile-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
}

.btn.primary {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.btn.primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
}

.btn.ghost {
    background: transparent;
    color: #9ca3af;
    border: 1px solid #374151;
}

.btn.ghost:hover {
    background: #374151;
    color: #ffffff;
    transform: translateY(-2px);
}

.hero-decoration {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    overflow: hidden;
}

.floating-shape {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(147, 51, 234, 0.1));
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 100px;
    height: 100px;
    top: 20%;
    right: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 60px;
    height: 60px;
    top: 60%;
    left: 5%;
    animation-delay: 2s;
}

.shape-3 {
    width: 80px;
    height: 80px;
    bottom: 20%;
    right: 20%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    background: linear-gradient(135deg, #ffffff 0%, #3b82f6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #9ca3af;
    max-width: 600px;
    margin: 0 auto;
}

.timeline-section {
    background: rgba(17, 24, 39, 0.5);
    padding: 4rem 0;
}

.timeline-container {
    max-width: 800px;
    margin: 0 auto;
    position: relative;
}

.timeline-container::before {
    content: '';
    position: absolute;
    left: 2rem;
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, #3b82f6, #9333ea);
}

.timeline-item {
    display: flex;
    gap: 2rem;
    margin-bottom: 3rem;
    position: relative;
}

.timeline-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 4rem;
    height: 4rem;
    background: #1f2937;
    border: 3px solid #3b82f6;
    border-radius: 50%;
    font-size: 1.5rem;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
}

.timeline-card {
    background: #1f2937;
    border: 1px solid #374151;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    flex: 1;
}

.timeline-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
}

.timeline-date {
    display: inline-block;
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
}

.timeline-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #ffffff;
}

.timeline-subtitle {
    color: #3b82f6;
    font-weight: 500;
    margin-bottom: 0.75rem;
}

.timeline-description {
    color: #9ca3af;
    line-height: 1.6;
}

.stack-section {
    padding: 4rem 0;
}

.stack-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    max-width: 1200px;
    margin: 0 auto;
}

.tech-card {
    background: #1f2937;
    border: 1px solid #374151;
    border-radius: 1rem;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.tech-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
    border-color: rgba(59, 130, 246, 0.3);
}

.tech-icon {
    font-size: 2.5rem;
    width: 4rem;
    height: 4rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(59, 130, 246, 0.1);
    border-radius: 0.75rem;
    flex-shrink: 0;
}

.tech-name {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #ffffff;
}

.tech-level {
    font-size: 0.9rem;
    color: #9ca3af;
    background: rgba(55, 65, 81, 0.5);
    padding: 0.25rem 0.5rem;
    border-radius: 0.5rem;
}

.certificates-section {
    background: rgba(17, 24, 39, 0.5);
    padding: 4rem 0;
}

.certificates-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 1.5rem;
    max-width: 1200px;
    margin: 0 auto;
}

.certificate-card {
    background: #1f2937;
    border: 1px solid #374151;
    border-radius: 1rem;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.certificate-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
    border-color: rgba(59, 130, 246, 0.3);
}

.certificate-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    display: block;
}

.certificate-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #ffffff;
}

.certificate-issuer {
    color: #3b82f6;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.certificate-date {
    display: block;
    font-size: 0.9rem;
    color: #9ca3af;
    margin-bottom: 1rem;
}

.certificate-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #3b82f6;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.certificate-link:hover {
    color: rgba(59, 130, 246, 0.8);
}

@media (max-width: 768px) {
    .about-hero {
        padding: 2rem 0;
    }
    
    .profile-section {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 1.5rem;
    }
    
    .profile-photo,
    .profile-placeholder {
        width: 120px;
        height: 120px;
    }
    
    .profile-title {
        font-size: 2rem;
    }
    
    .profile-description {
        font-size: 1rem;
    }
    
    .profile-stats {
        gap: 1rem;
        justify-content: center;
    }
    
    .stat-number {
        font-size: 1.25rem;
    }
    
    .profile-actions {
        justify-content: center;
    }
    
    .btn {
        padding: 0.6rem 1.2rem;
        font-size: 0.85rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .timeline-container::before {
        left: 1.5rem;
    }
    
    .timeline-item {
        gap: 1rem;
    }
    
    .timeline-icon {
        width: 3rem;
        height: 3rem;
        font-size: 1.2rem;
    }
    
    .stack-grid,
    .certificates-grid {
        grid-template-columns: 1fr;
    }
    
    .floating-shape {
        display: none;
    }
}
</style>
@endpush

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Theme toggle
    setupThemeToggle();
});

function setupThemeToggle() {
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;
    
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
