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
            $product = \App\Models\Product::find($request->product_id);
            if ($product) {
                auth()->user()->logActivity("Menambahkan {$product->name} ke wishlist");
            }
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
            $productName = $item->product->name ?? 'Produk';
            $item->delete();
            auth()->user()->logActivity("Menghapus {$productName} dari wishlist");
            return back()->with('success', 'Produk dihapus dari wishlist.');
        }

        return back()->with('error', 'Aksi tidak diizinkan.');
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $wishlist = Wishlist::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        $item = WishlistItem::where('wishlist_id', $wishlist->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($item) {
            $productName = $item->product->name ?? 'Produk';
            $item->delete();
            auth()->user()->logActivity("Menghapus {$productName} dari wishlist");
            return response()->json([
                'status' => 'removed',
                'message' => 'Produk dihapus dari wishlist.'
            ]);
        } else {
            WishlistItem::create([
                'wishlist_id' => $wishlist->id,
                'product_id' => $request->product_id
            ]);
            $product = \App\Models\Product::find($request->product_id);
            if ($product) {
                auth()->user()->logActivity("Menambahkan {$product->name} ke wishlist");
            }
            return response()->json([
                'status' => 'added',
                'message' => 'Produk ditambahkan ke wishlist.'
            ]);
        }
    }
}
