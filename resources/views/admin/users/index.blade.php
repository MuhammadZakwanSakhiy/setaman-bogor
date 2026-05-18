@extends('layouts.admin')

@section('title', 'Kelola Pengguna | Admin Setaman Bogor')

@section('content')
<div class="mb-8 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-900 mb-1">KELOLA PENGGUNA</h2>
    <p class="text-sm text-gray-500">Daftar pengguna dan manajemen akses.</p>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-md">
    {{ session('error') }}
</div>
@endif

<div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-xs uppercase font-bold text-gray-500 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Telepon</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">{{ $user->phone ?? '-' }}</td>
                    <td class="px-6 py-4">
                        @if($user->is_blocked)
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-bold uppercase">Diblokir</span>
                        @else
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold uppercase">Aktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('users.toggle-block', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin {{ $user->is_blocked ? 'mengaktifkan' : 'memblokir' }} pengguna ini?');">
                            @csrf
                            @method('PUT')
                            @if($user->is_blocked)
                                <button type="submit" class="text-green-500 hover:text-green-700 transition font-bold text-xs uppercase tracking-wider bg-green-50 border border-green-200 px-3 py-1 rounded">Aktifkan</button>
                            @else
                                <button type="submit" class="text-red-500 hover:text-red-700 transition font-bold text-xs uppercase tracking-wider bg-red-50 border border-red-200 px-3 py-1 rounded">Blokir</button>
                            @endif
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="p-4 border-t border-gray-200">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
