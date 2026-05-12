<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukasi & Artikel | Setaman Bogor</title>
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
        <div class="flex items-center gap-2 flex-1">
            <img src="{{ asset('img/logosetaman.png') }}" alt="Logo Setaman Bogor" class="h-14 w-auto">
            <div class="text-2xl font-bold text-brand-dark">Setaman Bogor</div>
        </div>
        <div class="hidden md:flex space-x-16 text-sm font-medium justify-center">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-brand transition">Beranda</a>
            <a href="{{ url('/katalog') }}" class="text-gray-500 hover:text-brand transition">Katalog</a>
            <a href="{{ url('/artikel') }}" class="text-brand border-b-2 border-brand pb-1">Edukasi</a>
        </div>
        <div class="flex space-x-4 text-gray-600 flex-1 justify-end">
            <a href="{{ url('/keranjang') }}" class="hover:text-brand transition"><i class="fas fa-shopping-cart"></i></a>
            <a href="{{ url('/login') }}" class="hover:text-brand transition"><i class="fas fa-user"></i></a>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="container mx-auto px-6 py-12 md:py-16">
        <div class="max-w-3xl">
            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 block">Pusat Pengetahuan</span>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">Daftar Artikel & Edukasi</h1>
            <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                Temukan panduan praktis, riset botani terbaru, dan tips perawatan tanaman dari pakar Setaman Bogor.
            </p>
            
            <!-- Search Bar -->
            <div class="relative max-w-2xl">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Cari artikel atau topik tanaman..." class="w-full border border-gray-300 rounded-md py-3 pl-12 pr-4 focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition">
            </div>
        </div>
    </header>

    <!-- Main Content: Article Grid -->
    <main class="container mx-auto px-6 pb-16 flex-grow">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            
            <!-- Artikel 1 -->
            <article class="bg-white border border-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col group">
                
                <!-- 1. LINK PADA GAMBAR -->
                <a href="{{ url('/detail-artikel') }}" class="block h-56 bg-gray-100 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1589824781472-c5112e69888d?auto=format&fit=crop&w=600&q=80" alt="Propagasi Tanaman" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                </a>
                
                <div class="p-6 flex-grow flex flex-col">
                    <span class="text-[10px] text-brand font-bold uppercase tracking-widest mb-2 block">Kategori Panduan</span>
                    
                    <!-- 2. LINK PADA JUDUL -->
                    <a href="{{ url('/detail-artikel') }}" class="block hover:text-brand transition mb-3">
                        <h2 class="text-xl font-bold text-gray-900 leading-snug">Teknik Propagasi Tanaman Endemik Bogor</h2>
                    </a>
                    
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Pelajari metode paling efektif untuk memperbanyak tanaman khas Bogor dengan memperhatikan kelembaban...
                    </p>
                    
                    <!-- 3. LINK PADA TEKS "BACA SELENGKAPNYA" -->
                    <a href="{{ url('/detail-artikel') }}" class="mt-auto inline-block text-xs font-bold text-gray-900 border-b border-gray-900 hover:text-brand hover:border-brand transition pb-0.5 w-max uppercase tracking-wider">
                        Baca Selengkapnya
                    </a>
                </div>
            </article>

            <!-- Artikel 2 -->
            <article class="bg-white border border-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col group">
                <a href="{{ url('/detail-artikel') }}" class="block h-56 bg-gray-100 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&w=600&q=80" alt="Arsitektur Modern" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                </a>
                <div class="p-6 flex-grow flex flex-col">
                    <span class="text-[10px] text-brand font-bold uppercase tracking-widest mb-2 block">Kategori Riset</span>
                    <a href="{{ url('/detail-artikel') }}" class="block hover:text-brand transition mb-3">
                        <h2 class="text-xl font-bold text-gray-900 leading-snug">Manfaat Botani dalam Arsitektur Modern</h2>
                    </a>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Bagaimana integrasi tanaman dalam ruang tinggal dapat meningkatkan kualitas udara dan kesehatan mental penghuninya...
                    </p>
                    <a href="{{ url('/detail-artikel') }}" class="mt-auto inline-block text-xs font-bold text-gray-900 border-b border-gray-900 hover:text-brand hover:border-brand transition pb-0.5 w-max uppercase tracking-wider">Baca Selengkapnya</a>
                </div>
            </article>

            <!-- Artikel 3 -->
            <article class="bg-white border border-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col group">
                <a href="{{ url('/detail-artikel') }}" class="block h-56 bg-gray-100 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1545241047-6083a36ee2bf?auto=format&fit=crop&w=600&q=80" alt="Tanaman Pencahayaan Rendah" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                </a>
                <div class="p-6 flex-grow flex flex-col">
                    <span class="text-[10px] text-brand font-bold uppercase tracking-widest mb-2 block">Kategori Katalog</span>
                    <a href="{{ url('/detail-artikel') }}" class="block hover:text-brand transition mb-3">
                        <h2 class="text-xl font-bold text-gray-900 leading-snug">10 Tanaman Hias Terbaik untuk Pencahayaan Rendah</h2>
                    </a>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Daftar tanaman yang tetap subur meskipun diletakkan di sudut ruangan dengan akses cahaya matahari yang...
                    </p>
                    <a href="{{ url('/detail-artikel') }}" class="mt-auto inline-block text-xs font-bold text-gray-900 border-b border-gray-900 hover:text-brand hover:border-brand transition pb-0.5 w-max uppercase tracking-wider">Baca Selengkapnya</a>
                </div>
            </article>

            <!-- Artikel 4 -->
            <article class="bg-white border border-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col group">
                <a href="{{ url('/detail-artikel') }}" class="block h-56 bg-gray-100 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e736?auto=format&fit=crop&w=600&q=80" alt="pH Tanah" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                </a>
                <div class="p-6 flex-grow flex flex-col">
                    <span class="text-[10px] text-brand font-bold uppercase tracking-widest mb-2 block">Kategori Tanah</span>
                    <a href="{{ url('/detail-artikel') }}" class="block hover:text-brand transition mb-3">
                        <h2 class="text-xl font-bold text-gray-900 leading-snug">Memahami pH Tanah untuk Kebun Organik</h2>
                    </a>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Panduan mendalam mengenai cara menguji dan menyesuaikan tingkat keasaman tanah untuk memaksimalkan...
                    </p>
                    <a href="{{ url('/detail-artikel') }}" class="mt-auto inline-block text-xs font-bold text-gray-900 border-b border-gray-900 hover:text-brand hover:border-brand transition pb-0.5 w-max uppercase tracking-wider">Baca Selengkapnya</a>
                </div>
            </article>

            <!-- Artikel 5 -->
            <article class="bg-white border border-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col group">
                <a href="{{ url('/detail-artikel') }}" class="block h-56 bg-gray-100 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1558904541-efa843a96f09?auto=format&fit=crop&w=600&q=80" alt="Taman Minimalis" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                </a>
                <div class="p-6 flex-grow flex flex-col">
                    <span class="text-[10px] text-brand font-bold uppercase tracking-widest mb-2 block">Kategori Lanskap</span>
                    <a href="{{ url('/detail-artikel') }}" class="block hover:text-brand transition mb-3">
                        <h2 class="text-xl font-bold text-gray-900 leading-snug">Prinsip Desain Taman Minimalis Brutalis</h2>
                    </a>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Mengeksplorasi penggunaan beton, garis tegas, dan struktur tanaman arsitektural dalam menciptakan taman yang...
                    </p>
                    <a href="{{ url('/detail-artikel') }}" class="mt-auto inline-block text-xs font-bold text-gray-900 border-b border-gray-900 hover:text-brand hover:border-brand transition pb-0.5 w-max uppercase tracking-wider">Baca Selengkapnya</a>
                </div>
            </article>

            <!-- Artikel 6 -->
            <article class="bg-white border border-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col group">
                <a href="{{ url('/detail-artikel') }}" class="block h-56 bg-gray-100 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1416879598555-220b3cb1a4bb?auto=format&fit=crop&w=600&q=80" alt="Irigasi Musim Hujan" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                </a>
                <div class="p-6 flex-grow flex flex-col">
                    <span class="text-[10px] text-brand font-bold uppercase tracking-widest mb-2 block">Kategori Perawatan</span>
                    <a href="{{ url('/detail-artikel') }}" class="block hover:text-brand transition mb-3">
                        <h2 class="text-xl font-bold text-gray-900 leading-snug">Manajemen Irigasi untuk Musim Penghujan</h2>
                    </a>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Strategi khusus untuk mencegah pembusukan akar pada tanaman luar ruangan selama periode curah hujan tinggi...
                    </p>
                    <a href="{{ url('/detail-artikel') }}" class="mt-auto inline-block text-xs font-bold text-gray-900 border-b border-gray-900 hover:text-brand hover:border-brand transition pb-0.5 w-max uppercase tracking-wider">Baca Selengkapnya</a>
                </div>
            </article>

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

    <!-- Newsletter Section -->
    <section class="bg-white pt-16 pb-8 border-t border-gray-100">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="md:w-1/2">
                <h2 class="text-2xl md:text-3xl font-bold text-brand-dark mb-3">Dapatkan Artikel Terbaru di Email Anda</h2>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Berlangganan buletin mingguan kami untuk wawasan botani eksklusif dan pembaruan katalog.
                </p>
            </div>
            <div class="md:w-1/2 w-full max-w-md">
                <form class="flex w-full shadow-sm rounded-md overflow-hidden">
                    <input type="email" placeholder="Alamat Email" class="flex-grow border border-gray-300 py-3 px-4 focus:outline-none focus:border-brand text-sm" required>
                    <button type="submit" class="bg-brand text-white font-bold py-3 px-6 uppercase tracking-wider text-xs hover:bg-brand-dark transition">
                        Daftar
                    </button>
                </form>
            </div>
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