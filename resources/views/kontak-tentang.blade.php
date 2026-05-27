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
                @foreach ([['10k+', 'Pohon Tertanam'], [$activeProductsCount ?? 0, 'Produk Aktif'], [$activeArticlesCount ?? 0, 'Artikel Edukasi']] as $stat)
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
            <div class="mt-6 h-64 rounded-2xl overflow-hidden shadow-inner border border-gray-100">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.490793616654!2d106.7360212!3d-6.5857642!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5400e3da17f%3A0xa5d8c465aa180b61!2sSetaman%20Bogor!5e0!3m2!1sen!2sid!4v1716298000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>
@endsection
