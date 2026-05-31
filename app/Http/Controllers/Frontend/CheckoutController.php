<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('katalog')->with('error', 'Keranjang belanja Anda kosong.');
        }

        return view('checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'subdistrict' => 'required|string|max:100',
            'village' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'street' => 'required|string|min:5',
            'payment_method' => 'required|string|in:QRIS,GoPay,BNI,BRI,BSI,CIMB Niaga,Bank Mandiri,Permata Bank',
            'note' => 'nullable|string'
        ], [
            'street.min' => 'Nama jalan dan nomor rumah harus diisi lengkap.'
        ]);

        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('katalog')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $subtotal = 0;
        foreach ($cart->items as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('cart.index')->with('error', 'Maaf, stok ' . $item->product->name . ' tidak mencukupi (sisa ' . $item->product->stock . ').');
            }
            $subtotal += $item->product->price * $item->quantity;
        }

        $shipping_cost = 0; // For now free shipping
        $total_price = $subtotal + $shipping_cost;

        $orderCode = 'ORD-' . strtoupper(Str::random(8));
        
        $fullAddress = "{$request->street}, Kel. {$request->village}, Kec. {$request->subdistrict}, {$request->city}, Prov. {$request->province}, {$request->postal_code}";

        // Initialize Midtrans Snap Integration
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-6nC_P4H9h7Bvx1ZqI-Uj10nJ');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $paymentMapping = [
            'QRIS' => 'qris',
            'GoPay' => 'gopay',
            'BNI' => 'bni_va',
            'BRI' => 'bri_va',
            'BSI' => 'bsi_va',
            'CIMB Niaga' => 'cimb_va',
            'Bank Mandiri' => 'echannel',
            'Permata Bank' => 'permata_va',
        ];

        $enabledPayment = $paymentMapping[$request->payment_method] ?? 'qris';

        $midtransParams = [
            'transaction_details' => [
                'order_id' => $orderCode,
                'gross_amount' => (int) $total_price,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'phone' => $request->customer_phone,
                'email' => auth()->user()->email,
                'shipping_address' => [
                    'first_name' => $request->customer_name,
                    'phone' => $request->customer_phone,
                    'address' => $fullAddress,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'country_code' => 'IDN'
                ]
            ],
            'callbacks' => [
                'finish' => route('katalog'),
                'unfinish' => route('profile.orders'),
                'error' => route('profile.orders')
            ]
        ];

        $snapToken = null;
        try {
            $snapToken = \Midtrans\Snap::getSnapToken($midtransParams);
        } catch (\Exception $e) {
            $snapToken = 'DEMO_TOKEN_' . Str::random(10);
            \Illuminate\Support\Facades\Log::error('Midtrans Snap error: ' . $e->getMessage());
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_code' => $orderCode,
            'status' => 'menunggu',
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $fullAddress,
            'note' => $request->note,
            'subtotal_price' => $subtotal,
            'shipping_cost' => $shipping_cost,
            'total_price' => $total_price,
            'payment_method' => $request->payment_method,
            'snap_token' => $snapToken,
        ]);

        $productListStr = "";

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'subtotal' => $item->product->price * $item->quantity,
            ]);

            // For WhatsApp message
            $productListStr .= "- " . $item->product->name . " (" . $item->quantity . "x)\n";
        }

        // Generate WA message
        $waNumber = \App\Models\Setting::where('key', 'wa_number')->value('value') ?? '62895321313124';
        
        $message = "Saya " . $orderCode . " : " . $order->customer_name . " ingin memesan produk:\n\n";
        $message .= $productListStr . "\n";
        $message .= "Metode Pembayaran: Midtrans (" . $order->payment_method . ")\n";
        $message .= "Alamat Pengiriman:\n";
        $message .= "- Jalan/No: " . $request->street . "\n";
        $message .= "- Kelurahan/Desa: " . $request->village . "\n";
        $message .= "- Kecamatan: " . $request->subdistrict . "\n";
        $message .= "- Kota/Kab: " . $request->city . "\n";
        $message .= "- Provinsi: " . $request->province . "\n";
        $message .= "- Kode Pos: " . $request->postal_code . "\n\n";
        $message .= "Catatan: " . ($order->note ?? '-') . "\n";
        $message .= "Total: Rp " . number_format($total_price, 0, ',', '.') . "\n\n";
        $message .= "Saya memilih pembayaran otomatis melalui Midtrans (" . $order->payment_method . "). Mohon kirimkan link pembayaran / status transaksi.";

        $order->update([
            'whatsapp_message' => $message
        ]);

        // Update product stock before deleting cart items
        foreach ($cart->items as $item) {
            $item->product->decrement('stock', $item->quantity);
        }

        // Clear cart
        $cart->items()->delete();
        $cart->delete();

        auth()->user()->logActivity("Melakukan checkout pesanan: {$orderCode}");

        $waLink = "https://api.whatsapp.com/send?phone=" . $waNumber . "&text=" . urlencode($message);

        return redirect()->route('profile.orders')->with([
            'success' => 'Pesanan Anda berhasil dibuat! Silakan lakukan pembayaran otomatis melalui Midtrans.',
            'pay_snap_token' => $snapToken,
            'wa_link' => $waLink
        ]);
    }
}
