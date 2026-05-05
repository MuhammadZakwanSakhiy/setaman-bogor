<article class="group overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
    <a href="{{ url('/produk/' . ($produk['slug'] ?? 'monstera-deliciosa')) }}" class="block">
        <div class="relative h-56 overflow-hidden bg-brand-light">
            <img src="{{ $produk['image'] }}" alt="{{ $produk['nama'] }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
            <div class="absolute left-4 top-4 rounded-full bg-white/90 px-3 py-1 text-[11px] font-bold uppercase tracking-widest text-brand">
                {{ $produk['kategori'] }}
            </div>
            @if (!empty($produk['best']))
                <div class="absolute right-4 top-4 rounded-full bg-brand px-3 py-1 text-[11px] font-bold uppercase tracking-widest text-white">
                    Best Seller
                </div>
            @endif
        </div>
        <div class="space-y-3 p-5">
            <div>
                <h3 class="text-lg font-bold text-brand-dark">{{ $produk['nama'] }}</h3>
                <p class="mt-1 line-clamp-2 text-sm leading-6 text-gray-500">{{ $produk['deskripsi'] }}</p>
            </div>
            <div class="flex items-center justify-between">
                <span class="font-bold text-brand-dark">{{ $produk['harga'] }}</span>
                <span class="text-xs font-semibold {{ ($produk['stok'] ?? 0) > 0 ? 'text-brand' : 'text-red-500' }}">
                    {{ ($produk['stok'] ?? 0) > 0 ? ($produk['stok'] . ' stok') : 'Habis' }}
                </span>
            </div>
        </div>
    </a>
    <div class="flex gap-2 px-5 pb-5">
        <a href="{{ url('/keranjang') }}" class="flex-1 rounded-md bg-brand px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-brand-dark">
            Tambah
        </a>
        <a href="{{ url('/wishlist') }}" class="grid h-11 w-11 place-items-center rounded-md border border-green-100 text-brand transition hover:bg-brand-light" aria-label="Simpan ke wishlist">
            <i class="far fa-heart"></i>
        </a>
    </div>
</article>
