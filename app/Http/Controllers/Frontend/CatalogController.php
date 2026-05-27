<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != '') {
            $categoryParam = $request->category;
            $query->whereHas('category', function($q) use ($categoryParam) {
                $matchingCategories = \App\Models\Category::all()->filter(function($cat) use ($categoryParam) {
                    return \Illuminate\Support\Str::slug($cat->name) === \Illuminate\Support\Str::slug($categoryParam) 
                        || strtolower($cat->name) === strtolower($categoryParam);
                });
                
                if ($matchingCategories->isNotEmpty()) {
                    $q->whereIn('id', $matchingCategories->pluck('id'));
                } else {
                    $q->where('name', 'like', '%' . $categoryParam . '%');
                }
            });
        }

        $products = $query->latest()->paginate(9);
        $categories = Category::all();

        $wishlistProductIds = [];
        if (auth()->check()) {
            $wishlist = \App\Models\Wishlist::where('user_id', auth()->id())->first();
            if ($wishlist) {
                $wishlistProductIds = $wishlist->items()->pluck('product_id')->toArray();
            }
        }

        $allProducts = Product::with('category')->where('is_active', true)->latest()->get();
        $allProductsJson = $allProducts->map(function($product) use ($wishlistProductIds) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'formatted_price' => 'Rp ' . number_format($product->price, 0, ',', '.'),
                'description' => \Illuminate\Support\Str::limit($product->description, 70),
                'stock' => $product->stock,
                'image_url' => \Illuminate\Support\Str::startsWith($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url),
                'detail_url' => route('katalog.show', $product->slug),
                'category_name' => $product->category->name ?? 'Umum',
                'category_slug' => $product->category ? \Illuminate\Support\Str::slug($product->category->name) : 'umum',
                'in_wishlist' => in_array($product->id, $wishlistProductIds),
            ];
        });
        
        return view('katalog', compact('products', 'categories', 'wishlistProductIds', 'allProductsJson'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        $relatedProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $product->id)
                                ->where('is_active', true)
                                ->take(4)
                                ->get();
                                
        return view('detail-produk', compact('product', 'relatedProducts'));
    }
}
