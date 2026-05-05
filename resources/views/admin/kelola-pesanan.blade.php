@extends('layouts.admin')

@section('title', 'Kelola Pesanan - Admin Setaman Bogor')

@php
    $pesanan = [
        ['kode' => 'SB-2026-001', 'nama' => 'Budi Setiawan', 'tanggal' => '5 Mei 2026', 'total' => 'Rp 600.000', 'status' => 'diproses'],
        ['kode' => 'SB-2026-002', 'nama' => 'Ayu Lestari', 'tanggal' => '5 Mei 2026', 'total' => 'Rp 185.000', 'status' => 'pending'],
        ['kode' => 'SB-2026-003', 'nama' => 'Raka Pratama', 'tanggal' => '4 Mei 2026', 'total' => 'Rp 350.000', 'status' => 'dikirim'],
    ];
@endphp

@section('content')
<header class="mb-8">
    <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Transaksi</div>
    <h1 class="mt-3 text-3xl font-bold text-brand-dark">Kelola Pesanan</h1>
    <p class="mt-2 text-gray-500">Pantau pesanan masuk dan perbarui status transaksi.</p>
</header>

<section class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm">
    <div class="mb-6 flex flex-wrap gap-2">
        @foreach (['Semua', 'Pending', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'] as $index => $filter)
            <button class="rounded-full px-4 py-2 text-sm font-bold {{ $index === 0 ? 'bg-brand text-white' : 'bg-brand-light text-brand' }}">{{ $filter }}</button>
        @endforeach
    </div>
    <div class="grid gap-4">
        @foreach ($pesanan as $item)
            <a href="{{ url('/admin/pesanan/' . $item['kode']) }}" class="flex flex-col gap-4 rounded-2xl border border-green-100 p-4 transition hover:bg-brand-light md:flex-row md:items-center md:justify-between">
                <div>
                    <div class="text-xs font-bold uppercase tracking-[0.25em] text-brand">{{ $item['kode'] }}</div>
                    <h2 class="mt-2 font-bold text-brand-dark">{{ $item['nama'] }}</h2>
                    <p class="text-sm text-gray-500">{{ $item['tanggal'] }}</p>
                </div>
                <div class="flex items-center gap-4">
                    @include('components.badge-status', ['status' => $item['status']])
                    <span class="font-bold text-brand-dark">{{ $item['total'] }}</span>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endsection
