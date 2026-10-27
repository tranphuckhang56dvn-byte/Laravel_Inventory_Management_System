<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Services\InventoryService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        protected InventoryService $inventoryService
    ) {}

    public function index(Request $request): View
    {
        $query = Product::with(['category', 'supplier']);

        if ($request->filled('keyword')) {
            $kw = $request->keyword;
            $query->where(function ($q) use ($kw) {
                $q->where('name', 'like', "%{$kw}%")
                    ->orWhere('sku', 'like', "%{$kw}%")
                    ->orWhere('barcode', 'like', "%{$kw}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }

        if ($request->filled('stock_status')) {
            if ($request->stock_status === 'low') {
                $query->lowStock();
            } elseif ($request->stock_status === 'out') {
                $query->where('current_stock', '<=', 0);
            } elseif ($request->stock_status === 'in') {
                $query->where('current_stock', '>', 0);
            }
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::where('status', true)->orderBy('name')->get();
        $suppliers = Supplier::where('status', true)->orderBy('name')->get();

        return view('products.index', compact('products', 'categories', 'suppliers'));
    }

    public function create(): View
    {
        $categories = Category::where('status', true)->orderBy('name')->get();
        $suppliers = Supplier::where('status', true)->orderBy('name')->get();

        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'sku' => 'required|string|max:50|unique:products,sku',
            'barcode' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'unit' => 'required|string|max:50',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'current_stock' => 'nullable|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'max_stock' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $validated['status'] = $request->boolean('status', true);
        $validated['current_stock'] = $validated['current_stock'] ?? 0;

        $product = Product::create($validated);

        // Nếu có số tồn ban đầu > 0, ghi nhận initial log
        if ($product->current_stock > 0) {
            $product->inventoryLogs()->create([
                'user_id' => auth()->id(),
                'type' => 'in',
                'reference_type' => 'initial',
                'reference_code' => 'INIT-'.$product->sku,
                'quantity_before' => 0,
                'quantity_change' => $product->current_stock,
                'quantity_after' => $product->current_stock,
                'unit_price' => $product->purchase_price,
                'note' => 'Khởi tạo tồn kho ban đầu khi tạo sản phẩm',
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function show(Product $product): View
    {
        $product->load(['category', 'supplier', 'inventoryLogs.user']);

        return view('products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $categories = Category::where('status', true)->orderBy('name')->get();
        $suppliers = Supplier::where('status', true)->orderBy('name')->get();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'sku' => 'required|string|max:50|unique:products,sku,'.$product->id,
            'barcode' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'unit' => 'required|string|max:50',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'min_stock' => 'required|integer|min:0',
            'max_stock' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $validated['status'] = $request->boolean('status', true);
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->receiptItems()->count() > 0 || $product->issueItems()->count() > 0) {
            return back()->with('error', 'Không thể xóa sản phẩm đã có lịch sử nhập/xuất kho.');
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Đã xóa sản phẩm thành công.');
    }

    public function lowStock(): View
    {
        $products = Product::with(['category', 'supplier'])
            ->lowStock()
            ->orderByRaw('current_stock - min_stock ASC')
            ->paginate(15);

        return view('products.low-stock', compact('products'));
    }

    public function adjustStock(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'new_stock' => 'required|integer|min:0',
            'reason' => 'required|string|max:255',
        ]);

        try {
            $this->inventoryService->adjustStock(
                $product->id,
                $validated['new_stock'],
                $validated['reason'],
                $request->user()
            );

            return back()->with('success', 'Kiểm kê và điều chỉnh tồn kho thành công (Pessimistic Locking)!');
        } catch (Exception $e) {
            return back()->with('error', 'Lỗi kiểm kê: '.$e->getMessage());
        }
    }
}
