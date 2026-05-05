@extends('layouts.setaman')

@section('title', 'Tentang & Kontak - Setaman Bogor')

@section('content')
<section class="container mx-auto px-6 py-12">
    <div class="grid gap-10 lg:grid-cols-2">
        <div class="space-y-6">
            <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Tentang Kami</div>
            <h1 class="text-4xl font-bold leading-tight text-brand-dark">Setaman Bogor, ruang hijau untuk hidup urban.</h1>
            <p class="leading-8 text-gray-600">Setaman Bogor membantu masyarakat memilih, merawat, dan memesan tanaman yang tepat untuk hunian maupun ruang kerja. Fokus kami adalah tanaman berkualitas, edukasi perawatan, dan proses pemesanan sederhana melalui WhatsApp.</p>
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach ([['10k+', 'Pohon Tertanam'], ['245', 'Produk Aktif'], ['56', 'Artikel Edukasi']] as $stat)
                    <div class="rounded-2xl bg-brand-light p-5">
                        <div class="text-2xl font-bold text-brand-dark">{{ $stat[0] }}</div>
                        <div class="mt-1 text-xs font-bold uppercase tracking-widest text-brand">{{ $stat[1] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <h2 class="text-2xl font-bold text-brand-dark">Kontak</h2>
            <div class="mt-6 grid gap-4 text-sm text-gray-600">
                <div class="rounded-2xl bg-brand-light p-4"><i class="fab fa-whatsapp mr-3 text-brand"></i>0812-3456-7890</div>
                <div class="rounded-2xl bg-brand-light p-4"><i class="fas fa-envelope mr-3 text-brand"></i>halo@setamanbogor.com</div>
                <div class="rounded-2xl bg-brand-light p-4"><i class="fas fa-location-dot mr-3 text-brand"></i>Dramaga, Bogor, Jawa Barat</div>
            </div>
            <div class="mt-6 h-64 rounded-2xl bg-brand-light grid place-items-center text-center text-sm font-semibold text-brand">
                Placeholder Lokasi Google Maps
            </div>
        </div>
    </div>
</section>
@endsection
