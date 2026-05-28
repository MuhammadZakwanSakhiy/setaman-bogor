<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|gt:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'care_tips' => 'nullable|string',
            'is_active' => 'boolean',
            'is_best_seller' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        $validated['is_active'] = $request->has('is_active');
        $validated['is_best_seller'] = $request->has('is_best_seller');

        // Create product first
        $product = Product::create($validated);

        // Process main image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $pImg = ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $path,
                'sort_order' => 0
            ]);
            $product->update(['image_id' => $pImg->id]);
        }

        // Process additional images
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $index => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $path,
                    'sort_order' => $index + 1
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|gt:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'care_tips' => 'nullable|string',
            'is_active' => 'boolean',
            'is_best_seller' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_best_seller'] = $request->has('is_best_seller');
        
        if ($request->name !== $product->name) {
            $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        }

        $product->update($validated);

        // Process new main image
        if ($request->hasFile('image')) {
            // Delete old primary image if exists
            $oldPrimary = $product->primaryImage;
            
            $path = $request->file('image')->store('products', 'public');
            $pImg = ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $path,
                'sort_order' => 0
            ]);
            $product->update(['image_id' => $pImg->id]);

            if ($oldPrimary) {
                if (Storage::disk('public')->exists($oldPrimary->image_url)) {
                    Storage::disk('public')->delete($oldPrimary->image_url);
                }
                $oldPrimary->delete();
            }
        }

        // Process new additional images
        if ($request->hasFile('additional_images')) {
            $maxSort = $product->images()->max('sort_order') ?? 0;
            foreach ($request->file('additional_images') as $index => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $path,
                    'sort_order' => $maxSort + $index + 1
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        // Delete all associated images
        foreach ($product->images as $img) {
            if (Storage::disk('public')->exists($img->image_url)) {
                Storage::disk('public')->delete($img->image_url);
            }
            $img->delete();
        }
        
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function deleteImage(ProductImage $image)
    {
        $product = $image->product;
        
        // If this image is the primary image, nullify image_id on product
        if ($product && $product->image_id === $image->id) {
            // Find another image to set as primary, if any
            $nextImage = $product->images()->where('id', '!=', $image->id)->first();
            $product->update(['image_id' => $nextImage ? $nextImage->id : null]);
        }

        if (Storage::disk('public')->exists($image->image_url)) {
            Storage::disk('public')->delete($image->image_url);
        }

        $image->delete();

        return back()->with('success', 'Foto tambahan berhasil dihapus.');
    }

    public function export()
    {
        $products = Product::with('category')->get();

        if ($products->isEmpty()) {
            return back()->with('error', 'Tidak ada data untuk di-export.');
        }

        $filename = "products-export-" . date('Y-m-d') . ".csv";

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = ['ID', 'Kategori', 'Nama Produk', 'Slug', 'Harga', 'Stok', 'Status', 'Best Seller'];

        $callback = function() use($products, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($products as $product) {
                $row['ID']  = $product->id;
                $row['Kategori'] = $product->category->name ?? 'N/A';
                $row['Nama Produk'] = $product->name;
                $row['Slug']  = $product->slug;
                $row['Harga']  = $product->price;
                $row['Stok']  = $product->stock;
                $row['Status']  = $product->is_active ? 'Aktif' : 'Nonaktif';
                $row['Best Seller']  = $product->is_best_seller ? 'Ya' : 'Tidak';

                fputcsv($file, array($row['ID'], $row['Kategori'], $row['Nama Produk'], $row['Slug'], $row['Harga'], $row['Stok'], $row['Status'], $row['Best Seller']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
