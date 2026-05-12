<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja | Setaman Bogor</title>
    <!-- Tailwind CSS CDN -->
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white container mx-auto px-6 py-4 flex justify-between items-center border-b border-gray-100">
        <div class="flex items-center gap-2 flex-1">
            <img src="{{ asset('img/logosetaman.png') }}" alt="Logo Setaman Bogor" class="h-14 w-auto">
            <div class="text-2xl font-bold text-brand-dark">Setaman Bogor</div>
        </div>
        <div class="hidden md:flex space-x-16 text-sm font-medium justify-center">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-brand transition">Beranda</a>
            <a href="{{ url('/katalog') }}" class="text-gray-500 hover:text-brand transition">Katalog</a>
            <a href="javascript:void(0)" class="text-gray-500 hover:text-brand transition">Edukasi</a>
        </div>
        <div class="flex space-x-4 text-gray-600 flex-1 justify-end">
            <a href="{{ url('/keranjang') }}" class="text-brand"><i class="fas fa-shopping-cart"></i></a>
            <a href="{{ url('/login') }}" class="hover:text-brand transition"><i class="fas fa-user"></i></a>
        </div>
    </nav>

    <!-- Main Content: Keranjang -->
    <main class="container mx-auto px-6 py-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">Keranjang Belanja</h1>

        <div class="flex flex-col lg:flex-row gap-10">
            
            <!-- Kolom Kiri: Daftar Produk -->
            <div class="lg:w-2/3 flex flex-col gap-6">
                
                <!-- [AWAL LOOPING PHP DARI DATABASE DI SINI] -->

                <!-- Item Keranjang 1 -->
                <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-6 flex flex-col sm:flex-row gap-6 items-start sm:items-center relative shadow-sm">
                    <!-- Gambar -->
                    <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1614594975525-e45190c55d0b?auto=format&fit=crop&w=300&q=80" alt="Monstera Deliciosa" class="w-full h-full object-cover">
                    </div>
                    
                    <!-- Info Produk -->
                    <div class="flex-grow flex flex-col justify-center">
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold mb-1">Indoor / Botanical</span>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Monstera Deliciosa</h3>
                        <p class="text-brand-dark font-bold text-lg mb-4 sm:mb-0">Rp 250.000</p>
                    </div>

                    <!-- Kuantitas & Hapus -->
                    <div class="flex flex-row sm:flex-col items-end gap-4 sm:gap-6 w-full sm:w-auto justify-between sm:justify-start">
                        <!-- Input Jumlah -->
                        <div class="flex items-center border border-gray-300 rounded-md overflow-hidden">
                            <button class="px-3 py-1 bg-white hover:bg-gray-100 text-gray-600 transition">-</button>
                            <input type="text" value="1" class="w-10 text-center text-sm font-semibold text-gray-900 focus:outline-none border-x border-gray-300 py-1" readonly>
                            <button class="px-3 py-1 bg-white hover:bg-gray-100 text-gray-600 transition">+</button>
                        </div>
                        <button class="text-xs font-bold text-gray-400 hover:text-red-500 uppercase tracking-wider transition underline">Hapus</button>
                    </div>
                </div>

                <!-- Item Keranjang 2 -->
                <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-6 flex flex-col sm:flex-row gap-6 items-start sm:items-center relative shadow-sm">
                    <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1603436326446-7dc41f021c7a?auto=format&fit=crop&w=300&q=80" alt="Ficus Lyrata" class="w-full h-full object-cover">
                    </div>
                    
                    <div class="flex-grow flex flex-col justify-center">
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold mb-1">Indoor / Air Purifying</span>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Ficus Lyrata</h3>
                        <p class="text-brand-dark font-bold text-lg mb-4 sm:mb-0">Rp 350.000</p>
                    </div>

                    <div class="flex flex-row sm:flex-col items-end gap-4 sm:gap-6 w-full sm:w-auto justify-between sm:justify-start">
                        <div class="flex items-center border border-gray-300 rounded-md overflow-hidden">
                            <button class="px-3 py-1 bg-white hover:bg-gray-100 text-gray-600 transition">-</button>
                            <input type="text" value="1" class="w-10 text-center text-sm font-semibold text-gray-900 focus:outline-none border-x border-gray-300 py-1" readonly>
                            <button class="px-3 py-1 bg-white hover:bg-gray-100 text-gray-600 transition">+</button>
                        </div>
                        <button class="text-xs font-bold text-gray-400 hover:text-red-500 uppercase tracking-wider transition underline">Hapus</button>
                    </div>
                </div>

                <!-- [AKHIR LOOPING PHP DARI DATABASE DI SINI] -->

            </div>

            <!-- Kolom Kanan: Ringkasan Pesanan -->
            <div class="lg:w-1/3">
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm sticky top-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Ringkasan</h2>
                    
                    <div class="space-y-4 text-sm text-gray-600 mb-6">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span class="font-bold text-gray-900">Rp 600.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Estimasi Pengiriman</span>
                            <span class="font-bold text-gray-900">Rp 0</span>
                        </div>
                    </div>

                    <hr class="border-gray-200 border-dashed mb-6">

                    <div class="flex justify-between items-end mb-8">
                        <span class="text-base font-bold text-gray-900 uppercase tracking-wider">Total</span>
                        <span class="text-2xl font-bold text-brand-dark">Rp 600.000</span>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button class="w-full bg-brand hover:bg-brand-dark text-white font-bold py-3.5 px-6 rounded-md transition uppercase text-xs tracking-widest shadow-md">
                            Lanjut ke Checkout
                        </button>
                        <a href="{{ url('/katalog') }}" class="w-full text-center bg-white border border-gray-300 hover:border-brand hover:text-brand text-gray-700 font-bold py-3 px-6 rounded-md transition uppercase text-xs tracking-widest">
                            Lanjutkan Belanja
                        </a>
                    </div>

                    <!-- Trust Badges -->
                    <div class="mt-8 space-y-3 text-xs text-gray-500">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-truck text-brand mt-0.5"></i>
                            <span>Gratis Ongkir untuk wilayah Bogor.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-seedling text-brand mt-0.5"></i>
                            <span>Garansi tanaman sehat 7 hari.</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Rekomendasi / Mungkin Anda Suka -->
    <section class="container mx-auto px-6 py-12 mb-12">
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
                    <i class="fas fa-image text-gray-300 text-3xl"></i>
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

    <!-- Footer -->
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