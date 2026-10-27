<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\GoodsReceipt;
use App\Models\Product;
use App\Models\Supplier;
use App\Services\InventoryService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GoodsReceiptController extends Controller
{
    public function __construct(
        protected InventoryService $inventoryService
    ) {}

    public function index(Request $request): View
    {
        $query = GoodsReceipt::with(['supplier', 'user', 'items.product']);

        if ($request->filled('keyword')) {
            $kw = $request->keyword;
            $query->where('code', 'like', "%{$kw}%");
        }

        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('receipt_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('receipt_date', '<=', $request->to_date);
        }

        $receipts = $query->latest()->paginate(10)->withQueryString();
        $suppliers = Supplier::where('status', true)->get();

        return view('receipts.index', compact('receipts', 'suppliers'));
    }

    public function create(): View
    {
        $suppliers = Supplier::where('status', true)->orderBy('name')->get();
        $products = Product::where('status', true)->orderBy('name')->get();
        $suggestedCode = $this->inventoryService->generateReceiptCode();

        return view('receipts.create', compact('suppliers', 'products', 'suggestedCode'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'nullable|string|max:50|unique:goods_receipts,code',
            'supplier_id' => 'required|exists:suppliers,id',
            'receipt_date' => 'required|date',
            'note' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'nullable|numeric|min:0',
            'items.*.note' => 'nullable|string|max:255',
        ]);

        try {
            $receipt = $this->inventoryService->createReceipt($validated, $request->user());

            return redirect()->route('receipts.show', $receipt)
                ->with('success', 'Nhập kho thành công! Đã cập nhật số lượng tồn kho (Database Transaction + Pessimistic Locking).');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Lỗi nhập kho: '.$e->getMessage());
        }
    }

    public function show(GoodsReceipt $receipt): View
    {
        $receipt->load(['supplier', 'user', 'items.product.category']);

        return view('receipts.show', compact('receipt'));
    }
}
