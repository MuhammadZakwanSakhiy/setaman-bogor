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
            'customer_address' => 'required|string|min:10',
            'note' => 'nullable|string'
        ], [
            'customer_address.min' => 'Alamat pengiriman harus detail.'
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

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_code' => $orderCode,
            'status' => 'pending',
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'note' => $request->note,
            'subtotal_price' => $subtotal,
            'shipping_cost' => $shipping_cost,
            'total_price' => $total_price,
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
        $message .= "Catatan: " . ($order->note ?? '-') . "\n";
        $message .= "Total: Rp " . number_format($total_price, 0, ',', '.') . "\n\n";
        $message .= "berikut adalah bukti pembayarannya.";

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
            'success' => 'Pesanan Anda berhasil dibuat! Silakan kirimkan pesan konfirmasi di WhatsApp yang baru terbuka.',
            'wa_link' => $waLink
        ]);
    }
}
