@extends('layouts.app')

@section('title', 'Quản lý Danh mục')
@section('page_title', 'Danh Mục Nhóm Hàng Hóa')

@section('content')
<div class="row g-4">
    <!-- Form Thêm Danh mục nhanh ở bên trái -->
    <div class="col-lg-4">
        <div class="card card-custom">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-plus-circle text-primary me-2"></i>Thêm Danh Mục Mới
                </h6>
            </div>
            <form method="POST" action="{{ route('categories.store') }}" class="card-body p-3">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Mã danh mục (*)</label>
                    <input type="text" name="code" class="form-control" placeholder="Ví dụ: CAT-DIENTU" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Tên danh mục (*)</label>
                    <input type="text" name="name" class="form-control" placeholder="Ví dụ: Thiết bị văn phòng" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Mô tả ngắn</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Mô tả nhóm hàng hóa..."></textarea>
                </div>
                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="status" id="catStatus" value="1" checked>
                    <label class="form-check-label small text-secondary fw-semibold" for="catStatus">Trạng thái hoạt động</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Lưu Danh Mục
                </button>
            </form>
        </div>
    </div>

    <!-- Bảng Danh sách Danh mục ở bên phải -->
    <div class="col-lg-8">
        <div class="card card-custom">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-tags text-primary me-2"></i>Danh Sách Danh Mục Hiện Có
                </h6>
            </div>
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th class="text-center">Số sản phẩm</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td><span class="badge bg-light text-dark border font-monospace">{{ $category->code }}</span></td>
                                <td class="fw-semibold text-dark">{{ $category->name }}</td>
                                <td class="small text-muted">{{ Str::limit($category->description, 35) }}</td>
                                <td class="text-center">
                                    <span class="badge badge-subtle-primary">{{ $category->products_count }} sản phẩm</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $category->status ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $category->status ? 'Hoạt động' : 'Tạm dừng' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editCat{{ $category->id }}" title="Sửa">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    @if(auth()->user()->isAdmin())
                                        <form id="del-cat-{{ $category->id }}" method="POST" action="{{ route('categories.destroy', $category) }}" class="d-inline-block m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('del-cat-{{ $category->id }}', 'Xóa danh mục {{ $category->name }}?')" title="Xóa">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Modal Sửa Danh mục -->
                                    <div class="modal fade" id="editCat{{ $category->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered text-start">
                                            <form method="POST" action="{{ route('categories.update', $category) }}" class="modal-content">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h6 class="modal-title fw-bold">Chỉnh sửa danh mục</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-semibold">Mã danh mục (*)</label>
                                                        <input type="text" name="code" class="form-control" value="{{ $category->code }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-semibold">Tên danh mục (*)</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-semibold">Mô tả</label>
                                                        <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="status" id="editCatStatus{{ $category->id }}" value="1" {{ $category->status ? 'checked' : '' }}>
                                                        <label class="form-check-label small fw-semibold" for="editCatStatus{{ $category->id }}">Hoạt động</label>
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
                                <td colspan="6" class="text-center text-muted py-4">Chưa có danh mục nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($categories->hasPages())
                <div class="card-footer bg-white py-3">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
