<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('category')->where('is_published', true);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('artikel', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::with('category')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        
        if (auth()->check()) {
            auth()->user()->logActivity("Membaca artikel: {$article->title}");
        }

        return view('detail-artikel', compact('article'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        \Illuminate\Support\Facades\Mail::raw("Halo! Terima kasih telah berlangganan newsletter Setaman Bogor. Anda akan menerima informasi terbaru mengenai tips perawatan tanaman dan promo katalog kami.", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Terima Kasih Telah Berlangganan Newsletter Setaman Bogor');
        });

        if (auth()->check()) {
            auth()->user()->logActivity("Berlangganan buletin/newsletter email");
        }

        return back()->with('success_subscription', 'Terima kasih! Anda berhasil berlangganan newsletter Setaman Bogor.');
    }
}
