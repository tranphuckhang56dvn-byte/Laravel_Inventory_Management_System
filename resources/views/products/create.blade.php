@extends('layouts.app')

@section('title', 'Thêm sản phẩm mới')
@section('page_title', 'Tạo Mặt Hàng Mới')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card card-custom">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-box-open text-primary me-2"></i>Thông tin sản phẩm mới
                </h6>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
                </a>
            </div>
            <form method="POST" action="{{ route('products.store') }}" class="card-body p-4">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Mã sản phẩm / SKU (*)</label>
                        <input type="text" name="sku" class="form-control" placeholder="Ví dụ: SP-LAPTOP-01" value="{{ old('sku') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Mã vạch (Barcode)</label>
                        <input type="text" name="barcode" class="form-control" placeholder="Ví dụ: 893850123999" value="{{ old('barcode') }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-semibold text-secondary">Tên mặt hàng (*)</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên chi tiết sản phẩm..." value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Danh mục hàng hóa (*)</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Nhà cung cấp chính</label>
                        <select name="supplier_id" class="form-select">
                            <option value="">-- Chọn nhà cung cấp (nếu có) --</option>
                            @foreach($suppliers as $sup)
                                <option value="{{ $sup->id }}" {{ old('supplier_id') == $sup->id ? 'selected' : '' }}>
                                    {{ $sup->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary">Đơn vị tính (*)</label>
                        <input type="text" name="unit" class="form-control" placeholder="Cái, Chiếc, Hộp, Thùng, Kg..." value="{{ old('unit', 'Cái') }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary">Giá vốn nhập dự kiến (VNĐ) (*)</label>
                        <input type="number" step="1000" min="0" name="purchase_price" class="form-control" placeholder="0" value="{{ old('purchase_price', 0) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary">Giá xuất bán dự kiến (VNĐ) (*)</label>
                        <input type="number" step="1000" min="0" name="selling_price" class="form-control" placeholder="0" value="{{ old('selling_price', 0) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary">Số tồn ban đầu</label>
                        <input type="number" min="0" name="current_stock" class="form-control" value="{{ old('current_stock', 0) }}">
                        <small class="text-muted" style="font-size: 0.75rem;">Sẽ ghi nhận log khởi tạo ban đầu</small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-danger">Ngưỡng tồn tối thiểu (min_stock) (*)</label>
                        <input type="number" min="0" name="min_stock" class="form-control border-danger" value="{{ old('min_stock', 5) }}" required>
                        <small class="text-danger" style="font-size: 0.75rem;">Hệ thống sẽ cảnh báo khi tồn ≤ mức này</small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary">Ngưỡng tồn tối đa (max_stock)</label>
                        <input type="number" min="0" name="max_stock" class="form-control" value="{{ old('max_stock', 1000) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-semibold text-secondary">Mô tả chi tiết / Ghi chú</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Thông số kỹ thuật, quy cách đóng gói...">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold small text-secondary" for="statusSwitch">Kích hoạt kinh doanh mặt hàng này</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                    <a href="{{ route('products.index') }}" class="btn btn-light border px-4">Hủy bỏ</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Lưu sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
