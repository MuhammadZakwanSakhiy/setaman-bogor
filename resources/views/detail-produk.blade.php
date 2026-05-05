@extends('layouts.setaman')

@section('title', 'Detail Produk - Setaman Bogor')

@php
    $produkSerupa = [
        ['nama' => 'Sansevieria', 'slug' => 'sansevieria', 'kategori' => 'Indoor', 'harga' => 'Rp 85.000', 'stok' => 20, 'deskripsi' => 'Tanaman tahan banting untuk ruangan minim cahaya.', 'image' => 'https://images.unsplash.com/photo-1593482892290-f54927ae2b3c?auto=format&fit=crop&w=700&q=80'],
        ['nama' => 'Philodendron', 'slug' => 'philodendron', 'kategori' => 'Indoor', 'harga' => 'Rp 120.000', 'stok' => 11, 'deskripsi' => 'Daun hijau mengilap dengan karakter tropis.', 'image' => 'https://images.unsplash.com/photo-1591958911259-bee2173bdccc?auto=format&fit=crop&w=700&q=80'],
        ['nama' => 'Calathea', 'slug' => 'calathea', 'kategori' => 'Outdoor', 'harga' => 'Rp 150.000', 'stok' => 8, 'deskripsi' => 'Motif daun cantik untuk aksen dekoratif.', 'image' => 'https://images.unsplash.com/photo-1632207691143-643e2a9a9361?auto=format&fit=crop&w=700&q=80'],
    ];
@endphp

@section('content')
<section class="container mx-auto px-6 py-12">
    <div class="grid gap-12 lg:grid-cols-2">
        <div class="space-y-4">
            <div class="overflow-hidden rounded-3xl bg-brand-light">
                <img src="https://images.unsplash.com/photo-1614594975525-e45190c55d0b?auto=format&fit=crop&w=900&q=80" alt="Monstera Deliciosa" class="h-[460px] w-full object-cover">
            </div>
            <div class="grid grid-cols-4 gap-3">
                @foreach ([
                    'https://images.unsplash.com/photo-1614594975525-e45190c55d0b?auto=format&fit=crop&w=300&q=80',
                    'https://images.unsplash.com/photo-1604762524889-3e2fcc145683?auto=format&fit=crop&w=300&q=80',
                    'https://images.unsplash.com/photo-1611843467160-25afb8df1074?auto=format&fit=crop&w=300&q=80',
                    'https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&w=300&q=80',
                ] as $gambar)
                    <img src="{{ $gambar }}" alt="Galeri Monstera" class="h-24 w-full rounded-2xl object-cover">
                @endforeach
            </div>
        </div>

        <div class="space-y-7">
            <div>
                <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Tanaman Indoor</div>
                <h1 class="mt-3 text-4xl font-bold text-brand-dark">Monstera Deliciosa</h1>
                <div class="mt-4 flex flex-wrap items-center gap-4">
                    <span class="text-2xl font-bold text-brand-dark">Rp 250.000</span>
                    <span class="rounded-full bg-green-50 px-4 py-2 text-xs font-bold uppercase tracking-widest text-brand">Tersedia 12 unit</span>
                </div>
            </div>

            <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
                <h2 class="font-bold uppercase tracking-[0.2em] text-brand-dark">Deskripsi</h2>
                <p class="mt-4 leading-7 text-gray-600">Tanaman ikonik dengan daun berlubang unik yang memberikan kesan tropis modern pada ruangan Anda. Mudah dirawat dan cocok untuk pemula.</p>
            </div>

            <div class="rounded-3xl bg-brand-light p-6">
                <h2 class="font-bold uppercase tracking-[0.2em] text-brand-dark">Tips Perawatan</h2>
                <ul class="mt-4 grid gap-3 text-sm text-gray-600">
                    <li><i class="fas fa-sun mr-3 text-brand"></i>Cahaya terang tidak langsung</li>
                    <li><i class="fas fa-droplet mr-3 text-brand"></i>Siram saat 2-3 cm tanah atas kering</li>
                    <li><i class="fas fa-temperature-half mr-3 text-brand"></i>Suhu ideal 18°C - 30°C</li>
                </ul>
            </div>

            <div class="grid gap-3 sm:grid-cols-2">
                <a href="{{ url('/keranjang') }}" class="rounded-md bg-brand px-6 py-4 text-center font-bold text-white transition hover:bg-brand-dark">Tambah ke Keranjang</a>
                <a href="{{ url('/checkout') }}" class="rounded-md bg-brand-dark px-6 py-4 text-center font-bold text-white transition hover:bg-brand">Beli Sekarang</a>
                <a href="{{ url('/wishlist') }}" class="sm:col-span-2 rounded-md border border-green-100 px-6 py-4 text-center font-bold text-brand transition hover:bg-brand-light">Simpan ke Wishlist</a>
            </div>

            <div class="rounded-3xl border border-gray-100 bg-white p-6">
                <div class="flex items-center justify-between">
                    <h2 class="font-bold text-brand-dark">Review Pengguna</h2>
                    <span class="text-sm font-semibold text-brand"><i class="fas fa-star"></i> 4.8 / 5</span>
                </div>
                <p class="mt-3 text-sm leading-6 text-gray-500">“Daunnya sehat, packing aman, dan cocok untuk sudut ruang kerja.”</p>
            </div>
        </div>
    </div>

    <div class="mt-20 flex items-end justify-between">
        <div>
            <div class="text-xs font-bold uppercase tracking-[0.3em] text-brand">Katalog Serupa</div>
            <h2 class="mt-3 text-2xl font-bold text-brand-dark">Mungkin Anda Suka</h2>
        </div>
        <a href="{{ url('/katalog') }}" class="text-sm font-semibold text-brand hover:underline">Lihat Semua</a>
    </div>
    <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-3">
        @foreach ($produkSerupa as $produk)
            @include('components.kartu-produk', ['produk' => $produk])
        @endforeach
    </div>
</section>
@endsection
