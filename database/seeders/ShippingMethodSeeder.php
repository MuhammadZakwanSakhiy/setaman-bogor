<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Kurir Setaman (Bogor Area)',
                'cost' => 15000.00,
                'description' => 'Pengiriman cepat menggunakan kurir internal Setaman Bogor khusus wilayah Bogor kota & kabupaten.',
                'is_active' => true,
            ],
            [
                'name' => 'JNE Reguler',
                'cost' => 12000.00,
                'description' => 'Pengiriman reguler ke seluruh wilayah Indonesia melalui ekspedisi JNE.',
                'is_active' => true,
            ],
            [
                'name' => 'Ambil di Toko',
                'cost' => 0.00,
                'description' => 'Ambil langsung pesanan Anda ke kebun Setaman Bogor (Dramaga Regency 1).',
                'is_active' => true,
            ],
        ];

        foreach ($methods as $method) {
            ShippingMethod::firstOrCreate(['name' => $method['name']], $method);
        }
    }
}
