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
        // Seed initial article categories
        $this->call(\Database\Seeders\ArticleCategorySeeder::class);

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
    }
}
