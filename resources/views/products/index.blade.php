@extends('layouts.app')

@section('title', 'Quản lý Sản phẩm')
@section('page_title', 'Danh Sách Mặt Hàng & Sản Phẩm')

@section('content')
<div class="card card-custom mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('products.index') }}" class="row g-2 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                    <input type="text" name="keyword" class="form-control border-start-0" placeholder="Tìm theo tên, SKU, mã vạch..." value="{{ request('keyword') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select">
                    <option value="">-- Tất cả danh mục --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="stock_status" class="form-select">
                    <option value="">-- Tình trạng tồn kho --</option>
                    <option value="in" {{ request('stock_status') == 'in' ? 'selected' : '' }}>Còn hàng trong kho</option>
                    <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>⚠️ Cảnh báo tồn thấp (< min_stock)</option>
                    <option value="out" {{ request('stock_status') == 'out' ? 'selected' : '' }}>Hết hàng (0)</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">
                    <i class="fa-solid fa-filter me-1"></i> Lọc
                </button>
                @if(request()->hasAny(['keyword', 'category_id', 'stock_status']))
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary" title="Đặt lại bộ lọc">
                        <i class="fa-solid fa-arrow-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card card-custom">
    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold mb-0 text-dark">
                <i class="fa-solid fa-boxes-stacked text-primary me-2"></i>Tổng số: {{ $products->total() }} sản phẩm
            </h6>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('products.low-stock') }}" class="btn btn-sm btn-outline-warning">
                <i class="fa-solid fa-triangle-exclamation me-1"></i> Xem cảnh báo
            </a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-plus me-1"></i> Thêm sản phẩm mới
                </a>
            @endif
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-custom align-middle mb-0">
            <thead>
                <tr>
                    <th>Mã / Tên Sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Nhà cung cấp</th>
                    <th class="text-end">Giá nhập / Giá xuất</th>
                    <th class="text-center">Tồn kho / Tối thiểu</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $product->name }}</div>
                            <div class="small text-muted font-monospace">
                                <span class="badge bg-light text-dark border me-1">SKU: {{ $product->sku }}</span>
                                @if($product->barcode)
                                    <span><i class="fa-solid fa-barcode text-secondary me-1"></i>{{ $product->barcode }}</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-subtle-primary">{{ $product->category->name ?? 'Chưa phân loại' }}</span>
                        </td>
                        <td>
                            <small class="text-muted">{{ $product->supplier->name ?? 'N/A' }}</small>
                        </td>
                        <td class="text-end">
                            <div class="text-dark fw-semibold">{{ number_format($product->selling_price) }} đ</div>
                            <small class="text-muted">Vốn: {{ number_format($product->purchase_price) }} đ</small>
                        </td>
                        <td class="text-center">
                            @if($product->current_stock <= 0)
                                <span class="badge badge-subtle-danger fs-6 px-2 py-1">Hết hàng (0)</span>
                            @elseif($product->current_stock < $product->min_stock)
                                <span class="badge badge-subtle-warning fs-6 px-2 py-1 text-danger fw-bold">
                                    <i class="fa-solid fa-triangle-exclamation me-1"></i>{{ $product->current_stock }} {{ $product->unit }}
                                </span>
                            @else
                                <span class="badge badge-subtle-success fs-6 px-2 py-1">
                                    {{ $product->current_stock }} {{ $product->unit }}
                                </span>
                            @endif
                            <div class="small text-muted mt-1">Min: {{ $product->min_stock }} {{ $product->unit }}</div>
                        </td>
                        <td class="text-center">
                            @if($product->status)
                                <span class="badge bg-success bg-opacity-75">Kinh doanh</span>
                            @else
                                <span class="badge bg-secondary">Ngừng bán</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Thao tác
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('products.show', $product) }}">
                                            <i class="fa-solid fa-eye text-primary me-2"></i> Chi tiết & Lịch sử
                                        </a>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#adjustModal{{ $product->id }}">
                                            <i class="fa-solid fa-sliders text-warning me-2"></i> Kiểm kê / Điều chỉnh
                                        </button>
                                    </li>
                                    @if(auth()->user()->isAdmin())
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('products.edit', $product) }}">
                                                <i class="fa-solid fa-pen-to-square text-info me-2"></i> Chỉnh sửa
                                            </a>
                                        </li>
                                        <li>
                                            <form id="delete-product-{{ $product->id }}" method="POST" action="{{ route('products.destroy', $product) }}" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="dropdown-item text-danger" onclick="confirmDelete('delete-product-{{ $product->id }}', 'Xóa sản phẩm này? Lưu ý chỉ xóa được nếu chưa có phiếu xuất nhập kho!')">
                                                    <i class="fa-solid fa-trash me-2"></i> Xóa sản phẩm
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            <!-- Modal Điều chỉnh kho -->
                            <div class="modal fade" id="adjustModal{{ $product->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered text-start">
                                    <form method="POST" action="{{ route('products.adjust-stock', $product) }}" class="modal-content">
                                        @csrf
                                        <div class="modal-header">
                                            <h6 class="modal-title fw-bold">
                                                <i class="fa-solid fa-sliders text-warning me-1"></i> Kiểm kê & Điều chỉnh tồn kho
                                            </h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="small text-muted mb-3">Sản phẩm: <strong>{{ $product->name }}</strong> (SKU: {{ $product->sku }})</p>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Tồn kho thực tế hiện tại</label>
                                                <input type="text" class="form-control" value="{{ $product->current_stock }} {{ $product->unit }}" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Số lượng kiểm kê mới (*)</label>
                                                <input type="number" name="new_stock" class="form-control" min="0" value="{{ $product->current_stock }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Lý do điều chỉnh (*)</label>
                                                <textarea name="reason" class="form-control" rows="2" placeholder="Ví dụ: Kiểm kê định kỳ cuối tháng, sai lệch thực tế..." required></textarea>
                                            </div>
                                            <div class="alert alert-info py-2 small mb-0">
                                                <i class="fa-solid fa-shield-halved me-1"></i> Nghiệp vụ sử dụng Pessimistic Locking và ghi log kiểm toán.
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn btn-sm btn-warning">Xác nhận cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fa-solid fa-box-open fs-2 mb-2 d-block"></i>
                            Không tìm thấy sản phẩm nào phù hợp với điều kiện tìm kiếm.
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
