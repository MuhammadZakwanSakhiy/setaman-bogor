<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Anda | Setaman Bogor</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logosetaman.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Tailwind CSS CDN -->
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <x-navbar />

    <!-- Main Content: Wishlist -->
    <main class="container mx-auto px-6 py-12 grow">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">Wishlist Anda</h1>

        <!-- Daftar Wishlist (Full Width) -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-md mb-4 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-md mb-4 text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif

            @if($wishlist && $wishlist->items->count() > 0)
                @foreach($wishlist->items as $item)
                @if($item->product)
                <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-6 flex flex-col sm:flex-row gap-6 items-start sm:items-center relative shadow-sm hover:border-brand transition">
                    <!-- Gambar -->
                    <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gray-100 rounded-lg overflow-hidden shrink-0 relative">
                        <a href="{{ route('katalog.show', $item->product->slug) }}" class="block w-full h-full">
                            <img src="{{ Str::startsWith($item->product->image_url, 'http') ? $item->product->image_url : asset('storage/' . $item->product->image_url) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                        </a>
                    </div>
                    
                    <!-- Info Produk -->
                    <div class="grow flex flex-col justify-center">
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold mb-1">{{ $item->product->category->name }}</span>
                        <a href="{{ route('katalog.show', $item->product->slug) }}" class="hover:text-brand transition">
                            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $item->product->name }}</h3>
                        </a>
                        <p class="text-brand-dark font-bold text-lg mb-4 sm:mb-0">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                    </div>

                    <!-- Aksi -->
                    <div class="flex flex-row sm:flex-col items-end gap-4 sm:gap-6 w-full sm:w-auto justify-between sm:justify-start">
                        <div class="flex items-center gap-4 mt-auto">
                            <form action="{{ route('wishlist.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button type="submit" class="text-xs font-bold text-gray-400 hover:text-red-500 uppercase tracking-wider transition underline">Hapus</button>
                            </form>
                            <form action="{{ url('/cart/add') }}" method="POST" class="hidden sm:block">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                <button type="submit" class="bg-brand text-white text-[10px] font-bold uppercase tracking-wider px-4 py-2 rounded-md hover:bg-brand-dark transition shadow-sm">Tambah ke Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            @else
                <div class="text-center py-12 bg-white border border-gray-200 rounded-xl">
                    <i class="far fa-heart text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg mb-4">Wishlist Anda masih kosong.</p>
                    <a href="{{ route('katalog') }}" class="bg-brand text-white font-bold py-2 px-6 rounded-md hover:bg-brand-dark transition uppercase text-sm tracking-wider">Mulai Belanja</a>
                </div>
            @endif

        </div>

        <!-- Rekomendasi / Mungkin Anda Suka -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Mungkin Anda Suka</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                
                <!-- Item 1 -->
                <a href="{{ url('/detail-produk') }}" class="block bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition group">
                    <div class="h-32 md:h-48 bg-gray-100 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1596547609652-9cb5d8d736bb?auto=format&fit=crop&w=400&q=80" alt="Aloe Vera Compact" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                    </div>
                    <div class="p-4">
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold block">Sukulen</span>
                        <h3 class="font-bold text-gray-900 text-sm md:text-base mb-1 truncate">Aloe Vera Compact</h3>
                        <p class="text-brand-dark font-bold text-sm md:text-base">Rp 45.000</p>
                    </div>
                </a>

                <!-- Item 2 -->
                <a href="{{ url('/detail-produk') }}" class="block bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition group">
                    <div class="h-32 md:h-48 bg-gray-100 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&w=400&q=80" alt="Air Plant Medium" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                    </div>
                    <div class="p-4">
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold block">Aerium</span>
                        <h3 class="font-bold text-gray-900 text-sm md:text-base mb-1 truncate">Air Plant Medium</h3>
                        <p class="text-brand-dark font-bold text-sm md:text-base">Rp 85.000</p>
                    </div>
                </a>

                <!-- Item 3 -->
                <a href="javascript:void(0)" class="block bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition group">
                    <div class="h-32 md:h-48 bg-gray-100 overflow-hidden relative flex items-center justify-center">
                        <img src="https://images.unsplash.com/photo-1620127351139-44e21a224a1b?auto=format&fit=crop&w=400&q=80" alt="Terracotta Pot" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                    </div>
                    <div class="p-4">
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold block">Pot</span>
                        <h3 class="font-bold text-gray-900 text-sm md:text-base mb-1 truncate">Terracotta Pot L</h3>
                        <p class="text-brand-dark font-bold text-sm md:text-base">Rp 120.000</p>
                    </div>
                </a>

                <!-- Item 4 -->
                <a href="javascript:void(0)" class="block bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition group">
                    <div class="h-32 md:h-48 bg-gray-100 overflow-hidden relative flex items-center justify-center">
                        <i class="fas fa-image text-gray-300 text-3xl"></i>
                    </div>
                    <div class="p-4">
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold block">Tools</span>
                        <h3 class="font-bold text-gray-900 text-sm md:text-base mb-1 truncate">Sekop Set (3pcs)</h3>
                        <p class="text-brand-dark font-bold text-sm md:text-base">Rp 65.000</p>
                    </div>
                </a>

            </div>
        </section>

    </main>

    <x-footer />

</body>
</html>