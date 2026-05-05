@php
    $statusClass = [
        'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
        'diproses' => 'bg-blue-50 text-blue-700 border-blue-100',
        'dikirim' => 'bg-purple-50 text-purple-700 border-purple-100',
        'selesai' => 'bg-green-50 text-green-700 border-green-100',
        'dibatalkan' => 'bg-red-50 text-red-700 border-red-100',
    ][$status] ?? 'bg-gray-50 text-gray-600 border-gray-100';
@endphp

<span class="inline-flex rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-widest {{ $statusClass }}">
    {{ $status }}
</span>
