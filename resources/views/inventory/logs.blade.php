@extends('layouts.app')

@section('title', 'Nhật ký biến động tồn kho')
@section('page_title', 'Nhật Ký Biến Động Kho (Inventory Audit Log)')

@section('content')
<div class="card card-custom mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('inventory.logs') }}" class="row g-2 align-items-center">
            <div class="col-md-3">
                <select name="product_id" class="form-select">
                    <option value="">-- Tất cả sản phẩm --</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}" {{ request('product_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->sku }} - {{ $p->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="type" class="form-select">
                    <option value="">-- Loại biến động --</option>
                    <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>Nhập kho (+)</option>
                    <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>Xuất kho (-)</option>
                    <option value="adjust" {{ request('type') == 'adjust' ? 'selected' : '' }}>Kiểm kê / Điều chỉnh</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="user_id" class="form-select">
                    <option value="">-- Người thực hiện --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>
                            {{ $u->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="from_date" class="form-control" title="Từ ngày" value="{{ request('from_date') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="to_date" class="form-control" title="Đến ngày" value="{{ request('to_date') }}">
            </div>
            <div class="col-md-1 d-flex gap-1">
                <button type="submit" class="btn btn-primary w-100" title="Lọc"><i class="fa-solid fa-filter"></i></button>
                @if(request()->hasAny(['product_id', 'type', 'user_id', 'from_date', 'to_date']))
                    <a href="{{ route('inventory.logs') }}" class="btn btn-outline-secondary" title="Xóa lọc"><i class="fa-solid fa-rotate-left"></i></a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card card-custom">
    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold mb-0 text-dark">
                <i class="fa-solid fa-clock-rotate-left text-primary me-2"></i>Tổng số {{ $logs->total() }} bản ghi kiểm toán tồn kho
            </h6>
        </div>
        <span class="badge bg-light text-secondary border">Tự động ghi nhận khi có Transaction</span>
    </div>
    <div class="table-responsive">
        <table class="table table-custom align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 150px;">Thời gian</th>
                    <th style="width: 140px;">Mã chứng từ</th>
                    <th>Sản phẩm / Mặt hàng</th>
                    <th style="width: 120px;" class="text-center">Loại giao dịch</th>
                    <th style="width: 90px;" class="text-center">Tồn trước</th>
                    <th style="width: 110px;" class="text-center">Biến động</th>
                    <th style="width: 90px;" class="text-center">Tồn sau</th>
                    <th>Người lập & Lý do chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>
                            <div class="small fw-semibold text-dark">{{ $log->created_at->format('d/m/Y') }}</div>
                            <small class="text-muted">{{ $log->created_at->format('H:i:s') }}</small>
                        </td>
                        <td>
                            <span class="font-monospace text-primary fw-bold">{{ $log->reference_code ?? 'N/A' }}</span>
                            <div class="text-muted" style="font-size: 0.7rem;">Loại: {{ $log->reference_type }}</div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $log->product->name ?? 'Sản phẩm đã xóa' }}</div>
                            <small class="text-muted font-monospace">SKU: {{ $log->product->sku ?? 'N/A' }}</small>
                        </td>
                        <td class="text-center">
                            @if($log->type === 'in')
                                <span class="badge badge-subtle-success px-2 py-1">
                                    <i class="fa-solid fa-arrow-down me-1"></i>Nhập kho
                                </span>
                            @elseif($log->type === 'out')
                                <span class="badge badge-subtle-danger px-2 py-1">
                                    <i class="fa-solid fa-arrow-up me-1"></i>Xuất kho
                                </span>
                            @else
                                <span class="badge badge-subtle-warning px-2 py-1">
                                    <i class="fa-solid fa-sliders me-1"></i>Kiểm kê
                                </span>
                            @endif
                        </td>
                        <td class="text-center text-muted font-monospace">
                            {{ $log->quantity_before }}
                        </td>
                        <td class="text-center">
                            @if($log->quantity_change > 0)
                                <span class="fw-bold text-success font-monospace fs-6">+{{ $log->quantity_change }}</span>
                            @else
                                <span class="fw-bold text-danger font-monospace fs-6">{{ $log->quantity_change }}</span>
                            @endif
                        </td>
                        <td class="text-center fw-bold text-dark font-monospace fs-6">
                            {{ $log->quantity_after }}
                        </td>
                        <td>
                            <div class="small fw-semibold text-dark">{{ $log->user->name ?? 'Hệ thống tự động' }}</div>
                            <small class="text-muted">{{ $log->note }}</small>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="fa-solid fa-clipboard-list fs-2 mb-2 d-block"></i>
                            Không có dữ liệu nhật ký kho nào khớp với điều kiện tìm kiếm.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($logs->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $logs->links() }}
        </div>
    @endif
</div>
@endsection
