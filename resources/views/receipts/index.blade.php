@extends('layouts.app')

@section('title', 'Quản lý Nhập kho')
@section('page_title', 'Danh Sách Phiếu Nhập Kho')

@section('content')
<div class="card card-custom mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('receipts.index') }}" class="row g-2 align-items-center">
            <div class="col-md-3">
                <input type="text" name="keyword" class="form-control" placeholder="Mã phiếu nhập (PN-...)" value="{{ request('keyword') }}">
            </div>
            <div class="col-md-3">
                <select name="supplier_id" class="form-select">
                    <option value="">-- Tất cả nhà cung cấp --</option>
                    @foreach($suppliers as $sup)
                        <option value="{{ $sup->id }}" {{ request('supplier_id') == $sup->id ? 'selected' : '' }}>
                            {{ $sup->name }}
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
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1"><i class="fa-solid fa-filter me-1"></i> Lọc</button>
                @if(request()->hasAny(['keyword', 'supplier_id', 'from_date', 'to_date']))
                    <a href="{{ route('receipts.index') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-rotate-left"></i></a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card card-custom">
    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold mb-0 text-dark">
                <i class="fa-solid fa-cart-arrow-down text-primary me-2"></i>Tổng số: {{ $receipts->total() }} phiếu nhập kho
            </h6>
        </div>
        <a href="{{ route('receipts.create') }}" class="btn btn-sm btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Lập phiếu nhập kho mới
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-custom align-middle mb-0">
            <thead>
                <tr>
                    <th>Mã phiếu</th>
                    <th>Nhà cung cấp</th>
                    <th>Ngày nhập</th>
                    <th>Người lập phiếu</th>
                    <th class="text-center">Số mặt hàng</th>
                    <th class="text-end">Tổng giá trị (VNĐ)</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($receipts as $receipt)
                    <tr>
                        <td>
                            <a href="{{ route('receipts.show', $receipt) }}" class="fw-bold text-primary font-monospace">
                                {{ $receipt->code }}
                            </a>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $receipt->supplier->name ?? 'N/A' }}</div>
                            <small class="text-muted">{{ $receipt->supplier->phone ?? '' }}</small>
                        </td>
                        <td>
                            <span class="text-dark">{{ $receipt->receipt_date->format('d/m/Y') }}</span>
                        </td>
                        <td>
                            <div class="small fw-semibold">{{ $receipt->user->name ?? 'N/A' }}</div>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-subtle-primary">{{ $receipt->items->count() }} mặt hàng</span>
                        </td>
                        <td class="text-end fw-bold text-dark">
                            {{ number_format($receipt->total_amount) }} đ
                        </td>
                        <td class="text-center">
                            <span class="badge badge-subtle-success">Hoàn thành</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('receipts.show', $receipt) }}" class="btn btn-sm btn-outline-primary" title="Xem chi tiết & In phiếu">
                                <i class="fa-solid fa-eye me-1"></i> Chi tiết
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            Chưa có phiếu nhập kho nào.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($receipts->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $receipts->links() }}
        </div>
    @endif
</div>
@endsection
