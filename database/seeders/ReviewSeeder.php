<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        
        // Create a few additional users for reviews
        $reviewers = [
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@setaman.com',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@setaman.com',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi@setaman.com',
                'password' => bcrypt('password'),
                'role' => 'user',
            ]
        ];

        $users = [];
        foreach ($reviewers as $reviewerData) {
            $users[] = User::firstOrCreate(['email' => $reviewerData['email']], $reviewerData);
        }

        // Add Pelanggan Setaman if exists
        $pelanggan = User::where('email', 'pelanggan@setaman.com')->first();
        if ($pelanggan) {
            $users[] = $pelanggan;
        }

        $comments = [
            5 => [
                'Tanaman sangat segar saat sampai. Pengemasan sangat aman dan rapi!',
                'Sangat suka! Daunnya hijau lebat dan tidak layu sama sekali.',
                'Kualitas premium. Pelayanan ramah dan pengiriman cepat.',
                'Rekomendasi banget untuk pecinta tanaman hias indoor!',
                'Sesuai deskripsi, dapet tips perawatan juga. Mantap!'
            ],
            4 => [
                'Tanaman bagus, ada sedikit daun yang kuning tapi wajar karena pengiriman.',
                'Respon admin cepat, pengiriman reguler lumayan cepat.',
                'Stok tanaman sehat dan media tanamnya juga subur.',
                'Packing aman dan tanaman sampai dengan selamat.'
            ]
        ];

        foreach ($products as $product) {
            // Assign 1 to 2 random reviews for each product
            $reviewerSubset = array_slice($users, 0, rand(1, 2));
            shuffle($reviewerSubset);

            foreach ($reviewerSubset as $user) {
                $rating = rand(4, 5);
                $comment = $comments[$rating][array_rand($comments[$rating])];

                Review::firstOrCreate(
                    ['user_id' => $user->id, 'product_id' => $product->id],
                    [
                        'rating' => $rating,
                        'comment' => $comment,
                    ]
                );
            }
        }
    }
}
