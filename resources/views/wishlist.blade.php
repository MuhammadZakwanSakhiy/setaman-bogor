@extends('layouts.setaman')

@section('title', 'Wishlist - Setaman Bogor')

@php
    $items = [
        ['nama' => 'Monstera Deliciosa', 'kategori' => 'Outdoor / Botanical', 'harga' => 'Rp 250.000', 'image' => 'https://images.unsplash.com/photo-1614594975525-e45190c55d0b?auto=format&fit=crop&w=500&q=80'],
        ['nama' => 'Ficus Lyrata', 'kategori' => 'Indoor / Air Purifying', 'harga' => 'Rp 175.000', 'image' => 'https://images.unsplash.com/photo-1598880940080-ff9a29891b85?auto=format&fit=crop&w=500&q=80'],
        ['nama' => 'Anggrek Bulan', 'kategori' => 'Outdoor / Flowering', 'harga' => 'Rp 350.000', 'image' => 'https://images.unsplash.com/photo-1566907225471-2e94c99ec0cf?auto=format&fit=crop&w=500&q=80'],
    ];
@endphp

@section('content')
<section class="container mx-auto px-6 py-12">
    <div class="mb-10">
        <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Favorit</div>
        <h1 class="mt-3 text-3xl font-bold text-brand-dark">Wishlist Anda</h1>
        <p class="mt-2 text-gray-500">Simpan tanaman incaran dan pindahkan ke keranjang saat siap memesan.</p>
    </div>

    <div class="grid gap-4">
        @foreach ($items as $item)
            <div class="flex flex-col gap-4 rounded-3xl border border-gray-100 bg-white p-4 shadow-sm md:flex-row md:items-center">
                <img src="{{ $item['image'] }}" alt="{{ $item['nama'] }}" class="h-32 w-full rounded-2xl object-cover md:w-40">
                <div class="flex-1">
                    <div class="text-[11px] font-bold uppercase tracking-[0.25em] text-brand">{{ $item['kategori'] }}</div>
                    <h2 class="mt-2 text-xl font-bold text-brand-dark">{{ $item['nama'] }}</h2>
                    <p class="mt-1 font-semibold text-gray-600">{{ $item['harga'] }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ url('/keranjang') }}" class="rounded-md bg-brand px-4 py-3 text-sm font-bold text-white hover:bg-brand-dark">Pindah ke Keranjang</a>
                    <button class="rounded-md border border-red-100 px-4 py-3 text-sm font-bold text-red-500 hover:bg-red-50">Hapus</button>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
