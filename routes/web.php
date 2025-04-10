<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', [ProductController::class, 'home'])->name('home'); 
// Products List
Route::get('/products/list', [ProductController::class, 'showAllProducts'])->name('products.list');  
// Product Details (Fixed)
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');
// Search
Route::get('/live-search', [ProductController::class, 'liveSearch']);

// ================================= CRUD =======================================================
// Products CRUD Routes
Route::prefix('admin/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});
// Users CRUD Routes
Route::prefix('admin/users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

// Packs CRUD Routes
Route::prefix('admin/packs')->group(function () {
    Route::get('/', [PackController::class, 'index'])->name('admin.packs.index');
    Route::get('/create', [PackController::class, 'create'])->name('admin.packs.create');
    Route::post('/', [PackController::class, 'store'])->name('admin.packs.store');
    Route::get('/{pack}/edit', [PackController::class, 'edit'])->name('admin.packs.edit');
    Route::put('/{pack}', [PackController::class, 'update'])->name('admin.packs.update');
    Route::delete('/{pack}', [PackController::class, 'destroy'])->name('admin.packs.destroy');
});});

// Orders CRUD Routes
Route::prefix('admin/orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
    Route::put('/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
});

// Categories CRUD Routes
Route::prefix('admin/categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});



// Admin Dashboard Route 
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile-page', [ProfileController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Laravel Auth Routes
require __DIR__.'/auth.php';

// Product Resource Controller
Route::resource('products', ProductController::class);
Route::get('/packs', [PackController::class, 'showPacks'])->name('packs.index');



Route::middleware('auth')->group(function () {
    // Cart routes
    Route::post('/order/add/{id}', [OrderController::class, 'addToCart'])->name('order.add');
    Route::get('/cart', [OrderController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/remove/{id}', [OrderController::class, 'remove'])->name('cart.remove');

    // Checkout routes
    Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('checkout.form');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout.submit');
});

