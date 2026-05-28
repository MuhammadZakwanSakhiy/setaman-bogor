@php
    $inWishlist = false;
    if (auth()->check()) {
        $wishlist = \App\Models\Wishlist::where('user_id', auth()->id())->first();
        if ($wishlist) {
            $inWishlist = \App\Models\WishlistItem::where('wishlist_id', $wishlist->id)
                ->where('product_id', $product->id)
                ->exists();
        }
    }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monstera Deliciosa - Detail Produk | Setaman Bogor</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logosetaman.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Tailwind CSS CDN -->
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar (Sama dengan halaman lain) -->
    <x-navbar />

    <!-- Breadcrumb -->
    <div class="container mx-auto px-6 py-4 text-sm text-gray-500">
        <a href="{{ route('katalog') }}" class="hover:text-brand">Katalog</a> <span class="mx-2">/</span>
        <a href="{{ route('katalog', ['category' => $product->category->slug ?? $product->category->name]) }}" class="hover:text-brand">{{ $product->category->name }}</a> <span class="mx-2">/</span>
        <span class="text-gray-800 font-medium">{{ $product->name }}</span>
    </div>

    <!-- Product Detail Section -->
    <main class="container mx-auto px-6 py-8">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-12">
            
            <!-- Left Column: Images Slider -->
            @php
                $productImages = $product->images()->orderBy('sort_order')->get();
                if ($productImages->isEmpty() && $product->image_url) {
                    $productImages = collect([new \App\Models\ProductImage(['image_url' => $product->image_url])]);
                }
            @endphp
            <div class="flex flex-col gap-4">
                <!-- Main Slider Container -->
                <div class="relative w-full h-100 md:h-125 bg-gray-100 rounded-xl overflow-hidden group">
                    <div id="product-slider" class="w-full h-full flex transition-transform duration-500 ease-in-out">
                        @foreach($productImages as $index => $img)
                            <div class="w-full h-full shrink-0">
                                <img src="{{ Str::startsWith($img->image_url, 'http') ? $img->image_url : asset('storage/' . $img->image_url) }}" alt="{{ $product->name }} - Foto {{ $index + 1 }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                    
                    @if($productImages->count() > 1)
                        <!-- Navigation Arrows -->
                        <button onclick="prevSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 w-10 h-10 rounded-full flex items-center justify-center shadow-md transition duration-300 opacity-0 group-hover:opacity-100">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 w-10 h-10 rounded-full flex items-center justify-center shadow-md transition duration-300 opacity-0 group-hover:opacity-100">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    @endif
                </div>

                @if($productImages->count() > 1)
                    <!-- Thumbnails -->
                    <div class="flex gap-3 overflow-x-auto py-2">
                        @foreach($productImages as $index => $img)
                            <button onclick="goToSlide({{ $index }})" class="thumbnail-btn w-20 h-20 rounded-md overflow-hidden border-2 border-transparent transition duration-300 shrink-0 {{ $index === 0 ? 'border-brand' : '' }}">
                                <img src="{{ Str::startsWith($img->image_url, 'http') ? $img->image_url : asset('storage/' . $img->image_url) }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right Column: Product Info -->
            <div class="flex flex-col">
                <div class="mb-4">
                    <span class="inline-block border border-gray-800 text-gray-800 text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-sm mb-4">{{ $product->category->name }}</span>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                    <p class="text-2xl font-bold text-brand-dark mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    
                    <div class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                        <div class="w-2.5 h-2.5 rounded-full {{ $product->stock > 0 ? ($product->stock < 5 ? 'bg-orange-500' : 'bg-green-500') : 'bg-red-500' }}"></div>
                        @if($product->stock == 0)
                            Stok Habis
                        @elseif($product->stock < 5)
                            Stok Terbatas (Tersisa {{ $product->stock }})
                        @else
                            Tersedia ({{ $product->stock }} Unit)
                        @endif
                    </div>
                </div>

                <hr class="border-gray-200 my-6">

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3">Deskripsi</h3>
                    <p class="text-gray-600 leading-relaxed text-sm whitespace-pre-line">{{ $product->description }}</p>
                </div>

                <!-- Care Tips Box -->
                @if($product->care_tips)
                <div class="bg-brand-light p-5 rounded-xl border border-green-100 mb-8">
                    <h3 class="text-xs font-bold text-brand-dark uppercase tracking-wider mb-4 border-b border-green-200 pb-2">Tips Perawatan</h3>
                    <ul class="space-y-3 text-sm text-gray-700">
                        @foreach(explode("\n", $product->care_tips) as $tip)
                            @if(trim($tip))
                            <li class="flex items-start gap-3">
                                <div class="w-6 text-center mt-0.5"><i class="fas fa-check text-brand"></i></div>
                                <span>{{ $tip }}</span>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="mt-auto">
                    <form action="{{ url('/cart/add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex flex-col sm:flex-row gap-4 mb-4">
                            @if($product->stock > 0)
                                <button type="submit" name="action" value="cart" class="flex-1 border-2 border-brand text-brand hover:bg-brand-light font-bold py-3 px-6 rounded-md transition uppercase text-sm tracking-wider">
                                    Tambah ke Keranjang
                                </button>
                                <button type="submit" name="action" value="checkout" class="flex-1 bg-brand text-white hover:bg-brand-dark font-bold py-3 px-6 rounded-md transition uppercase text-sm tracking-wider shadow-md">
                                    Beli Sekarang
                                </button>
                            @else
                                <button type="button" disabled class="w-full bg-gray-300 text-gray-500 cursor-not-allowed font-bold py-3 px-6 rounded-md uppercase text-sm tracking-wider">
                                    Stok Habis
                                </button>
                            @endif
                        </div>
                    </form>
                    
                    <div id="wishlist-container">
                        @if(auth()->check())
                            <button id="btn-wishlist" data-product-id="{{ $product->id }}" class="w-full flex items-center justify-center gap-2 text-gray-500 hover:text-red-500 font-medium text-sm transition py-2 focus:outline-none">
                                @if($inWishlist)
                                    <i class="fas fa-heart text-red-500"></i> Hapus dari Wishlist
                                @else
                                    <i class="far fa-heart"></i> Simpan ke Wishlist
                                @endif
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 text-gray-500 hover:text-red-500 font-medium text-sm transition py-2">
                                <i class="far fa-heart"></i> Simpan ke Wishlist
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Horizontal Divider -->
    <div class="container mx-auto px-6">
        <hr class="border-gray-200 border-2 my-8 rounded-full">
    </div>

    <!-- Related Products Section -->
    @if($relatedProducts->count() > 0)
    <section class="container mx-auto px-6 py-8 mb-12">
        <div class="flex justify-between items-end mb-8">
            <h2 class="text-2xl font-bold text-gray-900 uppercase tracking-wide">Katalog Serupa</h2>
            <a href="{{ route('katalog', ['category' => $product->category->slug ?? $product->category->name]) }}" class="text-sm font-bold text-gray-900 border-b border-gray-900 hover:text-brand hover:border-brand transition pb-1 uppercase tracking-wider">Lihat Semua</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
            <!-- Card -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col">
                <div class="h-48 bg-gray-100 relative group cursor-pointer block">
                    <a href="{{ route('katalog.show', $related->slug) }}">
                        <img src="{{ Str::startsWith($related->image_url, 'http') ? $related->image_url : asset('storage/' . $related->image_url) }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </a>
                </div>
                <div class="p-5 flex flex-col grow">
                    <span class="text-[10px] text-gray-500 uppercase tracking-widest mb-1 font-semibold">{{ $related->category->name }}</span>
                    <a href="{{ route('katalog.show', $related->slug) }}" class="hover:text-brand transition block">
                         <h3 class="font-bold text-gray-900 text-lg mb-1">{{ $related->name }}</h3>
                    </a>
                    <p class="text-brand-dark font-bold mb-4">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                    
                    <form action="{{ url('/cart/add') }}" method="POST" class="mt-auto w-full">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $related->id }}">
                        <button type="submit" class="w-full border border-gray-300 text-gray-700 font-bold py-2 text-xs uppercase tracking-wider hover:border-brand hover:text-brand transition rounded-sm">Tambah</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <x-footer />

    <script>
        let currentSlide = 0;
        const totalSlides = {{ isset($productImages) ? $productImages->count() : 1 }};
        const slider = document.getElementById('product-slider');
        const thumbnails = document.querySelectorAll('.thumbnail-btn');

        function updateSlider() {
            if (slider) {
                slider.style.transform = `translateX(-${currentSlide * 100}%)`;
            }
            thumbnails.forEach((btn, index) => {
                if (index === currentSlide) {
                    btn.classList.add('border-brand');
                } else {
                    btn.classList.remove('border-brand');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateSlider();
        }

        function goToSlide(slideIndex) {
            currentSlide = slideIndex;
            updateSlider();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const btnWishlist = document.getElementById('btn-wishlist');
            if (btnWishlist) {
                btnWishlist.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productId = btnWishlist.getAttribute('data-product-id');
                    
                    fetch("{{ route('wishlist.toggle') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'added') {
                            btnWishlist.innerHTML = '<i class="fas fa-heart text-red-500"></i> Hapus dari Wishlist';
                        } else if (data.status === 'removed') {
                            btnWishlist.innerHTML = '<i class="far fa-heart"></i> Simpan ke Wishlist';
                        }
                    })
                    .catch(error => {
                        console.error('Error toggling wishlist:', error);
                    });
                });
            }
        });
    </script>
</body>
</html>