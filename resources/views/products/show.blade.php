@extends('layouts.app')

@section('title', 'Chi tiết sản phẩm: ' . $product->name)
@section('page_title', 'Thông Tin Chi Tiết Sản Phẩm')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card card-custom p-4 text-center mb-4">
            <div class="d-inline-flex p-3 rounded-circle bg-primary bg-opacity-10 text-primary mb-3 mx-auto">
                <i class="fa-solid fa-box-open fa-3x"></i>
            </div>
            <h5 class="fw-bold text-dark mb-1">{{ $product->name }}</h5>
            <span class="badge bg-light text-secondary border font-monospace mb-3">Mã SKU: {{ $product->sku }}</span>

            <div class="p-3 bg-light rounded-3 mb-3 text-start">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Tồn kho hiện tại:</span>
                    <strong class="fs-5 {{ $product->isLowStock() ? 'text-danger' : 'text-success' }}">
                        {{ $product->current_stock }} {{ $product->unit }}
                    </strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Ngưỡng tối thiểu (min_stock):</span>
                    <span class="fw-semibold text-danger">{{ $product->min_stock }} {{ $product->unit }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Giá vốn nhập:</span>
                    <span class="fw-semibold">{{ number_format($product->purchase_price) }} đ</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Giá xuất bán:</span>
                    <span class="fw-semibold text-primary">{{ number_format($product->selling_price) }} đ</span>
                </div>
            </div>

            @if($product->isLowStock())
                <div class="alert alert-danger py-2 small mb-3">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> Tồn kho đang ở mức cảnh báo!
                </div>
            @endif

            <div class="d-flex gap-2">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary flex-grow-1">
                        <i class="fa-solid fa-pen-to-square me-1"></i> Sửa thông tin
                    </a>
                @endif
                <a href="{{ route('receipts.create') }}" class="btn btn-sm btn-success flex-grow-1">
                    <i class="fa-solid fa-cart-plus me-1"></i> Nhập thêm
                </a>
            </div>
        </div>

        <div class="card card-custom p-4">
            <h6 class="fw-bold mb-3 text-dark">Thông tin bổ sung</h6>
            <ul class="list-unstyled mb-0 small">
                <li class="mb-2 d-flex justify-content-between">
                    <span class="text-muted">Danh mục:</span>
                    <span class="fw-semibold">{{ $product->category->name ?? 'N/A' }}</span>
                </li>
                <li class="mb-2 d-flex justify-content-between">
                    <span class="text-muted">Nhà cung cấp:</span>
                    <span class="fw-semibold">{{ $product->supplier->name ?? 'N/A' }}</span>
                </li>
                <li class="mb-2 d-flex justify-content-between">
                    <span class="text-muted">Mã vạch (Barcode):</span>
                    <span class="font-monospace">{{ $product->barcode ?? 'Chưa cập nhật' }}</span>
                </li>
                <li class="d-flex justify-content-between">
                    <span class="text-muted">Trạng thái:</span>
                    <span class="badge {{ $product->status ? 'bg-success' : 'bg-secondary' }}">
                        {{ $product->status ? 'Đang kinh doanh' : 'Ngừng kinh doanh' }}
                    </span>
                </li>
            </ul>
            @if($product->description)
                <div class="mt-3 pt-3 border-top small text-muted">
                    <strong class="text-dark d-block mb-1">Mô tả:</strong>
                    {{ $product->description }}
                </div>
            @endif
        </div>
    </div>

    <!-- Cột bên phải: Lịch sử biến động của riêng sản phẩm này -->
    <div class="col-lg-8">
        <div class="card card-custom h-100">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-clock-rotate-left text-primary me-2"></i>Lịch sử biến động kho (Audit Log)
                </h6>
                <span class="badge bg-light text-secondary border">{{ $product->inventoryLogs->count() }} giao dịch</span>
            </div>
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Thời gian</th>
                            <th>Mã tham chiếu / Loại</th>
                            <th class="text-center">Trước</th>
                            <th class="text-center">Biến động</th>
                            <th class="text-center">Sau biến động</th>
                            <th>Người thực hiện / Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($product->inventoryLogs as $log)
                            <tr>
                                <td>
                                    <div class="small fw-semibold text-dark">{{ $log->created_at->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $log->created_at->format('H:i:s') }}</small>
                                </td>
                                <td>
                                    @if($log->type === 'in')
                                        <span class="badge badge-subtle-success mb-1 d-inline-block">Nhập kho</span>
                                    @elseif($log->type === 'out')
                                        <span class="badge badge-subtle-danger mb-1 d-inline-block">Xuất kho</span>
                                    @else
                                        <span class="badge badge-subtle-warning mb-1 d-inline-block">Kiểm kê</span>
                                    @endif
                                    <div class="small font-monospace text-primary">{{ $log->reference_code ?? 'N/A' }}</div>
                                </td>
                                <td class="text-center text-muted">{{ $log->quantity_before }}</td>
                                <td class="text-center">
                                    <strong class="{{ $log->quantity_change > 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $log->quantity_change > 0 ? '+'.$log->quantity_change : $log->quantity_change }}
                                    </strong>
                                </td>
                                <td class="text-center fw-bold text-dark">{{ $log->quantity_after }}</td>
                                <td>
                                    <div class="small fw-semibold">{{ $log->user->name ?? 'Hệ thống' }}</div>
                                    <small class="text-muted text-truncate d-block" style="max-width: 200px;">{{ $log->note }}</small>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Chưa có lịch sử biến động cho sản phẩm này.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
