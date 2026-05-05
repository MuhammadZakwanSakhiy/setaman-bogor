@extends('layouts.setaman')

@section('title', 'Keranjang - Setaman Bogor')

@php
    $items = [
        ['nama' => 'Monstera Deliciosa', 'kategori' => 'Outdoor / Botanical', 'harga' => 'Rp 250.000', 'qty' => 1, 'image' => 'https://images.unsplash.com/photo-1614594975525-e45190c55d0b?auto=format&fit=crop&w=500&q=80'],
        ['nama' => 'Ficus Lyrata', 'kategori' => 'Indoor / Air Purifying', 'harga' => 'Rp 175.000', 'qty' => 2, 'image' => 'https://images.unsplash.com/photo-1598880940080-ff9a29891b85?auto=format&fit=crop&w=500&q=80'],
    ];
@endphp

@section('content')
<section class="container mx-auto px-6 py-12">
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-brand-dark">Keranjang Belanja</h1>
        <p class="mt-2 text-gray-500">Periksa kembali tanaman pilihan sebelum checkout.</p>
    </div>

    <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
        <div class="space-y-4">
            @foreach ($items as $item)
                <div class="flex flex-col gap-4 rounded-3xl border border-gray-100 bg-white p-4 shadow-sm md:flex-row md:items-center">
                    <img src="{{ $item['image'] }}" alt="{{ $item['nama'] }}" class="h-32 w-full rounded-2xl object-cover md:w-40">
                    <div class="flex-1">
                        <div class="text-[11px] font-bold uppercase tracking-[0.25em] text-brand">{{ $item['kategori'] }}</div>
                        <h2 class="mt-2 text-xl font-bold text-brand-dark">{{ $item['nama'] }}</h2>
                        <p class="mt-1 font-semibold text-gray-600">{{ $item['harga'] }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="grid h-9 w-9 place-items-center rounded-full bg-brand-light text-brand">-</button>
                        <span class="w-6 text-center font-bold">{{ $item['qty'] }}</span>
                        <button class="grid h-9 w-9 place-items-center rounded-full bg-brand-light text-brand">+</button>
                    </div>
                    <button class="text-sm font-bold text-red-500">Hapus</button>
                </div>
            @endforeach
        </div>

        <aside class="h-fit rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-brand-dark">Ringkasan</h2>
            <div class="mt-6 space-y-4 text-sm">
                <div class="flex justify-between text-gray-500"><span>Subtotal</span><span>Rp 600.000</span></div>
                <div class="flex justify-between text-gray-500"><span>Estimasi Pengiriman</span><span>Rp 0</span></div>
                <div class="border-t border-green-100 pt-4 flex justify-between text-lg font-bold text-brand-dark"><span>Total</span><span>Rp 600.000</span></div>
            </div>
            <a href="{{ url('/checkout') }}" class="mt-6 block rounded-md bg-brand px-6 py-4 text-center font-bold text-white hover:bg-brand-dark">Lanjut ke Checkout</a>
            <a href="{{ url('/katalog') }}" class="mt-3 block rounded-md border border-green-100 px-6 py-4 text-center font-bold text-brand hover:bg-brand-light">Lanjutkan Belanja</a>
            <div class="mt-6 grid gap-3 text-sm text-gray-500">
                <div><i class="fas fa-truck mr-2 text-brand"></i>Gratis ongkir untuk wilayah Bogor</div>
                <div><i class="fas fa-shield-heart mr-2 text-brand"></i>Garansi tanaman sehat 7 hari</div>
            </div>
        </aside>
    </div>
</section>
@endsection
