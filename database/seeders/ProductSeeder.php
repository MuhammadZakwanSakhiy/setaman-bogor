<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $indoor = Category::where('name', 'Tanaman Indoor')->first()->id;
        $outdoor = Category::where('name', 'Tanaman Outdoor')->first()->id;
        $pupuk = Category::where('name', 'Media Tanam & Pupuk')->first()->id;

        $products = [
            [
                'name' => 'Monstera Deliciosa',
                'category_id' => $indoor,
                'price' => 250000,
                'stock' => 12,
                'description' => 'Tanaman hias populer dengan daun berlubang unik yang mudah dirawat. Tanaman ikonik dengan daun berlubang unik yang memberikan kesan tropis modern pada ruangan Anda. Mudah dirawat dan cocok untuk pemula yang ingin menghadirkan nuansa alam ke dalam rumah.',
                'care_tips' => "Cahaya terang tidak langsung\nSiram saat 2-3 cm tanah atas kering\nSuhu ideal 18°C - 30°C",
                'image_url' => 'https://images.unsplash.com/photo-1614594975525-e45190c55d0b?auto=format&fit=crop&w=600&q=80',
                'is_active' => true,
                'is_best_seller' => true,
            ],
            [
                'name' => 'Sansevieria Trifasciata',
                'category_id' => $indoor,
                'price' => 120000,
                'stock' => 25,
                'description' => 'Lidah mertua yang tangguh, mampu menyaring udara ruangan dengan maksimal.',
                'care_tips' => "Tahan cahaya rendah hingga terang\nSiram jarang, biarkan tanah benar-benar kering sebelum disiram\nSangat mudah dirawat",
                'image_url' => 'https://images.unsplash.com/photo-1599598425947-33002629e0fa?auto=format&fit=crop&w=600&q=80',
                'is_active' => true,
                'is_best_seller' => true,
            ],
            [
                'name' => 'Orchidaceae Phalaenopsis',
                'category_id' => $outdoor,
                'price' => 350000,
                'stock' => 8,
                'description' => 'Anggrek bulan dengan kelopak putih bersih yang memberikan kesan elegan.',
                'care_tips' => "Cahaya terang tidak langsung (hindari matahari terik)\nSiram 1-2 kali seminggu, pastikan media drainase baik\nButuh sirkulasi udara yang baik",
                'image_url' => 'https://images.unsplash.com/photo-1520302630591-fd1c66edc19d?auto=format&fit=crop&w=600&q=80',
                'is_active' => true,
                'is_best_seller' => false,
            ],
            [
                'name' => 'Pupuk Organik Cair',
                'category_id' => $pupuk,
                'price' => 450000,
                'stock' => 50,
                'description' => 'Nutrisi lengkap untuk mempercepat pertumbuhan dan kesehatan daun tanaman.',
                'care_tips' => "Campurkan 1 tutup botol dengan 1 liter air\nSemprotkan pada daun atau siram ke media tanam\nGunakan 2 minggu sekali",
                'image_url' => 'https://images.unsplash.com/photo-1629837050013-16a8b1965e52?auto=format&fit=crop&w=600&q=80',
                'is_active' => true,
                'is_best_seller' => true,
            ],
            [
                'name' => 'Ficus Lyrata',
                'category_id' => $indoor,
                'price' => 420000,
                'stock' => 5,
                'description' => 'Ketapang biola dengan daun lebar yang memberikan pernyataan artistik di ruangan.',
                'care_tips' => "Cahaya terang, bisa kena sinar matahari pagi sedikit\nSiram saat tanah bagian atas kering\nBersihkan daun dari debu secara berkala",
                'image_url' => 'https://images.unsplash.com/photo-1603436326446-7dc41f021c7a?auto=format&fit=crop&w=600&q=80',
                'is_active' => true,
                'is_best_seller' => false,
            ],
            [
                'name' => 'Aloe Barbadensis',
                'category_id' => $outdoor,
                'price' => 65000,
                'stock' => 30,
                'description' => 'Lidah buaya multifungsi yang tahan panas dan sangat mudah dikembangbiakkan.',
                'care_tips' => "Cahaya terang, tahan sinar matahari langsung\nSiram jarang, tanah harus kering sebelum disiram lagi\nGunakan tanah kaktus/sukulen",
                'image_url' => 'https://images.unsplash.com/photo-1596547609652-9cb5d8d736bb?auto=format&fit=crop&w=600&q=80',
                'is_active' => true,
                'is_best_seller' => false,
            ],
            [
                'name' => 'Philodendron',
                'category_id' => $indoor,
                'price' => 120000,
                'stock' => 15,
                'description' => 'Tanaman hias dengan daun hijau mengkilap, cocok untuk mempercantik ruangan.',
                'care_tips' => "Cahaya redup hingga terang tidak langsung\nSiram secara teratur\nBisa mentolerir kondisi cahaya rendah",
                'image_url' => 'https://images.unsplash.com/photo-1612363228104-db838b00a6e3?auto=format&fit=crop&w=400&q=80',
                'is_active' => true,
                'is_best_seller' => false,
            ],
            [
                'name' => 'Calathea',
                'category_id' => $outdoor,
                'price' => 150000,
                'stock' => 20,
                'description' => 'Tanaman hias dengan corak daun yang indah, daunnya bergerak mengikuti cahaya.',
                'care_tips' => "Cahaya tidak langsung yang terang\nJaga agar tanah tetap lembab\nButuh kelembaban tinggi",
                'image_url' => 'https://images.unsplash.com/photo-1620127351139-44e21a224a1b?auto=format&fit=crop&w=400&q=80',
                'is_active' => true,
                'is_best_seller' => false,
            ],
            [
                'name' => 'Bunga Mawar',
                'category_id' => $outdoor,
                'price' => 75000,
                'stock' => 15,
                'description' => 'Tanaman hias bunga mawar merah yang harum dan indah untuk mempercantik taman Anda.',
                'care_tips' => "Sinar matahari langsung minimal 6 jam sehari\nSiram secara teratur 1-2 kali sehari\nLakukan pemangkasan berkala untuk merangsang bunga baru",
                'image_url' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=600&q=80',
                'is_active' => true,
                'is_best_seller' => false,
            ]
        ];

        foreach ($products as $product) {
            $product['slug'] = Str::slug($product['name']);
            Product::create($product);
        }
    }
}
