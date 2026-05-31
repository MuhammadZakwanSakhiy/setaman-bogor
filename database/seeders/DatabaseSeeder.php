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
        $admin = User::firstOrCreate([
            'email' => 'admin@setaman.com',
        ], [
            'name' => 'Admin Setaman',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $admin->profile()->firstOrCreate([
            'user_id' => $admin->id
        ], [
            'avatar_url' => null,
            'bio' => 'Administrator Setaman Bogor',
            'is_public' => true,
        ]);

        $user = User::firstOrCreate([
            'email' => 'pelanggan@setaman.com',
        ], [
            'name' => 'Pelanggan Setaman',
            'password' => bcrypt('password'),
            'phone' => '0895321313124',
            'role' => 'user',
        ]);

        $user->profile()->firstOrCreate([
            'user_id' => $user->id
        ], [
            'avatar_url' => null,
            'bio' => 'Pecinta tanaman hias sejak 2020.',
            'address' => 'Jl. Sindang Barang Pilar 1 No.4, RT.05/RW.07, Sindangbarang',
            'province' => 'Jawa Barat',
            'city' => 'Kota Bogor',
            'subdistrict' => 'Bogor Barat',
            'village' => 'Sindangbarang',
            'postal_code' => '16117',
            'is_public' => true,
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
            \Database\Seeders\ReviewSeeder::class,
        ]);
    }
}
