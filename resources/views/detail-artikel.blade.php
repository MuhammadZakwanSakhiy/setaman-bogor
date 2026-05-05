@extends('layouts.setaman')

@section('title', 'Detail Artikel - Setaman Bogor')

@section('content')
<article class="container mx-auto px-6 py-12">
    <div class="overflow-hidden rounded-3xl bg-brand-light">
        <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?auto=format&fit=crop&w=1200&q=80" alt="Ekosistem tanaman Bogor" class="h-[420px] w-full object-cover">
    </div>

    <div class="mx-auto mt-12 max-w-3xl">
        <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Edukasi & Botani</div>
        <h1 class="mt-4 text-4xl font-bold leading-tight text-brand-dark">Mengenal Ekosistem Tanaman Endemik di Kawasan Bogor Utara</h1>
        <p class="mt-4 text-xs font-bold uppercase tracking-[0.2em] text-gray-400">Diunggah: 24 Oktober 2023 oleh Tim Arsitektur Botani</p>

        <div class="prose prose-green mt-8 max-w-none text-gray-600">
            <p class="leading-8">Bogor telah lama dikenal sebagai kota hujan dengan keanekaragaman hayati yang luar biasa. Dalam upaya pelestarian botani lokal, Setaman Bogor berkomitmen mendokumentasikan dan membagikan pengetahuan mengenai spesies tanaman yang memiliki nilai historis dan ekologis.</p>
            <p class="leading-8">Kondisi tanah yang lembap dan curah hujan tinggi menciptakan mikroklimat unik. Tanaman seperti pakis, talas-talasan, hingga pohon peneduh besar tumbuh subur tanpa intervensi berlebihan.</p>
            <blockquote class="my-8 border-l-4 border-brand bg-brand-light p-6 text-xl font-semibold leading-9 text-brand-dark">Menanam bukan hanya soal estetika, melainkan menjaga kesinambungan ekologis yang telah ada selama berabad-abad.</blockquote>
            <p class="leading-8">Langkah pertama memulai taman botani pribadi adalah memahami karakteristik tempat: intensitas cahaya, kelembapan, drainase, dan pola perawatan harian.</p>
        </div>

        <a href="{{ url('/artikel') }}" class="mt-10 inline-flex items-center gap-2 rounded-md bg-brand px-5 py-3 text-sm font-bold text-white hover:bg-brand-dark">
            <i class="fas fa-arrow-left"></i> Kembali ke Artikel
        </a>
    </div>
</article>
@endsection
