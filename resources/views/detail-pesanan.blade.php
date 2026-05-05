@extends('layouts.setaman')

@section('title', 'Detail Pesanan - Setaman Bogor')

@section('content')
<section class="container mx-auto px-6 py-12">
    <a href="{{ url('/pesanan') }}" class="mb-8 inline-flex items-center gap-2 text-sm font-semibold text-brand">
        <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
    </a>

    <div class="grid gap-8 lg:grid-cols-[1fr_360px]">
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                <div>
                    <div class="text-xs font-bold uppercase tracking-[0.25em] text-brand">SB-2026-001</div>
                    <h1 class="mt-2 text-3xl font-bold text-brand-dark">Detail Pesanan</h1>
                    <p class="mt-2 text-gray-500">Dibuat pada 5 Mei 2026</p>
                </div>
                @include('components.badge-status', ['status' => 'diproses'])
            </div>

            <div class="mt-8 space-y-4">
                @foreach ([
                    ['nama' => 'Monstera Deliciosa', 'qty' => 1, 'harga' => 'Rp 250.000'],
                    ['nama' => 'Ficus Lyrata', 'qty' => 2, 'harga' => 'Rp 350.000'],
                ] as $item)
                    <div class="flex justify-between rounded-2xl bg-brand-light p-4">
                        <div>
                            <div class="font-bold text-brand-dark">{{ $item['nama'] }}</div>
                            <div class="mt-1 text-sm text-gray-500">Jumlah: {{ $item['qty'] }}</div>
                        </div>
                        <div class="font-bold text-brand-dark">{{ $item['harga'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <aside class="h-fit rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <h2 class="font-bold text-brand-dark">Informasi Pembeli</h2>
            <div class="mt-4 space-y-3 text-sm text-gray-500">
                <p><span class="font-semibold text-brand-dark">Nama:</span> Budi Setiawan</p>
                <p><span class="font-semibold text-brand-dark">WhatsApp:</span> 081234567890</p>
                <p><span class="font-semibold text-brand-dark">Alamat:</span> Jl. Dramaga, Bogor</p>
            </div>
            <div class="mt-6 border-t border-green-100 pt-6 space-y-3 text-sm">
                <div class="flex justify-between text-gray-500"><span>Subtotal</span><span>Rp 600.000</span></div>
                <div class="flex justify-between text-gray-500"><span>Ongkir</span><span>Rp 0</span></div>
                <div class="flex justify-between text-lg font-bold text-brand-dark"><span>Total</span><span>Rp 600.000</span></div>
            </div>
        </aside>
    </div>
</section>
@endsection
