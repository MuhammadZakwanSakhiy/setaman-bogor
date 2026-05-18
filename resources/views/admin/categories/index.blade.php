@extends('layouts.admin')

@section('title', 'Kelola Kategori | Admin Setaman Bogor')

@section('content')
<div class="mb-8 border-b border-gray-200 pb-4 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-1">KELOLA KATEGORI</h2>
        <p class="text-sm text-gray-500">Daftar kategori produk.</p>
    </div>
    <a href="{{ route('categories.create') }}" class="bg-brand text-white px-4 py-2 rounded-md font-bold text-sm uppercase tracking-wider hover:bg-brand-dark transition">
        + Tambah Kategori
    </a>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-md">
    {{ session('error') }}
</div>
@endif

<div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-xs uppercase font-bold text-gray-500 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Nama Kategori</th>
                    <th class="px-6 py-4">Slug</th>
                    <th class="px-6 py-4">Total Produk</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="px-6 py-4 font-mono">#{{ $category->id }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $category->name }}</td>
                    <td class="px-6 py-4">{{ $category->slug }}</td>
                    <td class="px-6 py-4">{{ $category->products()->count() }}</td>
                    <td class="px-6 py-4 text-right space-x-2 flex justify-end items-center">
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-brand hover:text-brand-dark transition inline-block"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 transition cursor-pointer"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())
    <div class="p-4 border-t border-gray-200">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection
