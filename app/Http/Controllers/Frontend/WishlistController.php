<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\WishlistItem;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::with('items.product.category')->firstOrCreate([
            'user_id' => auth()->id()
        ]);

        return view('wishlist', compact('wishlist'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $wishlist = Wishlist::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        // Check if item already exists
        $exists = WishlistItem::where('wishlist_id', $wishlist->id)
            ->where('product_id', $request->product_id)
            ->exists();

        if (!$exists) {
            WishlistItem::create([
                'wishlist_id' => $wishlist->id,
                'product_id' => $request->product_id
            ]);
            return back()->with('success', 'Produk berhasil ditambahkan ke wishlist.');
        }

        return back()->with('info', 'Produk sudah ada di wishlist Anda.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:wishlist_items,id'
        ]);

        $item = WishlistItem::findOrFail($request->item_id);
        
        // Ensure the item belongs to the user
        if ($item->wishlist->user_id === auth()->id()) {
            $item->delete();
            return back()->with('success', 'Produk dihapus dari wishlist.');
        }

        return back()->with('error', 'Aksi tidak diizinkan.');
    }
}
