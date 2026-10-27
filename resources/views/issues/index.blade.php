@extends('layouts.app')

@section('title', 'Quản lý Xuất kho')
@section('page_title', 'Danh Sách Phiếu Xuất Kho')

@section('content')
<div class="card card-custom mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('issues.index') }}" class="row g-2 align-items-center">
            <div class="col-md-3">
                <input type="text" name="keyword" class="form-control" placeholder="Mã phiếu, tên khách hàng..." value="{{ request('keyword') }}">
            </div>
            <div class="col-md-3">
                <select name="reason" class="form-select">
                    <option value="">-- Tất cả lý do xuất --</option>
                    <option value="Xuất bán" {{ request('reason') == 'Xuất bán' ? 'selected' : '' }}>Xuất bán hàng</option>
                    <option value="Xuất chuyển kho" {{ request('reason') == 'Xuất chuyển kho' ? 'selected' : '' }}>Xuất chuyển kho nội bộ</option>
                    <option value="Xuất hủy" {{ request('reason') == 'Xuất hủy' ? 'selected' : '' }}>Xuất hủy hàng lỗi / hỏng</option>
                    <option value="Xuất trả nhà cung cấp" {{ request('reason') == 'Xuất trả nhà cung cấp' ? 'selected' : '' }}>Xuất trả nhà cung cấp</option>
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
                @if(request()->hasAny(['keyword', 'reason', 'from_date', 'to_date']))
                    <a href="{{ route('issues.index') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-rotate-left"></i></a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card card-custom">
    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold mb-0 text-dark">
                <i class="fa-solid fa-truck-ramp-box text-primary me-2"></i>Tổng số: {{ $issues->total() }} phiếu xuất kho
            </h6>
        </div>
        <a href="{{ route('issues.create') }}" class="btn btn-sm btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Lập phiếu xuất kho mới
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-custom align-middle mb-0">
            <thead>
                <tr>
                    <th>Mã phiếu</th>
                    <th>Khách hàng / Đơn vị nhận</th>
                    <th>Ngày xuất</th>
                    <th>Lý do xuất</th>
                    <th>Người lập phiếu</th>
                    <th class="text-center">Số mặt hàng</th>
                    <th class="text-end">Tổng giá trị (VNĐ)</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($issues as $issue)
                    <tr>
                        <td>
                            <a href="{{ route('issues.show', $issue) }}" class="fw-bold text-primary font-monospace">
                                {{ $issue->code }}
                            </a>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $issue->customer_name ?? 'Khách lẻ' }}</div>
                        </td>
                        <td>
                            <span class="text-dark">{{ $issue->issue_date->format('d/m/Y') }}</span>
                        </td>
                        <td>
                            <span class="badge badge-subtle-info">{{ $issue->reason }}</span>
                        </td>
                        <td>
                            <div class="small fw-semibold">{{ $issue->user->name ?? 'N/A' }}</div>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-subtle-primary">{{ $issue->items->count() }} mặt hàng</span>
                        </td>
                        <td class="text-end fw-bold text-dark">
                            {{ number_format($issue->total_amount) }} đ
                        </td>
                        <td class="text-center">
                            <span class="badge badge-subtle-success">Đã xuất kho</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('issues.show', $issue) }}" class="btn btn-sm btn-outline-primary" title="Xem chi tiết & In phiếu">
                                <i class="fa-solid fa-eye me-1"></i> Chi tiết
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">Chưa có phiếu xuất kho nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($issues->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $issues->links() }}
        </div>
    @endif
</div>
@endsection
