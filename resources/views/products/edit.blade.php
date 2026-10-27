@extends('layouts.app')

@section('title', 'Cập nhật sản phẩm: ' . $product->name)
@section('page_title', 'Chỉnh Sửa Sản Phẩm')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card card-custom">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-pen-to-square text-primary me-2"></i>Chỉnh sửa: {{ $product->name }}
                </h6>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
                </a>
            </div>
            <form method="POST" action="{{ route('products.update', $product) }}" class="card-body p-4">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Mã sản phẩm / SKU (*)</label>
                        <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Mã vạch (Barcode)</label>
                        <input type="text" name="barcode" class="form-control" value="{{ old('barcode', $product->barcode) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-semibold text-secondary">Tên mặt hàng (*)</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Danh mục hàng hóa (*)</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Nhà cung cấp chính</label>
                        <select name="supplier_id" class="form-select">
                            <option value="">-- Chọn nhà cung cấp --</option>
                            @foreach($suppliers as $sup)
                                <option value="{{ $sup->id }}" {{ old('supplier_id', $product->supplier_id) == $sup->id ? 'selected' : '' }}>
                                    {{ $sup->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary">Đơn vị tính (*)</label>
                        <input type="text" name="unit" class="form-control" value="{{ old('unit', $product->unit) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary">Giá vốn nhập (VNĐ) (*)</label>
                        <input type="number" step="1000" min="0" name="purchase_price" class="form-control" value="{{ old('purchase_price', $product->purchase_price) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary">Giá xuất bán (VNĐ) (*)</label>
                        <input type="number" step="1000" min="0" name="selling_price" class="form-control" value="{{ old('selling_price', $product->selling_price) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary">Tồn kho hiện tại</label>
                        <input type="text" class="form-control bg-light" value="{{ $product->current_stock }} {{ $product->unit }}" disabled>
                        <small class="text-muted" style="font-size: 0.75rem;">Để đổi số tồn, dùng chức năng Nhập/Xuất hoặc Kiểm kê</small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-danger">Ngưỡng tồn tối thiểu (min_stock) (*)</label>
                        <input type="number" min="0" name="min_stock" class="form-control border-danger" value="{{ old('min_stock', $product->min_stock) }}" required>
                        <small class="text-danger" style="font-size: 0.75rem;">Hệ thống sẽ cảnh báo khi tồn ≤ mức này</small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary">Ngưỡng tồn tối đa (max_stock)</label>
                        <input type="number" min="0" name="max_stock" class="form-control" value="{{ old('max_stock', $product->max_stock) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-semibold text-secondary">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" {{ old('status', $product->status) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold small text-secondary" for="statusSwitch">Kích hoạt kinh doanh mặt hàng này</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                    <a href="{{ route('products.index') }}" class="btn btn-light border px-4">Hủy bỏ</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Cập nhật thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
