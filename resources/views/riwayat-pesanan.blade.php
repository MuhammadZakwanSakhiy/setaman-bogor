@extends('layouts.setaman')

@section('title', 'Riwayat Pesanan - Setaman Bogor')

@php
    $pesanan = [
        ['kode' => 'SB-2026-001', 'tanggal' => '5 Mei 2026', 'total' => 'Rp 600.000', 'status' => 'diproses'],
        ['kode' => 'SB-2026-000', 'tanggal' => '28 April 2026', 'total' => 'Rp 185.000', 'status' => 'selesai'],
    ];
@endphp

@section('content')
<section class="container mx-auto px-6 py-12">
    <div class="mb-10">
        <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Transaksi</div>
        <h1 class="mt-3 text-3xl font-bold text-brand-dark">Riwayat Pesanan</h1>
        <p class="mt-2 text-gray-500">Pantau status pesanan tanaman Anda.</p>
    </div>

    <div class="grid gap-4">
        @foreach ($pesanan as $item)
            <a href="{{ url('/pesanan/' . $item['kode']) }}" class="flex flex-col gap-4 rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg md:flex-row md:items-center md:justify-between">
                <div>
                    <div class="text-xs font-bold uppercase tracking-[0.25em] text-brand">{{ $item['kode'] }}</div>
                    <h2 class="mt-2 text-xl font-bold text-brand-dark">{{ $item['tanggal'] }}</h2>
                    <p class="mt-1 text-sm text-gray-500">2 item tanaman</p>
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
