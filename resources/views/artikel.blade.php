@extends('layouts.setaman')

@section('title', 'Artikel Edukasi - Setaman Bogor')

@php
    $artikelList = [
        ['judul' => 'Teknik Propagasi Tanaman Endemik Bogor', 'slug' => 'teknik-propagasi-tanaman-endemik-bogor', 'kategori' => 'Panduan', 'ringkasan' => 'Pelajari metode paling efektif untuk memperbanyak tanaman khas Bogor dengan memperhatikan kelembaban.', 'image' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?auto=format&fit=crop&w=700&q=80'],
        ['judul' => 'Manfaat Botani dalam Arsitektur Modern', 'slug' => 'manfaat-botani-dalam-arsitektur-modern', 'kategori' => 'Riset', 'ringkasan' => 'Integrasi tanaman dalam ruang tinggal dapat meningkatkan kualitas udara dan kesehatan mental.', 'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=700&q=80'],
        ['judul' => '10 Tanaman Hias Terbaik untuk Pencahayaan Rendah', 'slug' => 'tanaman-hias-pencahayaan-rendah', 'kategori' => 'Katalog', 'ringkasan' => 'Daftar tanaman yang tetap subur meskipun diletakkan di sudut ruangan minim cahaya.', 'image' => 'https://images.unsplash.com/photo-1509423350716-97f9360b4e09?auto=format&fit=crop&w=700&q=80'],
        ['judul' => 'Memahami pH Tanah untuk Kebun Organik', 'slug' => 'memahami-ph-tanah', 'kategori' => 'Tanah', 'ringkasan' => 'Panduan menguji dan menyesuaikan tingkat keasaman tanah untuk pertumbuhan optimal.', 'image' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=700&q=80'],
    ];
@endphp

@section('content')
<section class="container mx-auto px-6 py-12">
    <div class="mb-10">
        <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Pusat Pengetahuan</div>
        <h1 class="mt-3 text-3xl font-bold text-brand-dark">Daftar Artikel & Edukasi</h1>
        <p class="mt-2 max-w-2xl text-gray-500">Temukan panduan praktis, riset botani terbaru, dan tips perawatan tanaman dari pakar Setaman Bogor.</p>
    </div>

    <label class="relative mb-8 block">
        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-brand"></i>
        <input type="search" placeholder="Cari artikel atau topik tanaman..." class="w-full rounded-2xl border border-green-100 bg-white py-4 pl-12 pr-4 text-sm outline-none transition focus:border-brand">
    </label>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        @foreach ($artikelList as $artikel)
            @include('components.kartu-artikel', ['artikel' => $artikel])
        @endforeach
    </div>
</section>
@endsection
