<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Berita',
            'Tips & Trik',
            'Panduan',
            'Event',
            'Ulasan Produk',
        ];

        foreach ($categories as $name) {
            ArticleCategory::firstOrCreate(['name' => $name]);
        }
    }
}
