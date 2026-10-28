@extends('layouts.app')

@section('title', 'Lập phiếu xuất kho')
@section('page_title', 'Tạo Phiếu Xuất Hàng Mới')

@section('content')
<form method="POST" action="{{ route('issues.store') }}" id="issueForm">
    @csrf
    <div class="row g-4">
        <!-- Thông tin chung phiếu xuất -->
        <div class="col-xl-3 col-lg-4">
            <div class="card card-custom p-4">
                <h6 class="fw-bold mb-3 text-dark">
                    <i class="fa-solid fa-file-export text-primary me-2"></i>Thông tin xuất kho
                </h6>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Mã phiếu xuất</label>
                    <input type="text" name="code" class="form-control font-monospace fw-bold" value="{{ old('code', $suggestedCode) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Khách hàng / Đơn vị nhận (*)</label>
                    <input type="text" name="customer_name" class="form-control" placeholder="Tên khách hàng, đại lý, phòng ban..." value="{{ old('customer_name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Ngày xuất kho (*)</label>
                    <input type="date" name="issue_date" class="form-control" value="{{ old('issue_date', date('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Lý do xuất kho (*)</label>
                    <select name="reason" class="form-select" required>
                        <option value="Xuất bán" {{ old('reason') == 'Xuất bán' ? 'selected' : '' }}>Xuất bán hàng thương mại</option>
                        <option value="Xuất chuyển kho" {{ old('reason') == 'Xuất chuyển kho' ? 'selected' : '' }}>Xuất điều chuyển nội bộ</option>
                        <option value="Xuất hủy" {{ old('reason') == 'Xuất hủy' ? 'selected' : '' }}>Xuất thanh lý / hủy hàng hỏng</option>
                        <option value="Xuất trả nhà cung cấp" {{ old('reason') == 'Xuất trả nhà cung cấp' ? 'selected' : '' }}>Xuất trả nhà cung cấp (đổi trả)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Ghi chú xuất hàng</label>
                    <textarea name="note" class="form-control" rows="2" placeholder="Ghi chú vận chuyển, hợp đồng...">{{ old('note') }}</textarea>
                </div>

                <div class="p-3 bg-light rounded-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted small">Người thực hiện:</span>
                        <strong class="small text-dark">{{ auth()->user()->name }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Bảo vệ tồn kho:</span>
                        <span class="badge bg-success small"><i class="fa-solid fa-shield-halved me-1"></i>Pessimistic Locking</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chi tiết sản phẩm xuất -->
        <div class="col-xl-9 col-lg-8">
            <div class="card card-custom">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="fa-solid fa-boxes-stacked text-primary me-2"></i>Danh mục hàng hóa cần xuất kho
                    </h6>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="btn-add-item">
                        <i class="fa-solid fa-plus me-1"></i> Thêm mặt hàng
                    </button>
                </div>

                <div class="px-4 py-2 bg-light border-bottom d-flex align-items-center justify-content-between text-muted small">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-circle-info text-primary me-2"></i>
                        <span>Hệ thống hiển thị <strong>tồn khả dụng</strong> và tự động tính <strong>số lượng còn lại sau xuất</strong> theo thời gian thực.</span>
                    </div>
                    <span class="badge bg-success-subtle text-success border border-success-subtle small ms-2 text-nowrap">
                        <i class="fa-solid fa-shield-halved me-1"></i>Chống âm kho
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom mb-0" id="itemsTable">
                        <thead>
                            <tr class="table-light text-secondary small fw-bold text-uppercase border-bottom">
                                <th style="width: 33%;" class="ps-3 text-nowrap">Sản phẩm xuất (*)</th>
                                <th style="width: 15%;" class="text-center text-nowrap">Tồn khả dụng</th>
                                <th style="width: 17%;" class="text-center text-nowrap">Số lượng xuất (*)</th>
                                <th style="width: 16%;" class="text-end text-nowrap">Đơn giá xuất</th>
                                <th style="width: 14%;" class="text-end text-nowrap">Thành tiền</th>
                                <th style="width: 5%;" class="text-center text-nowrap pe-3"></th>
                            </tr>
                        </thead>
                        <tbody id="itemsBody">
                            <!-- Các dòng được sinh bằng JS -->
                        </tbody>
                        <tfoot>
                            <tr class="table-light border-top">
                                <td colspan="4" class="text-end fw-bold text-secondary py-3 ps-3">Tổng giá trị xuất kho:</td>
                                <td class="text-end fw-bold fs-5 text-primary py-3 font-monospace" id="grandTotal">0 đ</td>
                                <td class="pe-3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="card-footer bg-white p-3 border-top d-flex justify-content-between align-items-center">
                    <a href="{{ route('issues.index') }}" class="btn btn-light border">Hủy bỏ</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-arrow-up-from-bracket me-1"></i> Xác nhận xuất kho & Trừ tồn
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
        'price' => (float) $p->selling_price,
        'unit' => $p->unit,
        'stock' => (int) $p->current_stock,
        'min_stock' => (int) $p->min_stock
    ])) !!};
</script>
<!-- Issues Create JS -->
<script src="{{ asset('js/issues-create.js') }}"></script>
@endsection
