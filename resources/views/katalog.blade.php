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

    <!-- Navbar -->
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        
        <!-- Bagian Kiri: Logo -->
        <div class="flex items-center gap-2 flex-1">
            <img src="{{ asset('img/logosetaman.png') }}" alt="Logo Setaman Bogor" class="h-14 w-auto">
            <div class="text-2xl font-bold text-brand-dark">Setaman Bogor</div>
        </div>

        <!-- Bagian Tengah: Menu -->
        <div class="hidden md:flex space-x-16 text-sm font-medium justify-center">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-brand transition   ">Beranda</a>
            <a href="{{ url('/katalog') }}" class="text-brand border-b-2 border-brand pb-1">Katalog</a>
            <a href="{{ url('/artikel') }}" class="text-gray-500 hover:text-brand transition">Edukasi</a>
        </div>

        <!-- Bagian Kanan: Ikon -->
        <div class="flex space-x-4 text-gray-600 flex-1 justify-end">
            <a href="{{ url('/keranjang') }}" class="hover:text-brand transition"><i class="fas fa-shopping-cart"></i></a>
            <a href="{{ url('/login') }}" class="hover:text-brand transition"><i class="fas fa-user"></i></a>
        </div>

    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        
        <!-- Search & Filter Bar -->
        <div class="mb-8">
            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2 font-semibold">Cari Produk</p>
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <!-- Search Input -->
                <div class="relative w-full md:w-1/2">
                    <input type="text" placeholder="Cari tanaman favorit Anda..." class="w-full border border-gray-300 rounded-sm py-2 px-4 focus:outline-none focus:border-brand text-sm">
                    <i class="fas fa-search absolute right-4 top-3 text-gray-400 text-sm"></i>
                </div>
                <!-- Filter Buttons -->
                <div class="flex flex-wrap gap-2 text-xs font-semibold uppercase tracking-wider w-full md:w-auto">
                    <button class="bg-brand text-white px-4 py-2 border border-brand hover:bg-brand-dark transition rounded-sm">Semua</button>
                    <button class="bg-white text-gray-700 px-4 py-2 border border-gray-300 hover:border-brand hover:text-brand transition rounded-sm">Indoor</button>
                    <button class="bg-white text-gray-700 px-4 py-2 border border-gray-300 hover:border-brand hover:text-brand transition rounded-sm">Outdoor</button>
                    <button class="bg-white text-gray-700 px-4 py-2 border border-gray-300 hover:border-brand hover:text-brand transition rounded-sm">Pupuk</button>
                    <button class="bg-white text-gray-700 px-4 py-2 border border-gray-300 hover:border-brand hover:text-brand transition rounded-sm">Pot</button>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            
            <!-- Product 1 -->
            <!-- Product 1 -->
            <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md transition rounded-xl flex flex-col overflow-hidden">
                
                <!-- 1. BUNGKUS GAMBAR DENGAN LINK KE DETAIL.HTML -->
                <a href="{{ url('/detail-produk') }}" class="h-64 bg-gray-100 flex items-center justify-center relative group block cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1614594975525-e45190c55d0b?auto=format&fit=crop&w=600&q=80" alt="Monstera Deliciosa" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                </a>
                
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <p class="text-xs text-brand uppercase tracking-wider mb-1 font-semibold">Tanaman Indoor</p>
                        
                        <!-- 2. BUNGKUS JUDUL DENGAN LINK KE DETAIL.HTML -->
                        <a href="{{ url('/detail-produk') }}" class="block hover:text-brand transition">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Monstera Deliciosa</h3>
                        </a>
                        
                        <p class="text-sm text-gray-500 mb-6">Tanaman hias populer dengan daun berlubang unik yang mudah dirawat.</p>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xl font-bold text-brand-dark">Rp 250.000</span>
                        <button class="bg-brand text-white text-xs font-semibold uppercase tracking-wider px-6 py-2 hover:bg-brand-dark transition rounded-md">Tambah</button>
                    </div>
                </div>
            </div>
            

            <!-- Product 2 -->
            <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md transition rounded-xl flex flex-col overflow-hidden">
                <div class="h-64 bg-gray-100 flex items-center justify-center relative group">
                    <img src="https://images.unsplash.com/photo-1599598425947-33002629e0fa?auto=format&fit=crop&w=600&q=80" alt="Sansevieria Trifasciata" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <p class="text-xs text-brand uppercase tracking-wider mb-1 font-semibold">Tanaman Indoor</p>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Sansevieria Trifasciata</h3>
                        <p class="text-sm text-gray-500 mb-6">Lidah mertua yang tangguh, mampu menyaring udara ruangan dengan maksimal.</p>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xl font-bold text-brand-dark">Rp 120.000</span>
                        <button class="bg-brand text-white text-xs font-semibold uppercase tracking-wider px-6 py-2 hover:bg-brand-dark transition rounded-md">Tambah</button>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md transition rounded-xl flex flex-col overflow-hidden">
                <div class="h-64 bg-gray-100 flex items-center justify-center relative group">
                    <img src="https://images.unsplash.com/photo-1520302630591-fd1c66edc19d?auto=format&fit=crop&w=600&q=80" alt="Orchidaceae Phalaenopsis" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <p class="text-xs text-brand uppercase tracking-wider mb-1 font-semibold">Tanaman Outdoor</p>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Orchidaceae Phalaenopsis</h3>
                        <p class="text-sm text-gray-500 mb-6">Anggrek bulan dengan kelopak putih bersih yang memberikan kesan elegan.</p>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xl font-bold text-brand-dark">Rp 350.000</span>
                        <button class="bg-brand text-white text-xs font-semibold uppercase tracking-wider px-6 py-2 hover:bg-brand-dark transition rounded-md">Tambah</button>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md transition rounded-xl flex flex-col overflow-hidden">
                <div class="h-64 bg-gray-100 flex items-center justify-center relative group">
                    <img src="https://images.unsplash.com/photo-1629837050013-16a8b1965e52?auto=format&fit=crop&w=600&q=80" alt="Pupuk Organik Cair" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <p class="text-xs text-brand uppercase tracking-wider mb-1 font-semibold">Nutrisi</p>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Pupuk Organik Cair</h3>
                        <p class="text-sm text-gray-500 mb-6">Nutrisi lengkap untuk mempercepat pertumbuhan dan kesehatan daun tanaman.</p>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xl font-bold text-brand-dark">Rp 45.000</span>
                        <button class="bg-brand text-white text-xs font-semibold uppercase tracking-wider px-6 py-2 hover:bg-brand-dark transition rounded-md">Tambah</button>
                    </div>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md transition rounded-xl flex flex-col overflow-hidden">
                <div class="h-64 bg-gray-100 flex items-center justify-center relative group">
                    <img src="https://images.unsplash.com/photo-1603436326446-7dc41f021c7a?auto=format&fit=crop&w=600&q=80" alt="Ficus Lyrata" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <p class="text-xs text-brand uppercase tracking-wider mb-1 font-semibold">Tanaman Indoor</p>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Ficus Lyrata</h3>
                        <p class="text-sm text-gray-500 mb-6">Ketapang biola dengan daun lebar yang memberikan pernyataan artistik di ruangan.</p>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xl font-bold text-brand-dark">Rp 420.000</span>
                        <button class="bg-brand text-white text-xs font-semibold uppercase tracking-wider px-6 py-2 hover:bg-brand-dark transition rounded-md">Tambah</button>
                    </div>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md transition rounded-xl flex flex-col overflow-hidden">
                <div class="h-64 bg-gray-100 flex items-center justify-center relative group">
                    <img src="https://images.unsplash.com/photo-1596547609652-9cb5d8d736bb?auto=format&fit=crop&w=600&q=80" alt="Aloe Barbadensis" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <p class="text-xs text-brand uppercase tracking-wider mb-1 font-semibold">Tanaman Outdoor</p>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Aloe Barbadensis</h3>
                        <p class="text-sm text-gray-500 mb-6">Lidah buaya multifungsi yang tahan panas dan sangat mudah dikembangbiakkan.</p>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xl font-bold text-brand-dark">Rp 65.000</span>
                        <button class="bg-brand text-white text-xs font-semibold uppercase tracking-wider px-6 py-2 hover:bg-brand-dark transition rounded-md">Tambah</button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center space-x-2">
            <button class="w-8 h-8 flex items-center justify-center border border-gray-300 bg-white text-gray-500 hover:border-brand hover:text-brand transition text-sm rounded-sm"><i class="fas fa-chevron-left"></i></button>
            <button class="w-8 h-8 flex items-center justify-center border border-brand bg-brand text-white text-sm font-semibold rounded-sm">1</button>
            <button class="w-8 h-8 flex items-center justify-center border border-gray-300 bg-white text-gray-700 hover:border-brand hover:text-brand transition text-sm font-semibold rounded-sm">2</button>
            <button class="w-8 h-8 flex items-center justify-center border border-gray-300 bg-white text-gray-700 hover:border-brand hover:text-brand transition text-sm font-semibold rounded-sm">3</button>
            <button class="w-8 h-8 flex items-center justify-center border border-gray-300 bg-white text-gray-500 hover:border-brand hover:text-brand transition text-sm rounded-sm"><i class="fas fa-chevron-right"></i></button>
        </div>

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