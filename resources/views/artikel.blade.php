<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukasi & Artikel | Setaman Bogor</title>
    <link class="favicon" rel="icon" type="image/png" href="{{ asset('img/logosetaman.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Tailwind CSS CDN -->
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800">

    <x-navbar />

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
                <form action="{{ route('artikel.index') }}" method="GET">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel atau topik tanaman..." class="w-full border border-gray-300 rounded-md py-3 pl-12 pr-4 focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition">
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content: Article Grid -->
    <main class="container mx-auto px-6 pb-16 flex-grow">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            
            @forelse($articles as $article)
            <article class="bg-white border border-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col group">
                <a href="{{ route('artikel.show', $article->slug) }}" class="block h-56 bg-gray-100 overflow-hidden relative">
                    <img src="{{ Str::startsWith($article->image_url, 'http') ? $article->image_url : asset('storage/' . $article->image_url) }}" alt="{{ $article->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                </a>
                
                <div class="p-6 flex-grow flex flex-col">
                    <span class="text-[10px] text-brand font-bold uppercase tracking-widest mb-2 block">Kategori {{ $article->category->name ?? 'Umum' }}</span>
                    
                    <a href="{{ route('artikel.show', $article->slug) }}" class="block hover:text-brand transition mb-3">
                        <h2 class="text-xl font-bold text-gray-900 leading-snug">{{ $article->title }}</h2>
                    </a>
                    
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        {{ Str::limit(strip_tags($article->content), 120) }}
                    </p>
                    
                    <a href="{{ route('artikel.show', $article->slug) }}" class="mt-auto inline-block text-xs font-bold text-gray-900 border-b border-gray-900 hover:text-brand hover:border-brand transition pb-0.5 w-max uppercase tracking-wider">
                        Baca Selengkapnya
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                <i class="fas fa-newspaper text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada artikel edukasi.</p>
            </div>
            @endforelse

        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            {{ $articles->links() }}
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
                @if (session('success_subscription'))
                    <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-md mb-4 text-xs font-semibold">
                        {{ session('success_subscription') }}
                    </div>
                @endif
                <form action="{{ route('subscribe') }}" method="POST" class="flex w-full shadow-sm rounded-md overflow-hidden">
                    @csrf
                    <input type="email" name="email" placeholder="Alamat Email" class="flex-grow border border-gray-300 py-3 px-4 focus:outline-none focus:border-brand text-sm" required>
                    <button type="submit" class="bg-brand text-white font-bold py-3 px-6 uppercase tracking-wider text-xs hover:bg-brand-dark transition">
                        Daftar
                    </button>
                </form>
            </div>
        </div>
    </section>

    <x-footer />

</body>
</html>