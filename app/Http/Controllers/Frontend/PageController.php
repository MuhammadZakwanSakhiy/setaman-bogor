<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Article;

class PageController extends Controller
{
    public function tentang()
    {
        $activeProductsCount = Product::where('is_active', true)->count();
        $activeArticlesCount = Article::where('is_published', true)->count();
        return view('kontak-tentang', compact('activeProductsCount', 'activeArticlesCount'));
    }

    public function kontak()
    {
        $activeProductsCount = Product::where('is_active', true)->count();
        $activeArticlesCount = Article::where('is_published', true)->count();
        return view('kontak-tentang', compact('activeProductsCount', 'activeArticlesCount'));
    }

    public function privasi()
    {
        return view('welcome'); // Placeholder
    }
}
