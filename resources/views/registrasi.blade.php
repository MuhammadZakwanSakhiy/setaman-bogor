<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi | Setaman Bogor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <x-navbar />

    <main class="flex-grow flex items-center justify-center p-6 py-12">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm w-full max-w-2xl p-8 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-brand"></div>

            <div class="flex justify-center mb-6">
                <img src="{{ asset('img/logosetaman.png') }}" alt="Logo Icon" class="h-14 w-auto">
            </div>

            <h1 class="text-2xl md:text-3xl font-bold text-center text-gray-900 mb-2">DAFTAR AKUN BARU</h1>
            <p class="text-sm text-center text-gray-500 mb-8 px-4 leading-relaxed">
                Buat akun untuk menyimpan wishlist dan melihat riwayat pesanan Anda.
            </p>

            <form method="POST" action="{{ route('register') }}" class="mt-8 grid gap-5 md:grid-cols-2">
                @csrf
                
                @if ($errors->any())
                    <div class="md:col-span-2 bg-red-50 text-red-500 p-4 rounded-md text-sm mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                    Nama Lengkap
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Budi Setiawan" class="rounded-xl border border-gray-300 px-4 py-3 font-normal outline-none focus:border-brand" required>
                </label>
                <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                    Nomor WhatsApp
                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="081234567890" class="rounded-xl border border-gray-300 px-4 py-3 font-normal outline-none focus:border-brand">
                </label>
                <label class="grid gap-2 text-sm font-semibold text-brand-dark md:col-span-2">
                    Email
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" class="rounded-xl border border-gray-300 px-4 py-3 font-normal outline-none focus:border-brand" required>
                </label>
                <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                    Password
                    <input type="password" name="password" placeholder="••••••••" class="rounded-xl border border-gray-300 px-4 py-3 font-normal outline-none focus:border-brand" required minlength="8">
                </label>
                <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                    Konfirmasi Password
                    <input type="password" name="password_confirmation" placeholder="••••••••" class="rounded-xl border border-gray-300 px-4 py-3 font-normal outline-none focus:border-brand" required minlength="8">
                </label>
                
                <button type="submit" class="w-full bg-brand hover:bg-brand-dark text-white font-bold py-3.5 px-6 rounded-md transition uppercase text-sm tracking-wider shadow-md mt-4 md:col-span-2">
                    Daftar Akun
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-500 mb-4">Sudah punya akun?</p>
                <a href="{{ route('login') }}" class="block w-full text-center border-2 border-brand text-brand hover:bg-brand-light font-bold py-3 px-6 rounded-md transition uppercase text-xs tracking-widest">
                    Masuk ke Akun
                </a>
            </div>
        </div>
    </main>

    <footer class="py-6 text-center text-xs text-gray-400 border-t border-gray-200 bg-white mt-auto">
        &copy; 2026 Setaman Bogor. Cultivating calm in every corner.
    </footer>

</body>
</html>
