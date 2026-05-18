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

    <x-navbar />

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12 flex-grow">
        
        <!-- Header Profil -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 inline-block border-b-4 border-gray-900 pb-2 uppercase tracking-wide">
                Profil Pengguna
            </h1>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-md mb-6 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-md text-sm mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 block">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full border-b border-gray-300 py-2 focus:outline-none focus:border-brand font-bold text-gray-900" required>
                        </div>
                        <div>
                            <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 block">Alamat Email</label>
                            <input type="email" value="{{ Auth::user()->email }}" class="w-full border-b border-gray-300 py-2 text-gray-500 bg-gray-50 cursor-not-allowed" disabled>
                        </div>
                        <div>
                            <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 block">Nomor WhatsApp</label>
                            <input type="tel" name="phone" value="{{ Auth::user()->phone }}" class="w-full border-b border-gray-300 py-2 focus:outline-none focus:border-brand text-gray-700">
                        </div>
                        <button type="submit" class="w-full mt-4 bg-brand hover:bg-brand-dark text-white font-bold py-3 px-4 rounded-md transition uppercase text-xs tracking-wider shadow-sm">
                            Simpan Perubahan Profil
                        </button>
                    </form>

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

                <!-- Row: Pengaturan & Ganti Password -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Ganti Password -->
                    <div class="bg-white border border-gray-200 p-6 lg:p-8 rounded-xl shadow-sm flex flex-col">
                        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide mb-6">Ganti Password</h3>
                        <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 block">Password Lama</label>
                                <input type="password" name="current_password" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-brand" required>
                            </div>
                            <div>
                                <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 block">Password Baru</label>
                                <input type="password" name="password" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-brand" required minlength="8">
                            </div>
                            <div>
                                <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 block">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-brand" required minlength="8">
                            </div>
                            <button type="submit" class="w-full mt-2 bg-gray-900 hover:bg-black text-white font-bold py-2.5 px-4 rounded-md transition uppercase text-xs tracking-wider shadow-sm">
                                Update Password
                            </button>
                        </form>
                    </div>

                    <!-- Pengaturan -->
                    <div class="bg-white border border-gray-200 p-6 lg:p-8 rounded-xl shadow-sm">
                        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide mb-6">Pintasan</h3>
                        <div class="space-y-4">
                            <a href="{{ route('profile.orders') }}" class="block w-full text-center bg-brand-light text-brand hover:bg-brand hover:text-white font-bold py-3 px-4 rounded-md transition uppercase text-xs tracking-wider border border-brand">
                                Lihat Riwayat Pesanan
                            </a>
                            <a href="{{ route('katalog') }}" class="block w-full text-center bg-white border border-gray-300 hover:border-brand hover:text-brand text-gray-700 font-bold py-3 px-4 rounded-md transition uppercase text-xs tracking-wider">
                                Belanja Lagi
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Danger Zone / Sesi Aktif -->
                <div class="bg-red-50 border border-red-200 p-6 rounded-xl shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mt-2">
                    <div>
                        <h4 class="font-bold text-red-600 text-sm mb-1">Sesi Aktif</h4>
                        <p class="text-[10px] font-bold text-red-400 uppercase tracking-widest">Masuk dari: Bogor, ID (Desktop)</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white text-red-600 border border-red-200 hover:bg-red-100 font-bold py-2 px-6 rounded-md transition uppercase text-xs tracking-wider cursor-pointer">
                            Keluar Akun
                        </button>
                    </form>
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