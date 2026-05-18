<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Setaman Bogor</title>
    <!-- Tailwind CSS CDN -->
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    <x-navbar />

    <main class="container mx-auto px-6 py-12">
        <div class="mb-10">
            <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Pemesanan</div>
            <h1 class="mt-3 text-3xl font-bold text-brand-dark">Checkout</h1>
            <p class="mt-2 text-gray-500">Isi data pembeli, lalu kirim pesanan ke WhatsApp admin.</p>
        </div>

        <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
            <form id="checkoutForm" action="{{ route('checkout.store') }}" method="POST" class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
                @csrf
                <div class="grid gap-5 md:grid-cols-2">
                    <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                        Nama Pembeli
                        <input type="text" name="customer_name" required value="{{ auth()->user()->name ?? '' }}" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand">
                    </label>
                    <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                        Nomor WhatsApp
                        <input type="tel" name="customer_phone" required class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand">
                    </label>
                    <label class="grid gap-2 text-sm font-semibold text-brand-dark md:col-span-2">
                        Alamat Pengiriman
                        <textarea name="customer_address" rows="4" required class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand"></textarea>
                    </label>
                    <label class="grid gap-2 text-sm font-semibold text-brand-dark md:col-span-2">
                        Catatan Pesanan (Opsional)
                        <input type="text" name="note" placeholder="Contoh: dikirim sore hari" class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-600 outline-none focus:border-brand">
                    </label>
                </div>
            </form>

            <aside class="h-fit rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-bold text-brand-dark">Ringkasan Pesanan</h2>
                <div class="mt-5 space-y-4">
                    @php $subtotal = 0; @endphp
                    @foreach($cart->items as $item)
                        @php $subtotal += $item->product->price * $item->quantity; @endphp
                        <div class="flex justify-between gap-4 text-sm">
                            <span class="text-gray-500">{{ $item->product->name }} x{{ $item->quantity }}</span>
                            <span class="font-semibold text-brand-dark">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                    <div class="border-t border-green-100 pt-4 flex justify-between text-sm text-gray-500"><span>Subtotal</span><span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                    <div class="flex justify-between text-sm text-gray-500"><span>Ongkir</span><span>(Dihitung manual via WA)</span></div>
                    <div class="border-t border-green-100 pt-4 flex justify-between text-lg font-bold text-brand-dark"><span>Total Sementara</span><span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                </div>
                <button form="checkoutForm" type="submit" class="w-full mt-6 block rounded-md bg-brand px-6 py-4 text-center font-bold text-white hover:bg-brand-dark uppercase tracking-widest text-sm">
                    Kirim ke WhatsApp
                </button>
            </aside>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-brand-light pt-16 pb-8 border-t border-green-100 mt-12">
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
        <div class="container mx-auto px-6 pt-8 border-t border-green-200 text-xs text-gray-400">
            &copy; 2026 Setaman Bogor
        </div>
    </footer>

</body>
</html>
