@extends('layouts.admin')

@section('title', 'Form Artikel - Admin Setaman Bogor')

@section('content')
<a href="{{ url('/admin/artikel') }}" class="mb-8 inline-flex items-center gap-2 text-sm font-semibold text-brand">
    <i class="fas fa-arrow-left"></i> Kembali ke Artikel
</a>

<section class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm">
    <div class="mb-8">
        <div class="text-xs font-bold uppercase tracking-[0.35em] text-brand">Artikel</div>
        <h1 class="mt-3 text-3xl font-bold text-brand-dark">Form Artikel</h1>
        <p class="mt-2 text-gray-500">Tulis panduan, riset, atau tips perawatan tanaman.</p>
    </div>

    <form class="grid gap-6 lg:grid-cols-[1fr_320px]">
        <div class="grid gap-5">
            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                Judul Artikel
                <input type="text" value="Teknik Propagasi Tanaman Endemik Bogor" class="rounded-2xl border border-green-100 px-4 py-3 font-normal outline-none focus:border-brand">
            </label>
            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                Konten
                <textarea rows="12" class="rounded-2xl border border-green-100 px-4 py-3 font-normal leading-7 outline-none focus:border-brand">Pelajari metode paling efektif untuk memperbanyak tanaman khas Bogor dengan memperhatikan kelembaban dan pencahayaan.</textarea>
            </label>
        </div>

        <aside class="h-fit rounded-3xl bg-brand-light p-5">
            <label class="grid gap-2 text-sm font-semibold text-brand-dark">
                Kategori
                <select class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-500 outline-none focus:border-brand">
                    <option>Panduan</option>
                    <option>Riset</option>
                    <option>Tanah</option>
                    <option>Lanskap</option>
                </select>
            </label>
            <label class="mt-5 grid gap-2 text-sm font-semibold text-brand-dark">
                Status Publikasi
                <select class="rounded-2xl border border-green-100 px-4 py-3 font-normal text-gray-500 outline-none focus:border-brand">
                    <option>Published</option>
                    <option>Draft</option>
                </select>
            </label>
            <div class="mt-5 grid h-48 place-items-center rounded-2xl border-2 border-dashed border-green-200 bg-white text-center text-sm text-gray-500">
                <div>
                    <i class="fas fa-image mb-3 text-3xl text-brand"></i>
                    <p>Upload gambar artikel</p>
                </div>
            </div>
            <button class="mt-5 w-full rounded-md bg-brand px-5 py-4 font-bold text-white hover:bg-brand-dark">Simpan Artikel</button>
        </aside>
    </form>
</section>
@endsection
