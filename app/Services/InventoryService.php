<?php

namespace App\Services;

use App\Models\GoodsIssue;
use App\Models\GoodsIssueItem;
use App\Models\GoodsReceipt;
use App\Models\GoodsReceiptItem;
use App\Models\InventoryLog;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    /**
     * Tạo mã phiếu tự động
     */
    public function generateReceiptCode(): string
    {
        $prefix = 'PN-'.date('Ymd').'-';
        $latest = GoodsReceipt::where('code', 'like', $prefix.'%')->latest('id')->first();
        $number = 1;

        if ($latest) {
            $parts = explode('-', $latest->code);
            $number = intval(end($parts)) + 1;
        }

        return $prefix.str_pad((string) $number, 4, '0', STR_PAD_LEFT);
    }

    public function generateIssueCode(): string
    {
        $prefix = 'PX-'.date('Ymd').'-';
        $latest = GoodsIssue::where('code', 'like', $prefix.'%')->latest('id')->first();
        $number = 1;

        if ($latest) {
            $parts = explode('-', $latest->code);
            $number = intval(end($parts)) + 1;
        }

        return $prefix.str_pad((string) $number, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Nhập kho với Database Transaction & Pessimistic Locking (lockForUpdate)
     *
     * @param  array  $data  ['supplier_id', 'receipt_date', 'note', 'items' => [['product_id', 'quantity', 'unit_price', 'note']]]
     *
     * @throws Exception
     */
    public function createReceipt(array $data, User $user): GoodsReceipt
    {
        return DB::transaction(function () use ($data, $user) {
            $code = $data['code'] ?? $this->generateReceiptCode();
            $totalAmount = 0;

            $receipt = GoodsReceipt::create([
                'code' => $code,
                'supplier_id' => $data['supplier_id'],
                'user_id' => $user->id,
                'receipt_date' => $data['receipt_date'] ?? date('Y-m-d'),
                'status' => 'completed',
                'note' => $data['note'] ?? null,
                'total_amount' => 0,
            ]);

            foreach ($data['items'] as $item) {
                // Pessimistic Locking: Khóa hàng để cập nhật an toàn tránh race condition
                $product = Product::where('id', $item['product_id'])->lockForUpdate()->firstOrFail();

                $quantity = intval($item['quantity']);
                $unitPrice = floatval($item['unit_price'] ?? $product->purchase_price);
                $totalPrice = $quantity * $unitPrice;
                $totalAmount += $totalPrice;

                // Lưu chi tiết phiếu nhập
                GoodsReceiptItem::create([
                    'goods_receipt_id' => $receipt->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'note' => $item['note'] ?? null,
                ]);

                // Tính toán số lượng tồn
                $before = $product->current_stock;
                $after = $before + $quantity;

                // Cập nhật tồn kho sản phẩm & giá nhập gần nhất
                $product->current_stock = $after;
                if ($unitPrice > 0) {
                    $product->purchase_price = $unitPrice;
                }
                $product->save();

                // Lưu Audit Log biến động tồn kho
                InventoryLog::create([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                    'type' => 'in',
                    'reference_type' => 'receipt',
                    'reference_id' => $receipt->id,
                    'reference_code' => $receipt->code,
                    'quantity_before' => $before,
                    'quantity_change' => $quantity,
                    'quantity_after' => $after,
                    'unit_price' => $unitPrice,
                    'note' => 'Nhập kho theo phiếu '.$receipt->code.(!empty($item['note']) ? ' ('.$item['note'].')' : ''),
                ]);
            }

            $receipt->update(['total_amount' => $totalAmount]);

            return $receipt->fresh(['supplier', 'user', 'items.product']);
        });
    }

    /**
     * Xuất kho với Database Transaction & Pessimistic Locking (lockForUpdate)
     * Kiểm tra tồn kho nghiêm ngặt, ngăn chặn âm kho khi giao dịch đồng thời
     *
     * @param  array  $data  ['customer_name', 'issue_date', 'reason', 'note', 'items' => [['product_id', 'quantity', 'unit_price', 'note']]]
     *
     * @throws Exception
     */
    public function createIssue(array $data, User $user): GoodsIssue
    {
        return DB::transaction(function () use ($data, $user) {
            $code = $data['code'] ?? $this->generateIssueCode();
            $totalAmount = 0;

            $issue = GoodsIssue::create([
                'code' => $code,
                'customer_name' => $data['customer_name'] ?? 'Khách lẻ',
                'user_id' => $user->id,
                'issue_date' => $data['issue_date'] ?? date('Y-m-d'),
                'status' => 'completed',
                'reason' => $data['reason'] ?? 'Xuất bán',
                'note' => $data['note'] ?? null,
                'total_amount' => 0,
            ]);

            foreach ($data['items'] as $item) {
                // Pessimistic Locking: Khóa sản phẩm để kiểm tra và trừ tồn kho
                $product = Product::where('id', $item['product_id'])->lockForUpdate()->firstOrFail();

                $quantity = intval($item['quantity']);
                $unitPrice = floatval($item['unit_price'] ?? $product->selling_price);

                // Kiểm tra điều kiện tồn kho an toàn
                if ($product->current_stock < $quantity) {
                    throw new Exception("Sản phẩm '{$product->name}' (Mã: {$product->sku}) không đủ tồn kho để xuất. Tồn hiện tại: {$product->current_stock}, Yêu cầu xuất: {$quantity}.");
                }

                $totalPrice = $quantity * $unitPrice;
                $totalAmount += $totalPrice;

                // Lưu chi tiết phiếu xuất
                GoodsIssueItem::create([
                    'goods_issue_id' => $issue->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'note' => $item['note'] ?? null,
                ]);

                // Trừ tồn kho
                $before = $product->current_stock;
                $after = $before - $quantity;

                $product->current_stock = $after;
                $product->save();

                // Lưu Audit Log
                InventoryLog::create([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                    'type' => 'out',
                    'reference_type' => 'issue',
                    'reference_id' => $issue->id,
                    'reference_code' => $issue->code,
                    'quantity_before' => $before,
                    'quantity_change' => -$quantity,
                    'quantity_after' => $after,
                    'unit_price' => $unitPrice,
                    'note' => 'Xuất kho theo phiếu '.$issue->code.' ('.$issue->reason.')',
                ]);
            }

            $issue->update(['total_amount' => $totalAmount]);

            return $issue->fresh(['user', 'items.product']);
        });
    }

    /**
     * Điều chỉnh/Kiểm kê kho với Pessimistic Locking
     */
    public function adjustStock(int $productId, int $newStock, string $reason, User $user): InventoryLog
    {
        return DB::transaction(function () use ($productId, $newStock, $reason, $user) {
            $product = Product::where('id', $productId)->lockForUpdate()->firstOrFail();

            $before = $product->current_stock;
            $diff = $newStock - $before;

            $product->current_stock = $newStock;
            $product->save();

            return InventoryLog::create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'type' => 'adjust',
                'reference_type' => 'adjustment',
                'reference_id' => null,
                'reference_code' => 'ADJ-'.date('Ymd-His'),
                'quantity_before' => $before,
                'quantity_change' => $diff,
                'quantity_after' => $newStock,
                'unit_price' => $product->purchase_price,
                'note' => 'Kiểm kê / điều chỉnh kho: '.$reason,
            ]);
        });
    }
}
