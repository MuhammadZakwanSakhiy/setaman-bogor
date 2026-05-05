@extends('layouts.setaman')

@section('title', 'Checkout - Setaman Bogor')

@section('content')
<section class="container mx-auto px-6 py-12">
    <div class="mb-10">
        <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Pemesanan</div>
        <h1 class="mt-3 text-3xl font-bold text-brand-dark">Checkout</h1>
        <p class="mt-2 text-gray-500">Isi data pembeli, pilih metode pengiriman, lalu kirim pesanan ke WhatsApp admin.</p>
    </div>

    <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
        <form class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                    Nama Pembeli
                    <input type="text" value="Budi Setiawan" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand">
                </label>
                <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                    Nomor WhatsApp
                    <input type="tel" value="081234567890" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand">
                </label>
                <label class="grid gap-2 text-sm font-semibold text-brand-dark md:col-span-2">
                    Alamat
                    <textarea rows="4" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand">Jl. Dramaga, Bogor, Jawa Barat</textarea>
                </label>
                <label class="grid gap-2 text-sm font-semibold text-brand-dark md:col-span-2">
                    Catatan Pesanan
                    <input type="text" placeholder="Contoh: dikirim sore hari" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand">
                </label>
            </div>

            <div class="mt-8">
                <h2 class="font-bold text-brand-dark">Metode Pengiriman</h2>
                <div class="mt-4 grid gap-3 md:grid-cols-2">
                    <label class="rounded-2xl border-2 border-brand bg-brand-light p-4">
                        <input type="radio" name="shipping" checked class="mr-2">
                        <span class="font-semibold text-brand-dark">Ambil di Tempat</span>
                        <p class="mt-2 text-sm text-gray-500">Gratis, konfirmasi jadwal melalui WhatsApp.</p>
                    </label>
                    <label class="rounded-2xl border border-green-100 p-4">
                        <input type="radio" name="shipping" class="mr-2">
                        <span class="font-semibold text-brand-dark">Antar ke Alamat</span>
                        <p class="mt-2 text-sm text-gray-500">Ongkir manual sesuai area Bogor.</p>
                    </label>
                </div>
            </div>
        </form>

        <aside class="h-fit rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-brand-dark">Ringkasan Pesanan</h2>
            <div class="mt-5 space-y-4">
                <div class="flex justify-between gap-4 text-sm">
                    <span class="text-gray-500">Monstera Deliciosa x1</span>
                    <span class="font-semibold text-brand-dark">Rp 250.000</span>
                </div>
                <div class="flex justify-between gap-4 text-sm">
                    <span class="text-gray-500">Ficus Lyrata x2</span>
                    <span class="font-semibold text-brand-dark">Rp 350.000</span>
                </div>
                <div class="border-t border-green-100 pt-4 flex justify-between text-sm text-gray-500"><span>Subtotal</span><span>Rp 600.000</span></div>
                <div class="flex justify-between text-sm text-gray-500"><span>Ongkir</span><span>Rp 0</span></div>
                <div class="border-t border-green-100 pt-4 flex justify-between text-lg font-bold text-brand-dark"><span>Total</span><span>Rp 600.000</span></div>
            </div>
            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Setaman%20Bogor,%20saya%20ingin%20memesan%20tanaman." class="mt-6 block rounded-md bg-brand px-6 py-4 text-center font-bold text-white hover:bg-brand-dark">
                Kirim ke WhatsApp
            </a>
            <a href="{{ url('/pesanan') }}" class="mt-3 block text-center text-sm font-semibold text-brand hover:underline">Lihat Riwayat Pesanan</a>
        </aside>
    </div>
</section>
@endsection
