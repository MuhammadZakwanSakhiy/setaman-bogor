<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan | Setaman Bogor</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logosetaman.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 h-screen flex flex-col">

    <x-navbar />

    <main class="flex-grow flex items-center justify-center container mx-auto px-6 py-12 text-center">
        <div>
            <div class="text-[100px] md:text-[150px] font-bold text-brand leading-none">404</div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 mt-4">Halaman Tidak Ditemukan</h1>
            <p class="text-gray-500 mb-8 max-w-md mx-auto">Maaf, halaman yang Anda cari mungkin telah dihapus, diubah namanya, atau tidak tersedia sementara.</p>
            <a href="{{ url('/') }}" class="inline-block bg-brand hover:bg-brand-dark text-white font-bold py-3 px-8 rounded-md transition uppercase text-sm tracking-wider">
                Kembali ke Beranda
            </a>
        </div>
    </main>

    <footer class="bg-brand-light py-6 border-t border-green-100 mt-auto text-center">
        <p class="text-xs text-gray-500">&copy; {{ date('Y') }} Setaman Bogor.</p>
    </footer>
</body>
</html>
