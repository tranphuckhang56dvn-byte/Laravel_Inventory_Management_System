<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GoodsIssue;
use App\Models\GoodsReceipt;
use App\Models\InventoryLog;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function stats(): JsonResponse
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

        // Top 5 sản phẩm cảnh báo tồn kho thấp nhất
        $lowStockProducts = Product::with('category')
            ->lowStock()
            ->orderByRaw('current_stock - min_stock ASC')
            ->take(5)
            ->get();

        // Thống kê 6 tháng gần nhất cho Chart.js
        $months = [];
        $receiptsData = [];
        $issuesData = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthStr = $month->format('m/Y');
            $months[] = $monthStr;

            $mStart = $month->copy()->startOfMonth()->toDateString();
            $mEnd = $month->copy()->endOfMonth()->toDateString();

            $receiptsData[] = (float) GoodsReceipt::whereBetween('receipt_date', [$mStart, $mEnd])->sum('total_amount');
            $issuesData[] = (float) GoodsIssue::whereBetween('issue_date', [$mStart, $mEnd])->sum('total_amount');
        }

        // Cơ cấu danh mục
        $categoryBreakdown = Category::withCount('products')
            ->having('products_count', '>', 0)
            ->get()
            ->map(fn ($cat) => [
                'name' => $cat->name,
                'count' => $cat->products_count,
            ]);

        // 5 giao dịch biến động gần nhất
        $recentLogs = InventoryLog::with(['product', 'user'])
            ->latest('id')
            ->take(6)
            ->get();

        return response()->json([
            'success' => true,
            'summary' => [
                'total_products' => $totalProducts,
                'total_stock' => $totalStock,
                'total_stock_value' => (float) $totalStockValue,
                'low_stock_count' => $lowStockCount,
                'monthly_receipts_count' => $monthlyReceiptsCount,
                'monthly_receipts_value' => (float) $monthlyReceiptsValue,
                'monthly_issues_count' => $monthlyIssuesCount,
                'monthly_issues_value' => (float) $monthlyIssuesValue,
            ],
            'charts' => [
                'months' => $months,
                'receipts_value' => $receiptsData,
                'issues_value' => $issuesData,
                'categories' => $categoryBreakdown,
            ],
            'low_stock_alerts' => $lowStockProducts,
            'recent_logs' => $recentLogs,
        ]);
    }
}
