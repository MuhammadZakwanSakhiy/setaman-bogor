<article class="group overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
    <a href="{{ url('/artikel/' . ($artikel['slug'] ?? 'detail')) }}" class="block">
        <div class="h-52 overflow-hidden bg-brand-light">
            <img src="{{ $artikel['image'] }}" alt="{{ $artikel['judul'] }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        </div>
        <div class="space-y-4 p-6">
            <div class="text-[11px] font-bold uppercase tracking-[0.25em] text-brand">Kategori: {{ $artikel['kategori'] }}</div>
            <h3 class="text-xl font-bold leading-snug text-brand-dark">{{ $artikel['judul'] }}</h3>
            <p class="line-clamp-3 text-sm leading-6 text-gray-500">{{ $artikel['ringkasan'] }}</p>
            <div class="inline-flex items-center gap-2 text-sm font-semibold text-brand">
                Baca Selengkapnya <i class="fas fa-arrow-right text-xs"></i>
            </div>
        </div>
    </a>
</article>
