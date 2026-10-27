@extends('layouts.app')

@section('title', 'Cảnh báo tồn kho dưới ngưỡng')
@section('page_title', 'Cảnh Báo Tồn Kho Dưới Ngưỡng An Toàn (min_stock)')

@section('content')
<div class="alert alert-danger d-flex align-items-center gap-3 p-3 mb-4 rounded-4 shadow-sm">
    <div class="fs-2 text-danger"><i class="fa-solid fa-triangle-exclamation"></i></div>
    <div>
        <h6 class="fw-bold mb-1 text-danger">Quy định cảnh báo tồn kho tối thiểu</h6>
        <p class="mb-0 small text-danger text-opacity-75">
            Danh sách dưới đây liệt kê các sản phẩm có số lượng tồn kho thực tế <code>current_stock</code> nhỏ hơn hoặc bằng ngưỡng an toàn <code>min_stock</code>. Thủ kho cần lên phương án nhập bổ sung ngay để tránh gián đoạn kinh doanh.
        </p>
    </div>
</div>

<div class="card card-custom">
    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold mb-0 text-danger">
                <i class="fa-solid fa-bell me-2"></i>Có {{ $products->total() }} mặt hàng đang bị thiếu hụt
            </h6>
        </div>
        <a href="{{ route('receipts.create') }}" class="btn btn-sm btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Lập phiếu nhập kho ngay
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-custom align-middle mb-0">
            <thead>
                <tr>
                    <th>Sản phẩm / Mã SKU</th>
                    <th>Danh mục</th>
                    <th>Nhà cung cấp đề xuất</th>
                    <th class="text-center">Tồn hiện tại</th>
                    <th class="text-center">Ngưỡng an toàn (min_stock)</th>
                    <th class="text-center">Mức độ thiếu</th>
                    <th class="text-end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $p->name }}</div>
                            <span class="badge bg-light text-secondary border font-monospace">SKU: {{ $p->sku }}</span>
                        </td>
                        <td>
                            <span class="badge badge-subtle-primary">{{ $p->category->name ?? 'N/A' }}</span>
                        </td>
                        <td>
                            <div class="small fw-semibold">{{ $p->supplier->name ?? 'Chưa xác định' }}</div>
                            <small class="text-muted">{{ $p->supplier->phone ?? '' }}</small>
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $p->current_stock <= 0 ? 'bg-danger' : 'bg-warning text-dark' }} fs-6 px-3 py-1">
                                {{ $p->current_stock }} {{ $p->unit }}
                            </span>
                        </td>
                        <td class="text-center fw-bold text-secondary">
                            {{ $p->min_stock }} {{ $p->unit }}
                        </td>
                        <td class="text-center">
                            <span class="badge bg-danger bg-opacity-10 text-danger fw-bold px-2 py-1">
                                Thiếu {{ max(0, $p->min_stock - $p->current_stock) }} {{ $p->unit }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('receipts.create') }}" class="btn btn-sm btn-outline-success">
                                <i class="fa-solid fa-cart-plus me-1"></i> Đặt hàng
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fa-solid fa-circle-check text-success fs-1 mb-2 d-block"></i>
                            <h6 class="fw-bold text-success">Không có sản phẩm nào thiếu hụt!</h6>
                            <p class="small text-muted mb-0">Tất cả hàng hóa trong kho đều duy trì trên mức an toàn.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($products->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
