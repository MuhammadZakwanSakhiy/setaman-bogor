@php
    $cartCount = auth()->check() ? (\App\Models\Cart::where('user_id', auth()->id())->first()?->items()->sum('quantity') ?? 0) : 0;
    $avatarUrl = null;
    if (auth()->check()) {
        $profile = auth()->user()->profile;
        if ($profile && $profile->avatar_url) {
            $avatarUrl = Str::startsWith($profile->avatar_url, 'http') ? $profile->avatar_url : asset('storage/' . $profile->avatar_url);
        }
    }
@endphp
<nav class="container mx-auto px-6 py-4 flex justify-between items-center bg-white border-b border-gray-100">
    <!-- Bagian Kiri: Logo -->
    <div class="flex items-center gap-2 flex-1">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <img src="{{ asset('img/logosetaman.png') }}" alt="Logo Setaman Bogor" class="h-14 w-auto">
            <div class="text-2xl font-bold text-brand-dark">Setaman Bogor</div>
        </a>
    </div>

    <!-- Bagian Tengah: Menu -->
    <div class="hidden md:flex space-x-16 text-sm font-medium justify-center">
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-brand border-b-2 border-brand pb-1' : 'text-gray-500 hover:text-brand transition' }}">Beranda</a>
        <a href="{{ url('/katalog') }}" class="{{ request()->is('katalog') || request()->is('katalog/*') || request()->is('detail-produk*') ? 'text-brand border-b-2 border-brand pb-1' : 'text-gray-500 hover:text-brand transition' }}">Katalog</a>
        <a href="{{ url('/artikel') }}" class="{{ request()->is('artikel') || request()->is('artikel/*') || request()->is('detail-artikel*') ? 'text-brand border-b-2 border-brand pb-1' : 'text-gray-500 hover:text-brand transition' }}">Edukasi</a>
    </div>

    <!-- Bagian Kanan: Ikon -->
    <div class="flex space-x-4 text-gray-600 flex-1 justify-end items-center">
        @auth
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold bg-brand text-white px-3 py-1.5 rounded-md hover:bg-brand-dark transition mr-2 uppercase tracking-wider">Admin Dashboard</a>
            @endif
            <a href="{{ url('/wishlist') }}" class="hover:text-brand transition {{ request()->is('wishlist') ? 'text-brand' : '' }}" title="Wishlist"><i class="fas fa-heart text-lg"></i></a>
            <a href="{{ url('/keranjang') }}" class="hover:text-brand transition {{ request()->is('keranjang') ? 'text-brand' : '' }} relative" title="Keranjang">
                <i class="fas fa-shopping-cart text-lg"></i>
                @if($cartCount > 0)
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full text-[10px] font-bold h-4 w-4 flex items-center justify-center border border-white">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
            <div class="relative ml-2">
                <button id="user-menu-button" class="focus:outline-none cursor-pointer flex items-center">
                    @if($avatarUrl)
                        <img src="{{ $avatarUrl }}" class="w-8 h-8 rounded-full border border-gray-200 object-cover hover:border-brand transition">
                    @else
                        <i class="fas fa-user {{ request()->is('profil') ? 'text-brand' : '' }} hover:text-brand transition text-lg"></i>
                    @endif
                </button>
                <!-- Dropdown -->
                <div id="user-menu-dropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-md shadow-lg py-1 hidden z-50">
                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-sm font-bold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="{{ url('/profil') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand transition">Profil Saya</a>
                    <a href="{{ route('profile.orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand transition">Pesanan Saya</a>
                    <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-100 mt-1">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 transition">Keluar</button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ url('/login') }}" class="hover:text-brand transition text-sm font-bold text-gray-700 uppercase tracking-wider">Masuk</a>
            <a href="{{ url('/registrasi') }}" class="bg-brand text-white px-4 py-2 rounded-md hover:bg-brand-dark transition text-sm font-bold uppercase tracking-wider ml-2 shadow-sm">Daftar</a>
        @endauth
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.getElementById('user-menu-button');
        const dropdown = document.getElementById('user-menu-dropdown');
        if (button && dropdown) {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function(e) {
                if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        }
    });
</script>
