@extends('layouts.admin')

@section('title', 'Detail Pesanan | Admin Setaman Bogor')

@section('content')
<div class="mb-8 border-b border-gray-200 pb-4 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-1">DETAIL PESANAN: {{ $order->order_code }}</h2>
        <p class="text-sm text-gray-500">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</p>
    </div>
    <a href="{{ route('orders.index') }}" class="text-gray-500 hover:text-brand font-medium text-sm transition flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-600 rounded-md font-medium text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Informasi Utama -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Rincian Produk -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="font-bold text-gray-900 uppercase tracking-wider text-sm">Produk yang Dipesan</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-white text-xs uppercase font-bold text-gray-500 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4">Produk</th>
                            <th class="px-6 py-4 text-center">Qty</th>
                            <th class="px-6 py-4 text-right">Harga Satuan</th>
                            <th class="px-6 py-4 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $item->product_name }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-right font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50 text-sm">
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-right font-medium text-gray-500">Subtotal</td>
                            <td class="px-6 py-3 text-right font-medium text-gray-900">Rp {{ number_format($order->subtotal_price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-right font-medium text-gray-500">Ongkos Kirim</td>
                            <td class="px-6 py-3 text-right font-medium text-gray-900">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-900 uppercase text-xs tracking-wider border-t border-gray-200">Total Harga</td>
                            <td class="px-6 py-4 text-right font-bold text-brand text-lg border-t border-gray-200">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Informasi Pelanggan -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="font-bold text-gray-900 uppercase tracking-wider text-sm">Informasi Pelanggan & Pengiriman</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Nama Penerima</p>
                    <p class="text-gray-900 font-medium">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">No. WhatsApp / Telepon</p>
                    <p class="text-gray-900 font-medium">{{ $order->customer_phone }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Alamat Pengiriman</p>
                    <p class="text-gray-900">{{ $order->customer_address }}</p>
                </div>
                @if($order->note)
                <div class="md:col-span-2">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Catatan Tambahan</p>
                    <div class="bg-yellow-50 p-3 rounded-md border border-yellow-200 text-sm text-yellow-800">
                        {{ $order->note }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar / Aksi -->
    <div class="space-y-6">
        <!-- Update Status Box -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="font-bold text-gray-900 uppercase tracking-wider text-sm">Status Pesanan</h3>
            </div>
            <div class="p-6">
                @php
                    $colors = [
                        'pending' => 'bg-yellow-100 text-yellow-700',
                        'diproses' => 'bg-blue-100 text-blue-700',
                        'dikirim' => 'bg-indigo-100 text-indigo-700',
                        'selesai' => 'bg-green-100 text-green-700',
                        'dibatalkan' => 'bg-red-100 text-red-700',
                    ];
                    $colorClass = $colors[$order->status] ?? 'bg-gray-100 text-gray-700';
                @endphp
                <div class="mb-6">
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-2">Status Saat Ini:</p>
                    <span class="inline-block px-3 py-1.5 {{ $colorClass }} rounded text-sm font-bold uppercase tracking-wider">{{ $order->status }}</span>
                </div>

                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="status" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Ubah Status</label>
                        <select name="status" id="status" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand bg-white text-sm">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu Pembayaran)</option>
                            <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses (Sedang Disiapkan)</option>
                            <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim (Dalam Perjalanan)</option>
                            <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai (Sudah Diterima)</option>
                            <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-brand text-white py-3 rounded-md font-bold text-sm uppercase tracking-wider hover:bg-brand-dark transition">Simpan Status</button>
                </form>
            </div>
        </div>
        
        <!-- Tindakan Lain -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
            <h3 class="font-bold text-gray-900 uppercase tracking-wider text-sm mb-4">Zona Berbahaya</h3>
            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini secara permanen? Data yang dihapus tidak dapat dikembalikan.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full border border-red-500 text-red-500 py-3 rounded-md font-bold text-sm uppercase tracking-wider hover:bg-red-50 transition">
                    <i class="fas fa-trash mr-2"></i> Hapus Pesanan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
