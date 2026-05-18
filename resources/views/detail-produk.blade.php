<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monstera Deliciosa - Detail Produk | Setaman Bogor</title>
    <!-- Tailwind CSS CDN -->
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar (Sama dengan halaman lain) -->
    <x-navbar />

    <!-- Breadcrumb -->
    <div class="container mx-auto px-6 py-4 text-sm text-gray-500">
        <a href="{{ route('katalog') }}" class="hover:text-brand">Katalog</a> <span class="mx-2">/</span>
        <a href="{{ route('katalog', ['category' => $product->category->slug ?? $product->category->name]) }}" class="hover:text-brand">{{ $product->category->name }}</a> <span class="mx-2">/</span>
        <span class="text-gray-800 font-medium">{{ $product->name }}</span>
    </div>

    <!-- Product Detail Section -->
    <main class="container mx-auto px-6 py-8">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-12">
            
            <!-- Left Column: Images -->
            <div class="flex flex-col gap-4">
                <!-- Main Image -->
                <div class="w-full h-[400px] md:h-[500px] bg-gray-100 rounded-xl overflow-hidden">
                    <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Right Column: Product Info -->
            <div class="flex flex-col">
                <div class="mb-4">
                    <span class="inline-block border border-gray-800 text-gray-800 text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-sm mb-4">{{ $product->category->name }}</span>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                    <p class="text-2xl font-bold text-brand-dark mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    
                    <div class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                        <div class="w-2.5 h-2.5 rounded-full {{ $product->stock > 0 ? ($product->stock < 5 ? 'bg-orange-500' : 'bg-green-500') : 'bg-red-500' }}"></div>
                        @if($product->stock == 0)
                            Stok Habis
                        @elseif($product->stock < 5)
                            Stok Terbatas (Tersisa {{ $product->stock }})
                        @else
                            Tersedia ({{ $product->stock }} Unit)
                        @endif
                    </div>
                </div>

                <hr class="border-gray-200 my-6">

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3">Deskripsi</h3>
                    <p class="text-gray-600 leading-relaxed text-sm whitespace-pre-line">{{ $product->description }}</p>
                </div>

                <!-- Care Tips Box -->
                @if($product->care_tips)
                <div class="bg-brand-light p-5 rounded-xl border border-green-100 mb-8">
                    <h3 class="text-xs font-bold text-brand-dark uppercase tracking-wider mb-4 border-b border-green-200 pb-2">Tips Perawatan</h3>
                    <ul class="space-y-3 text-sm text-gray-700">
                        @foreach(explode("\n", $product->care_tips) as $tip)
                            @if(trim($tip))
                            <li class="flex items-start gap-3">
                                <div class="w-6 text-center mt-0.5"><i class="fas fa-check text-brand"></i></div>
                                <span>{{ $tip }}</span>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="mt-auto">
                    <form action="{{ url('/cart/add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex flex-col sm:flex-row gap-4 mb-4">
                            @if($product->stock > 0)
                                <button type="submit" name="action" value="cart" class="flex-1 border-2 border-brand text-brand hover:bg-brand-light font-bold py-3 px-6 rounded-md transition uppercase text-sm tracking-wider">
                                    Tambah ke Keranjang
                                </button>
                                <button type="submit" name="action" value="checkout" class="flex-1 bg-brand text-white hover:bg-brand-dark font-bold py-3 px-6 rounded-md transition uppercase text-sm tracking-wider shadow-md">
                                    Beli Sekarang
                                </button>
                            @else
                                <button type="button" disabled class="w-full bg-gray-300 text-gray-500 cursor-not-allowed font-bold py-3 px-6 rounded-md uppercase text-sm tracking-wider">
                                    Stok Habis
                                </button>
                            @endif
                        </div>
                    </form>
                    
                    <form action="{{ url('/wishlist/add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="w-full flex items-center justify-center gap-2 text-gray-500 hover:text-red-500 font-medium text-sm transition py-2">
                            <i class="far fa-heart"></i> Simpan ke Wishlist
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <!-- Horizontal Divider -->
    <div class="container mx-auto px-6">
        <hr class="border-gray-200 border-2 my-8 rounded-full">
    </div>

    <!-- Related Products Section -->
    @if($relatedProducts->count() > 0)
    <section class="container mx-auto px-6 py-8 mb-12">
        <div class="flex justify-between items-end mb-8">
            <h2 class="text-2xl font-bold text-gray-900 uppercase tracking-wide">Katalog Serupa</h2>
            <a href="{{ route('katalog', ['category' => $product->category->slug ?? $product->category->name]) }}" class="text-sm font-bold text-gray-900 border-b border-gray-900 hover:text-brand hover:border-brand transition pb-1 uppercase tracking-wider">Lihat Semua</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
            <!-- Card -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col">
                <div class="h-48 bg-gray-100 relative group cursor-pointer block">
                    <a href="{{ route('katalog.show', $related->slug) }}">
                        <img src="{{ Str::startsWith($related->image_url, 'http') ? $related->image_url : asset('storage/' . $related->image_url) }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </a>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold">{{ $related->category->name }}</span>
                    <a href="{{ route('katalog.show', $related->slug) }}" class="hover:text-brand transition block">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">{{ $related->name }}</h3>
                    </a>
                    <p class="text-brand-dark font-bold mb-4">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                    
                    <form action="{{ url('/cart/add') }}" method="POST" class="mt-auto w-full">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $related->id }}">
                        <button type="submit" class="w-full border border-gray-300 text-gray-700 font-bold py-2 text-xs uppercase tracking-wider hover:border-brand hover:text-brand transition rounded-sm">Tambah</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Footer (Sama dengan halaman lain) -->
    <footer class="bg-brand-light pt-16 pb-8 border-t border-green-100">
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