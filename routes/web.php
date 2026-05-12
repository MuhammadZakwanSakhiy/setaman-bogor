<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('login');
});

Route::get('/registrasi', function () {
    return view('registrasi');
});

Route::get('/profil', function () {
    return view('profil-pengguna');
});

Route::get('/wishlist', function () {
    return view('wishlist');
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

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});
