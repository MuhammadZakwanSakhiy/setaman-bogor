@extends('layouts.admin')

@section('title', 'Kelola Pesanan | Admin Setaman Bogor')

@section('content')
<div class="mb-8 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-900 mb-1">KELOLA PESANAN</h2>
    <p class="text-sm text-gray-500">Pantau dan kelola pesanan pelanggan.</p>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-600 rounded-md font-medium text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-xs uppercase font-bold text-gray-500 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4">Order Code</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4">Total Harga</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="px-6 py-4 font-mono font-medium text-gray-900">{{ $order->order_code }}</td>
                    <td class="px-6 py-4">{{ $order->created_at->format('d M Y, H:i') }}</td>
                    <td class="px-6 py-4">{{ $order->customer_name }}</td>
                    <td class="px-6 py-4 font-medium">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
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
                        <span class="px-2 py-1 {{ $colorClass }} rounded text-xs font-bold uppercase">{{ $order->status }}</span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('orders.show', $order->id) }}" class="text-brand hover:text-brand-dark transition font-medium text-xs uppercase tracking-wider inline-block">Detail</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 transition font-medium text-xs uppercase tracking-wider"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="p-4 border-t border-gray-200">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
