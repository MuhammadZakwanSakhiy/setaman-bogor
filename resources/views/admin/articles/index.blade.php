@extends('layouts.admin')

@section('title', 'Kelola Artikel | Admin Setaman Bogor')

@section('content')
<div class="mb-8 border-b border-gray-200 pb-4 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-1">KELOLA ARTIKEL</h2>
        <p class="text-sm text-gray-500">Daftar artikel dan konten edukasi.</p>
    </div>
    <a href="{{ route('articles.create') }}" class="bg-brand text-white px-4 py-2 rounded-md font-bold text-sm uppercase tracking-wider hover:bg-brand-dark transition">
        + Tulis Artikel
    </a>
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
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Judul Artikel</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Penulis</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="px-6 py-4 font-mono">#{{ $article->id }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $article->title }}</td>
                    <td class="px-6 py-4">{{ $article->category->name ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $article->author->name ?? '-' }}</td>
                    <td class="px-6 py-4">
                        @if($article->is_published)
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold uppercase">Terbit</span>
                        @else
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-bold uppercase">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('articles.edit', $article->id) }}" class="text-brand hover:text-brand-dark transition inline-block"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 transition"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data artikel.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($articles->hasPages())
    <div class="p-4 border-t border-gray-200">
        {{ $articles->links() }}
    </div>
    @endif
</div>
@endsection
