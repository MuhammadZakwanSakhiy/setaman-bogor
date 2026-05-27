<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $authorId = $admin ? $admin->id : 1;

        $tips = ArticleCategory::where('name', 'Tips & Trik')->first();
        $panduan = ArticleCategory::where('name', 'Panduan')->first();
        $event = ArticleCategory::where('name', 'Event')->first();
        $ulasan = ArticleCategory::where('name', 'Ulasan Produk')->first();
        $berita = ArticleCategory::where('name', 'Berita')->first();

        $articles = [
            [
                'title' => 'Panduan Lengkap Merawat Tanaman Hias Indoor untuk Pemula',
                'category_id' => $panduan ? $panduan->id : null,
                'content' => "Merawat tanaman hias di dalam ruangan (indoor) tidaklah sesulit yang dibayangkan. Kunci utamanya adalah pencahayaan, penyiraman, dan sirkulasi udara yang tepat.\n\n1. Pencahayaan: Sebagian besar tanaman indoor membutuhkan cahaya tidak langsung (bright indirect light). Letakkan dekat jendela yang menghadap ke timur atau utara.\n2. Penyiraman: Jangan menyiram terlalu sering! Sentuh permukaan tanah sedalam 2-3 cm. Jika terasa kering, baru siram sampai air mengalir keluar dari pot.\n3. Sirkulasi Udara: Pastikan ruangan memiliki ventilasi udara yang baik agar terhindar dari jamur dan bakteri.\n\nBeberapa tanaman indoor yang sangat ramah pemula antara lain Lidah Mertua (Sansevieria), Sirih Gading (Pothos), dan Monsteras.",
                'image_url' => 'https://images.unsplash.com/photo-1545241047-6083a3684587?q=80&w=800&auto=format&fit=crop',
                'is_published' => true,
            ],
            [
                'title' => '5 Jenis Tanaman Hias Gantung yang Bikin Rumah Sejuk dan Asri',
                'category_id' => $tips ? $tips->id : null,
                'content' => "Tanaman hias gantung adalah solusi cerdas untuk menghemat ruang sekaligus memperindah interior maupun eksterior rumah Anda.\n\nBerikut adalah 5 jenis tanaman gantung populer yang mudah dirawat:\n1. Sirih Gading (Golden Pothos): Memiliki daun berbentuk hati berwarna hijau dengan corak kuning emas.\n2. Spider Plant (Chlorophytum comosum): Sangat efektif membersihkan udara dari racun.\n3. String of Pearls (Senecio rowleyanus): Berbentuk unik menyerupai butiran mutiara hijau.\n4. Boston Fern (Paku Sarang Burung): Memberikan nuansa hutan tropis yang sejuk.\n5. Dischidia Nummularia: Daunnya bulat tebal seperti uang koin, sangat manis untuk dekorasi minimalis.",
                'image_url' => 'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?q=80&w=800&auto=format&fit=crop',
                'is_published' => true,
            ],
            [
                'title' => 'Cara Mengatasi Hama Kutu Putih pada Tanaman Monstera',
                'category_id' => $tips ? $tips->id : null,
                'content' => "Kutu putih (mealybugs) adalah salah satu hama yang paling sering menyerang tanaman hias daun seperti Monstera. Serangga kecil berselubung seperti kapas ini menghisap cairan tanaman dan bisa menyebabkan daun menguning hingga rontok.\n\nCara membasminya secara organik:\n1. Semprot dengan Air Mengalir: Untuk tingkat serangan ringan, semprot dengan air mengalir untuk merontokkan kutu.\n2. Alkohol 70%: Celupkan cotton bud ke dalam alkohol, lalu usap langsung pada kutu putih.\n3. Campuran Sabun Cair dan Minyak Neem: Semprotkan larutan minyak neem yang dicampur sedikit sabun pencuci piring organik ke seluruh permukaan daun seminggu sekali sampai hama hilang.",
                'image_url' => 'https://images.unsplash.com/photo-1614594975525-e45190c55d0b?q=80&w=800&auto=format&fit=crop',
                'is_published' => true,
            ],
            [
                'title' => 'Mengenal Seni Terarium: Membuat Ekosistem Mini dalam Wadah Kaca',
                'category_id' => $panduan ? $panduan->id : null,
                'content' => "Terarium adalah wadah kaca atau plastik transparan yang berisi tanah dan tanaman, dirancang sedemikian rupa sehingga membentuk ekosistem mandiri skala mini.\n\nAda dua jenis terarium:\n- Terarium Terbuka: Cocok untuk tanaman gurun seperti kaktus dan sukulen yang menyukai kelembapan rendah.\n- Terarium Tertutup: Cocok untuk tanaman tropis seperti pakis, lumut, dan fittonia yang membutuhkan kelembapan tinggi.\n\nMembuat terarium sangat menyenangkan dan melatih kreativitas. Gunakan lapisan batu kerikil di bagian bawah sebagai drainase, karbon aktif untuk menyerap bau, tanah humus, lalu susun tanaman hias mini Anda.",
                'image_url' => 'https://images.unsplash.com/photo-1463936575829-25148e1db1b8?q=80&w=800&auto=format&fit=crop',
                'is_published' => true,
            ],
            [
                'title' => 'Event Setaman Bogor: Lokakarya Curation & Gardening Awal Juni Ini',
                'category_id' => $event ? $event->id : null,
                'content' => "Kabar gembira buat warga Bogor dan sekitarnya! Setaman Bogor akan menyelenggarakan Workshop & Gardening Curation pada tanggal 6 Juni 2026.\n\nDalam event ini, kita akan belajar:\n- Cara memadukan jenis tanaman hias indoor agar sesuai dengan estetika interior rumah.\n- Teknik repotting dan perbanyakan tanaman (propagation).\n- Sesi tanya jawab gratis dengan tim kurator Setaman Bogor.\n\nPendaftaran dibuka mulai hari ini dengan kuota terbatas. Setiap peserta akan mendapatkan starter kit tanaman hias, pot keramik eksklusif, dan pupuk organik secara gratis. Hubungi admin kami untuk memesan slot!",
                'image_url' => 'https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?q=80&w=800&auto=format&fit=crop',
                'is_published' => true,
            ],
            [
                'title' => 'Review Pupuk Organik Cair Terbaik untuk Tanaman Hias Daun',
                'category_id' => $ulasan ? $ulasan->id : null,
                'content' => "Memberikan nutrisi tambahan berupa pupuk sangat penting agar tanaman tumbuh subur dan daunnya mengilap indah. Dari berbagai jenis pupuk, Pupuk Organik Cair (POC) menjadi pilihan paling aman untuk kelestarian tanah dan tanaman hias.\n\nHasil uji coba kami menunjukkan bahwa POC berbahan dasar urin kelinci fermentasi atau rumput laut memberikan hasil terbaik untuk mempercepat tunas baru pada Philodendron, Aglaonema, dan Calathea. Gunakan seminggu sekali dengan melarutkan 5-10 ml POC ke dalam 1 liter air, lalu siramkan langsung pada media tanam.",
                'image_url' => 'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?q=80&w=800&auto=format&fit=crop',
                'is_published' => true,
            ]
        ];

        foreach ($articles as $item) {
            $item['author_id'] = $authorId;
            $item['slug'] = Str::slug($item['title']);
            Article::create($item);
        }
    }
}
