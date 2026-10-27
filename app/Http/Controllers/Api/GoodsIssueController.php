<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GoodsIssue;
use App\Services\InventoryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GoodsIssueController extends Controller
{
    public function __construct(
        protected InventoryService $inventoryService
    ) {}

    public function index(Request $request): JsonResponse
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

        $perPage = $request->integer('per_page', 15);
        $issues = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $issues,
        ]);
    }

    public function store(Request $request): JsonResponse
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

            return response()->json([
                'success' => true,
                'message' => 'Lập phiếu xuất kho và trừ tồn kho an toàn (Pessimistic Locking).',
                'data' => $issue,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi xuất kho: '.$e->getMessage(),
            ], 422);
        }
    }

    public function show(GoodsIssue $goodsIssue): JsonResponse
    {
        $goodsIssue->load(['user', 'items.product.category']);

        return response()->json([
            'success' => true,
            'data' => $goodsIssue,
        ]);
    }
}
