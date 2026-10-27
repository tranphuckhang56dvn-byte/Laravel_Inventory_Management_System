<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GoodsIssue;
use App\Models\GoodsReceipt;
use App\Models\InventoryLog;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('current_stock');
        $totalStockValue = Product::selectRaw('SUM(current_stock * purchase_price) as value')->value('value') ?? 0;
        $lowStockCount = Product::lowStock()->count();

        $startOfMonth = Carbon::now()->startOfMonth();
        $monthlyReceiptsCount = GoodsReceipt::where('receipt_date', '>=', $startOfMonth)->count();
        $monthlyReceiptsValue = GoodsReceipt::where('receipt_date', '>=', $startOfMonth)->sum('total_amount');

        $monthlyIssuesCount = GoodsIssue::where('issue_date', '>=', $startOfMonth)->count();
        $monthlyIssuesValue = GoodsIssue::where('issue_date', '>=', $startOfMonth)->sum('total_amount');

        // Top 6 sản phẩm cảnh báo tồn kho thấp nhất
        $lowStockProducts = Product::with(['category', 'supplier'])
            ->lowStock()
            ->orderByRaw('current_stock - min_stock ASC')
            ->take(6)
            ->get();

        // 6 tháng gần nhất cho biểu đồ doanh số nhập/xuất
        $chartLabels = [];
        $chartReceipts = [];
        $chartIssues = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $chartLabels[] = 'Tháng '.$month->format('m/Y');

            $mStart = $month->copy()->startOfMonth()->toDateString();
            $mEnd = $month->copy()->endOfMonth()->toDateString();

            $chartReceipts[] = (float) GoodsReceipt::whereBetween('receipt_date', [$mStart, $mEnd])->sum('total_amount');
            $chartIssues[] = (float) GoodsIssue::whereBetween('issue_date', [$mStart, $mEnd])->sum('total_amount');
        }

        // Cơ cấu sản phẩm theo danh mục
        $categories = Category::withCount('products')
            ->having('products_count', '>', 0)
            ->get();

        $catLabels = $categories->pluck('name')->toArray();
        $catData = $categories->pluck('products_count')->toArray();

        // 8 biến động kho gần đây nhất
        $recentLogs = InventoryLog::with(['product', 'user'])
            ->latest('id')
            ->take(8)
            ->get();

        return view('dashboard.index', compact(
            'totalProducts',
            'totalStock',
            'totalStockValue',
            'lowStockCount',
            'monthlyReceiptsCount',
            'monthlyReceiptsValue',
            'monthlyIssuesCount',
            'monthlyIssuesValue',
            'lowStockProducts',
            'chartLabels',
            'chartReceipts',
            'chartIssues',
            'catLabels',
            'catData',
            'recentLogs'
        ));
    }
}
