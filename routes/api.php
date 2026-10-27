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
Route::middleware(['auth:sanctum,web'])->group(function () {
    // Auth routes
    Route::prefix('auth')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    // Dashboard & Thống kê
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);

    // Cảnh báo tồn kho thấp
    Route::get('/products/low-stock', [ProductController::class, 'lowStock']);

    // Danh mục dữ liệu - Tra cứu & Kiểm kê (Staff + Admin)
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);
    Route::post('/products/{product}/adjust-stock', [ProductController::class, 'adjustStock']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::get('/suppliers/{supplier}', [SupplierController::class, 'show']);

    // Danh mục dữ liệu - Quyền quản trị cao nhất (Chỉ Quản trị viên - Admin)
    Route::middleware('role:admin')->group(function () {
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{product}', [ProductController::class, 'update']);
        Route::delete('/products/{product}', [ProductController::class, 'destroy']);

        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{category}', [CategoryController::class, 'update']);
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

        Route::post('/suppliers', [SupplierController::class, 'store']);
        Route::put('/suppliers/{supplier}', [SupplierController::class, 'update']);
        Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy']);
    });

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
