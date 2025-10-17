@extends('layouts.app')

@section('title', 'Contato - Geja Systems')

@section('content')
<section class="section">
    <div class="container">
        <h1 class="page-title">Contato</h1>
        <div class="contact-layout">
            <div class="contact-info">
                <h2>Vamos conversar?</h2>
                <p>Entre em contato para solicitar um projeto personalizado ou tirar suas dúvidas.</p>
                
                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="contact-icon">📱</div>
                        <div class="contact-details">
                            <h3>WhatsApp</h3>
                            <p>Resposta rápida e direta</p>
                            <a href="https://wa.me/5549999195407" class="btn primary" target="_blank">Falar pelo WhatsApp</a>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">📧</div>
                        <div class="contact-details">
                            <h3>E-mail</h3>
                            <p>contato@leonardogeja.com.br</p>
                            <a href="mailto:contato@leonardogeja.com.br" class="btn secondary">Enviar e-mail</a>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">💼</div>
                        <div class="contact-details">
                            <h3>LinkedIn</h3>
                            <p>Conecte-se profissionalmente</p>
                            <a href="https://www.linkedin.com/in/leonardogeja" target="_blank" rel="noopener noreferrer" class="btn ghost">Ver no LinkedIn</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-container">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
                @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form method="POST" action="{{ route('contact.store') }}" class="contact-form">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">Nome *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-mail *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_reason">Motivo do contato *</label>
                        <select id="contact_reason" name="contact_reason" required>
                            <option value="">Selecione uma opção</option>
                            <option value="custom_project" {{ old('contact_reason') == 'custom_project' ? 'selected' : '' }}>Solicitar projeto personalizado</option>
                            <option value="general" {{ old('contact_reason') == 'general' ? 'selected' : '' }}>Tirar dúvidas sobre um sistema</option>
                            <option value="support" {{ old('contact_reason') == 'support' ? 'selected' : '' }}>Suporte técnico</option>
                            <option value="partnership" {{ old('contact_reason') == 'partnership' ? 'selected' : '' }}>Proposta de parceria</option>
                            <option value="other" {{ old('contact_reason') == 'other' ? 'selected' : '' }}>Outro</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Assunto (opcional)</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Assunto específico da mensagem">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Mensagem *</label>
                        <textarea id="message" name="message" rows="5" required placeholder="Descreva seu projeto ou dúvida...">{{ old('message') }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <div class="captcha">
                            <label for="captcha">Quanto é 2 + 2? *</label>
                            <input type="number" id="captcha" name="captcha" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn primary full-width" id="submitBtn">
                        <span class="btn-text">Enviar mensagem</span>
                        <span class="btn-loading" style="display: none;">
                            <svg class="loading-spinner" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Enviando...
                        </span>
                    </button>
                    
                    <!-- Loading Overlay -->
                    <div class="loading-overlay" id="loadingOverlay" style="display: none;">
                        <div class="loading-content">
                            <div class="loading-spinner-large">
                                <svg class="animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                            <p class="loading-text">Enviando sua mensagem...</p>
                            <p class="loading-subtext">Por favor, aguarde</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Theme toggle
    setupThemeToggle();
    
    // Form validation and loading state
    const form = document.querySelector('.contact-form');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    const loadingOverlay = document.getElementById('loadingOverlay');
    
    form.addEventListener('submit', function(e) {
        const captcha = document.getElementById('captcha').value;
        if (captcha !== '4') {
            e.preventDefault();
            alert('Por favor, responda corretamente a pergunta de segurança.');
            return;
        }
        
        loadingOverlay.style.display = 'flex';
        // Show loading state
        submitBtn.disabled = true;
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-flex';
        btnLoading.style.alignItems = 'center';
        btnLoading.style.gap = '8px';
    });
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
