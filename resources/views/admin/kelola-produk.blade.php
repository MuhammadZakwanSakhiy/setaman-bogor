@extends('layouts.admin')

@section('title', 'Kelola Produk - Admin Setaman Bogor')

@php
    $produk = [
        ['id' => 1, 'nama' => 'Monstera Deliciosa', 'kategori' => 'Indoor', 'harga' => 'Rp 250.000', 'stok' => 12, 'status' => 'Aktif'],
        ['id' => 2, 'nama' => 'Ficus Lyrata', 'kategori' => 'Indoor', 'harga' => 'Rp 420.000', 'stok' => 2, 'status' => 'Aktif'],
        ['id' => 3, 'nama' => 'Aloe Barbadensis', 'kategori' => 'Outdoor', 'harga' => 'Rp 65.000', 'stok' => 0, 'status' => 'Nonaktif'],
    ];
@endphp

@section('content')
<header class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
        <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Inventori</div>
        <h1 class="mt-3 text-3xl font-bold text-brand-dark">Kelola Produk</h1>
        <p class="mt-2 text-gray-500">Tambah, edit, hapus, dan pantau stok tanaman.</p>
    </div>
    <a href="{{ url('/admin/produk/tambah') }}" class="rounded-md bg-brand px-5 py-3 text-center font-bold text-white hover:bg-brand-dark">Tambah Produk</a>
</header>

<section class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm">
    <div class="mb-6 grid gap-4 md:grid-cols-[1fr_220px]">
        <input type="search" placeholder="Cari produk..." class="rounded-2xl border border-green-100 px-4 py-3 outline-none focus:border-brand">
        <select class="rounded-2xl border border-green-100 px-4 py-3 text-gray-500 outline-none focus:border-brand">
            <option>Semua Kategori</option>
            <option>Indoor</option>
            <option>Outdoor</option>
        </select>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full min-w-[760px] text-left text-sm">
            <thead class="text-xs uppercase tracking-[0.2em] text-gray-400">
                <tr>
                    <th class="py-4">Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-green-100">
                @foreach ($produk as $item)
                    <tr>
                        <td class="py-4 font-bold text-brand-dark">{{ $item['nama'] }}</td>
                        <td>{{ $item['kategori'] }}</td>
                        <td>{{ $item['harga'] }}</td>
                        <td>{{ $item['stok'] }}</td>
                        <td><span class="rounded-full bg-brand-light px-3 py-1 text-xs font-bold text-brand">{{ $item['status'] }}</span></td>
                        <td class="text-right">
                            <a href="{{ url('/admin/produk/' . $item['id'] . '/edit') }}" class="font-bold text-brand">Edit</a>
                            <button class="ml-4 font-bold text-red-500">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
