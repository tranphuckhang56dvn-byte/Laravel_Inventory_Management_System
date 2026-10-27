<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\InventoryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected InventoryService $inventoryService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $query = Product::with(['category', 'supplier']);

        // Tìm kiếm theo tên, mã SKU, mã vạch
        if ($request->filled('keyword')) {
            $kw = $request->keyword;
            $query->where(function ($q) use ($kw) {
                $q->where('name', 'like', "%{$kw}%")
                    ->orWhere('sku', 'like', "%{$kw}%")
                    ->orWhere('barcode', 'like', "%{$kw}%");
            });
        }

        // Lọc danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Lọc nhà cung cấp
        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }

        // Lọc cảnh báo tồn kho thấp
        if ($request->boolean('low_stock')) {
            $query->lowStock();
        }

        $perPage = $request->integer('per_page', 15);
        $products = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function store(Request $request): JsonResponse
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

        $product = Product::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tạo sản phẩm thành công.',
            'data' => $product->load(['category', 'supplier']),
        ], 201);
    }

    public function show(Product $product): JsonResponse
    {
        $product->load(['category', 'supplier', 'inventoryLogs' => fn ($q) => $q->take(20)]);

        return response()->json([
            'success' => true,
            'data' => $product,
        ]);
    }

    public function update(Request $request, Product $product): JsonResponse
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

        $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật sản phẩm thành công.',
            'data' => $product->load(['category', 'supplier']),
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        if ($product->receiptItems()->count() > 0 || $product->issueItems()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa sản phẩm đã có lịch sử nhập/xuất kho.',
            ], 422);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa sản phẩm thành công.',
        ]);
    }

    /**
     * Danh sách sản phẩm sắp hết hàng (cảnh báo tồn kho dưới ngưỡng min_stock)
     */
    public function lowStock(): JsonResponse
    {
        $products = Product::with(['category', 'supplier'])
            ->lowStock()
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'count' => $products->count(),
            'data' => $products,
        ]);
    }

    /**
     * Điều chỉnh / Kiểm kê kho
     */
    public function adjustStock(Request $request, Product $product): JsonResponse
    {
        $validated = $request->validate([
            'new_stock' => 'required|integer|min:0',
            'reason' => 'required|string|max:255',
        ]);

        try {
            $log = $this->inventoryService->adjustStock(
                $product->id,
                $validated['new_stock'],
                $validated['reason'],
                $request->user()
            );

            return response()->json([
                'success' => true,
                'message' => 'Điều chỉnh tồn kho thành công.',
                'log' => $log,
                'product' => $product->fresh(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi điều chỉnh tồn kho: '.$e->getMessage(),
            ], 500);
        }
    }
}
