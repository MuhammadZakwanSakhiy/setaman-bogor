@extends('layouts.admin')

@section('title', 'Kelola Artikel - Admin Setaman Bogor')

@php
    $artikel = [
        ['id' => 1, 'judul' => 'Teknik Propagasi Tanaman Endemik Bogor', 'kategori' => 'Panduan', 'status' => 'Published'],
        ['id' => 2, 'judul' => 'Manfaat Botani dalam Arsitektur Modern', 'kategori' => 'Riset', 'status' => 'Published'],
        ['id' => 3, 'judul' => 'Memahami pH Tanah untuk Kebun Organik', 'kategori' => 'Tanah', 'status' => 'Draft'],
    ];
@endphp

@section('content')
<header class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
        <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Edukasi</div>
        <h1 class="mt-3 text-3xl font-bold text-brand-dark">Kelola Artikel</h1>
        <p class="mt-2 text-gray-500">Atur konten tips tanaman dan edukasi botani.</p>
    </div>
    <a href="{{ url('/admin/artikel/tambah') }}" class="rounded-md bg-brand px-5 py-3 text-center font-bold text-white hover:bg-brand-dark">Tambah Artikel</a>
</header>

<section class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm">
    <div class="grid gap-4">
        @foreach ($artikel as $item)
            <div class="flex flex-col gap-4 rounded-2xl border border-green-100 p-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <div class="text-xs font-bold uppercase tracking-[0.25em] text-brand">{{ $item['kategori'] }}</div>
                    <h2 class="mt-2 font-bold text-brand-dark">{{ $item['judul'] }}</h2>
                    <p class="mt-1 text-sm text-gray-500">{{ $item['status'] }}</p>
                </div>
                <div>
                    <a href="{{ url('/admin/artikel/' . $item['id'] . '/edit') }}" class="font-bold text-brand">Edit</a>
                    <button class="ml-4 font-bold text-red-500">Hapus</button>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
