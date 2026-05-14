@extends('layouts.admin')

@section('title', 'Edit Artikel | Admin Setaman Bogor')

@section('content')
<div class="mb-8 border-b border-gray-200 pb-4 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-1">EDIT ARTIKEL</h2>
        <p class="text-sm text-gray-500">Perbarui informasi dan konten artikel edukasi.</p>
    </div>
    <a href="{{ route('articles.index') }}" class="text-gray-500 hover:text-brand font-medium text-sm transition flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8 max-w-4xl">
    
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-md">
            <ul class="list-disc pl-5 text-sm font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 gap-6">
            <!-- Judul Artikel -->
            <div>
                <label for="title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Judul Artikel *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" required class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand" placeholder="Cth: Cara Merawat Monstera Deliciosa">
            </div>

            <!-- Kategori -->
            <div>
                <label for="category_id" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori *</label>
                <select name="category_id" id="category_id" required class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand bg-white">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Gambar Utama -->
            <div class="border border-gray-300 rounded-md p-4 bg-gray-50">
                <label for="image" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Foto Utama Artikel (Opsional)</label>
                
                @if($article->image_url)
                <div class="mb-4">
                    <p class="text-xs text-gray-500 mb-2">Gambar Saat Ini:</p>
                    <img src="{{ Storage::url($article->image_url) }}" alt="{{ $article->title }}" class="h-32 w-auto object-cover rounded-md border border-gray-200">
                </div>
                @endif

                <input type="file" name="image" id="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-bold file:uppercase file:tracking-wider file:bg-brand file:text-white hover:file:bg-brand-dark cursor-pointer">
                <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, WEBP. Maks 2MB. Kosongkan jika tidak ingin mengubah gambar.</p>
            </div>

            <!-- Konten -->
            <div>
                <label for="content" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Isi Artikel *</label>
                <textarea name="content" id="content" rows="10" required class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand" placeholder="Tuliskan isi artikel Anda di sini...">{{ old('content', $article->content) }}</textarea>
            </div>

            <!-- Status Toggles -->
            <div class="pt-4 border-t border-gray-200">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $article->is_published) ? 'checked' : '' }} class="w-5 h-5 text-brand rounded focus:ring-brand">
                    <span class="text-sm font-bold text-gray-700 uppercase tracking-wider">Terbitkan Langsung (Publish)</span>
                </label>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-200 flex justify-end gap-4">
            <a href="{{ route('articles.index') }}" class="px-6 py-3 border border-gray-300 rounded-md text-sm font-bold text-gray-700 uppercase tracking-wider hover:bg-gray-50 transition">Batal</a>
            <button type="submit" class="px-6 py-3 bg-black text-white rounded-md text-sm font-bold uppercase tracking-wider hover:bg-gray-800 transition">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
