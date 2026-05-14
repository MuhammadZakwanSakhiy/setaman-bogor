<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Product;
use App\Models\Order;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic counts
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalArticles = Article::count();
        $totalCategories = ArticleCategory::count();

        // Low stock products (stock < 5)
        $lowStockProducts = Product::where('stock', '<', 5)->get();
        $lowStockCount = $lowStockProducts->count();

        // Recent orders (latest 5)
        $recentOrders = Order::latest()->take(5)->with(['user'])->get();

        // Sales per month for current year (placeholder for chart)
        $salesPerMonth = Order::select(
                DB::raw("EXTRACT(MONTH FROM created_at) as month"),
                DB::raw('SUM(total_price) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalArticles',
            'totalCategories',
            'lowStockCount',
            'lowStockProducts',
            'recentOrders',
            'salesPerMonth'
        ));
    }
}
