@extends('layouts.admin')

@section('title', 'Pengaturan | Admin Setaman Bogor')

@section('content')
<div class="mb-8 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-900 mb-1">PENGATURAN SISTEM</h2>
    <p class="text-sm text-gray-500">Kelola pengaturan aplikasi Setaman Bogor.</p>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
    {{ session('success') }}
</div>
@endif

<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp Admin (Untuk Checkout)</label>
            <input type="text" name="wa_number" value="{{ $settings['wa_number'] ?? '62895321313124' }}" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:border-brand" required>
            <p class="text-xs text-gray-500 mt-2">Format: Gunakan kode negara tanpa '+', misalnya 6281234567890.</p>
        </div>

        <button type="submit" class="bg-brand text-white px-6 py-2 rounded-md font-bold text-sm uppercase tracking-wider hover:bg-brand-dark transition">
            Simpan Pengaturan
        </button>
    </form>
</div>
@endsection
