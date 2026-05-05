@extends('layouts.setaman')

@section('title', 'Registrasi - Setaman Bogor')

@section('content')
<section class="container mx-auto px-6 py-12">
    <div class="mx-auto max-w-xl rounded-3xl border border-gray-100 bg-white p-8 shadow-sm">
        <h1 class="text-3xl font-bold text-brand-dark">Daftar Akun Baru</h1>
        <p class="mt-2 text-sm text-gray-500">Buat akun untuk menyimpan wishlist dan melihat riwayat pesanan.</p>
        <form class="mt-8 grid gap-5 md:grid-cols-2">
            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                Nama Lengkap
                <input type="text" placeholder="Budi Setiawan" class="rounded-2xl border border-green-100 px-4 py-3 font-normal outline-none focus:border-brand">
            </label>
            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                Nomor WhatsApp
                <input type="tel" placeholder="081234567890" class="rounded-2xl border border-green-100 px-4 py-3 font-normal outline-none focus:border-brand">
            </label>
            <label class="grid gap-2 text-sm font-semibold text-brand-dark md:col-span-2">
                Email
                <input type="email" placeholder="contoh@email.com" class="rounded-2xl border border-green-100 px-4 py-3 font-normal outline-none focus:border-brand">
            </label>
            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                Password
                <input type="password" placeholder="••••••••" class="rounded-2xl border border-green-100 px-4 py-3 font-normal outline-none focus:border-brand">
            </label>
            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                Konfirmasi Password
                <input type="password" placeholder="••••••••" class="rounded-2xl border border-green-100 px-4 py-3 font-normal outline-none focus:border-brand">
            </label>
            <a href="{{ url('/profil') }}" class="rounded-md bg-brand px-6 py-4 text-center font-bold text-white hover:bg-brand-dark md:col-span-2">Daftar</a>
        </form>
    </div>
</section>
@endsection
