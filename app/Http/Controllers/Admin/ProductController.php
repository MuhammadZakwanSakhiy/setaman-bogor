<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
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
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        $validated['is_active'] = $request->has('is_active');
        $validated['is_best_seller'] = $request->has('is_best_seller');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_url'] = $path;
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
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
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_best_seller'] = $request->has('is_best_seller');
        
        if ($request->name !== $product->name) {
            $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                Storage::disk('public')->delete($product->image_url);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image_url'] = $path;
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
            Storage::disk('public')->delete($product->image_url);
        }
        
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
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
