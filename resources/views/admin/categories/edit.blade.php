@extends('layouts.admin')

@section('title', 'Edit Kategori | Admin Setaman Bogor')

@section('content')
<div class="mb-8 border-b border-gray-200 pb-4 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-1">EDIT KATEGORI</h2>
        <p class="text-sm text-gray-500">Ubah detail kategori produk.</p>
    </div>
    <a href="{{ route('categories.index') }}" class="text-gray-500 hover:text-brand transition text-sm font-bold uppercase tracking-wider">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>

<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 max-w-2xl">
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:border-brand @error('name') border-red-500 @enderror" required>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (Opsional)</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:border-brand">{{ old('description', $category->description) }}</textarea>
        </div>

        <button type="submit" class="bg-brand text-white px-6 py-2 rounded-md font-bold text-sm uppercase tracking-wider hover:bg-brand-dark transition">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
