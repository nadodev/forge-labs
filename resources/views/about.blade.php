@extends('layouts.app')

@section('title', 'Sobre - Geja Systems')

@section('content')
<section class="section">
    <div class="container">
        <h1 class="page-title">Sobre mim</h1>
        <div class="about-grid">
            <div class="about-card">
                <img src="/images/profile.jpg" alt="Foto do desenvolvedor" class="avatar">
                <p>Desenvolvedor focado em criar produtos digitais com qualidade e impacto. Especializado em Laravel, Vue.js e desenvolvimento de sistemas web modernos.</p>
            </div>
            <div class="about-card">
                <h3>Propósito</h3>
                <p>Transformar ideias em sistemas que simplificam rotinas e geram valor real para empresas e profissionais.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="section-title">Linha do tempo</h2>
        <div class="timeline" id="timeline">
            @foreach($timeline as $item)
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <div class="timeline-year">{{ $item['year'] }}</div>
                    <h3 class="timeline-title">{{ $item['title'] }}</h3>
                    <p class="timeline-description">{{ $item['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="section-title">Stack atual</h2>
        <div class="chip-row" id="stack">
            @foreach($stack as $tech)
            <div class="tech-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <span class="tech-icon">{{ $tech['icon'] }}</span>
                <div class="tech-info">
                    <h4 class="tech-name">{{ $tech['name'] }}</h4>
                    <span class="tech-level">{{ $tech['level'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="section-title">Certificados</h2>
        <div class="cert-grid" id="certs">
            @foreach($certificates as $cert)
            <div class="cert-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="cert-icon">{{ $cert['icon'] }}</div>
                <div class="cert-content">
                    <h4 class="cert-name">{{ $cert['name'] }}</h4>
                    <p class="cert-issuer">{{ $cert['issuer'] }}</p>
                    <span class="cert-date">{{ $cert['date'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

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
