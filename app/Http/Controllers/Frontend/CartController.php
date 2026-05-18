<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')->firstOrCreate([
            'user_id' => auth()->id()
        ]);

        return view('keranjang', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
            'action' => 'nullable|string'
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        $quantity = $request->quantity ?? 1;

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        $currentQty = $cartItem ? $cartItem->quantity : 0;
        
        if (($currentQty + $quantity) > $product->stock) {
            return back()->with('error', 'Stok tidak mencukupi. Sisa stok: ' . $product->stock);
        }

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $quantity
            ]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $quantity
            ]);
        }

        if ($request->action == 'checkout') {
            return redirect()->route('checkout.index');
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
            'action' => 'required|in:increment,decrement'
        ]);

        $item = CartItem::findOrFail($request->item_id);
        
        if ($item->cart->user_id === auth()->id()) {
            if ($request->action == 'increment') {
                if ($item->quantity + 1 > $item->product->stock) {
                    return back()->with('error', 'Stok tidak mencukupi.');
                }
                $item->increment('quantity');
            } else {
                if ($item->quantity > 1) {
                    $item->decrement('quantity');
                } else {
                    $item->delete();
                }
            }
            return back();
        }

        return back()->with('error', 'Aksi tidak diizinkan.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id'
        ]);

        $item = CartItem::findOrFail($request->item_id);
        
        if ($item->cart->user_id === auth()->id()) {
            $item->delete();
            return back()->with('success', 'Produk dihapus dari keranjang.');
        }

        return back()->with('error', 'Aksi tidak diizinkan.');
    }
}
