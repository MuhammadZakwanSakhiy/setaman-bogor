@extends('layouts.setaman')

@section('title', 'Masuk - Setaman Bogor')

@section('content')
<section class="container mx-auto px-6 py-12">
    <div class="mx-auto max-w-md rounded-3xl border border-gray-100 bg-white p-8 shadow-sm">
        <div class="mb-8 text-center">
            <img src="{{ asset('img/logosetaman.png') }}" alt="Logo Setaman Bogor" class="mx-auto h-20 w-20 rounded-full object-cover">
            <h1 class="mt-5 text-3xl font-bold text-brand-dark">Masuk</h1>
            <p class="mt-2 text-sm text-gray-500">Silakan masuk ke akun Setaman Bogor Anda.</p>
        </div>
        <form class="grid gap-5">
            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                Email
                <input type="email" placeholder="contoh@email.com" class="rounded-2xl border border-green-100 px-4 py-3 font-normal outline-none focus:border-brand">
            </label>
            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                Password
                <input type="password" placeholder="••••••••" class="rounded-2xl border border-green-100 px-4 py-3 font-normal outline-none focus:border-brand">
            </label>
            <div class="flex items-center justify-between text-sm">
                <label class="text-gray-500"><input type="checkbox" class="mr-2">Ingat saya</label>
                <a href="#" class="font-semibold text-brand">Lupa password?</a>
            </div>
            <a href="{{ url('/profil') }}" class="rounded-md bg-brand px-6 py-4 text-center font-bold text-white hover:bg-brand-dark">Masuk</a>
        </form>
        <div class="mt-8 text-center text-sm text-gray-500">
            Belum punya akun?
            <a href="{{ url('/registrasi') }}" class="font-bold text-brand">Daftar akun baru</a>
        </div>
    </div>
</section>
@endsection
