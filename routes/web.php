<?php

use App\Http\Controllers\Web\ApiDocsController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\GoodsIssueController;
use App\Http\Controllers\Web\GoodsReceiptController;
use App\Http\Controllers\Web\InventoryLogController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\SupplierController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Hệ Thống Quản Lý Nhập Xuất Tồn Kho
|--------------------------------------------------------------------------
*/

// Chuyển hướng trang chủ
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Xác thực Web (Khách)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Các tuyến đường yêu cầu đăng nhập
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard & Thống kê
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Cảnh báo tồn kho dưới ngưỡng an toàn
    Route::get('/products/low-stock', [ProductController::class, 'lowStock'])->name('products.low-stock');

    // Điều chỉnh / Kiểm kê kho
    Route::post('/products/{product}/adjust-stock', [ProductController::class, 'adjustStock'])->name('products.adjust-stock');

    // Quản lý sản phẩm (Staff + Admin)
    Route::resource('products', ProductController::class);

    // Quản lý danh mục
    Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'show']);

    // Quản lý nhà cung cấp
    Route::resource('suppliers', SupplierController::class)->except(['create', 'edit', 'show']);

    // Quản lý Nhập kho (Transaction + Pessimistic Locking)
    Route::resource('receipts', GoodsReceiptController::class)->only(['index', 'create', 'store', 'show']);

    // Quản lý Xuất kho (Transaction + Pessimistic Locking)
    Route::resource('issues', GoodsIssueController::class)->only(['index', 'create', 'store', 'show']);

    // Nhật ký biến động tồn kho (Inventory Audit Log)
    Route::get('/inventory/logs', [InventoryLogController::class, 'index'])->name('inventory.logs');

    // Quản trị viên (Chỉ Admin mới có quyền truy cập quản lý người dùng & phân quyền RBAC)
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->except(['create', 'edit', 'show']);
    });

    // Tài liệu API trực quan
    Route::get('/docs/api', [ApiDocsController::class, 'index'])->name('docs.api');
});
