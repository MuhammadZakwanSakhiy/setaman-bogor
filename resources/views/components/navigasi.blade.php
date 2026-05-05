@php
    $menu = [
        ['label' => 'Beranda', 'href' => url('/'), 'active' => request()->is('/')],
        ['label' => 'Katalog', 'href' => url('/katalog'), 'active' => request()->is('katalog*') || request()->is('produk*')],
        ['label' => 'Edukasi', 'href' => url('/artikel'), 'active' => request()->is('artikel*')],
    ];
@endphp

<nav class="container mx-auto px-6 py-4 flex items-center justify-between gap-4">
    <a href="{{ url('/') }}" class="flex flex-1 items-center gap-3">
        <img src="{{ asset('img/logosetaman.png') }}" alt="Logo Setaman Bogor" class="h-14 w-14 rounded-full object-cover">
        <span class="text-xl md:text-2xl font-bold text-brand-dark">Setaman Bogor</span>
    </a>

    <div class="hidden md:flex items-center justify-center gap-12 text-sm font-medium">
        @foreach ($menu as $item)
            <a href="{{ $item['href'] }}" class="{{ $item['active'] ? 'text-brand border-b-2 border-brand pb-1' : 'text-gray-500 hover:text-brand transition' }}">
                {{ $item['label'] }}
            </a>
        @endforeach
    </div>

    <div class="flex flex-1 items-center justify-end gap-3 text-gray-600">
        <a href="{{ url('/wishlist') }}" class="grid h-10 w-10 place-items-center rounded-full hover:bg-brand-light hover:text-brand" aria-label="Wishlist">
            <i class="far fa-heart"></i>
        </a>
        <a href="{{ url('/keranjang') }}" class="grid h-10 w-10 place-items-center rounded-full hover:bg-brand-light hover:text-brand" aria-label="Keranjang">
            <i class="fas fa-shopping-cart"></i>
        </a>
        <a href="{{ url('/profil') }}" class="grid h-10 w-10 place-items-center rounded-full hover:bg-brand-light hover:text-brand" aria-label="Profil">
            <i class="fas fa-user"></i>
        </a>
    </div>
</nav>

<div class="container mx-auto px-6 pb-4 md:hidden">
    <div class="flex gap-2 overflow-x-auto rounded-full bg-brand-light p-1 text-sm font-medium">
        @foreach ($menu as $item)
            <a href="{{ $item['href'] }}" class="whitespace-nowrap rounded-full px-4 py-2 {{ $item['active'] ? 'bg-white text-brand shadow-sm' : 'text-gray-500' }}">
                {{ $item['label'] }}
            </a>
        @endforeach
    </div>
</div>
