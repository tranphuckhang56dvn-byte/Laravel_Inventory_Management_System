<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\GoodsIssueController;
use App\Http\Controllers\Api\GoodsReceiptController;
use App\Http\Controllers\Api\InventoryLogController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RESTful API Routes - Hệ Thống Quản Lý Nhập Xuất Tồn Kho
|--------------------------------------------------------------------------
*/

// Xác thực (Public)
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

// Các API yêu cầu xác thực Sanctum Token
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::prefix('auth')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    // Dashboard & Thống kê
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);

    // Cảnh báo tồn kho thấp
    Route::get('/products/low-stock', [ProductController::class, 'lowStock']);

    // Quản lý sản phẩm
    Route::apiResource('products', ProductController::class);
    Route::post('/products/{product}/adjust-stock', [ProductController::class, 'adjustStock'])
        ->middleware('role:admin'); // Chỉ admin được kiểm kê điều chỉnh tồn kho

    // Quản lý danh mục
    Route::apiResource('categories', CategoryController::class);

    // Quản lý nhà cung cấp
    Route::apiResource('suppliers', SupplierController::class);

    // Phiếu nhập kho (Transaction + Pessimistic Locking)
    Route::get('/goods-receipts', [GoodsReceiptController::class, 'index']);
    Route::post('/goods-receipts', [GoodsReceiptController::class, 'store']);
    Route::get('/goods-receipts/{goodsReceipt}', [GoodsReceiptController::class, 'show']);

    // Phiếu xuất kho (Transaction + Pessimistic Locking + Safe Stock Check)
    Route::get('/goods-issues', [GoodsIssueController::class, 'index']);
    Route::post('/goods-issues', [GoodsIssueController::class, 'store']);
    Route::get('/goods-issues/{goodsIssue}', [GoodsIssueController::class, 'show']);

    // Nhật ký biến động tồn kho (Inventory Audit Log)
    Route::get('/inventory-logs', [InventoryLogController::class, 'index']);
});
