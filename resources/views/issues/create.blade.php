@extends('layouts.app')

@section('title', 'Lập phiếu xuất kho')
@section('page_title', 'Tạo Phiếu Xuất Hàng Mới')

@section('content')
<form method="POST" action="{{ route('issues.store') }}" id="issueForm">
    @csrf
    <div class="row g-4">
        <!-- Thông tin chung phiếu xuất -->
        <div class="col-lg-4">
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
        <div class="col-lg-8">
            <div class="card card-custom">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="fa-solid fa-boxes-stacked text-primary me-2"></i>Danh mục hàng hóa cần xuất kho
                    </h6>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="btn-add-item">
                        <i class="fa-solid fa-plus me-1"></i> Thêm mặt hàng
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0" id="itemsTable">
                        <thead>
                            <tr>
                                <th style="width: 40%;">Sản phẩm (*)</th>
                                <th style="width: 15%;" class="text-center">Số lượng xuất (*)</th>
                                <th style="width: 20%;" class="text-end">Đơn giá xuất (VNĐ)</th>
                                <th style="width: 20%;" class="text-end">Thành tiền</th>
                                <th style="width: 5%;" class="text-center">Xóa</th>
                            </tr>
                        </thead>
                        <tbody id="itemsBody">
                            <!-- Các dòng được sinh bằng JS -->
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td colspan="3" class="text-end fw-bold fs-6">Tổng giá trị xuất kho:</td>
                                <td class="text-end fw-bold fs-5 text-primary" id="grandTotal">0 đ</td>
                                <td></td>
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
        'stock' => $p->current_stock
    ])) !!};

    let itemIndex = 0;

    function formatNumber(num) {
        return new Intl.NumberFormat('vi-VN').format(num);
    }

    function addRow() {
        const tbody = document.getElementById('itemsBody');
        const tr = document.createElement('tr');
        tr.id = `row-${itemIndex}`;

        let options = '<option value="">-- Chọn sản phẩm có tồn --</option>';
        availableProducts.forEach(p => {
            options += `<option value="${p.id}" data-price="${p.price}" data-unit="${p.unit}" data-stock="${p.stock}">
                ${p.sku} - ${p.name} (Khả dụng: ${p.stock} ${p.unit})
            </option>`;
        });

        tr.innerHTML = `
            <td>
                <select name="items[${itemIndex}][product_id]" class="form-select product-select" required onchange="onProductChange(${itemIndex})">
                    ${options}
                </select>
                <div class="stock-warning text-danger small mt-1" style="display:none;"></div>
            </td>
            <td>
                <input type="number" name="items[${itemIndex}][quantity]" class="form-control text-center qty-input" min="1" value="1" required oninput="onQuantityChange(${itemIndex})">
            </td>
            <td>
                <input type="number" step="1000" min="0" name="items[${itemIndex}][unit_price]" class="form-control text-end price-input" value="0" required oninput="calculateTotal(${itemIndex})">
            </td>
            <td class="text-end fw-semibold row-total" id="row-total-${itemIndex}">
                0 đ
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm text-danger p-1" onclick="removeRow(${itemIndex})">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
        itemIndex++;
        calculateGrandTotal();
    }

    function onProductChange(idx) {
        const row = document.getElementById(`row-${idx}`);
        const select = row.querySelector('.product-select');
        const selectedOption = select.options[select.selectedIndex];
        const priceInput = row.querySelector('.price-input');
        const qtyInput = row.querySelector('.qty-input');

        if (selectedOption && selectedOption.dataset.price) {
            priceInput.value = selectedOption.dataset.price;
            const stock = parseInt(selectedOption.dataset.stock) || 0;
            qtyInput.max = stock;
        }

        onQuantityChange(idx);
    }

    function onQuantityChange(idx) {
        const row = document.getElementById(`row-${idx}`);
        const select = row.querySelector('.product-select');
        const selectedOption = select.options[select.selectedIndex];
        const qtyInput = row.querySelector('.qty-input');
        const warning = row.querySelector('.stock-warning');

        if (selectedOption && selectedOption.dataset.stock) {
            const stock = parseInt(selectedOption.dataset.stock) || 0;
            const qty = parseInt(qtyInput.value) || 0;

            if (qty > stock) {
                warning.style.display = 'block';
                warning.innerHTML = `<i class="fa-solid fa-circle-exclamation me-1"></i> Vượt tồn khả dụng (${stock})!`;
                qtyInput.classList.add('is-invalid');
            } else {
                warning.style.display = 'none';
                qtyInput.classList.remove('is-invalid');
            }
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
