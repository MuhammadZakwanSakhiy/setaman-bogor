<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk | Setaman Bogor</title>
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

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        
        <!-- Search & Filter Bar -->
        <div class="mb-8">
            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2 font-semibold">Cari Produk</p>
            <form id="search-form" action="{{ route('katalog') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <!-- Search Input -->
                <div class="relative w-full md:w-1/2">
                    <input type="text" id="search-input" name="search" value="{{ request('search') }}" placeholder="Cari tanaman favorit Anda..." class="w-full border border-gray-300 rounded-sm py-2 px-4 focus:outline-none focus:border-brand text-sm">
                    <button type="submit" class="absolute right-4 top-2 text-gray-400 text-sm hover:text-brand"><i class="fas fa-search"></i></button>
                </div>
                <!-- Filter Buttons -->
                <div id="category-filters" class="flex flex-wrap gap-2 text-xs font-semibold uppercase tracking-wider w-full md:w-auto">
                    <a href="{{ route('katalog') }}" data-category="" class="category-btn {{ !request('category') ? 'bg-brand text-white border-brand' : 'bg-white text-gray-700 border-gray-300 hover:border-brand hover:text-brand' }} px-4 py-2 border transition rounded-sm">Semua</a>
                    @foreach($categories as $cat)
                        @php
                            $catSlug = \Illuminate\Support\Str::slug($cat->name);
                            $isActive = request('category') == $catSlug || request('category') == $cat->name;
                        @endphp
                        <a href="{{ route('katalog', ['category' => $catSlug]) }}" data-category="{{ $catSlug }}" class="category-btn {{ $isActive ? 'bg-brand text-white border-brand' : 'bg-white text-gray-700 border-gray-300 hover:border-brand hover:text-brand' }} px-4 py-2 border transition rounded-sm">
                            {{ str_replace('Tanaman ', '', $cat->name) }}
                        </a>
                    @endforeach
                </div>
            </form>
        </div>

        <!-- Product Grid -->
        <div id="product-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @forelse($products as $product)
            <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md transition rounded-xl flex flex-col overflow-hidden relative">
                <!-- Wishlist Button -->
                @auth
                    @php
                        $inWishlist = in_array($product->id, $wishlistProductIds);
                    @endphp
                    <button type="button" onclick="toggleWishlist({{ $product->id }}, this)" class="absolute top-4 right-4 bg-white hover:bg-red-50 text-gray-400 hover:text-red-500 w-8 h-8 rounded-full shadow-md flex items-center justify-center transition focus:outline-none z-10">
                        <i class="{{ $inWishlist ? 'fas fa-heart text-red-500' : 'far fa-heart' }}"></i>
                    </button>
                @else
                    <a href="{{ route('login') }}" class="absolute top-4 right-4 bg-white hover:bg-red-50 text-gray-400 hover:text-red-500 w-8 h-8 rounded-full shadow-md flex items-center justify-center transition z-10">
                        <i class="far fa-heart"></i>
                    </a>
                @endauth

                <a href="{{ route('katalog.show', $product->slug) }}" class="h-64 bg-gray-100 flex items-center justify-center relative group cursor-pointer">
                    <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                    @if($product->stock == 0)
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                            <span class="bg-red-600 text-white font-bold px-4 py-2 rounded-sm text-sm uppercase tracking-wider">Habis</span>
                        </div>
                    @elseif($product->stock < 5)
                        <div class="absolute top-4 left-4 bg-orange-500 text-white font-bold px-3 py-1 text-xs uppercase tracking-wider rounded-sm shadow-sm">
                            Stok Terbatas
                        </div>
                    @endif
                </a>
                
                <div class="p-6 grow flex flex-col justify-between">
                    <div>
                        <p class="text-xs text-brand uppercase tracking-wider mb-1 font-semibold">{{ $product->category->name }}</p>
                        
                        <a href="{{ route('katalog.show', $product->slug) }}" class="block hover:text-brand transition">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                        </a>
                        
                        <p class="text-sm text-gray-500 mb-6">{{ Str::limit($product->description, 70) }}</p>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xl font-bold text-brand-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        
                        <!-- Form Tambah ke Keranjang -->
                        <form action="{{ url('/cart/add') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            @if($product->stock > 0)
                                <button type="submit" class="bg-brand text-white text-xs font-semibold uppercase tracking-wider px-6 py-2 hover:bg-brand-dark transition rounded-md">Tambah</button>
                            @else
                                <button type="button" disabled class="bg-gray-300 text-gray-500 text-xs font-semibold uppercase tracking-wider px-6 py-2 rounded-md cursor-not-allowed">Habis</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Produk tidak ditemukan.</p>
                <a href="{{ route('katalog') }}" class="text-brand hover:underline mt-2 inline-block">Reset Pencarian</a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div id="pagination-container">
            @if($products->hasPages())
            <div class="flex justify-center mt-12">
                {{ $products->links() }}
            </div>
            @endif
        </div>

    </main>

    <x-footer />

    <script>
        const allProducts = @json($allProductsJson);
        const isAuthenticated = @json(auth()->check());
        const csrfToken = "{{ csrf_token() }}";
        const loginUrl = "{{ route('login') }}";

        const productGrid = document.getElementById('product-grid');
        const paginationContainer = document.getElementById('pagination-container');
        const searchInput = document.getElementById('search-input');
        const searchForm = document.getElementById('search-form');
        const categoryFilters = document.getElementById('category-filters');

        // Save original server-rendered HTML for search reset
        const originalGridHtml = productGrid.innerHTML;
        const originalPaginationHtml = paginationContainer ? paginationContainer.innerHTML : '';

        let activeCategory = new URLSearchParams(window.location.search).get('category') || '';

        // Prevent standard form submission
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            filterProducts();
        });

        // Search input keyup/input handler
        searchInput.addEventListener('input', function() {
            filterProducts();
        });

        // Category filter buttons click handlers
        categoryFilters.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                activeCategory = this.getAttribute('data-category') || '';
                filterProducts();
            });
        });

        function filterProducts() {
            const searchTerm = searchInput.value.trim().toLowerCase();
            
            // Highlight active category filter button
            categoryFilters.querySelectorAll('.category-btn').forEach(btn => {
                const btnCategory = btn.getAttribute('data-category') || '';
                if (btnCategory === activeCategory) {
                    btn.className = 'category-btn bg-brand text-white border-brand px-4 py-2 border transition rounded-sm';
                } else {
                    btn.className = 'category-btn bg-white text-gray-700 border-gray-300 hover:border-brand hover:text-brand px-4 py-2 border transition rounded-sm';
                }
            });

            // Update URL query parameters
            const urlParams = new URLSearchParams(window.location.search);
            if (searchTerm) {
                urlParams.set('search', searchTerm);
            } else {
                urlParams.delete('search');
            }
            if (activeCategory) {
                urlParams.set('category', activeCategory);
            } else {
                urlParams.delete('category');
            }
            const newUrl = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
            window.history.pushState({ path: newUrl }, '', newUrl);

            // If filters are completely empty, restore original server-rendered HTML (re-enables pagination)
            if (!searchTerm && !activeCategory) {
                productGrid.innerHTML = originalGridHtml;
                if (paginationContainer) {
                    paginationContainer.innerHTML = originalPaginationHtml;
                }
                return;
            }

            // Client-side JSON filter
            const filtered = allProducts.filter(product => {
                const matchesSearch = !searchTerm || 
                    product.name.toLowerCase().includes(searchTerm) || 
                    product.description.toLowerCase().includes(searchTerm);
                
                const matchesCategory = !activeCategory || 
                    product.category_slug === activeCategory;
                
                return matchesSearch && matchesCategory;
            });

            // Hide pagination when active filters exist
            if (paginationContainer) {
                paginationContainer.innerHTML = '';
            }

            // Render matching products
            if (filtered.length === 0) {
                productGrid.innerHTML = `
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                        <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">Produk tidak ditemukan.</p>
                        <button type="button" onclick="resetFilters()" class="text-brand hover:underline mt-2 inline-block focus:outline-none">Reset Pencarian</button>
                    </div>
                `;
                return;
            }

            let cardsHtml = '';
            filtered.forEach(product => {
                let wishlistBtn = '';
                if (isAuthenticated) {
                    wishlistBtn = `
                        <button type="button" onclick="toggleWishlist(${product.id}, this)" class="absolute top-4 right-4 bg-white hover:bg-red-50 text-gray-400 hover:text-red-500 w-8 h-8 rounded-full shadow-md flex items-center justify-center transition focus:outline-none z-10">
                            <i class="${product.in_wishlist ? 'fas fa-heart text-red-500' : 'far fa-heart'}"></i>
                        </button>
                    `;
                } else {
                    wishlistBtn = `
                        <a href="${loginUrl}" class="absolute top-4 right-4 bg-white hover:bg-red-50 text-gray-400 hover:text-red-500 w-8 h-8 rounded-full shadow-md flex items-center justify-center transition z-10">
                            <i class="far fa-heart"></i>
                        </a>
                    `;
                }

                let stockBadge = '';
                if (product.stock === 0) {
                    stockBadge = `
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                            <span class="bg-red-600 text-white font-bold px-4 py-2 rounded-sm text-sm uppercase tracking-wider">Habis</span>
                        </div>
                    `;
                } else if (product.stock < 5) {
                    stockBadge = `
                        <div class="absolute top-4 left-4 bg-orange-500 text-white font-bold px-3 py-1 text-xs uppercase tracking-wider rounded-sm shadow-sm">
                            Stok Terbatas
                        </div>
                    `;
                }

                let actionButton = '';
                if (product.stock > 0) {
                    actionButton = `<button type="submit" class="bg-brand text-white text-xs font-semibold uppercase tracking-wider px-6 py-2 hover:bg-brand-dark transition rounded-md">Tambah</button>`;
                } else {
                    actionButton = `<button type="button" disabled class="bg-gray-300 text-gray-500 text-xs font-semibold uppercase tracking-wider px-6 py-2 rounded-md cursor-not-allowed">Habis</button>`;
                }

                cardsHtml += `
                    <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md transition rounded-xl flex flex-col overflow-hidden relative animate-fade-in">
                        ${wishlistBtn}
                        <a href="${product.detail_url}" class="h-64 bg-gray-100 flex items-center justify-center relative group cursor-pointer">
                            <img src="${product.image_url}" alt="${product.name}" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                            ${stockBadge}
                        </a>
                        <div class="p-6 grow flex flex-col justify-between">
                            <div>
                                <p class="text-xs text-brand uppercase tracking-wider mb-1 font-semibold">${product.category_name}</p>
                                <a href="${product.detail_url}" class="block hover:text-brand transition">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">${product.name}</h3>
                                </a>
                                <p class="text-sm text-gray-500 mb-6">${product.description}</p>
                            </div>
                            <div class="flex items-center justify-between mt-auto">
                                <span class="text-xl font-bold text-brand-dark">${product.formatted_price}</span>
                                <form action="/cart/add" method="POST" class="inline">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="product_id" value="${product.id}">
                                    ${actionButton}
                                </form>
                            </div>
                        </div>
                    </div>
                `;
            });
            productGrid.innerHTML = cardsHtml;
        }

        function resetFilters() {
            searchInput.value = '';
            activeCategory = '';
            filterProducts();
        }

        function toggleWishlist(productId, btn) {
            fetch("{{ route('wishlist.toggle') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                const icon = btn.querySelector('i');
                if (data.status === 'added') {
                    icon.className = 'fas fa-heart text-red-500';
                    // Update internal state
                    const prod = allProducts.find(p => p.id === productId);
                    if (prod) prod.in_wishlist = true;
                } else if (data.status === 'removed') {
                    icon.className = 'far fa-heart';
                    // Update internal state
                    const prod = allProducts.find(p => p.id === productId);
                    if (prod) prod.in_wishlist = false;
                }
            })
            .catch(error => console.error("Error updating wishlist:", error));
        }
    </script>
</body>
</html>