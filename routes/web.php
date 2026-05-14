<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/katalog', function () {
    return view('katalog');
});

Route::get('/detail-produk', function () {
    return view('detail-produk');
});

Route::get('/artikel', function () {
    return view('artikel');
});

Route::get('/detail-artikel', function () {
    return view('detail-artikel');
});

Route::get('/keranjang', function () {
    return view('keranjang');
});

Route::get('/checkout', function () {
    return view('checkout');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/registrasi', [AuthController::class, 'registerView'])->name('register');
    Route::post('/registrasi', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/profil', function () {
        return view('profil-pengguna');
    });

    Route::get('/wishlist', function () {
        return view('wishlist');
    });
});

Route::get('/tentang', function () {
    return view('kontak-tentang');
});

Route::get('/kontak', function () {
    return view('kontak-tentang');
});

Route::get('/privasi', function () {
    return view('welcome'); // Placeholder until privasi is created
});

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;

// Admin Routes protected by RoleMiddleware
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('/products', ProductController::class);
    Route::resource('/articles', ArticleController::class);
    Route::resource('/orders', OrderController::class)->except(['create', 'store', 'edit']);
});
