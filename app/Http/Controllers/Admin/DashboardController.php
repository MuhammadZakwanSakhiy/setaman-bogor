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
        $driver = DB::getDriverName();
        if ($driver === 'sqlite') {
            $monthExpr = "CAST(strftime('%m', created_at) AS INTEGER)";
            $groupByExpr = "strftime('%m', created_at)";
        } else {
            $monthExpr = "EXTRACT(MONTH FROM created_at)";
            $groupByExpr = "EXTRACT(MONTH FROM created_at)";
        }

        $salesPerMonth = Order::select(
                DB::raw("$monthExpr as month"),
                DB::raw('SUM(total_price) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw($groupByExpr))
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Weekly sales for the current month (driver-agnostic via PHP grouping)
        $currentMonthOrders = Order::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->get();
        $weeklySales = [0, 0, 0, 0];
        foreach ($currentMonthOrders as $order) {
            $day = $order->created_at->day;
            if ($day <= 7) {
                $weeklySales[0] += $order->total_price;
            } elseif ($day <= 14) {
                $weeklySales[1] += $order->total_price;
            } elseif ($day <= 21) {
                $weeklySales[2] += $order->total_price;
            } else {
                $weeklySales[3] += $order->total_price;
            }
        }

        $monthlySalesData = array_values(array_replace(array_fill(1, 12, 0), $salesPerMonth));

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalArticles',
            'totalCategories',
            'lowStockCount',
            'lowStockProducts',
            'recentOrders',
            'salesPerMonth',
            'monthlySalesData',
            'weeklySales'
        ));
    }
}
