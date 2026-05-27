<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('role', 'user')->first();
        $userId = $user ? $user->id : null;

        $shippingMethods = ShippingMethod::all();
        $products = Product::where('is_active', true)->get();

        if ($products->isEmpty() || $shippingMethods->isEmpty()) {
            return;
        }

        $statuses = ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'];
        $customerNames = [
            'Ahmad Fauzi', 'Siti Aminah', 'Budi Santoso', 'Dewi Lestari', 
            'Rian Hidayat', 'Mega Utami', 'Hendra Wijaya', 'Indah Permata', 
            'Yusuf Maulana', 'Fitri Handayani'
        ];

        // Seed orders from January to May of the current year (2026)
        $currentYear = 2026;
        $currentMonth = 5; // May

        for ($month = 1; $month <= $currentMonth; $month++) {
            // Generate 4 to 6 orders per month
            $orderCount = rand(4, 6);

            for ($i = 0; $i < $orderCount; $i++) {
                $shippingMethod = $shippingMethods->random();
                $day = rand(1, 28);
                $hour = rand(8, 20);
                $minute = rand(0, 59);
                $second = rand(0, 59);
                
                $orderDate = Carbon::create($currentYear, $month, $day, $hour, $minute, $second);
                
                $status = $statuses[array_rand($statuses)];
                // Make older orders more likely to be completed
                if ($month < $currentMonth - 1) {
                    $status = rand(1, 10) <= 8 ? 'selesai' : 'dibatalkan';
                }

                $customerName = $customerNames[array_rand($customerNames)];
                $customerPhone = '08' . rand(11, 99) . rand(1000, 9999) . rand(100, 999);
                $customerAddress = 'Jalan Melati No. ' . rand(1, 150) . ', Dramaga, Kabupaten Bogor, Jawa Barat';

                $orderCode = 'SB-' . $orderDate->format('Ymd') . '-' . strtoupper(Str::random(4));

                // Create Order
                $order = Order::create([
                    'user_id' => $userId,
                    'shipping_method_id' => $shippingMethod->id,
                    'order_code' => $orderCode,
                    'status' => $status,
                    'customer_name' => $customerName,
                    'customer_phone' => $customerPhone,
                    'customer_address' => $customerAddress,
                    'note' => rand(1, 5) == 5 ? 'Tolong dibungkus rapi' : null,
                    'subtotal_price' => 0,
                    'shipping_cost' => $shippingMethod->cost,
                    'total_price' => 0,
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ]);

                // Create Order Items (1 to 3 items)
                $itemCount = rand(1, 3);
                $subtotal = 0;
                $purchasedProducts = $products->random($itemCount);

                foreach ($purchasedProducts as $product) {
                    $quantity = rand(1, 2);
                    $price = $product->price;
                    $itemSubtotal = $quantity * $price;
                    $subtotal += $itemSubtotal;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'quantity' => $quantity,
                        'price' => $price,
                        'subtotal' => $itemSubtotal,
                        'created_at' => $orderDate,
                    ]);
                }

                // Update order totals and whatsapp message
                $totalPrice = $subtotal + $shippingMethod->cost;
                
                $waMessage = "Halo Admin Setaman Bogor, saya ingin mengonfirmasi pesanan saya:\n\n" .
                             "ID Pesanan: #{$orderCode}\n" .
                             "Nama: {$customerName}\n" .
                             "Alamat: {$customerAddress}\n" .
                             "Total Pembayaran: Rp " . number_format($totalPrice, 0, ',', '.') . "\n\n" .
                             "Mohon segera diproses ya, terima kasih.";

                $order->update([
                    'subtotal_price' => $subtotal,
                    'total_price' => $totalPrice,
                    'whatsapp_message' => $waMessage,
                ]);
            }
        }
    }
}
