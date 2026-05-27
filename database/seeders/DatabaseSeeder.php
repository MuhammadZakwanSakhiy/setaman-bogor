<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users first so they are available for other seeders
        User::firstOrCreate([
            'name' => 'Admin Setaman',
            'email' => 'admin@setaman.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::firstOrCreate([
            'name' => 'Pelanggan Setaman',
            'email' => 'pelanggan@setaman.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Seed initial article categories
        $this->call(\Database\Seeders\ArticleCategorySeeder::class);

        // Seed articles
        $this->call(\Database\Seeders\ArticleSeeder::class);

        // Seed products and categories
        $this->call([
            \Database\Seeders\CategorySeeder::class,
            \Database\Seeders\ProductSeeder::class,
        ]);

        // Seed settings
        $this->call(\Database\Seeders\SettingSeeder::class);

        // Seed shipping methods, orders, and reviews
        $this->call([
            \Database\Seeders\ShippingMethodSeeder::class,
            \Database\Seeders\OrderSeeder::class,
            \Database\Seeders\ReviewSeeder::class,
        ]);
    }
}
