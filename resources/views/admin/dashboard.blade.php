@extends('layouts.admin')

@section('title', 'Dashboard Admin - Setaman Bogor')

@section('content')
<header class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
        <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Ringkasan Dashboard</div>
        <h1 class="mt-3 text-3xl font-bold text-brand-dark">Selamat datang kembali, Admin.</h1>
        <p class="mt-2 text-gray-500">Berikut adalah performa toko hari ini.</p>
    </div>
    <a href="{{ url('/admin/produk/tambah') }}" class="inline-flex items-center justify-center gap-2 rounded-md bg-brand px-5 py-3 font-bold text-white hover:bg-brand-dark">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>
</header>

<section class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
    @foreach ([
        ['label' => 'Total Pesanan', 'value' => '1,284', 'meta' => '+12% bulan ini', 'icon' => 'fa-receipt'],
        ['label' => 'Stok Menipis', 'value' => '08', 'meta' => 'Lihat detail', 'icon' => 'fa-triangle-exclamation'],
        ['label' => 'Total Produk', 'value' => '245', 'meta' => 'Katalog aktif', 'icon' => 'fa-seedling'],
        ['label' => 'Total Artikel', 'value' => '56', 'meta' => 'Konten edukasi', 'icon' => 'fa-newspaper'],
    ] as $card)
        <div class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400">{{ $card['label'] }}</div>
                <div class="grid h-10 w-10 place-items-center rounded-full bg-brand-light text-brand"><i class="fas {{ $card['icon'] }}"></i></div>
            </div>
            <div class="mt-6 text-4xl font-bold text-brand-dark">{{ $card['value'] }}</div>
            <div class="mt-2 text-xs font-bold uppercase tracking-widest text-brand">{{ $card['meta'] }}</div>
        </div>
    @endforeach
</section>

<section class="mt-8 grid gap-8 xl:grid-cols-[1fr_380px]">
    <div class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-xl font-bold text-brand-dark">Tren Penjualan</h2>
            <div class="rounded-full bg-brand-light p-1 text-xs font-bold">
                <button class="rounded-full bg-white px-4 py-2 text-brand shadow-sm">Mingguan</button>
                <button class="px-4 py-2 text-gray-400">Bulanan</button>
            </div>
        </div>
        <div class="flex h-72 items-end gap-4 rounded-2xl bg-brand-light p-6">
            @foreach ([35, 58, 42, 70, 63, 86, 74] as $bar)
                <div class="flex flex-1 flex-col items-center justify-end gap-3">
                    <div class="w-full rounded-t-xl bg-brand" style="height: {{ $bar }}%;"></div>
                </div>
            @endforeach
        </div>
        <div class="mt-3 grid grid-cols-7 text-center text-xs font-bold uppercase tracking-widest text-gray-400">
            @foreach (['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $hari)
                <span>{{ $hari }}</span>
            @endforeach
        </div>
    </div>

    <div class="space-y-8">
        <div class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-brand-dark">Pesanan Terakhir</h2>
            <div class="mt-5 space-y-4">
                @foreach ([['SB-001', 'Budi Setiawan', 'diproses'], ['SB-000', 'Ayu Lestari', 'pending']] as $order)
                    <a href="{{ url('/admin/pesanan/' . $order[0]) }}" class="flex items-center justify-between rounded-2xl bg-brand-light p-4">
                        <div>
                            <div class="font-bold text-brand-dark">{{ $order[0] }}</div>
                            <div class="text-sm text-gray-500">{{ $order[1] }}</div>
                        </div>
                        @include('components.badge-status', ['status' => $order[2]])
                    </a>
                @endforeach
            </div>
        </div>

        <div class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-brand-dark">Peringatan Stok</h2>
            <div class="mt-5 space-y-3">
                @foreach ([['Ficus Lyrata', 'Sisa 2 unit'], ['Alocasia Polly', 'Sisa 1 unit'], ['Pot Terakota M', 'Habis']] as $stock)
                    <div class="flex items-center justify-between rounded-2xl bg-brand-light p-4">
                        <div>
                            <div class="font-bold text-brand-dark">{{ $stock[0] }}</div>
                            <div class="text-sm text-gray-500">{{ $stock[1] }}</div>
                        </div>
                        <a href="{{ url('/admin/produk') }}" class="text-xs font-bold uppercase tracking-widest text-brand">Restock</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
