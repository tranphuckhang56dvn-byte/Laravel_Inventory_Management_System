@extends('layouts.app')

@section('title', 'Quản lý Nhà cung cấp')
@section('page_title', 'Danh Sách Nhà Cung Cấp')

@section('content')
<div class="card card-custom mb-4">
    <div class="card-body p-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <form method="GET" action="{{ route('suppliers.index') }}" class="d-flex gap-2 flex-grow-1" style="max-width: 450px;">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm theo mã, tên, số điện thoại..." value="{{ request('keyword') }}">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                @if(request('keyword'))
                    <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-rotate-left"></i></a>
                @endif
            </form>
            @if(auth()->user()->isAdmin())
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSupplierModal">
                    <i class="fa-solid fa-plus me-1"></i> Thêm Nhà Cung Cấp Mới
                </button>
            @endif
        </div>
    </div>
</div>

<div class="card card-custom">
    <div class="table-responsive">
        <table class="table table-custom align-middle mb-0">
            <thead>
                <tr>
                    <th>Mã / Tên Nhà cung cấp</th>
                    <th>Thông tin liên hệ</th>
                    <th>Địa chỉ</th>
                    <th class="text-center">Số mặt hàng</th>
                    <th class="text-center">Số phiếu nhập</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $sup)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $sup->name }}</div>
                            <span class="badge bg-light text-secondary border font-monospace">Mã: {{ $sup->code }}</span>
                        </td>
                        <td>
                            <div><i class="fa-solid fa-phone text-muted me-1 small"></i>{{ $sup->phone ?? 'Chưa có' }}</div>
                            <small class="text-muted"><i class="fa-solid fa-envelope text-muted me-1"></i>{{ $sup->email ?? 'Chưa có' }}</small>
                        </td>
                        <td class="small text-muted">{{ Str::limit($sup->address, 40) ?? 'Chưa cập nhật' }}</td>
                        <td class="text-center"><span class="badge badge-subtle-primary">{{ $sup->products_count }} sản phẩm</span></td>
                        <td class="text-center"><span class="badge badge-subtle-info">{{ $sup->goods_receipts_count }} phiếu</span></td>
                        <td class="text-center">
                            <span class="badge {{ $sup->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $sup->status ? 'Hợp tác' : 'Tạm dừng' }}
                            </span>
                        </td>
                        <td class="text-end">
                            @if(auth()->user()->isAdmin())
                                <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editSup{{ $sup->id }}" title="Chỉnh sửa">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <form id="del-sup-{{ $sup->id }}" method="POST" action="{{ route('suppliers.destroy', $sup) }}" class="d-inline-block m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('del-sup-{{ $sup->id }}', 'Xóa nhà cung cấp {{ $sup->name }}?')" title="Xóa">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            @endif

                            <!-- Modal Sửa Nhà Cung Cấp -->
                            <div class="modal fade" id="editSup{{ $sup->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered text-start">
                                    <form method="POST" action="{{ route('suppliers.update', $sup) }}" class="modal-content">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h6 class="modal-title fw-bold">Chỉnh sửa nhà cung cấp</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Mã nhà cung cấp (*)</label>
                                                <input type="text" name="code" class="form-control" value="{{ $sup->code }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Tên công ty / nhà cung cấp (*)</label>
                                                <input type="text" name="name" class="form-control" value="{{ $sup->name }}" required>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-6">
                                                    <label class="form-label small fw-semibold">Số điện thoại</label>
                                                    <input type="text" name="phone" class="form-control" value="{{ $sup->phone }}">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label small fw-semibold">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $sup->email }}">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Địa chỉ trụ sở / kho</label>
                                                <textarea name="address" class="form-control" rows="2">{{ $sup->address }}</textarea>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="status" id="supStatus{{ $sup->id }}" value="1" {{ $sup->status ? 'checked' : '' }}>
                                                <label class="form-check-label small fw-semibold" for="supStatus{{ $sup->id }}">Hợp tác kinh doanh</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Lưu thay đổi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Chưa tìm thấy nhà cung cấp nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($suppliers->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $suppliers->links() }}
        </div>
    @endif
</div>

<!-- Modal Thêm Nhà Cung Cấp Mới -->
<div class="modal fade" id="createSupplierModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered text-start">
        <form method="POST" action="{{ route('suppliers.store') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="fa-solid fa-plus-circle text-primary me-1"></i> Thêm Nhà Cung Cấp Mới</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Mã nhà cung cấp (*)</label>
                    <input type="text" name="code" class="form-control" placeholder="Ví dụ: NCC-FPT, NCC-SAMSUNG..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Tên đối tác / nhà cung cấp (*)</label>
                    <input type="text" name="name" class="form-control" placeholder="Tên công ty hoặc doanh nghiệp..." required>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label small fw-semibold">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" placeholder="028...">
                    </div>
                    <div class="col-6">
                        <label class="form-label small fw-semibold">Email liên hệ</label>
                        <input type="email" name="email" class="form-control" placeholder="contact@supplier.vn">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Địa chỉ văn phòng / kho</label>
                    <textarea name="address" class="form-control" rows="2" placeholder="Số nhà, đường, quận/huyện..."></textarea>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="status" id="newSupStatus" value="1" checked>
                    <label class="form-check-label small fw-semibold" for="newSupStatus">Kích hoạt hợp tác</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i> Tạo nhà cung cấp</button>
            </div>
        </form>
    </div>
</div>
@endsection
