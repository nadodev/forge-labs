# Geja Systems

Sistema de portfólio e catálogo de sistemas desenvolvido em Laravel com Blade templates.

## 🚀 Características

- **Design Moderno**: Interface limpa e responsiva com modo claro/escuro
- **Banco de Dados**: Sistema completo com models, migrations e seeders
- **Catálogo de Sistemas**: Filtros, busca e ordenação avançada
- **Páginas Detalhadas**: Sistema de tabs, galeria e sidebar sticky
- **Sistema de Reviews**: Avaliações e depoimentos dos usuários
- **Formulário de Contato**: Salva mensagens no banco de dados
- **Carrinho de Compras**: Sistema completo com Stripe
- **Painel Admin**: CRUD completo para todos os recursos
- **Animações Suaves**: Efeitos de typing, partículas e transições
- **Responsivo**: Otimizado para todos os dispositivos

## 📁 Estrutura do Projeto

```
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   ├── SystemController.php
│   │   ├── AboutController.php
│   │   └── ContactController.php
│   └── Models/
│       ├── System.php
│       ├── Category.php
│       ├── Tag.php
│       ├── Review.php
│       └── Message.php
├── database/
│   ├── migrations/
│   │   ├── create_categories_table.php
│   │   ├── create_tags_table.php
│   │   ├── create_systems_table.php
│   │   ├── create_system_tag_table.php
│   │   ├── create_reviews_table.php
│   │   └── create_messages_table.php
│   └── seeders/
│       ├── CategorySeeder.php
│       ├── TagSeeder.php
│       ├── SystemSeeder.php
│       ├── ReviewSeeder.php
│       └── DatabaseSeeder.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── home.blade.php
│   │   ├── systems/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   ├── about.blade.php
│   │   └── contact.blade.php
│   ├── css/
│   │   └── app.css
│   └── js/
│       ├── app.js
│       └── bootstrap.js
├── routes/
│   └── web.php
└── public/
    └── index.php
```

## 🎨 Design System

### Cores
- **Primária**: #2563eb (Azul tecnológico)
- **Secundária**: #7c3aed (Roxo inovador)
- **Fundo Escuro**: #0f172a
- **Fundo Claro**: #ffffff
- **Texto**: #f1f5f9 (escuro) / #1e293b (claro)

### Tipografia
- **Títulos**: Poppins (600, 700)
- **Corpo**: Inter (400, 600, 700, 800)

### Componentes
- Botões com microinterações
- Cards com hover effects
- Sistema de tabs
- Lightbox para galeria
- Formulários com validação
- Notificações toast

## 🛠️ Instalação

1. **Clone o repositório**
```bash
git clone <repository-url>
cd geja-systems
```

2. **Instale as dependências**
```bash
composer install
npm install
```

3. **Configure o ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure o banco de dados**
```bash
# Edite o arquivo .env com suas credenciais
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=geja_systems
DB_USERNAME=root
DB_PASSWORD=
```

5. **Execute migrações e seeders**
```bash
php artisan migrate --seed
```

6. **Compile os assets**
```bash
npm run dev
# ou para produção
npm run build
```

7. **Inicie o servidor**
```bash
php artisan serve
```

### 🔐 Login (sem cadastro)

- Acesse "Entrar" no topo do site
- Usuário inicial (semeado):
  - Email: `admin@geja.local`
  - Senha: `password`
  - Recomenda-se alterar em produção

## 📄 Páginas Implementadas

### 🏠 Home
- Hero section com typing effect
- Cards de sistemas em destaque
- Categorias com links
- Vídeo de demonstração
- Feedbacks/testimonials

### 💻 Catálogo de Sistemas
- Grid responsivo de cards
- Filtros laterais (categoria, licença, linguagem)
- Busca instantânea
- Ordenação (data, popularidade, preço)
- Toggle de visualização (grade/lista)

### 📘 Detalhes do Sistema
- Banner hero com overlay
- Sistema de tabs (Descrição, Recursos, Tecnologias, Feedbacks)
- Galeria de screenshots com lightbox
- Sidebar sticky com preço e ações
- Sistemas relacionados

### 👤 Sobre
- Timeline interativa da trajetória
- Stack tecnológico com ícones
- Certificados e reconhecimentos
- Foto profissional

### ✉️ Contato
- Formulário com validação
- Botões de ação rápida (WhatsApp, Email, LinkedIn)
- Integração com Laravel Mail
- Captcha simples

## 🎯 Funcionalidades

### Interativas
- ✅ Modo claro/escuro (localStorage)
- ✅ Typing effect no hero
- ✅ Animações de partículas
- ✅ Scroll suave
- ✅ Lightbox para galeria
- ✅ Sistema de tabs
- ✅ Filtros dinâmicos
- ✅ Busca com debounce
- ✅ Notificações toast

### Comerciais (Preparado para)
- 🛒 Carrinho de compras
- 💳 Integração com Stripe/Mercado Pago
- 📧 Newsletter
- 👥 Área do cliente
- 📊 Dashboard administrativo

## 🔧 Tecnologias

- **Backend**: Laravel 10
- **Frontend**: Blade Templates, CSS3, JavaScript ES6+
- **Build**: Vite
- **Styling**: CSS Custom Properties, Flexbox, Grid
- **Icons**: Emoji (futuro: Lucide/Heroicons)
- **Fonts**: Google Fonts (Inter, Poppins)

## 📱 Responsividade

- **Desktop**: 1200px+ (Layout completo)
- **Tablet**: 768px - 1199px (Layout adaptado)
- **Mobile**: < 768px (Layout empilhado)

## 🚀 Próximos Passos

1. **Sistema de Autenticação**
2. **Painel Administrativo**
3. **Integração com Pagamentos**
4. **Sistema de Avaliações**
5. **Newsletter**
6. **SEO Otimizado**
7. **PWA (Progressive Web App)**

## 📞 Suporte

Para dúvidas ou suporte, entre em contato:
- **Email**: contato@gejasystems.com
- **WhatsApp**: (11) 99999-9999

---

Desenvolvido com ❤️ por Geja Systems