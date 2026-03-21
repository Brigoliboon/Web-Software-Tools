<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard route - shows different dashboard based on user role
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Books routes
Route::resource('books', BookController::class)->only(['index', 'show']);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('books', BookController::class)->except(['index', 'show']);
});

// Categories routes
Route::resource('categories', CategoryController::class)->only(['index', 'show']);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('categories', CategoryController::class)->except(['index', 'show']);
});

// Cart routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{bookId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{bookId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
});

// Order routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('orders', OrderController::class);
});

// Review routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Two-Factor Authentication routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/two-factor/setup', [TwoFactorController::class, 'showSetup'])->name('two-factor.setup');
    Route::post('/two-factor/enable', [TwoFactorController::class, 'enable'])->name('two-factor.enable');
    Route::post('/two-factor/disable', [TwoFactorController::class, 'disable'])->name('two-factor.disable');
    Route::get('/two-factor/backup-codes', [TwoFactorController::class, 'showBackupCodes'])->name('two-factor.backup-codes');
    Route::get('/two-factor/verify', [TwoFactorController::class, 'showVerify'])->name('two-factor.verify');
    Route::post('/two-factor/verify', [TwoFactorController::class, 'verify'])->name('two-factor.verify.post');
    Route::post('/two-factor/regenerate', [TwoFactorController::class, 'regenerateBackupCodes'])->name('two-factor.regenerate');
});

// Two-Factor Registration Verification (before email verification)
Route::middleware(['auth'])->group(function () {
    Route::get('/two-factor/verify-registration', [TwoFactorController::class, 'showVerifyRegistration'])->name('two-factor.verify-registration');
    Route::post('/two-factor/verify-registration', [TwoFactorController::class, 'verifyRegistration'])->name('two-factor.verify-registration.post');
    Route::post('/two-factor/resend-code', [TwoFactorController::class, 'resendCode'])->name('two-factor.resend-code');
});

// Profile routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Notification routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::patch('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

// Admin Routes - accessible only to admin users
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // User Management
    Route::resource('users', UserController::class);
    
    // Book Management (full CRUD accessible to admin)
    Route::resource('books', BookController::class);
    
    // Category Management (full CRUD accessible to admin)
    Route::resource('categories', CategoryController::class);
    
    // Order Management
    Route::get('/orders/pending', [OrderController::class, 'pendingOrders'])->name('orders.pending');
    Route::patch('/orders/{order}/approve', [OrderController::class, 'approve'])->name('orders.approve');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'destroy']);
});
