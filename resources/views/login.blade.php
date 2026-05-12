<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Setaman Bogor</title>
    <!-- Tailwind CSS CDN -->
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Minimal Navbar -->
    <!-- Untuk halaman login, biasanya menu lain dihilangkan agar user fokus login -->
    <nav class="bg-white border-b border-gray-100">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img src="{{ asset('img/logosetaman.png') }}" alt="Logo Setaman Bogor" class="h-10 w-auto md:h-12">
                <div class="text-xl md:text-2xl font-bold text-brand-dark">Setaman Bogor</div>
            </a>
            <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-500 hover:text-brand transition flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </nav>

    <!-- Main Content: Login Box -->
    <main class="flex-grow flex items-center justify-center p-6">
        
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm w-full max-w-md p-8 md:p-10 relative overflow-hidden">
            
            <!-- Aksen desain tipis di atas box -->
            <div class="absolute top-0 left-0 w-full h-1 bg-brand"></div>

            <!-- Logo di dalam card -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('img/logosetaman.png') }}" alt="Logo Icon" class="h-14 w-auto">
            </div>

            <!-- Judul -->
            <h1 class="text-2xl md:text-3xl font-bold text-center text-gray-900 mb-2">MASUK</h1>
            <p class="text-sm text-center text-gray-500 mb-8 px-4 leading-relaxed">
                Silakan masuk ke akun Setaman Bogor Anda untuk mengakses arsip botani.
            </p>

            <!-- Form Login -->
            <form class="space-y-5">
                
                <!-- Input Email -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-widest mb-2">Email</label>
                    <input type="email" placeholder="contoh@email.com" class="w-full border border-gray-300 rounded-md px-4 py-3.5 text-sm focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition" required>
                </div>
                
                <!-- Input Password -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-widest">Password</label>
                        <a href="javascript:void(0)" class="text-[10px] text-brand hover:text-brand-dark font-bold uppercase tracking-wider transition underline decoration-transparent hover:decoration-brand-dark">Lupa Password?</a>
                    </div>
                    <input type="password" placeholder="********" class="w-full border border-gray-300 rounded-md px-4 py-3.5 text-sm focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition" required>
                </div>
                
                <!-- Tombol Masuk -->
                <button type="button" class="w-full bg-brand hover:bg-brand-dark text-white font-bold py-3.5 px-6 rounded-md transition uppercase text-sm tracking-wider shadow-md mt-4">
                    Masuk
                </button>
            </form>

            <!-- Bagian Daftar -->
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-500 mb-4">Belum punya akun?</p>
                <a href="javascript:void(0)" class="block w-full text-center border-2 border-brand text-brand hover:bg-brand-light font-bold py-3 px-6 rounded-md transition uppercase text-xs tracking-widest">
                    Daftar Akun Baru
                </a>
            </div>

            <!-- Divider ATAU -->
            <div class="flex items-center my-8">
                <hr class="flex-grow border-gray-200">
                <span class="mx-4 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">Atau</span>
                <hr class="flex-grow border-gray-200">
            </div>

            <!-- Social Login -->
            <div class="grid grid-cols-2 gap-4">
                <button class="flex items-center justify-center gap-2 border border-gray-300 hover:border-gray-400 hover:bg-gray-50 transition rounded-md py-2.5 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">
                    <i class="fab fa-google text-red-500 text-sm"></i> Google
                </button>
                <button class="flex items-center justify-center gap-2 border border-gray-300 hover:border-gray-400 hover:bg-gray-50 transition rounded-md py-2.5 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">
                    <i class="fab fa-apple text-gray-900 text-base"></i> Apple
                </button>
            </div>

        </div>
    </main>

    <!-- Simple Footer for Login Page -->
    <footer class="py-6 text-center text-xs text-gray-400 border-t border-gray-200 bg-white">
        &copy; 2026 Setaman Bogor. Cultivating calm in every corner.
    </footer>

</body>
</html>