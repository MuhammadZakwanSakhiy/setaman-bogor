<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\CatalogController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ArticleController as FrontendArticleController;
use App\Http\Controllers\Frontend\PageController;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog');
Route::get('/katalog/{slug}', [CatalogController::class, 'show'])->name('katalog.show');

Route::get('/artikel', [FrontendArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [FrontendArticleController::class, 'show'])->name('artikel.show');



// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/registrasi', [AuthController::class, 'registerView'])->name('register');
    Route::post('/registrasi', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/pesanan', [ProfileController::class, 'orders'])->name('profile.orders');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');

    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::get('/privasi', [PageController::class, 'privasi'])->name('privasi');

// Admin Routes protected by RoleMiddleware
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');
    Route::resource('/products', ProductController::class);
    Route::resource('/categories', CategoryController::class)->except(['show']);
    Route::resource('/articles', ArticleController::class);
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/toggle-block', [UserController::class, 'toggleBlock'])->name('users.toggle-block');
});
