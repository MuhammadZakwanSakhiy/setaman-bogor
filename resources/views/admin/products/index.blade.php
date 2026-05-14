@extends('layouts.admin')

@section('title', 'Kelola Produk | Admin Setaman Bogor')

@section('content')
<div class="mb-8 border-b border-gray-200 pb-4 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-1">KELOLA PRODUK</h2>
        <p class="text-sm text-gray-500">Daftar semua tanaman dan produk pendukung.</p>
    </div>
    <a href="{{ route('products.create') }}" class="bg-brand text-white px-4 py-2 rounded-md font-bold text-sm uppercase tracking-wider hover:bg-brand-dark transition">
        + Tambah Produk
    </a>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
    {{ session('success') }}
</div>
@endif

<div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-xs uppercase font-bold text-gray-500 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Nama Produk</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4">Stok</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="px-6 py-4 font-mono">#{{ $product->id }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name }}</td>
                    <td class="px-6 py-4">{{ $product->category->name ?? '-' }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="{{ $product->stock < 5 ? 'text-red-500 font-bold' : '' }}">{{ $product->stock }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($product->is_active)
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold uppercase">Aktif</span>
                        @else
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-bold uppercase">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-2 flex justify-end items-center">
                        <a href="{{ route('products.edit', $product->id) }}" class="text-brand hover:text-brand-dark transition inline-block"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 transition cursor-pointer"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">Belum ada data produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($products->hasPages())
    <div class="p-4 border-t border-gray-200">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
