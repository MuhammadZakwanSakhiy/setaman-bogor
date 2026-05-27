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
    <x-navbar />

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
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-50 text-red-500 p-4 rounded-md text-sm mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Input Email -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-widest mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" class="w-full border border-gray-300 rounded-md px-4 py-3.5 text-sm focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition" required>
                </div>
                
                <!-- Input Password -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-widest">Password</label>
                        <a href="javascript:void(0)" class="text-[10px] text-brand hover:text-brand-dark font-bold uppercase tracking-wider transition underline decoration-transparent hover:decoration-brand-dark">Lupa Password?</a>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="********" class="w-full border border-gray-300 rounded-md px-4 pr-10 py-3.5 text-sm focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition" required>
                        <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-brand focus:outline-none">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Tombol Masuk -->
                <button type="submit" class="w-full bg-brand hover:bg-brand-dark text-white font-bold py-3.5 px-6 rounded-md transition uppercase text-sm tracking-wider shadow-md mt-4">
                    Masuk
                </button>
            </form>

            <!-- Bagian Daftar -->
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-500 mb-4">Belum punya akun?</p>
                <a href="{{ route('register') }}" class="block w-full text-center border-2 border-brand text-brand hover:bg-brand-light font-bold py-3 px-6 rounded-md transition uppercase text-xs tracking-widest">
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

    <script>
        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('far', 'fa-eye');
                icon.classList.add('fas', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fas', 'fa-eye-slash');
                icon.classList.add('far', 'fa-eye');
            }
        }
    </script>
</body>
</html>