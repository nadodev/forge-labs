<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SystemController as AdminSystemController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\StackController as AdminStackController;
use App\Http\Controllers\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Admin\TimelineController as AdminTimelineController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sistemas', [SystemController::class, 'index'])->name('systems.index');
Route::get('/sistema/{slug}', [SystemController::class, 'show'])->name('systems.show');
Route::get('/sobre', [AboutController::class, 'index'])->name('about');
Route::get('/contato', [ContactController::class, 'index'])->name('contact');
Route::post('/contato', [ContactController::class, 'store'])->name('contact.store');

// Portfolio
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{portfolio}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Cart
Route::get('/carrinho', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrinho/adicionar/{system}', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrinho/remover/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrinho/atualizar/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/carrinho/limpar', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/carrinho/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/carrinho/recibo/{order}', [CartController::class, 'receipt'])->name('cart.receipt');

// Stripe
Route::post('/stripe/checkout', [StripeController::class, 'createCheckoutSession'])->name('stripe.checkout');
Route::get('/stripe/sucesso/{order}', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/stripe/cancelado/{order}', [StripeController::class, 'cancel'])->name('stripe.cancel');
Route::post('/stripe/webhook', [StripeController::class, 'webhook'])->name('stripe.webhook');

// Auth (login/logout) - sem cadastro
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin - protegido por autenticação
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Systems CRUD (básico)
    Route::get('/systems', [AdminSystemController::class, 'index'])->name('systems.index');
    Route::get('/systems/create', [AdminSystemController::class, 'create'])->name('systems.create');
    Route::post('/systems', [AdminSystemController::class, 'store'])->name('systems.store');
    Route::get('/systems/{system}/edit', [AdminSystemController::class, 'edit'])->name('systems.edit');
    Route::put('/systems/{system}', [AdminSystemController::class, 'update'])->name('systems.update');
    Route::delete('/systems/{system}', [AdminSystemController::class, 'destroy'])->name('systems.destroy');

    // Categories CRUD
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    // Tags CRUD
    Route::get('/tags', [AdminTagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [AdminTagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [AdminTagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{tag}/edit', [AdminTagController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{tag}', [AdminTagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{tag}', [AdminTagController::class, 'destroy'])->name('tags.destroy');

    // Reviews e Messages (apenas listagem/moderação simples)
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');

    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/{message}/read', [AdminMessageController::class, 'markRead'])->name('messages.read');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

      // Profile management
      Route::resource('profile', AdminProfileController::class);

      // Stack management
      Route::resource('stack', AdminStackController::class);

      // Certificates management
      Route::resource('certificates', AdminCertificateController::class);

      // Timeline management
      Route::resource('timeline', AdminTimelineController::class);

      // About page management (legacy - manter para compatibilidade)
      Route::get('/about', [AdminAboutController::class, 'index'])->name('about.index');
      Route::post('/about/profile', [AdminAboutController::class, 'saveProfile'])->name('about.profile.save');
      Route::post('/about/stack', [AdminAboutController::class, 'storeStack'])->name('about.stack.store');
      Route::post('/about/stack/{stackItem}', [AdminAboutController::class, 'updateStack'])->name('about.stack.update');
      Route::delete('/about/stack/{stackItem}', [AdminAboutController::class, 'destroyStack'])->name('about.stack.destroy');
      Route::post('/about/certificates', [AdminAboutController::class, 'storeCertificate'])->name('about.certificates.store');
      Route::post('/about/certificates/{certificate}', [AdminAboutController::class, 'updateCertificate'])->name('about.certificates.update');
      Route::delete('/about/certificates/{certificate}', [AdminAboutController::class, 'destroyCertificate'])->name('about.certificates.destroy');
      Route::post('/about/timeline', [AdminAboutController::class, 'storeTimeline'])->name('about.timeline.store');
      Route::post('/about/timeline/{timelineItem}', [AdminAboutController::class, 'updateTimeline'])->name('about.timeline.update');
      Route::delete('/about/timeline/{timelineItem}', [AdminAboutController::class, 'destroyTimeline'])->name('about.timeline.destroy');

    // Orders management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');

    // Portfolio admin
    Route::get('/portfolio', [\App\Http\Controllers\Admin\PortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/portfolio/create', [\App\Http\Controllers\Admin\PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolio', [\App\Http\Controllers\Admin\PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolio/{portfolio}/edit', [\App\Http\Controllers\Admin\PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolio/{portfolio}', [\App\Http\Controllers\Admin\PortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('/portfolio/{portfolio}', [\App\Http\Controllers\Admin\PortfolioController::class, 'destroy'])->name('portfolio.destroy');
});