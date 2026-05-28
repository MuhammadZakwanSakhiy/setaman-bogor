<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $indoor = Category::where('name', 'Tanaman Indoor')->first()->id;

        $products = [
            [
                'name' => 'Monstera variegata marmorata',
                'category_id' => $indoor,
                'price' => 2500000,
                'stock' => 10,
                'description' => 'Monstera Variegata Marmorata adalah tanaman kolektor premium kelas atas dengan pola variegata bercorak marmer kuning-hijau (aurea) yang sangat menawan dan stabil. Setiap daun memiliki keunikan motif tersendiri yang menjadikannya sebuah karya seni hidup di sudut ruangan Anda.',
                'care_tips' => "Cahaya: Terang tidak langsung (terfilter)\nPenyiraman: Siram ketika 2-3 cm tanah atas mengering\nKelembapan: Menyukai kelembapan tinggi (60-80%)\nMedia: Campuran porous (sekam, perlite, andam)",
                'is_active' => true,
                'is_best_seller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1614594975525-e45190c55d0b?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1614594805320-e6a3ee51e227?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&w=600&q=80'
                ]
            ],
            [
                'name' => 'Monstera variegata Holland',
                'category_id' => $indoor,
                'price' => 1800000,
                'stock' => 8,
                'description' => 'Monstera Variegata Holland merupakan varietas Monstera dengan corak albo variegata putih bersih yang sangat kontras di atas daun hijau pekat. Bentuk daunnya elegan, kokoh, dan tangguh untuk menghiasi hunian minimalis modern.',
                'care_tips' => "Cahaya: Tidak langsung sedang hingga terang\nPenyiraman: Berkala seminggu sekali\nKelembapan: Sedang (50-60%)\nSuhu: Ideal pada 18°C - 28°C",
                'is_active' => true,
                'is_best_seller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1545167622-3a6ac756afa4?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1614594805320-e6a3ee51e227?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&w=600&q=80'
                ]
            ],
            [
                'name' => 'Monstera variegata white moon',
                'category_id' => $indoor,
                'price' => 3200000,
                'stock' => 5,
                'description' => 'Monstera Variegata White Moon adalah salah satu tanaman aroid paling langka dan eksklusif untuk kolektor sejati. Daunnya yang besar dihiasi warna putih melingkar bersih laksana bulan sabit atau bulan purnama yang sangat dramatis.',
                'care_tips' => "Cahaya: Tidak langsung intensitas tinggi (hindari matahari terik)\nPenyiraman: Siram secukupnya saat media mulai kering\nKelembapan: Sangat tinggi (70%+)\nMedia: Campuran super porous",
                'is_active' => true,
                'is_best_seller' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1612363228104-db838b00a6e3?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1614594805320-e6a3ee51e227?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&w=600&q=80'
                ]
            ],
            [
                'name' => 'Monstera Monthai',
                'category_id' => $indoor,
                'price' => 1500000,
                'stock' => 7,
                'description' => 'Monstera Monthai (Thai Constellation) memiliki pola variegata krem/kuning pucat yang tersebar merata secara genetik seperti taburan rasi bintang di langit malam. Daunnya tebal, kokoh, berukuran besar, dan tidak mudah reverting kembali ke hijau polos.',
                'care_tips' => "Cahaya: Terang terfilter tidak langsung\nPenyiraman: Biarkan tanah mengering sebelum disiram kembali\nKelembapan: Sedang hingga tinggi\nSuhu: Hangat (20°C - 30°C)",
                'is_active' => true,
                'is_best_seller' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1597055181300-e3633a207518?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1614594805320-e6a3ee51e227?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&w=600&q=80'
                ]
            ],
            [
                'name' => 'Anthurium kuping gajah',
                'category_id' => $indoor,
                'price' => 250000,
                'stock' => 15,
                'description' => 'Anthurium Kuping Gajah (Anthurium Crystallinum) adalah tanaman hias berdaun beludru gelap berbentuk hati dengan urat daun berwarna perak mengkilap yang menyerupai telinga gajah. Memberikan nuansa tropis mewah pada dekorasi interior Anda.',
                'care_tips' => "Cahaya: Teduh dengan sirkulasi udara baik\nPenyiraman: Jaga media tetap lembab (siram 1-2x sehari jika cuaca panas)\nKelembapan: Tinggi\nMedia: porous (pakis cacah, sekam)",
                'is_active' => true,
                'is_best_seller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1502082553048-f009c37129b9?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1614594805320-e6a3ee51e227?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&w=600&q=80'
                ]
            ],
            [
                'name' => 'Philodendron violin variegata',
                'category_id' => $indoor,
                'price' => 850000,
                'stock' => 12,
                'description' => 'Philodendron Violin Variegata memiliki daun unik berbentuk menyerupai biola dengan variegata warna kuning neon dan hijau lemon yang sangat cerah dan segar. Menghadirkan keceriaan alami di setiap sudut ruangan.',
                'care_tips' => "Cahaya: Terang terfilter tidak langsung\nPenyiraman: Siram saat 2 cm tanah atas terasa kering\nKelembapan: Sedang\nMedia: Beri tiang penyangga/moss pole",
                'is_active' => true,
                'is_best_seller' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1596547609652-9cb5d8d736bb?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1614594805320-e6a3ee51e227?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&w=600&q=80'
                ]
            ],
            [
                'name' => 'Philodendron Jose Buono',
                'category_id' => $indoor,
                'price' => 650000,
                'stock' => 14,
                'description' => 'Philodendron Jose Buono merupakan tanaman aroid panjat dengan daun memanjang tebal yang dihiasi corak variegata putih salju, krem, dan hijau muda yang sangat stabil dan menawan. Sangat mudah dirawat dan cepat tumbuh.',
                'care_tips' => "Cahaya: Tidak langsung sedang hingga terang\nPenyiraman: Siram saat tanah mengering\nKelembapan: Sedang\nMedia: Porous dengan tiang moss pole untuk daun optimal",
                'is_active' => true,
                'is_best_seller' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1603436326446-7dc41f021c7a?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1614594805320-e6a3ee51e227?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&w=600&q=80'
                ]
            ],
            [
                'name' => 'Philodendron pink princess',
                'category_id' => $indoor,
                'price' => 450000,
                'stock' => 20,
                'description' => 'Philodendron Pink Princess (PPP) adalah tanaman hias eksotis yang paling banyak dicari karena daunnya yang berwarna hijau gelap kehitaman yang berkilau dipadukan secara kontras dengan corak variegata warna merah muda (pink) cerah yang sangat anggun.',
                'care_tips' => "Cahaya: Terang terfilter tidak langsung untuk menjaga warna pink\nPenyiraman: Biarkan tanah setengah kering sebelum disiram lagi\nKelembapan: Tinggi (60%+)\nMedia: Sangat porous",
                'is_active' => true,
                'is_best_seller' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1620127351139-44e21a224a1b?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1614594805320-e6a3ee51e227?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&w=600&q=80'
                ]
            ],
            [
                'name' => 'Calathea black lipstik',
                'category_id' => $indoor,
                'price' => 95000,
                'stock' => 30,
                'description' => 'Calathea Black Lipstik (Dottie) terkenal dengan daun bulat mengkilap berwarna ungu gelap kehitaman yang dihiasi garis merah muda menyala di sepanjang urat daunnya, menyerupai sapuan lipstik merah muda yang menawan.',
                'care_tips' => "Cahaya: Teduh/cahaya minim tidak langsung\nPenyiraman: Jaga tanah tetap lembab tetapi tidak becek\nKelembapan: Sangat tinggi\nMedia: Gunakan air non-kaporit (hujan/filter)",
                'is_active' => true,
                'is_best_seller' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1614594975525-e45190c55d0b?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1614594805320-e6a3ee51e227?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&w=600&q=80'
                ]
            ],
            [
                'name' => 'Aglonema polkadot',
                'category_id' => $indoor,
                'price' => 150000,
                'stock' => 25,
                'description' => 'Aglonema Polkadot memiliki pola totol-totol putih-hijau cerah yang tersebar merata di atas daunnya yang rimbun dan membulat. Sangat mudah dirawat dan tangguh dalam kondisi pencahayaan rendah di dalam ruangan.',
                'care_tips' => "Cahaya: Tidak langsung sedang hingga teduh\nPenyiraman: Siram 2-3 hari sekali\nKelembapan: Sedang\nMedia: Campuran tanah, sekam bakar, dan pupuk kandang",
                'is_active' => true,
                'is_best_seller' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1599598425947-33002629e0fa?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1614594805320-e6a3ee51e227?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&w=600&q=80'
                ]
            ]
        ];

        foreach ($products as $pData) {
            $images = $pData['images'];
            unset($pData['images']);

            $pData['slug'] = Str::slug($pData['name']);
            $product = Product::create($pData);

            // Create product images
            $firstImageId = null;
            foreach ($images as $index => $imageUrl) {
                $pImg = ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $imageUrl,
                    'sort_order' => $index
                ]);

                if ($index === 0) {
                    $firstImageId = $pImg->id;
                }
            }

            // Set primary image
            $product->update(['image_id' => $firstImageId]);
        }
    }
}
