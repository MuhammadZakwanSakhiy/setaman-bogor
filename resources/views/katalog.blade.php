<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk | Setaman Bogor</title>
    <!-- Tailwind CSS CDN -->
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800">

    <x-navbar />

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        
        <!-- Search & Filter Bar -->
        <div class="mb-8">
            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2 font-semibold">Cari Produk</p>
            <form action="{{ route('katalog') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <!-- Search Input -->
                <div class="relative w-full md:w-1/2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tanaman favorit Anda..." class="w-full border border-gray-300 rounded-sm py-2 px-4 focus:outline-none focus:border-brand text-sm">
                    <button type="submit" class="absolute right-4 top-2 text-gray-400 text-sm hover:text-brand"><i class="fas fa-search"></i></button>
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                </div>
                <!-- Filter Buttons -->
                <div class="flex flex-wrap gap-2 text-xs font-semibold uppercase tracking-wider w-full md:w-auto">
                    <a href="{{ route('katalog') }}" class="{{ !request('category') ? 'bg-brand text-white border-brand' : 'bg-white text-gray-700 border-gray-300 hover:border-brand hover:text-brand' }} px-4 py-2 border transition rounded-sm">Semua</a>
                    @foreach($categories as $cat)
                        <a href="{{ route('katalog', ['category' => $cat->slug ?? $cat->name, 'search' => request('search')]) }}" class="{{ request('category') == ($cat->slug ?? $cat->name) ? 'bg-brand text-white border-brand' : 'bg-white text-gray-700 border-gray-300 hover:border-brand hover:text-brand' }} px-4 py-2 border transition rounded-sm">
                            {{ str_replace('Tanaman ', '', $cat->name) }}
                        </a>
                    @endforeach
                </div>
            </form>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @forelse($products as $product)
            <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md transition rounded-xl flex flex-col overflow-hidden">
                <a href="{{ route('katalog.show', $product->slug) }}" class="h-64 bg-gray-100 flex items-center justify-center relative group block cursor-pointer">
                    <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                </a>
                
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <p class="text-xs text-brand uppercase tracking-wider mb-1 font-semibold">{{ $product->category->name }}</p>
                        
                        <a href="{{ route('katalog.show', $product->slug) }}" class="block hover:text-brand transition">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                        </a>
                        
                        <p class="text-sm text-gray-500 mb-6">{{ Str::limit($product->description, 70) }}</p>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xl font-bold text-brand-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        
                        <!-- Form Tambah ke Keranjang -->
                        <form action="{{ url('/cart/add') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="bg-brand text-white text-xs font-semibold uppercase tracking-wider px-6 py-2 hover:bg-brand-dark transition rounded-md">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Tidak ada produk yang ditemukan.</p>
                <a href="{{ route('katalog') }}" class="text-brand hover:underline mt-2 inline-block">Reset Pencarian</a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="flex justify-center mt-12">
            {{ $products->links() }}
        </div>
        @endif

    </main>

    <!-- Footer -->
    <footer class="bg-brand-light pt-16 pb-8 border-t border-green-100 mt-12">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-8 gap-8 mb-12">
            <div class="md:col-span-5">
                <h4 class="text-lg font-bold text-brand-dark mb-4">Setaman Bogor</h4>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Cultivating calm in every corner. Solusi penghijauan modern untuk gaya hidup perkotaan Anda.
                </p>
            </div>
            <div class="md:col-span-1">
                <h4 class="font-semibold text-brand-dark mb-4">Perusahaan</h4>
                <ul class="space-y-2 text-sm text-brand">
                    <li><a href="{{ url('/tentang') }}" class="hover:underline">Tentang Kami</a></li>
                    <li><a href="{{ url('/kontak') }}" class="hover:underline">Kontak</a></li>
                </ul>
            </div>
            <div class="md:col-span-1">
                <h4 class="font-semibold text-brand-dark mb-4">Legal</h4>
                <ul class="space-y-2 text-sm text-brand">
                    <li><a href="{{ url('/privasi') }}" class="hover:underline">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div class="md:col-span-1">
                <h4 class="font-semibold text-brand-dark mb-4">Sosial Media</h4>
                <ul class="space-y-2 text-sm text-brand">
                    <li><a href="https://instagram.com" class="hover:underline">Instagram</a></li>
                    <li><a href="https://youtube.com" class="hover:underline">YouTube</a></li>
                </ul>
            </div>
        </div>
        <div class="container mx-auto px-6 pt-8 border-t border-green-200 text-xs text-gray-400">
            &copy; 2026 Setaman Bogor
        </div>
    </footer>

</body>
</html>