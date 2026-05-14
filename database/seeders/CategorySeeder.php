<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tanaman Indoor', 'description' => 'Tanaman yang cocok diletakkan di dalam ruangan.'],
            ['name' => 'Tanaman Outdoor', 'description' => 'Tanaman yang membutuhkan sinar matahari langsung.'],
            ['name' => 'Pot & Wadah', 'description' => 'Berbagai macam pot dan wadah tanaman.'],
            ['name' => 'Media Tanam & Pupuk', 'description' => 'Kebutuhan nutrisi dan media untuk tanaman.'],
            ['name' => 'Peralatan Berkebun', 'description' => 'Alat-alat untuk merawat tanaman.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
