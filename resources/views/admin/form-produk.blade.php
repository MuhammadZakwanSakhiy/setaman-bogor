@extends('layouts.admin')

@section('title', 'Form Produk - Admin Setaman Bogor')

@section('content')
<a href="{{ url('/admin/produk') }}" class="mb-8 inline-flex items-center gap-2 text-sm font-semibold text-brand">
    <i class="fas fa-arrow-left"></i> Kembali ke Produk
</a>

<section class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm">
    <div class="mb-8">
        <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Produk</div>
        <h1 class="mt-3 text-3xl font-bold text-brand-dark">Form Produk</h1>
        <p class="mt-2 text-gray-500">Lengkapi informasi tanaman, stok, harga, foto, dan tips perawatan.</p>
    </div>

    <form class="grid gap-6 lg:grid-cols-[1fr_320px]">
        <div class="grid gap-5 md:grid-cols-2">
            <label class="grid gap-2 text-sm font-semibold text-brand-dark md:col-span-2">
                Nama Tanaman
                <input type="text" value="Monstera Deliciosa" class="rounded-2xl border border-green-100 px-4 py-3 font-normal outline-none focus:border-brand">
            </label>
            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                Harga
                <input type="number" value="250000" class="rounded-2xl border border-green-100 px-4 py-3 font-normal outline-none focus:border-brand">
            </label>
            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                Stok
                <input type="number" value="12" class="rounded-2xl border border-green-100 px-4 py-3 font-normal outline-none focus:border-brand">
            </label>
            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                Kategori
                <select class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-500 outline-none focus:border-brand">
                    <option>Tanaman Indoor</option>
                    <option>Tanaman Outdoor</option>
                    <option>Pupuk</option>
                    <option>Pot</option>
                </select>
            </label>
            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                Status
                <select class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-500 outline-none focus:border-brand">
                    <option>Aktif</option>
                    <option>Nonaktif</option>
                </select>
            </label>
            <label class="grid gap-2 text-sm font-semibold text-brand-dark md:col-span-2">
                Deskripsi
                <textarea rows="4" class="rounded-2xl border border-green-100 px-4 py-3 font-normal outline-none focus:border-brand">Tanaman ikonik dengan daun berlubang unik.</textarea>
            </label>
            <label class="grid gap-2 text-sm font-semibold text-brand-dark md:col-span-2">
                Tips Perawatan
                <textarea rows="4" class="rounded-2xl border border-green-100 px-4 py-3 font-normal outline-none focus:border-brand">Cahaya terang tidak langsung, siram saat tanah atas mulai kering.</textarea>
            </label>
        </div>

        <aside class="rounded-3xl bg-brand-light p-5">
            <h2 class="font-bold text-brand-dark">Foto Produk</h2>
            <div class="mt-4 grid h-64 place-items-center rounded-2xl border-2 border-dashed border-green-200 bg-white text-center text-sm text-gray-500">
                <div>
                    <i class="fas fa-cloud-arrow-up mb-3 text-3xl text-brand"></i>
                    <p>Upload foto tanaman</p>
                </div>
            </div>
            <label class="mt-4 flex items-center justify-between rounded-2xl bg-white p-4 text-sm font-semibold text-brand-dark">
                Best Seller
                <input type="checkbox" checked>
            </label>
            <button class="mt-5 w-full rounded-md bg-brand px-5 py-4 font-bold text-white hover:bg-brand-dark">Simpan Produk</button>
        </aside>
    </form>
</section>
@endsection
