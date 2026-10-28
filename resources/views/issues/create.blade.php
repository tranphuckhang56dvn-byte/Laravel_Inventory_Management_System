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
    const availableProducts = {!! json_encode($products->map(fn($p) => [
        'id' => $p->id,
        'sku' => $p->sku,
        'name' => $p->name,
        'price' => (float) $p->selling_price,
        'unit' => $p->unit,
        'stock' => (int) $p->current_stock,
        'min_stock' => (int) $p->min_stock
    ])) !!};

    let itemIndex = 0;

    function formatNumber(num) {
        return new Intl.NumberFormat('vi-VN').format(num);
    }

    function addRow() {
        const tbody = document.getElementById('itemsBody');
        const tr = document.createElement('tr');
        tr.id = `row-${itemIndex}`;
        tr.className = 'border-bottom';

        let options = '<option value="">-- Chọn mặt hàng cần xuất --</option>';
        availableProducts.forEach(p => {
            if (p.stock > 0) {
                options += `<option value="${p.id}" data-sku="${p.sku}" data-price="${p.price}" data-unit="${p.unit}" data-stock="${p.stock}" data-min-stock="${p.min_stock}">
                    ${p.sku} — ${p.name} (Tồn: ${formatNumber(p.stock)} ${p.unit})
                </option>`;
            } else {
                options += `<option value="${p.id}" data-sku="${p.sku}" data-price="${p.price}" data-unit="${p.unit}" data-stock="${p.stock}" data-min-stock="${p.min_stock}" disabled class="text-muted">
                    ${p.sku} — ${p.name} (Hết hàng: 0 ${p.unit})
                </option>`;
            }
        });

        tr.innerHTML = `
            <td class="align-top py-3 ps-3">
                <select name="items[${itemIndex}][product_id]" class="form-select product-select" required onchange="onProductChange(${itemIndex})" style="height: 38px;">
                    ${options}
                </select>
                <div class="small mt-1 text-muted d-flex align-items-center" id="sku-hint-${itemIndex}" style="min-height: 22px; font-size: 0.78rem;">
                    <span><i class="fa-solid fa-barcode text-secondary me-1"></i>Mã SKU: <strong class="text-dark font-monospace">--</strong></span>
                </div>
            </td>
            <td class="align-top py-3 text-center">
                <div style="height: 38px;" class="d-flex align-items-center justify-content-center">
                    <span class="badge bg-light text-muted border px-2 py-2 w-100 fw-semibold" id="stock-badge-${itemIndex}" style="font-size: 0.85rem; height: 38px; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-boxes-stacked me-1.5 text-secondary"></i>--
                    </span>
                </div>
                <div class="small mt-1 d-flex align-items-center justify-content-center" id="stock-sub-${itemIndex}" style="min-height: 22px; font-size: 0.78rem;">
                    <span class="text-muted">Chưa chọn SP</span>
                </div>
            </td>
            <td class="align-top py-3">
                <div class="input-group" style="height: 38px;">
                    <input type="number" name="items[${itemIndex}][quantity]" class="form-control text-center qty-input fw-bold" min="1" value="1" required oninput="onQuantityChange(${itemIndex})" style="height: 38px;">
                    <span class="input-group-text unit-text text-muted bg-light" id="unit-text-${itemIndex}" style="min-width: 52px; justify-content: center; font-size: 0.82rem;">ĐVT</span>
                </div>
                <div class="small mt-1 d-flex align-items-center justify-content-center text-center" id="stock-feedback-${itemIndex}" style="min-height: 22px; font-size: 0.78rem;">
                    <span class="text-muted">Nhập số lượng</span>
                </div>
            </td>
            <td class="align-top py-3">
                <div class="input-group" style="height: 38px;">
                    <input type="number" step="1000" min="0" name="items[${itemIndex}][unit_price]" class="form-control text-end price-input fw-semibold" value="0" required oninput="calculateTotal(${itemIndex})" style="height: 38px;">
                    <span class="input-group-text text-muted bg-light" style="font-size: 0.82rem;">đ</span>
                </div>
                <div class="small mt-1 text-end text-muted d-flex align-items-center justify-content-end px-1" style="min-height: 22px; font-size: 0.78rem;">
                    Đơn giá bán
                </div>
            </td>
            <td class="align-top py-3 text-end">
                <div class="fw-bold fs-6 text-primary d-flex align-items-center justify-content-end row-total font-monospace" id="row-total-${itemIndex}" style="height: 38px;">
                    0 đ
                </div>
                <div class="small mt-1 text-end text-muted d-flex align-items-center justify-content-end px-1" style="min-height: 22px; font-size: 0.78rem;">
                    Tổng tiền dòng
                </div>
            </td>
            <td class="align-top py-3 text-center pe-3">
                <div class="d-flex align-items-center justify-content-center" style="height: 38px;">
                    <button type="button" class="btn btn-sm btn-outline-danger border-0 rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" onclick="removeRow(${itemIndex})" title="Xóa dòng mặt hàng">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
                <div style="min-height: 22px;"></div>
            </td>
        `;

        tbody.appendChild(tr);
        itemIndex++;
        calculateGrandTotal();
    }

    function onProductChange(idx) {
        const row = document.getElementById(`row-${idx}`);
        if (!row) return;

        const select = row.querySelector('.product-select');
        const selectedOption = select.options[select.selectedIndex];
        const priceInput = row.querySelector('.price-input');
        const qtyInput = row.querySelector('.qty-input');
        const unitText = document.getElementById(`unit-text-${idx}`);
        const stockBadge = document.getElementById(`stock-badge-${idx}`);
        const stockSub = document.getElementById(`stock-sub-${idx}`);
        const skuHint = document.getElementById(`sku-hint-${idx}`);

        if (selectedOption && selectedOption.value) {
            const price = selectedOption.dataset.price || 0;
            const stock = parseInt(selectedOption.dataset.stock) || 0;
            const minStock = parseInt(selectedOption.dataset.minStock) || 0;
            const unit = selectedOption.dataset.unit || 'Đơn vị';
            const sku = selectedOption.dataset.sku || '';

            priceInput.value = price;
            qtyInput.max = stock;
            if (unitText) unitText.textContent = unit;
            if (skuHint) {
                skuHint.innerHTML = `<span><i class="fa-solid fa-barcode text-secondary me-1"></i>Mã SKU: <strong class="text-dark font-monospace">${sku}</strong></span>`;
            }

            // Hiển thị badge Tồn khả dụng
            if (stock <= 0) {
                stockBadge.className = 'badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-2 w-100 fw-bold';
                stockBadge.innerHTML = `<i class="fa-solid fa-boxes-stacked me-1.5"></i>0 ${unit}`;
                stockSub.innerHTML = `<span class="text-danger fw-semibold"><i class="fa-solid fa-circle-xmark me-1"></i>Hết hàng</span>`;
            } else if (stock <= minStock) {
                stockBadge.className = 'badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-2 w-100 fw-bold';
                stockBadge.innerHTML = `<i class="fa-solid fa-boxes-stacked me-1.5"></i>${formatNumber(stock)} ${unit}`;
                stockSub.innerHTML = `<span class="text-warning-emphasis fw-semibold"><i class="fa-solid fa-triangle-exclamation text-warning me-1"></i>Tồn thấp (≤ ${minStock})</span>`;
            } else {
                stockBadge.className = 'badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-2 w-100 fw-bold';
                stockBadge.innerHTML = `<i class="fa-solid fa-boxes-stacked me-1.5"></i>${formatNumber(stock)} ${unit}`;
                stockSub.innerHTML = `<span class="text-success fw-semibold"><i class="fa-solid fa-circle-check me-1"></i>Sẵn sàng xuất</span>`;
            }
        } else {
            if (unitText) unitText.textContent = 'ĐVT';
            if (skuHint) skuHint.innerHTML = `<span><i class="fa-solid fa-barcode text-secondary me-1"></i>Mã SKU: <strong class="text-dark font-monospace">--</strong></span>`;
            if (stockBadge) {
                stockBadge.className = 'badge bg-light text-muted border px-2 py-2 w-100 fw-semibold';
                stockBadge.innerHTML = `<i class="fa-solid fa-boxes-stacked me-1.5 text-secondary"></i>--`;
            }
            if (stockSub) stockSub.innerHTML = `<span class="text-muted">Chưa chọn SP</span>`;
            qtyInput.removeAttribute('max');
        }

        onQuantityChange(idx);
    }

    function onQuantityChange(idx) {
        const row = document.getElementById(`row-${idx}`);
        if (!row) return;

        const select = row.querySelector('.product-select');
        const selectedOption = select.options[select.selectedIndex];
        const qtyInput = row.querySelector('.qty-input');
        const feedback = document.getElementById(`stock-feedback-${idx}`);

        if (selectedOption && selectedOption.value) {
            const stock = parseInt(selectedOption.dataset.stock) || 0;
            const unit = selectedOption.dataset.unit || 'Đơn vị';
            const qty = parseInt(qtyInput.value) || 0;

            if (qty <= 0) {
                feedback.innerHTML = `<span class="text-danger fw-bold"><i class="fa-solid fa-circle-exclamation me-1"></i>Số lượng phải ≥ 1</span>`;
                qtyInput.classList.add('is-invalid');
            } else if (qty > stock) {
                const excess = qty - stock;
                feedback.innerHTML = `<span class="text-danger fw-bold text-truncate" title="Vượt tồn: thiếu ${formatNumber(excess)} ${unit}"><i class="fa-solid fa-circle-xmark me-1"></i>Thiếu ${formatNumber(excess)} ${unit} (Tồn: ${formatNumber(stock)})</span>`;
                qtyInput.classList.add('is-invalid');
            } else {
                const remaining = stock - qty;
                qtyInput.classList.remove('is-invalid');

                if (remaining === 0) {
                    feedback.innerHTML = `<span class="text-warning-emphasis fw-semibold text-truncate"><i class="fa-solid fa-triangle-exclamation text-warning me-1"></i>Sau xuất: <strong>Hết tồn (0)</strong></span>`;
                } else {
                    feedback.innerHTML = `<span class="text-success fw-semibold text-truncate"><i class="fa-solid fa-circle-check me-1"></i>Còn lại: <strong>${formatNumber(remaining)}</strong> ${unit}</span>`;
                }
            }
        } else {
            feedback.innerHTML = `<span class="text-muted">Nhập số lượng</span>`;
            qtyInput.classList.remove('is-invalid');
        }

        calculateTotal(idx);
    }

    function calculateTotal(idx) {
        const row = document.getElementById(`row-${idx}`);
        if (!row) return;

        const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
        const price = parseFloat(row.querySelector('.price-input').value) || 0;
        const total = qty * price;

        row.querySelector('.row-total').textContent = formatNumber(total) + ' đ';
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        let sum = 0;
        document.querySelectorAll('#itemsBody tr').forEach(tr => {
            const qty = parseFloat(tr.querySelector('.qty-input').value) || 0;
            const price = parseFloat(tr.querySelector('.price-input').value) || 0;
            sum += (qty * price);
        });

        document.getElementById('grandTotal').textContent = formatNumber(sum) + ' đ';
    }

    function removeRow(idx) {
        const row = document.getElementById(`row-${idx}`);
        if (row) {
            row.remove();
            calculateGrandTotal();
        }
    }

    document.getElementById('btn-add-item').addEventListener('click', () => addRow());

    document.addEventListener('DOMContentLoaded', () => {
        addRow();
    });

    document.getElementById('issueForm').addEventListener('submit', function(e) {
        const rows = document.querySelectorAll('#itemsBody tr');
        if (rows.length === 0) {
            e.preventDefault();
            Swal.fire('Cảnh báo', 'Vui lòng chọn ít nhất một sản phẩm cần xuất kho!', 'warning');
            return;
        }

        // Kiểm tra xem có dòng nào bị vượt quá tồn kho không
        let hasInvalid = false;
        rows.forEach(tr => {
            const qtyInput = tr.querySelector('.qty-input');
            if (qtyInput.classList.contains('is-invalid')) {
                hasInvalid = true;
            }
        });

        if (hasInvalid) {
            e.preventDefault();
            Swal.fire('Lỗi tồn kho', 'Có sản phẩm vượt quá số lượng tồn khả dụng trong kho. Vui lòng kiểm tra lại!', 'error');
        }
    });
</script>
@endsection
