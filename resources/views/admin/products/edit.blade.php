@extends('layouts.admin')

@section('title', 'Edit Produk | Admin Setaman Bogor')

@section('content')
<div class="mb-8 border-b border-gray-200 pb-4 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-1">EDIT PRODUK</h2>
        <p class="text-sm text-gray-500">Perbarui informasi tanaman atau produk: <span class="font-bold text-brand">{{ $product->name }}</span></p>
    </div>
    <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-brand font-medium text-sm transition flex items-center gap-2">
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

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Produk -->
            <div class="md:col-span-2">
                <label for="name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Produk *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">
            </div>

            <!-- Kategori -->
            <div>
                <label for="category_id" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori *</label>
                <select name="category_id" id="category_id" required class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand bg-white">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Stok -->
            <div>
                <label for="stock" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Stok *</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0" required class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">
            </div>

            <!-- Harga -->
            <div class="md:col-span-2">
                <label for="price" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Harga (Rp) *</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" min="0" required class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">
            </div>

            <!-- Deskripsi -->
            <div class="md:col-span-2">
                <label for="description" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Deskripsi Lengkap</label>
                <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Panduan Perawatan -->
            <div class="md:col-span-2">
                <label for="care_tips" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Panduan Perawatan (Opsional)</label>
                <textarea name="care_tips" id="care_tips" rows="3" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">{{ old('care_tips', $product->care_tips) }}</textarea>
            </div>

            <!-- Gambar Utama -->
            <div class="md:col-span-2 border border-gray-300 rounded-md p-4 bg-gray-50 flex gap-6 items-start">
                @if($product->image_url)
                    <div class="w-32 h-32 rounded-md overflow-hidden bg-white border border-gray-200 flex-shrink-0">
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-32 h-32 rounded-md bg-gray-200 flex items-center justify-center flex-shrink-0 border border-gray-300 text-gray-400">
                        <i class="fas fa-image text-4xl"></i>
                    </div>
                @endif
                <div class="flex-1">
                    <label for="image" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Ganti Foto Utama (Opsional)</label>
                    <input type="file" name="image" id="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-bold file:uppercase file:tracking-wider file:bg-brand file:text-white hover:file:bg-brand-dark cursor-pointer">
                    <p class="text-xs text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG, WEBP. Maks 2MB.</p>
                </div>
            </div>

            <!-- Status Toggles -->
            <div class="md:col-span-2 flex flex-col sm:flex-row gap-6 pt-4 border-t border-gray-200">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-5 h-5 text-brand rounded focus:ring-brand">
                    <span class="text-sm font-bold text-gray-700 uppercase tracking-wider">Aktif (Tampilkan di Toko)</span>
                </label>

                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_best_seller" value="1" {{ old('is_best_seller', $product->is_best_seller) ? 'checked' : '' }} class="w-5 h-5 text-brand rounded focus:ring-brand">
                    <span class="text-sm font-bold text-gray-700 uppercase tracking-wider">Tandai Best Seller</span>
                </label>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-200 flex justify-end gap-4">
            <a href="{{ route('products.index') }}" class="px-6 py-3 border border-gray-300 rounded-md text-sm font-bold text-gray-700 uppercase tracking-wider hover:bg-gray-50 transition">Batal</a>
            <button type="submit" class="px-6 py-3 bg-black text-white rounded-md text-sm font-bold uppercase tracking-wider hover:bg-gray-800 transition">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
