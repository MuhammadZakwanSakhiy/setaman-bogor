<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna | Setaman Bogor</title>
    <!-- Tailwind CSS CDN -->
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white container mx-auto px-6 py-4 flex justify-between items-center border-b border-gray-100">
        <div class="flex items-center gap-2 flex-1">
            <img src="{{ asset('img/logosetaman.png') }}" alt="Logo Setaman Bogor" class="h-14 w-auto">
            <div class="text-2xl font-bold text-brand-dark">Setaman Bogor</div>
        </div>
        <div class="hidden md:flex space-x-16 text-sm font-medium justify-center">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-brand transition">Beranda</a>
            <a href="{{ url('/katalog') }}" class="text-gray-500 hover:text-brand transition">Katalog</a>
            <a href="{{ url('/artikel') }}" class="text-gray-500 hover:text-brand transition">Edukasi</a>
        </div>
        <div class="flex space-x-4 text-gray-600 flex-1 justify-end">
            <a href="{{ url('/keranjang') }}" class="hover:text-brand transition"><i class="fas fa-shopping-cart"></i></a>
            <!-- Ikon User Aktif -->
            <a href="{{ url('/profil') }}" class="text-brand"><i class="fas fa-user"></i></a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12 flex-grow">
        
        <!-- Header Profil -->
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-gray-900 inline-block border-b-4 border-gray-900 pb-2 uppercase tracking-wide">
                Profil Pengguna
            </h1>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Kolom Kiri: Kartu Identitas -->
            <div class="lg:w-1/3">
                <div class="bg-white border border-gray-200 p-6 lg:p-8 rounded-xl shadow-sm">
                    
                    <!-- Avatar Placeholder -->
                    <div class="w-full aspect-square bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-8 relative group cursor-pointer hover:bg-gray-50 transition">
                        <div class="text-center text-gray-400 group-hover:text-brand transition">
                            <i class="fas fa-camera text-3xl mb-2"></i>
                            <p class="text-xs font-bold uppercase tracking-widest border border-gray-300 px-3 py-1 bg-white rounded-sm">Avatar</p>
                        </div>
                    </div>

                    <!-- Info User -->
                    <div class="space-y-6">
                        <div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1">Nama Lengkap</p>
                            <h2 class="text-xl font-bold text-gray-900">Budi Setiawan</h2>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1">Alamat Email</p>
                            <p class="text-base text-gray-700">budi.setiawan@example.com</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1">ID Pengguna</p>
                            <p class="text-sm font-mono text-gray-500">#SB-2024-0089</p>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 space-y-3">
                        <button class="w-full bg-brand hover:bg-brand-dark text-white font-bold py-3 px-4 rounded-md transition uppercase text-xs tracking-wider shadow-sm">
                            Edit Profil
                        </button>
                        <button class="w-full bg-white border border-gray-300 hover:border-brand hover:text-brand text-gray-700 font-bold py-3 px-4 rounded-md transition uppercase text-xs tracking-wider">
                            Ganti Kata Sandi
                        </button>
                    </div>

                </div>
            </div>

            <!-- Kolom Kanan: Panel Info & Pengaturan -->
            <div class="lg:w-2/3 flex flex-col gap-6">
                
                <!-- Aktivitas Terakhir -->
                <div class="bg-white border border-gray-200 p-6 lg:p-8 rounded-xl shadow-sm">
                    <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide">Aktivitas Terakhir</h3>
                        <a href="javascript:void(0)" class="text-xs font-bold text-gray-500 border-b border-gray-500 hover:text-brand hover:border-brand transition pb-0.5 uppercase tracking-wider">Lihat Semua</a>
                    </div>
                    
                    <div class="space-y-0">
                        <!-- Item Aktivitas 1 -->
                        <a href="javascript:void(0)" class="flex justify-between items-center py-4 border-b border-gray-100 hover:bg-gray-50 transition px-2 rounded-md group">
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm mb-1 group-hover:text-brand transition">Membaca Artikel: Klasifikasi Paku-pakuan</h4>
                                <p class="text-xs text-gray-500">2 Jam yang lalu &bull; Edukasi</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 group-hover:text-brand transition"></i>
                        </a>
                        <!-- Item Aktivitas 2 -->
                        <a href="javascript:void(0)" class="flex justify-between items-center py-4 border-b border-gray-100 hover:bg-gray-50 transition px-2 rounded-md group border-transparent">
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm mb-1 group-hover:text-brand transition">Menambahkan Anggrek Hutan ke Katalog</h4>
                                <p class="text-xs text-gray-500">Kemarin &bull; Katalog</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 group-hover:text-brand transition"></i>
                        </a>
                    </div>
                </div>

                <!-- Row: Kontribusi & Pengaturan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Kontribusi -->
                    <div class="bg-brand-light border border-green-100 p-6 lg:p-8 rounded-xl shadow-sm flex flex-col">
                        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide mb-6">Kontribusi</h3>
                        <div class="grid grid-cols-2 gap-4 mt-auto">
                            <div class="bg-white border border-gray-200 p-4 rounded-lg text-center flex flex-col justify-center">
                                <span class="text-3xl font-bold text-brand-dark leading-none mb-2">12</span>
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Tanaman</span>
                            </div>
                            <div class="bg-white border border-gray-200 p-4 rounded-lg text-center flex flex-col justify-center">
                                <span class="text-3xl font-bold text-brand-dark leading-none mb-2">05</span>
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Artikel</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pengaturan -->
                    <div class="bg-white border border-gray-200 p-6 lg:p-8 rounded-xl shadow-sm">
                        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide mb-6">Pengaturan</h3>
                        <div class="space-y-4">
                            <!-- Toggle 1 -->
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" checked class="w-4 h-4 text-brand bg-gray-100 border-gray-300 rounded focus:ring-brand focus:ring-2 cursor-pointer">
                                <span class="text-xs font-bold text-gray-700 uppercase tracking-wider group-hover:text-brand transition">Notifikasi Email</span>
                            </label>
                            <!-- Toggle 2 -->
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" class="w-4 h-4 text-brand bg-gray-100 border-gray-300 rounded focus:ring-brand focus:ring-2 cursor-pointer">
                                <span class="text-xs font-bold text-gray-700 uppercase tracking-wider group-hover:text-brand transition">Mode Gelap</span>
                            </label>
                            <!-- Toggle 3 -->
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" checked class="w-4 h-4 text-brand bg-gray-100 border-gray-300 rounded focus:ring-brand focus:ring-2 cursor-pointer">
                                <span class="text-xs font-bold text-gray-700 uppercase tracking-wider group-hover:text-brand transition">Profil Publik</span>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Danger Zone / Sesi Aktif -->
                <div class="bg-red-50 border border-red-200 p-6 rounded-xl shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mt-2">
                    <div>
                        <h4 class="font-bold text-red-600 text-sm mb-1">Sesi Aktif</h4>
                        <p class="text-[10px] font-bold text-red-400 uppercase tracking-widest">Masuk dari: Bogor, ID (Desktop)</p>
                    </div>
                    <a href="{{ url('/login') }}" class="bg-white text-red-600 border border-red-200 hover:bg-red-100 font-bold py-2 px-6 rounded-md transition uppercase text-xs tracking-wider">
                        Keluar Akun
                    </a>
                </div>

            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white pt-16 pb-8 border-t border-gray-200">
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
        <div class="container mx-auto px-6 pt-8 border-t border-gray-100 text-xs text-gray-400">
            &copy; 2026 Setaman Bogor
        </div>
    </footer>

</body>
</html> 