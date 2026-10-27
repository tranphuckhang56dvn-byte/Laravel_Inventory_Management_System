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

    // Danh mục dữ liệu - Tra cứu & Kiểm kê (Staff + Admin)
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products/{product}/adjust-stock', [ProductController::class, 'adjustStock'])->name('products.adjust-stock');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');

    // Danh mục dữ liệu - Quyền quản trị cao nhất (Chỉ Quản trị viên - Admin)
    Route::middleware('role:admin')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
        Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
        Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

        Route::resource('users', UserController::class)->except(['create', 'edit', 'show']);
    });

    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Quản lý Nhập kho (Transaction + Pessimistic Locking)
    Route::resource('receipts', GoodsReceiptController::class)->only(['index', 'create', 'store', 'show']);

    // Quản lý Xuất kho (Transaction + Pessimistic Locking)
    Route::resource('issues', GoodsIssueController::class)->only(['index', 'create', 'store', 'show']);

    // Nhật ký biến động tồn kho (Inventory Audit Log)
    Route::get('/inventory/logs', [InventoryLogController::class, 'index'])->name('inventory.logs');

    // Tài liệu API trực quan
    Route::get('/docs/api', [ApiDocsController::class, 'index'])->name('docs.api');
});
