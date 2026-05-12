@php
    $adminMenu = [
        ['label' => 'Dashboard', 'icon' => 'fa-chart-line', 'href' => url('/admin'), 'active' => request()->is('admin')],
        ['label' => 'Kelola Produk', 'icon' => 'fa-seedling', 'href' => url('/admin/produk'), 'active' => request()->is('admin/produk*')],
        ['label' => 'Kelola Artikel', 'icon' => 'fa-newspaper', 'href' => url('/admin/artikel'), 'active' => request()->is('admin/artikel*')],
        ['label' => 'Kelola Pesanan', 'icon' => 'fa-receipt', 'href' => url('/admin/pesanan'), 'active' => request()->is('admin/pesanan*')],
    ];
@endphp

<aside class="border-b border-green-100 bg-white p-5 lg:min-h-screen lg:w-72 lg:border-b-0 lg:border-r">
    <a href="{{ url('/admin') }}" class="mb-8 flex items-center gap-3">
        <img src="{{ asset('img/logosetaman.png') }}" alt="Logo Setaman Bogor" class="h-12 w-12 rounded-full object-cover">
        <div>
            <div class="text-xs font-bold uppercase tracking-[0.25em] text-brand">Admin Panel</div>
            <div class="font-bold text-brand-dark">Setaman Bogor</div>
        </div>
    </a>

    <div class="mb-6 rounded-2xl bg-brand-light px-4 py-3 text-sm text-gray-500">
        <i class="fas fa-search mr-2 text-brand"></i> Search...
    </div>

    <nav class="grid gap-2">
        @foreach ($adminMenu as $item)
            <a href="{{ $item['href'] }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold transition {{ $item['active'] ? 'bg-brand text-white shadow-sm' : 'text-gray-500 hover:bg-brand-light hover:text-brand' }}">
                <i class="fas {{ $item['icon'] }} w-5"></i>
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="mt-8 rounded-2xl border border-green-100 bg-white p-4 shadow-sm">
        <div class="text-xs font-bold uppercase tracking-[0.2em] text-brand">Bantuan</div>
        <p class="mt-2 text-sm leading-6 text-gray-500">Analisis baru laporan tren tanaman tersedia untuk diunduh.</p>
        <a href="javascript:void(0)" class="mt-4 inline-flex rounded-md bg-brand-dark px-4 py-2 text-xs font-bold uppercase tracking-widest text-white">Unduh PDF</a>
    </div>

    <a href="{{ url('/') }}" class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-brand">
        <i class="fas fa-arrow-left"></i> Kembali ke Website
    </a>
</aside>
