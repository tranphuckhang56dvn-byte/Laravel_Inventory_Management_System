<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\GoodsIssue;
use App\Models\Product;
use App\Services\InventoryService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GoodsIssueController extends Controller
{
    public function __construct(
        protected InventoryService $inventoryService
    ) {}

    public function index(Request $request): View
    {
        $query = GoodsIssue::with(['user', 'items.product']);

        if ($request->filled('keyword')) {
            $kw = $request->keyword;
            $query->where(function ($q) use ($kw) {
                $q->where('code', 'like', "%{$kw}%")
                    ->orWhere('customer_name', 'like', "%{$kw}%");
            });
        }

        if ($request->filled('reason')) {
            $query->where('reason', $request->reason);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('issue_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('issue_date', '<=', $request->to_date);
        }

        $issues = $query->latest()->paginate(10)->withQueryString();

        return view('issues.index', compact('issues'));
    }

    public function create(): View
    {
        $products = Product::where('status', true)->where('current_stock', '>', 0)->orderBy('name')->get();
        $suggestedCode = $this->inventoryService->generateIssueCode();

        return view('issues.create', compact('products', 'suggestedCode'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'nullable|string|max:50|unique:goods_issues,code',
            'customer_name' => 'nullable|string|max:255',
            'issue_date' => 'required|date',
            'reason' => 'required|string|max:100',
            'note' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'nullable|numeric|min:0',
            'items.*.note' => 'nullable|string|max:255',
        ]);

        try {
            $issue = $this->inventoryService->createIssue($validated, $request->user());

            return redirect()->route('issues.show', $issue)
                ->with('success', 'Xuất kho thành công! Đã trừ tồn kho an toàn (Database Transaction + Pessimistic Locking).');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Lỗi xuất kho: '.$e->getMessage());
        }
    }

    public function show(GoodsIssue $issue): View
    {
        $issue->load(['user', 'items.product.category']);

        return view('issues.show', compact('issue'));
    }
}
