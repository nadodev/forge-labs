@props(['name' => 'icon', 'value' => '', 'placeholder' => 'Selecione um ícone'])

<div class="icon-selector-container">
    <div class="relative">
        <input type="text" 
               name="{{ $name }}" 
               value="{{ $value }}" 
               placeholder="{{ $placeholder }}"
               class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 pr-10 outline-none focus:ring-2 focus:ring-blue-500/40"
               id="icon-input-{{ $name }}"
               readonly>
        <button type="button" 
                class="absolute right-2 top-1/2 -translate-y-1/2 p-1 hover:bg-white/10 rounded"
                onclick="toggleIconSelector('{{ $name }}')">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M6 9l6 6 6-6"/>
            </svg>
        </button>
    </div>
    
    <div id="icon-selector-{{ $name }}" class="icon-selector hidden">
        <div class="icon-grid">
            @php
                $icons = [
                    '💻', '🚀', '⚡', '🔥', '⭐', '🎯', '💡', '🛠️', '📱', '🌐',
                    '🔧', '⚙️', '🎨', '📊', '🔒', '📈', '🎪', '🏆', '💎', '🌟',
                    '🎭', '🎪', '🎨', '🎵', '🎬', '📚', '🎓', '🏅', '🥇', '🏆',
                    '💼', '📋', '📝', '📄', '📑', '📊', '📈', '📉', '🔍', '🔎',
                    '⚡', '🔥', '💫', '✨', '🌟', '⭐', '🌙', '☀️', '🌈', '🎆',
                    '🎇', '🎊', '🎉', '🎈', '🎁', '🎀', '🏆', '🥇', '🥈', '🥉',
                    '🎖️', '🏅', '🎗️', '🎫', '🎟️', '🎪', '🎭', '🎨', '🎬', '🎤',
                    '🎧', '🎵', '🎶', '🎼', '🎹', '🥁', '🎺', '🎷', '🎸', '🎻',
                    '📱', '💻', '🖥️', '⌨️', '🖱️', '🖨️', '📷', '📹', '🎥', '📺',
                    '📻', '📞', '☎️', '📠', '📧', '📨', '📩', '📤', '📥', '📦'
                ];
            @endphp
            @foreach($icons as $icon)
                <button type="button" 
                        class="icon-option" 
                        data-icon="{{ $icon }}"
                        onclick="selectIcon('{{ $name }}', '{{ $icon }}')">
                    {{ $icon }}
                </button>
            @endforeach
        </div>
        <div class="icon-selector-footer">
            <button type="button" 
                    class="btn-secondary small"
                    onclick="toggleIconSelector('{{ $name }}')">
                Fechar
            </button>
        </div>
    </div>
</div>

<style>
.icon-selector-container {
    position: relative;
}

.icon-selector {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 50;
    background: hsl(var(--background));
    border: 1px solid hsl(var(--border));
    border-radius: 12px;
    box-shadow: 0 10px 25px hsl(var(--background) / 0.3);
    margin-top: 4px;
    max-height: 300px;
    overflow-y: auto;
}

.icon-grid {
    display: grid;
    grid-template-columns: repeat(10, 1fr);
    gap: 4px;
    padding: 12px;
}

.icon-option {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border: 1px solid hsl(var(--border) / 0.3);
    border-radius: 6px;
    background: hsl(var(--background));
    font-size: 16px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.icon-option:hover {
    background: hsl(var(--accent));
    border-color: hsl(var(--accent));
    transform: scale(1.1);
}

.icon-selector-footer {
    padding: 8px 12px;
    border-top: 1px solid hsl(var(--border) / 0.3);
    text-align: right;
}
</style>

<script>
function toggleIconSelector(name) {
    const selector = document.getElementById(`icon-selector-${name}`);
    selector.classList.toggle('hidden');
}

function selectIcon(name, icon) {
    const input = document.getElementById(`icon-input-${name}`);
    input.value = icon;
    toggleIconSelector(name);
}

// Fechar seletor ao clicar fora
document.addEventListener('click', function(e) {
    if (!e.target.closest('.icon-selector-container')) {
        document.querySelectorAll('.icon-selector').forEach(selector => {
            selector.classList.add('hidden');
        });
    }
});
</script>
