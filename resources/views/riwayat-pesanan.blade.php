<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan | Setaman Bogor</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logosetaman.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Tailwind CSS CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <x-navbar />

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12 grow">
        
        <div class="mb-8 flex justify-between items-end border-b-4 border-gray-900 pb-2">
            <h1 class="text-3xl font-bold text-gray-900 uppercase tracking-wide">
                Riwayat Pesanan
            </h1>
            <a href="{{ route('profile.index') }}" class="text-sm font-bold text-gray-500 hover:text-brand uppercase tracking-widest transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Profil
            </a>
        </div>

        @if($orders->count() > 0)
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                <th class="p-4">Kode Pesanan</th>
                                <th class="p-4">Tanggal</th>
                                <th class="p-4">Total</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                            @foreach($orders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-bold text-gray-900">{{ $order->order_code }}</td>
                                <td class="p-4">{{ $order->created_at->format('d M Y, H:i') }}</td>
                                <td class="p-4 font-bold text-brand-dark">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    @php
                                        $colors = [
                                            'menunggu' => 'bg-yellow-100 text-yellow-800',
                                            'diproses' => 'bg-blue-100 text-blue-800',
                                            'dikirim' => 'bg-indigo-100 text-indigo-800',
                                            'selesai' => 'bg-green-100 text-green-800',
                                            'dibatalkan' => 'bg-red-100 text-red-800',
                                        ];
                                        $colorClass = $colors[$order->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $colorClass }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    @if($order->status === 'menunggu' && $order->snap_token)
                                        <button onclick="payOrder('{{ $order->snap_token }}')" class="inline-block bg-brand hover:bg-brand-dark text-white px-3 py-1.5 rounded-md text-xs font-bold uppercase tracking-wider transition shadow-sm">
                                            Bayar Sekarang
                                        </button>
                                    @else
                                        <a href="https://api.whatsapp.com/send?phone={{ \App\Models\Setting::where('key', 'wa_number')->value('value') ?? '62895321313124' }}&text=Halo%20Admin,%20saya%20ingin%20menanyakan%20status%20pesanan%20saya%20dengan%20kode%20{{ $order->order_code }}" target="_blank" class="inline-block bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded-md text-xs font-bold uppercase tracking-wider transition">
                                            Tanya Admin
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-white border border-gray-200 rounded-xl shadow-sm">
                <i class="fas fa-shopping-bag text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-500 mb-6">Anda belum pernah melakukan pemesanan apapun.</p>
                <a href="{{ route('katalog') }}" class="inline-block bg-brand hover:bg-brand-dark text-white font-bold py-3 px-8 rounded-md transition uppercase text-sm tracking-wider shadow-sm">
                    Mulai Belanja
                </a>
            </div>
        @endif

    </main>

    <footer class="py-6 text-center text-xs text-gray-400 border-t border-gray-200 bg-white mt-auto">
        &copy; 2026 Setaman Bogor. Cultivating calm in every corner.
    </footer>

    <!-- Midtrans Snap JS Script -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-6nC_P4H9h7Bvx1ZqI-Uj10nJ') }}"></script>
    <script>
        function payOrder(snapToken) {
            if (snapToken.startsWith('DEMO_TOKEN_')) {
                alert('Ini adalah pesanan simulasi Midtrans. Token transaksi demo: ' + snapToken);
                return;
            }
            snap.pay(snapToken, {
                onSuccess: function(result) {
                    window.location.reload();
                },
                onPending: function(result) {
                    window.location.reload();
                },
                onError: function(result) {
                    alert('Pembayaran gagal, silakan coba lagi.');
                }
            });
        }

        @if(session('pay_snap_token'))
            document.addEventListener('DOMContentLoaded', function() {
                payOrder("{{ session('pay_snap_token') }}");
            });
        @endif
    </script>
</body>
</html>
