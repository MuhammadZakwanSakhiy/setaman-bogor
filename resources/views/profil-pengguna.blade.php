@extends('layouts.setaman')

@section('title', 'Profil Pengguna - Setaman Bogor')

@section('content')
<section class="container mx-auto px-6 py-12">
    <div class="grid gap-8 lg:grid-cols-[360px_1fr]">
        <aside class="rounded-3xl border border-gray-100 bg-white p-6 text-center shadow-sm">
            <div class="mx-auto grid h-32 w-32 place-items-center rounded-full bg-brand-light text-4xl font-bold text-brand">BS</div>
            <h1 class="mt-6 text-2xl font-bold text-brand-dark">Budi Setiawan</h1>
            <p class="mt-1 text-sm text-gray-500">budi.setiawan@example.com</p>
            <div class="mt-6 grid grid-cols-2 gap-3">
                <div class="rounded-2xl bg-brand-light p-4">
                    <div class="text-2xl font-bold text-brand-dark">12</div>
                    <div class="text-xs font-bold uppercase tracking-widest text-brand">Tanaman</div>
                </div>
                <div class="rounded-2xl bg-brand-light p-4">
                    <div class="text-2xl font-bold text-brand-dark">05</div>
                    <div class="text-xs font-bold uppercase tracking-widest text-brand">Artikel</div>
                </div>
            </div>
            <a href="{{ url('/login') }}" class="mt-6 block rounded-md border border-red-100 px-5 py-3 font-bold text-red-500 hover:bg-red-50">Keluar Akun</a>
        </aside>

        <div class="space-y-8">
            <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-brand-dark">Aktivitas Terakhir</h2>
                    <a href="#" class="text-sm font-semibold text-brand">Lihat Semua</a>
                </div>
                <div class="mt-5 grid gap-4">
                    @foreach ([
                        ['title' => 'Membaca Artikel: Klasifikasi Paku-pakuan', 'meta' => '2 jam yang lalu • Edukasi'],
                        ['title' => 'Menambahkan Anggrek Hutan ke Katalog', 'meta' => 'Kemarin • Katalog'],
                    ] as $aktivitas)
                        <div class="rounded-2xl bg-brand-light p-4">
                            <div class="font-semibold text-brand-dark">{{ $aktivitas['title'] }}</div>
                            <div class="mt-1 text-sm text-gray-500">{{ $aktivitas['meta'] }}</div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-bold text-brand-dark">Pengaturan</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-3">
                    @foreach (['Notifikasi Email', 'Mode Gelap', 'Profil Publik'] as $index => $label)
                        <label class="flex items-center justify-between rounded-2xl bg-brand-light p-4 text-sm font-semibold text-brand-dark">
                            {{ $label }}
                            <input type="checkbox" {{ $index !== 1 ? 'checked' : '' }}>
                        </label>
                    @endforeach
                </div>
                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <button class="rounded-md bg-brand px-5 py-3 font-bold text-white hover:bg-brand-dark">Edit Profil</button>
                    <button class="rounded-md border border-green-100 px-5 py-3 font-bold text-brand hover:bg-brand-light">Ganti Kata Sandi</button>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection
