@extends('layouts.app')

@section('title', 'Lập phiếu nhập kho')
@section('page_title', 'Tạo Phiếu Nhập Hàng Mới')

@section('content')
<form method="POST" action="{{ route('receipts.store') }}" id="receiptForm">
    @csrf
    <div class="row g-4">
        <!-- Thông tin chung phiếu nhập -->
        <div class="col-lg-4">
            <div class="card card-custom p-4">
                <h6 class="fw-bold mb-3 text-dark">
                    <i class="fa-solid fa-file-invoice text-primary me-2"></i>Thông tin phiếu nhập
                </h6>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Mã phiếu nhập</label>
                    <input type="text" name="code" class="form-control font-monospace fw-bold" value="{{ old('code', $suggestedCode) }}" required>
                    <small class="text-muted" style="font-size: 0.72rem;">Hệ thống tự động sinh mã chuẩn</small>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Nhà cung cấp (*)</label>
                    <select name="supplier_id" class="form-select" required>
                        <option value="">-- Chọn nhà cung cấp --</option>
                        @foreach($suppliers as $sup)
                            <option value="{{ $sup->id }}" {{ old('supplier_id') == $sup->id ? 'selected' : '' }}>
                                {{ $sup->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Ngày nhập kho (*)</label>
                    <input type="date" name="receipt_date" class="form-control" value="{{ old('receipt_date', date('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Ghi chú nhập hàng</label>
                    <textarea name="note" class="form-control" rows="3" placeholder="Số hóa đơn VAT, chứng từ kèm theo...">{{ old('note') }}</textarea>
                </div>

                <div class="p-3 bg-light rounded-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted small">Người lập phiếu:</span>
                        <strong class="small text-dark">{{ auth()->user()->name }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Cơ chế an toàn:</span>
                        <span class="badge bg-success small"><i class="fa-solid fa-lock me-1"></i>Pessimistic Lock</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danh sách mặt hàng nhập -->
        <div class="col-lg-8">
            <div class="card card-custom">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="fa-solid fa-boxes-stacked text-primary me-2"></i>Chi tiết các mặt hàng nhập kho
                    </h6>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="btn-add-item">
                        <i class="fa-solid fa-plus me-1"></i> Thêm sản phẩm
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0" id="itemsTable">
                        <thead>
                            <tr>
                                <th style="width: 40%;">Sản phẩm (*)</th>
                                <th style="width: 15%;" class="text-center">Số lượng (*)</th>
                                <th style="width: 20%;" class="text-end">Đơn giá vốn (VNĐ)</th>
                                <th style="width: 20%;" class="text-end">Thành tiền</th>
                                <th style="width: 5%;" class="text-center">Xóa</th>
                            </tr>
                        </thead>
                        <tbody id="itemsBody">
                            <!-- Các dòng sẽ được thêm tự động bằng JS -->
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td colspan="3" class="text-end fw-bold fs-6">Tổng giá trị phiếu nhập:</td>
                                <td class="text-end fw-bold fs-5 text-primary" id="grandTotal">0 đ</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="card-footer bg-white p-3 border-top d-flex justify-content-between align-items-center">
                    <a href="{{ route('receipts.index') }}" class="btn btn-light border">Hủy thao tác</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-circle-check me-1"></i> Hoàn tất nhập kho & Lưu tồn
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    window.availableProducts = {!! json_encode($products->map(fn($p) => [
        'id' => $p->id,
        'sku' => $p->sku,
        'name' => $p->name,
        'price' => (float) $p->purchase_price,
        'unit' => $p->unit,
        'stock' => $p->current_stock
    ])) !!};
</script>
<!-- Receipts Create JS -->
<script src="{{ asset('js/receipts-create.js') }}"></script>
@endsection
