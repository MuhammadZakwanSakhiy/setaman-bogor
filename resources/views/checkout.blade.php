<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Setaman Bogor</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logosetaman.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <x-navbar />

    <main class="container mx-auto px-6 py-12 grow">
        <div class="mb-10">
            <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Pemesanan</div>
            <h1 class="mt-3 text-3xl font-bold text-brand-dark">Checkout</h1>
            <p class="mt-2 text-gray-500">Lengkapi data pengiriman dan pilih metode pembayaran otomatis melalui Midtrans.</p>
        </div>

        <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
            <!-- Form Checkout -->
            <form id="checkoutForm" action="{{ route('checkout.store') }}" method="POST" class="rounded-3xl border border-gray-100 bg-white p-6 md:p-8 shadow-sm">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-50 text-red-500 p-4 rounded-2xl text-sm mb-6 border border-red-100">
                        <ul class="list-disc pl-5 font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-8">
                    <!-- Informasi Penerima -->
                    <div>
                        <h3 class="text-sm font-bold uppercase tracking-wider text-brand mb-4 flex items-center gap-2">
                            <i class="fas fa-address-card"></i> Informasi Penerima
                        </h3>
                        <div class="grid gap-5 md:grid-cols-2">
                            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                                Nama Lengkap Penerima
                                <input type="text" name="customer_name" required value="{{ old('customer_name', auth()->user()->name ?? '') }}" placeholder="Contoh: Muhammad Zakwan" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand focus:ring-1 focus:ring-brand">
                            </label>
                            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                                Nomor WhatsApp (Aktif)
                                <input type="tel" name="customer_phone" required value="{{ old('customer_phone', auth()->user()->phone ?? '') }}" placeholder="Contoh: 08123456789" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand focus:ring-1 focus:ring-brand">
                            </label>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    <!-- Detail Alamat Pengiriman -->
                    <div>
                        <h3 class="text-sm font-bold uppercase tracking-wider text-brand mb-4 flex items-center gap-2">
                            <i class="fas fa-map-marker-alt"></i> Alamat Pengiriman
                        </h3>
                        <div class="grid gap-5">
                            
                            <!-- Provinsi & Kota (Half Width Row) -->
                            <div class="grid gap-5 md:grid-cols-2">
                                <!-- Provinsi Searchable Dropdown -->
                                <div class="grid gap-2 text-sm font-semibold text-brand-dark relative">
                                    <label for="province_search">Provinsi</label>
                                    <div class="relative">
                                        <input type="text" id="province_search" placeholder="Ketik untuk mencari provinsi..." required autocomplete="off" value="{{ old('province', auth()->user()->profile?->province ?? '') }}" class="w-full rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand focus:ring-1 focus:ring-brand">
                                        <input type="hidden" name="province" id="province_value" value="{{ old('province', auth()->user()->profile?->province ?? '') }}">
                                        <div id="province_dropdown" class="absolute left-0 right-0 mt-1 max-h-60 overflow-y-auto bg-white border border-gray-200 rounded-2xl shadow-lg z-50 hidden divide-y divide-gray-50">
                                            <!-- Item diisi oleh JS -->
                                        </div>
                                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                            <i class="fas fa-chevron-down text-xs"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kota / Kabupaten -->
                                <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                                    Kota / Kabupaten
                                    <input type="text" name="city" required value="{{ old('city', auth()->user()->profile?->city ?? '') }}" placeholder="Contoh: Kota Bogor" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand focus:ring-1 focus:ring-brand">
                                </label>
                            </div>

                            <!-- Kecamatan, Kelurahan/Desa, Kode Pos (3-Column Row) -->
                            <div class="grid gap-5 md:grid-cols-3">
                                <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                                    Kecamatan
                                    <input type="text" name="subdistrict" required value="{{ old('subdistrict', auth()->user()->profile?->subdistrict ?? '') }}" placeholder="Contoh: Dramaga" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand focus:ring-1 focus:ring-brand">
                                </label>
                                <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                                    Kelurahan / Desa
                                    <input type="text" name="village" required value="{{ old('village', auth()->user()->profile?->village ?? '') }}" placeholder="Contoh: Sindangbarang" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand focus:ring-1 focus:ring-brand">
                                </label>
                                <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                                    Kode Pos
                                    <input type="text" name="postal_code" required value="{{ old('postal_code', auth()->user()->profile?->postal_code ?? '') }}" placeholder="Contoh: 16680" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand focus:ring-1 focus:ring-brand">
                                </label>
                            </div>

                            <!-- Jalan & No. Rumah -->
                            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                                Detail Nama Jalan, No. Rumah, RT/RW, Dusun
                                <textarea name="street" rows="3" required placeholder="Contoh: Jl. Raya Dramaga No. 12, RT 02/RW 03" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand focus:ring-1 focus:ring-brand">{{ old('street', auth()->user()->profile?->address ?? '') }}</textarea>
                            </label>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    <!-- Metode Pembayaran Midtrans -->
                    <div>
                        <h3 class="text-sm font-bold uppercase tracking-wider text-brand mb-4 flex items-center gap-2">
                            <i class="fas fa-credit-card"></i> Metode Pembayaran (Midtrans Otomatis)
                        </h3>
                        <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3">
                            <!-- QRIS -->
                            <label class="relative flex items-center p-4 border border-green-100 rounded-2xl cursor-pointer hover:border-brand transition shadow-sm bg-white select-none">
                                <input type="radio" name="payment_method" value="QRIS" checked class="w-4 h-4 text-brand border-gray-300 focus:ring-brand focus:ring-offset-0">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-brand-dark">QRIS</span>
                                    <span class="block text-[10px] text-gray-400">Scan QR via Gopay, OVO, dll.</span>
                                </div>
                            </label>

                            <!-- GoPay -->
                            <label class="relative flex items-center p-4 border border-green-100 rounded-2xl cursor-pointer hover:border-brand transition shadow-sm bg-white select-none">
                                <input type="radio" name="payment_method" value="GoPay" class="w-4 h-4 text-brand border-gray-300 focus:ring-brand focus:ring-offset-0">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-brand-dark">GoPay</span>
                                    <span class="block text-[10px] text-gray-400">Saldo GoPay & PayLater</span>
                                </div>
                            </label>

                            <!-- Bank Mandiri -->
                            <label class="relative flex items-center p-4 border border-green-100 rounded-2xl cursor-pointer hover:border-brand transition shadow-sm bg-white select-none">
                                <input type="radio" name="payment_method" value="Bank Mandiri" class="w-4 h-4 text-brand border-gray-300 focus:ring-brand focus:ring-offset-0">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-brand-dark">Bank Mandiri</span>
                                    <span class="block text-[10px] text-gray-400">Mandiri Virtual Account</span>
                                </div>
                            </label>

                            <!-- BNI -->
                            <label class="relative flex items-center p-4 border border-green-100 rounded-2xl cursor-pointer hover:border-brand transition shadow-sm bg-white select-none">
                                <input type="radio" name="payment_method" value="BNI" class="w-4 h-4 text-brand border-gray-300 focus:ring-brand focus:ring-offset-0">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-brand-dark">BNI</span>
                                    <span class="block text-[10px] text-gray-400">BNI Virtual Account</span>
                                </div>
                            </label>

                            <!-- BRI -->
                            <label class="relative flex items-center p-4 border border-green-100 rounded-2xl cursor-pointer hover:border-brand transition shadow-sm bg-white select-none">
                                <input type="radio" name="payment_method" value="BRI" class="w-4 h-4 text-brand border-gray-300 focus:ring-brand focus:ring-offset-0">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-brand-dark">BRI</span>
                                    <span class="block text-[10px] text-gray-400">BRI Virtual Account (BRIVA)</span>
                                </div>
                            </label>

                            <!-- BSI -->
                            <label class="relative flex items-center p-4 border border-green-100 rounded-2xl cursor-pointer hover:border-brand transition shadow-sm bg-white select-none">
                                <input type="radio" name="payment_method" value="BSI" class="w-4 h-4 text-brand border-gray-300 focus:ring-brand focus:ring-offset-0">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-brand-dark">BSI</span>
                                    <span class="block text-[10px] text-gray-400">BSI Virtual Account</span>
                                </div>
                            </label>

                            <!-- Permata Bank -->
                            <label class="relative flex items-center p-4 border border-green-100 rounded-2xl cursor-pointer hover:border-brand transition shadow-sm bg-white select-none">
                                <input type="radio" name="payment_method" value="Permata Bank" class="w-4 h-4 text-brand border-gray-300 focus:ring-brand focus:ring-offset-0">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-brand-dark">Permata Bank</span>
                                    <span class="block text-[10px] text-gray-400">Permata Virtual Account</span>
                                </div>
                            </label>

                            <!-- CIMB Niaga -->
                            <label class="relative flex items-center p-4 border border-green-100 rounded-2xl cursor-pointer hover:border-brand transition shadow-sm bg-white select-none">
                                <input type="radio" name="payment_method" value="CIMB Niaga" class="w-4 h-4 text-brand border-gray-300 focus:ring-brand focus:ring-offset-0">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-brand-dark">CIMB Niaga</span>
                                    <span class="block text-[10px] text-gray-400">CIMB Virtual Account</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    <!-- Catatan Tambahan -->
                    <div>
                        <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                            Catatan Pesanan (Opsional)
                            <input type="text" name="note" value="{{ old('note') }}" placeholder="Contoh: Mohon dikirim sore hari, bungkus pot plastik" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand focus:ring-1 focus:ring-brand">
                        </label>
                    </div>
                </div>
            </form>

            <!-- Sidebar Ringkasan Pesanan -->
            <aside class="h-fit rounded-3xl border border-gray-100 bg-white p-6 shadow-sm sticky top-6">
                <h2 class="text-xl font-bold text-brand-dark">Ringkasan Pesanan</h2>
                <div class="mt-5 space-y-4">
                    @php $subtotal = 0; @endphp
                    @foreach($cart->items as $item)
                        @php $subtotal += $item->product->price * $item->quantity; @endphp
                        <div class="flex justify-between gap-4 text-sm border-b border-gray-50 pb-3">
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-800">{{ $item->product->name }}</span>
                                <span class="text-xs text-gray-400">Qty: {{ $item->quantity }}</span>
                            </div>
                            <span class="font-bold text-brand-dark text-right">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                    @endforeach

                    <div class="pt-2 space-y-3">
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>Subtotal</span>
                            <span class="font-semibold text-brand-dark">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>Ongkos Kirim</span>
                            <span class="font-semibold text-brand-dark">Free Shipping</span>
                        </div>
                        <div class="border-t border-green-100 pt-4 flex justify-between text-lg font-bold text-brand-dark">
                            <span>Total</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <button form="checkoutForm" type="submit" class="w-full mt-6 block rounded-xl bg-brand px-6 py-4 text-center font-bold text-white hover:bg-brand-dark uppercase tracking-widest text-sm transition shadow-md hover:shadow-lg">
                    BELI
                </button>
            </aside>
        </div>
    </main>

    <x-footer />

    <!-- Script Searchable Dropdown Provinsi -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const provinces = [
                "Aceh", "Sumatera Utara", "Sumatera Barat", "Riau", "Kepulauan Riau", 
                "Jambi", "Sumatera Selatan", "Kepulauan Bangka Belitung", "Bengkulu", "Lampung", 
                "DKI Jakarta", "Jawa Barat", "Banten", "Jawa Tengah", "DI Yogyakarta", 
                "Jawa Timur", "Bali", "Nusa Tenggara Barat", "Nusa Tenggara Timur", "Kalimantan Barat", 
                "Kalimantan Tengah", "Kalimantan Selatan", "Kalimantan Timur", "Kalimantan Utara", 
                "Sulawesi Utara", "Gorontalo", "Sulawesi Tengah", "Sulawesi Barat", "Sulawesi Selatan", 
                "Sulawesi Tenggara", "Maluku", "Maluku Utara", "Papua Barat", "Papua", 
                "Papua Tengah", "Papua Pegunungan", "Papua Selatan", "Papua Barat Daya"
            ];

            const provinceSearch = document.getElementById('province_search');
            const provinceValue = document.getElementById('province_value');
            const provinceDropdown = document.getElementById('province_dropdown');

            function renderDropdown(filterText = '') {
                const filtered = provinces.filter(p => p.toLowerCase().includes(filterText.toLowerCase()));
                provinceDropdown.innerHTML = '';
                
                if (filtered.length === 0) {
                    provinceDropdown.innerHTML = '<div class="px-4 py-3 text-sm text-gray-500">Provinsi tidak ditemukan</div>';
                } else {
                    filtered.forEach(p => {
                        const item = document.createElement('div');
                        item.className = 'px-4 py-3 text-sm text-gray-700 hover:bg-green-50 hover:text-brand cursor-pointer transition';
                        item.textContent = p;
                        item.addEventListener('click', function() {
                            provinceSearch.value = p;
                            provinceValue.value = p;
                            provinceDropdown.classList.add('hidden');
                        });
                        provinceDropdown.appendChild(item);
                    });
                }
            }

            provinceSearch.addEventListener('focus', function() {
                provinceDropdown.classList.remove('hidden');
                renderDropdown(provinceSearch.value);
            });

            provinceSearch.addEventListener('input', function() {
                provinceDropdown.classList.remove('hidden');
                renderDropdown(provinceSearch.value);
            });

            // Close dropdown if clicked outside
            document.addEventListener('click', function(e) {
                if (!provinceSearch.contains(e.target) && !provinceDropdown.contains(e.target)) {
                    provinceDropdown.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
