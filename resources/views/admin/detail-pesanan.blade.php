@extends('layouts.admin')

@section('title', 'Detail Pesanan Admin - Setaman Bogor')

@section('content')
<a href="{{ url('/admin/pesanan') }}" class="mb-8 inline-flex items-center gap-2 text-sm font-semibold text-brand">
    <i class="fas fa-arrow-left"></i> Kembali ke Pesanan
</a>

<section class="grid gap-8 xl:grid-cols-[1fr_360px]">
    <div class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
            <div>
                <div class="text-xs font-bold uppercase tracking-[0.25em] text-brand">SB-2026-001</div>
                <h1 class="mt-3 text-3xl font-bold text-brand-dark">Pesanan Budi Setiawan</h1>
                <p class="mt-2 text-gray-500">Checkout melalui website pada 5 Mei 2026.</p>
            </div>
            @include('components.badge-status', ['status' => 'diproses'])
        </div>

        <div class="mt-8 grid gap-4">
            @foreach ([['Monstera Deliciosa', 1, 'Rp 250.000'], ['Ficus Lyrata', 2, 'Rp 350.000']] as $item)
                <div class="flex items-center justify-between rounded-2xl bg-brand-light p-4">
                    <div>
                        <div class="font-bold text-brand-dark">{{ $item[0] }}</div>
                        <div class="text-sm text-gray-500">Jumlah: {{ $item[1] }}</div>
                    </div>
                    <div class="font-bold text-brand-dark">{{ $item[2] }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <aside class="h-fit rounded-3xl border border-green-100 bg-white p-6 shadow-sm">
        <h2 class="font-bold text-brand-dark">Update Status</h2>
        <select class="mt-4 w-full rounded-2xl border border-green-100 px-4 py-3 text-gray-500 outline-none focus:border-brand">
            <option>Pending</option>
            <option selected>Diproses</option>
            <option>Dikirim</option>
            <option>Selesai</option>
            <option>Dibatalkan</option>
        </select>
        <button class="mt-4 w-full rounded-md bg-brand px-5 py-4 font-bold text-white hover:bg-brand-dark">Simpan Status</button>
        <a href="https://wa.me/6281234567890" class="mt-3 block rounded-md border border-green-100 px-5 py-4 text-center font-bold text-brand hover:bg-brand-light">Buka WhatsApp</a>

        <div class="mt-6 border-t border-green-100 pt-6 text-sm text-gray-500 space-y-3">
            <p><span class="font-bold text-brand-dark">Nama:</span> Budi Setiawan</p>
            <p><span class="font-bold text-brand-dark">Phone:</span> 081234567890</p>
            <p><span class="font-bold text-brand-dark">Alamat:</span> Jl. Dramaga, Bogor</p>
            <p class="flex justify-between border-t border-green-100 pt-4 text-lg font-bold text-brand-dark"><span>Total</span><span>Rp 600.000</span></p>
        </div>
    </aside>
</section>
@endsection
