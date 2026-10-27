<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GoodsReceipt;
use App\Services\InventoryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GoodsReceiptController extends Controller
{
    public function __construct(
        protected InventoryService $inventoryService
    ) {}

    public function index(Request $request): JsonResponse
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

        $perPage = $request->integer('per_page', 15);
        $receipts = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $receipts,
        ]);
    }

    public function store(Request $request): JsonResponse
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

            return response()->json([
                'success' => true,
                'message' => 'Lập phiếu nhập kho và cập nhật tồn kho thành công (Transaction + Pessimistic Locking).',
                'data' => $receipt,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi nhập kho: '.$e->getMessage(),
            ], 422);
        }
    }

    public function show(GoodsReceipt $goodsReceipt): JsonResponse
    {
        $goodsReceipt->load(['supplier', 'user', 'items.product.category']);

        return response()->json([
            'success' => true,
            'data' => $goodsReceipt,
        ]);
    }
}
