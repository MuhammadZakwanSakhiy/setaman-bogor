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
    <nav class="bg-white container mx-auto px-6 py-4 flex justify-between items-center border-b border-gray-100">
        <div class="flex items-center gap-2 flex-1">
            <img src="{{ asset('img/logosetaman.png') }}" alt="Logo Setaman Bogor" class="h-14 w-auto">
            <div class="text-2xl font-bold text-brand-dark">Setaman Bogor</div>
        </div>
        <div class="hidden md:flex space-x-16 text-sm font-medium justify-center">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-brand transition">Beranda</a>
            <a href="{{ url('/katalog') }}" class="text-brand border-b-2 border-brand pb-1">Katalog</a>
            <a href="{{ url('/artikel') }}" class="text-gray-500 hover:text-brand transition">Edukasi</a>
        </div>
        <div class="flex space-x-4 text-gray-600 flex-1 justify-end">
            <a href="{{ url('/keranjang') }}" class="hover:text-brand"><i class="fas fa-shopping-cart"></i></a>
            <a href="{{ url('/login') }}" class="hover:text-brand transition"><i class="fas fa-user"></i></a>
        </div>
    </nav>

    <!-- Breadcrumb (Opsional, sangat disarankan untuk navigasi e-commerce) -->
    <div class="container mx-auto px-6 py-4 text-sm text-gray-500">
        <a href="{{ url('/katalog') }}" class="hover:text-brand">Katalog</a> <span class="mx-2">/</span>
        <a href="javascript:void(0)" class="hover:text-brand">Tanaman Indoor</a> <span class="mx-2">/</span>
        <span class="text-gray-800 font-medium">Monstera Deliciosa</span>
    </div>

    <!-- Product Detail Section -->
    <main class="container mx-auto px-6 py-8">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-12">
            
            <!-- Left Column: Images -->
            <div class="flex flex-col gap-4">
                <!-- Main Image -->
                <div class="w-full h-[400px] md:h-[500px] bg-gray-100 rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1614594975525-e45190c55d0b?auto=format&fit=crop&w=800&q=80" alt="Monstera Deliciosa Utama" class="w-full h-full object-cover">
                </div>
                <!-- Thumbnails Grid -->
                <div class="grid grid-cols-4 gap-4">
                    <div class="h-20 md:h-24 bg-gray-100 rounded-lg overflow-hidden border-2 border-brand cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1614594975525-e45190c55d0b?auto=format&fit=crop&w=300&q=80" alt="Thumbnail 1" class="w-full h-full object-cover">
                    </div>
                    <div class="h-20 md:h-24 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 cursor-pointer opacity-70 hover:opacity-100 transition">
                        <img src="https://images.unsplash.com/photo-1545241047-6083a36ee2bf?auto=format&fit=crop&w=300&q=80" alt="Thumbnail 2" class="w-full h-full object-cover">
                    </div>
                    <div class="h-20 md:h-24 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 cursor-pointer opacity-70 hover:opacity-100 transition">
                        <img src="https://images.unsplash.com/photo-1600354143496-e26b801a61e7?auto=format&fit=crop&w=300&q=80" alt="Thumbnail 3" class="w-full h-full object-cover">
                    </div>
                    <div class="h-20 md:h-24 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 flex items-center justify-center text-gray-400 cursor-pointer hover:bg-gray-50 transition">
                        <i class="fas fa-play-circle text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Right Column: Product Info -->
            <div class="flex flex-col">
                <div class="mb-4">
                    <span class="inline-block border border-gray-800 text-gray-800 text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-sm mb-4">Tanaman Indoor</span>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Monstera Deliciosa</h1>
                    <p class="text-2xl font-bold text-brand-dark mb-4">Rp 250.000</p>
                    
                    <div class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                        <div class="w-2.5 h-2.5 rounded-full bg-green-500"></div>
                        Tersedia (12 Unit)
                    </div>
                </div>

                <hr class="border-gray-200 my-6">

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3">Deskripsi</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Tanaman ikonik dengan daun berlubang unik yang memberikan kesan tropis modern pada ruangan Anda. Mudah dirawat dan cocok untuk pemula yang ingin menghadirkan nuansa alam ke dalam rumah.
                    </p>
                </div>

                <!-- Care Tips Box -->
                <div class="bg-brand-light p-5 rounded-xl border border-green-100 mb-8">
                    <h3 class="text-xs font-bold text-brand-dark uppercase tracking-wider mb-4 border-b border-green-200 pb-2">Tips Perawatan</h3>
                    <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex items-center gap-3">
                            <div class="w-6 text-center"><i class="fas fa-sun text-brand text-lg"></i></div>
                            <span>Cahaya terang tidak langsung</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-6 text-center"><i class="fas fa-tint text-blue-500 text-lg"></i></div>
                            <span>Siram saat 2-3 cm tanah atas kering</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-6 text-center"><i class="fas fa-thermometer-half text-orange-500 text-lg"></i></div>
                            <span>Suhu ideal 18&deg;C - 30&deg;C</span>
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="mt-auto">
                    <div class="flex flex-col sm:flex-row gap-4 mb-4">
                        <button class="flex-1 border-2 border-brand text-brand hover:bg-brand-light font-bold py-3 px-6 rounded-md transition uppercase text-sm tracking-wider">
                            Tambah ke Keranjang
                        </button>
                        <button class="flex-1 bg-brand text-white hover:bg-brand-dark font-bold py-3 px-6 rounded-md transition uppercase text-sm tracking-wider shadow-md">
                            Beli Sekarang
                        </button>
                    </div>
                    <button class="w-full flex items-center justify-center gap-2 text-gray-500 hover:text-red-500 font-medium text-sm transition py-2">
                        <i class="far fa-heart"></i> Simpan ke Wishlist
                    </button>
                </div>
            </div>

        </div>
    </main>

    <!-- Horizontal Divider -->
    <div class="container mx-auto px-6">
        <hr class="border-gray-200 border-2 my-8 rounded-full">
    </div>

    <!-- Related Products Section -->
    <section class="container mx-auto px-6 py-8 mb-12">
        <div class="flex justify-between items-end mb-8">
            <h2 class="text-2xl font-bold text-gray-900 uppercase tracking-wide">Katalog Serupa</h2>
            <a href="{{ url('/katalog') }}" class="text-sm font-bold text-gray-900 border-b border-gray-900 hover:text-brand hover:border-brand transition pb-1 uppercase tracking-wider">Lihat Semua</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            
            <!-- Card 1 -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col">
                <div class="h-48 bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1599598425947-33002629e0fa?auto=format&fit=crop&w=400&q=80" alt="Sansevieria" class="w-full h-full object-cover">
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold">Indoor</span>
                    <h3 class="font-bold text-gray-900 text-lg mb-1">Sansevieria</h3>
                    <p class="text-brand-dark font-bold mb-4">Rp 85.000</p>
                    <button class="mt-auto w-full border border-gray-300 text-gray-700 font-bold py-2 text-xs uppercase tracking-wider hover:border-brand hover:text-brand transition rounded-sm">Detail</button>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col">
                <div class="h-48 bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1612363228104-db838b00a6e3?auto=format&fit=crop&w=400&q=80" alt="Philodendron" class="w-full h-full object-cover">
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold">Indoor</span>
                    <h3 class="font-bold text-gray-900 text-lg mb-1">Philodendron</h3>
                    <p class="text-brand-dark font-bold mb-4">Rp 120.000</p>
                    <button class="mt-auto w-full border border-gray-300 text-gray-700 font-bold py-2 text-xs uppercase tracking-wider hover:border-brand hover:text-brand transition rounded-sm">Detail</button>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col">
                <div class="h-48 bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1620127351139-44e21a224a1b?auto=format&fit=crop&w=400&q=80" alt="Calathea" class="w-full h-full object-cover">
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold">Outdoor</span>
                    <h3 class="font-bold text-gray-900 text-lg mb-1">Calathea</h3>
                    <p class="text-brand-dark font-bold mb-4">Rp 150.000</p>
                    <button class="mt-auto w-full border border-gray-300 text-gray-700 font-bold py-2 text-xs uppercase tracking-wider hover:border-brand hover:text-brand transition rounded-sm">Detail</button>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col">
                <div class="h-48 bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1603436326446-7dc41f021c7a?auto=format&fit=crop&w=400&q=80" alt="Ficus Lyrata" class="w-full h-full object-cover">
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold">Indoor</span>
                    <h3 class="font-bold text-gray-900 text-lg mb-1">Ficus Lyrata</h3>
                    <p class="text-brand-dark font-bold mb-4">Rp 300.000</p>
                    <button class="mt-auto w-full border border-gray-300 text-gray-700 font-bold py-2 text-xs uppercase tracking-wider hover:border-brand hover:text-brand transition rounded-sm">Detail</button>
                </div>
            </div>

        </div>
    </section>

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