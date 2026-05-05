@extends('layouts.setaman')

@section('title', 'Setaman Bogor - Beranda')

@section('content')
<section class="container mx-auto px-6 py-12 md:py-20 flex flex-col-reverse md:flex-row items-center gap-12">
    <div class="md:w-1/2 space-y-6">
        <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Kesejukan Ruang</div>
        <h1 class="text-4xl md:text-5xl font-bold text-brand-dark leading-tight">
            Hadirkan Kesejukan<br>di Ruang Anda
        </h1>
        <p class="text-gray-600 text-lg leading-8">
            Ubah sudut hunian Anda menjadi oase hijau yang menenangkan dengan koleksi tanaman kurasi terbaik dari Setaman Bogor.
        </p>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ url('/katalog') }}" class="inline-flex items-center justify-center gap-2 rounded-md bg-brand px-6 py-3 font-semibold text-white transition hover:bg-brand-dark">
                Jelajahi Koleksi <i class="fas fa-arrow-right text-sm"></i>
            </a>
            <a href="{{ url('/artikel') }}" class="inline-flex items-center justify-center gap-2 rounded-md border border-green-100 px-6 py-3 font-semibold text-brand transition hover:bg-brand-light">
                Baca Edukasi
            </a>
        </div>
    </div>
    <div class="md:w-1/2">
        <img src="https://images.unsplash.com/photo-1604762524889-3e2fcc145683?auto=format&fit=crop&w=900&q=80" alt="Tanaman Monstera" class="h-[420px] w-full rounded-2xl object-cover shadow-lg">
    </div>
</section>

<section class="bg-brand-light py-16">
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        @foreach ([
            ['icon' => 'fa-comment-dots', 'title' => 'Gratis Konsultasi', 'body' => 'Dapatkan saran ahli untuk memilih dan merawat tanaman yang sesuai ruangan Anda.'],
            ['icon' => 'fa-check-circle', 'title' => 'Kualitas Terjamin', 'body' => 'Setiap bibit dan tanaman telah melalui proses seleksi serta perawatan yang konsisten.'],
            ['icon' => 'fa-truck', 'title' => 'Pengiriman Aman', 'body' => 'Kemasan khusus menjaga tanaman tetap segar sampai ke rumah Anda.'],
        ] as $fitur)
            <div class="flex flex-col items-center space-y-4">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-brand shadow-sm">
                    <i class="fas {{ $fitur['icon'] }} text-xl"></i>
                </div>
                <h3 class="font-semibold text-brand-dark text-lg">{{ $fitur['title'] }}</h3>
                <p class="text-gray-500 text-sm px-4 leading-6">{{ $fitur['body'] }}</p>
            </div>
        @endforeach
    </div>
</section>

<section class="container mx-auto px-6 py-20">
    <div class="mb-10 flex items-end justify-between gap-4">
        <div>
            <div class="text-xs font-bold uppercase tracking-[0.3em] text-brand">Kategori</div>
            <h2 class="mt-3 text-2xl font-bold text-brand-dark">Pilihan Terbaik</h2>
            <p class="text-gray-500 mt-2">Pilihan favorit para pecinta kebun perkotaan.</p>
        </div>
        <a href="{{ url('/katalog') }}" class="hidden text-sm font-semibold text-brand hover:underline md:inline">Lihat Semua</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ([
            ['title' => 'Indoor', 'body' => 'Tanaman pembersih udara untuk ruang tamu dan kamar.', 'image' => 'https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&w=800&q=80'],
            ['title' => 'Bibit Sayur', 'body' => 'Mulai kebun mandiri Anda dari benih pilihan berkualitas.', 'image' => 'https://images.unsplash.com/photo-1592424001801-09439c1b7e41?auto=format&fit=crop&w=800&q=80'],
        ] as $kategori)
            <a href="{{ url('/katalog') }}" class="relative h-64 overflow-hidden rounded-2xl group">
                <img src="{{ $kategori['image'] }}" alt="{{ $kategori['title'] }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6 flex items-end justify-between">
                    <div>
                        <h3 class="text-xl font-semibold text-white">{{ $kategori['title'] }}</h3>
                        <p class="mt-1 text-sm text-gray-200">{{ $kategori['body'] }}</p>
                    </div>
                    <div class="grid h-9 w-9 place-items-center rounded-full bg-white/20 text-white backdrop-blur-sm">
                        <i class="fas fa-arrow-up-right-from-square text-xs"></i>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>

<section class="container mx-auto px-6 py-16 mb-16">
    <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm md:p-12 flex flex-col md:flex-row gap-12 items-center">
        <div class="md:w-1/2 relative">
            <img src="https://images.unsplash.com/photo-1611843467160-25afb8df1074?auto=format&fit=crop&w=800&q=80" alt="Mengenal Setaman" class="h-[350px] w-full rounded-2xl object-cover">
            <div class="absolute -bottom-6 right-4 rounded-xl border border-white bg-green-200 px-6 py-4 shadow-lg md:-right-6">
                <div class="text-2xl font-bold text-brand-dark">10k+</div>
                <div class="text-xs font-semibold tracking-wider text-brand">POHON TERTANAM</div>
            </div>
        </div>
        <div class="md:w-1/2 space-y-6">
            <div class="text-xs font-bold uppercase tracking-[0.3em] text-brand">Kisah Setaman</div>
            <h2 class="text-3xl font-bold text-brand-dark">Mengenal Setaman Bogor</h2>
            <p class="text-gray-600 leading-7 text-sm">
                Berawal dari kecintaan terhadap flora tropis Indonesia, Setaman Bogor hadir sebagai jembatan antara alam dan kehidupan urban.
            </p>
            <p class="text-gray-600 leading-7 text-sm">
                Kami menyediakan tanaman berkualitas tinggi yang dirawat dengan teknik botani modern agar siap mempercantik hunian Anda.
            </p>
            <a href="{{ url('/tentang') }}" class="inline-block text-brand font-semibold hover:underline">
                Pelajari Lebih Lanjut <i class="fas fa-external-link-alt text-xs ml-1"></i>
            </a>
        </div>
    </div>
</section>
@endsection
