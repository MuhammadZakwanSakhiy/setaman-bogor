@extends('layouts.setaman')

@section('title', 'Katalog Tanaman - Setaman Bogor')

@php
    $produkList = [
        ['nama' => 'Monstera Deliciosa', 'slug' => 'monstera-deliciosa', 'kategori' => 'Tanaman Indoor', 'harga' => 'Rp 250.000', 'stok' => 12, 'best' => true, 'deskripsi' => 'Tanaman hias populer dengan daun berlubang unik yang mudah dirawat.', 'image' => 'https://images.unsplash.com/photo-1614594975525-e45190c55d0b?auto=format&fit=crop&w=700&q=80'],
        ['nama' => 'Sansevieria Trifasciata', 'slug' => 'sansevieria-trifasciata', 'kategori' => 'Tanaman Indoor', 'harga' => 'Rp 120.000', 'stok' => 18, 'deskripsi' => 'Lidah mertua tangguh yang mampu menyaring udara ruangan.', 'image' => 'https://images.unsplash.com/photo-1593482892290-f54927ae2b3c?auto=format&fit=crop&w=700&q=80'],
        ['nama' => 'Orchidaceae Phalaenopsis', 'slug' => 'orchidaceae-phalaenopsis', 'kategori' => 'Tanaman Outdoor', 'harga' => 'Rp 350.000', 'stok' => 7, 'deskripsi' => 'Anggrek bulan dengan kelopak putih bersih yang elegan.', 'image' => 'https://images.unsplash.com/photo-1566907225471-2e94c99ec0cf?auto=format&fit=crop&w=700&q=80'],
        ['nama' => 'Pupuk Organik Cair', 'slug' => 'pupuk-organik-cair', 'kategori' => 'Nutrisi', 'harga' => 'Rp 45.000', 'stok' => 30, 'deskripsi' => 'Nutrisi lengkap untuk mempercepat pertumbuhan dan kesehatan daun.', 'image' => 'https://images.unsplash.com/photo-1615671524827-c1fe3973b648?auto=format&fit=crop&w=700&q=80'],
        ['nama' => 'Ficus Lyrata', 'slug' => 'ficus-lyrata', 'kategori' => 'Tanaman Indoor', 'harga' => 'Rp 420.000', 'stok' => 2, 'deskripsi' => 'Ketapang biola dengan daun lebar yang memberi pernyataan artistik.', 'image' => 'https://images.unsplash.com/photo-1598880940080-ff9a29891b85?auto=format&fit=crop&w=700&q=80'],
        ['nama' => 'Aloe Barbadensis', 'slug' => 'aloe-barbadensis', 'kategori' => 'Tanaman Outdoor', 'harga' => 'Rp 65.000', 'stok' => 0, 'deskripsi' => 'Lidah buaya multifungsi yang tahan panas dan mudah dikembangkan.', 'image' => 'https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=700&q=80'],
    ];
@endphp

@section('content')
<section class="container mx-auto px-6 py-12">
    <div class="mb-10 flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
        <div>
            <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Cari Produk</div>
            <h1 class="mt-3 text-3xl font-bold text-brand-dark">Katalog Tanaman</h1>
            <p class="mt-2 text-gray-500">Temukan tanaman favorit Anda dari koleksi Setaman Bogor.</p>
        </div>
        <div class="flex rounded-full bg-brand-light p-1 text-sm font-semibold">
            @foreach (['Semua', 'Indoor', 'Outdoor', 'Pupuk', 'Pot'] as $index => $filter)
                <button class="rounded-full px-4 py-2 {{ $index === 0 ? 'bg-white text-brand shadow-sm' : 'text-gray-500' }}">{{ $filter }}</button>
            @endforeach
        </div>
    </div>

    <div class="mb-8 grid gap-4 lg:grid-cols-[1fr_220px_220px]">
        <label class="relative block">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-brand"></i>
            <input type="search" placeholder="Cari tanaman favorit Anda..." class="w-full rounded-2xl border border-green-100 bg-white py-4 pl-12 pr-4 text-sm outline-none transition focus:border-brand">
        </label>
        <select class="rounded-2xl border border-green-100 bg-white px-4 py-4 text-sm text-gray-500 outline-none focus:border-brand">
            <option>Urutkan: Terbaru</option>
            <option>Harga Termurah</option>
            <option>Harga Termahal</option>
            <option>Terlaris</option>
        </select>
        <select class="rounded-2xl border border-green-100 bg-white px-4 py-4 text-sm text-gray-500 outline-none focus:border-brand">
            <option>Rentang Harga</option>
            <option>Di bawah Rp100.000</option>
            <option>Rp100.000 - Rp300.000</option>
            <option>Di atas Rp300.000</option>
        </select>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($produkList as $produk)
            @include('components.kartu-produk', ['produk' => $produk])
        @endforeach
    </div>

    <div class="mt-12 flex items-center justify-center gap-2">
        @foreach ([1, 2, 3] as $page)
            <button class="grid h-10 w-10 place-items-center rounded-full text-sm font-bold {{ $page === 1 ? 'bg-brand text-white' : 'bg-brand-light text-brand' }}">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</button>
        @endforeach
    </div>
</section>
@endsection
