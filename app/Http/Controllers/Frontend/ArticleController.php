<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->where('is_published', true)->orderBy('created_at', 'desc')->paginate(10);
        return view('artikel', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::with('category')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('detail-artikel', compact('article'));
    }
}
