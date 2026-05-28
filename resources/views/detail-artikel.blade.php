<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} | Setaman Bogor</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logosetaman.png') }}">
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

    <!-- Breadcrumb -->
    <div class="container mx-auto px-6 py-6 text-sm text-gray-500">
        <a href="{{ url('/artikel') }}" class="hover:text-brand">Edukasi</a> <span class="mx-2">/</span>
        <a href="{{ url('/artikel') }}?category={{ $article->category->name ?? 'umum' }}" class="hover:text-brand">{{ $article->category->name ?? 'Umum' }}</a> <span class="mx-2">/</span>
        <span class="text-gray-800 font-medium">{{ $article->title }}</span>
    </div>

    <!-- Article Content -->
    <main class="container mx-auto px-6 pb-16">
        
        <!-- Hero Image -->
        <div class="w-full max-w-5xl mx-auto h-75 md:h-125 bg-gray-100 rounded-2xl overflow-hidden mb-12">
            <img src="{{ Str::startsWith($article->image_url, 'http') ? $article->image_url : asset('storage/' . $article->image_url) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
        </div>

        <!-- Article Body -->
        <article class="max-w-3xl mx-auto">
            
            <!-- Header Artikel -->
            <header class="mb-10 text-center md:text-left">
                <span class="text-xs font-bold text-brand uppercase tracking-widest mb-3 block">Edukasi & {{ $article->category->name ?? 'Botani' }}</span>
                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">{{ $article->title }}</h1>
                <div class="text-xs text-gray-400 uppercase tracking-widest font-semibold flex flex-wrap justify-center md:justify-start gap-2">
                    <span>Diunggah: {{ $article->created_at->translatedFormat('d F Y') }}</span>
                    <span>&bull;</span>
                    <span>Oleh: {{ $article->author->name ?? 'Tim Setaman Bogor' }}</span>
                </div>
            </header>

            <!-- Teks Artikel -->
            <div class="prose prose-lg text-gray-700 leading-relaxed space-y-6">
                {!! $article->content !!}
            </div>
            
        </article>
    </main>

    <!-- Related Products Section (Produk Terkait) -->
    <section class="bg-gray-50 py-16 border-t border-gray-200">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-end mb-8">
                <h2 class="text-2xl font-bold text-gray-900 uppercase tracking-wide">Produk Terkait</h2>
                <a href="{{ url('/katalog') }}" class="text-xs font-bold text-gray-900 border-b border-gray-900 hover:text-brand hover:border-brand transition pb-1 uppercase tracking-wider">Lihat Semua Katalog</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                
                <!-- Card 1 -->
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col">
                    <div class="h-48 bg-gray-100">
                        <img src="https://images.unsplash.com/photo-1614594805320-e6a3ee51e227?auto=format&fit=crop&w=400&q=80" alt="Monstera Adansonii" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5 flex flex-col grow">
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold">Outdoor</span>
                        <h3 class="font-bold text-gray-900 text-base mb-4">Monstera Adansonii</h3>
                        <a href="{{ url('/detail-produk') }}" class="mt-auto block text-center bg-black text-white font-bold py-2 text-xs uppercase tracking-wider hover:bg-brand transition rounded-sm">Detail Produk</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col">
                    <div class="h-48 bg-gray-100">
                        <img src="https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&w=400&q=80" alt="Alocasia Reversa" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5 flex flex-col grow">
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold">Indoor</span>
                        <h3 class="font-bold text-gray-900 text-base mb-4">Alocasia Reversa</h3>
                        <a href="{{ url('/detail-produk') }}" class="mt-auto block text-center bg-black text-white font-bold py-2 text-xs uppercase tracking-wider hover:bg-brand transition rounded-sm">Detail Produk</a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col">
                    <div class="h-48 bg-gray-100">
                        <img src="https://images.unsplash.com/photo-1603436326446-7dc41f021c7a?auto=format&fit=crop&w=400&q=80" alt="Ficus Lyrata" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5 flex flex-col grow">
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold">Trees</span>
                        <h3 class="font-bold text-gray-900 text-base mb-4">Ficus Lyrata</h3>
                        <a href="{{ url('/detail-produk') }}" class="mt-auto block text-center bg-black text-white font-bold py-2 text-xs uppercase tracking-wider hover:bg-brand transition rounded-sm">Detail Produk</a>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col">
                    <div class="h-48 bg-gray-100">
                        <img src="https://images.unsplash.com/photo-1600412353723-f2ee4e90cb5d?auto=format&fit=crop&w=400&q=80" alt="Mentha Spicata" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5 flex flex-col grow">
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold">Herbs</span>
                        <h3 class="font-bold text-gray-900 text-base mb-4">Mentha Spicata</h3>
                        <a href="{{ url('/detail-produk') }}" class="mt-auto block text-center bg-black text-white font-bold py-2 text-xs uppercase tracking-wider hover:bg-brand transition rounded-sm">Detail Produk</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <x-footer />

</body>
</html>