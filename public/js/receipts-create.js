/**
 * Quản lý danh mục hàng hóa trên form Lập phiếu nhập kho
 */

let itemIndex = 0;

function formatNumber(num) {
    return new Intl.NumberFormat('vi-VN').format(num);
}

function getAvailableProducts() {
    return window.availableProducts || [];
}

function addRow(productId = '', quantity = 1, price = 0) {
    const tbody = document.getElementById('itemsBody');
    if (!tbody) return;

    const tr = document.createElement('tr');
    tr.id = `row-${itemIndex}`;

    let options = '<option value="">-- Chọn sản phẩm --</option>';
    getAvailableProducts().forEach(p => {
        const selected = (p.id == productId) ? 'selected' : '';
        options += `<option value="${p.id}" data-price="${p.price}" data-unit="${p.unit}" data-stock="${p.stock}" ${selected}>${p.sku} - ${p.name} (Tồn: ${p.stock} ${p.unit})</option>`;
    });

    tr.innerHTML = `
        <td>
            <select name="items[${itemIndex}][product_id]" class="form-select product-select" required onchange="onProductChange(${itemIndex})">
                ${options}
            </select>
        </td>
        <td>
            <input type="number" name="items[${itemIndex}][quantity]" class="form-control text-center qty-input" min="1" value="${quantity}" required oninput="calculateTotal(${itemIndex})">
        </td>
        <td>
            <input type="number" step="1000" min="0" name="items[${itemIndex}][unit_price]" class="form-control text-end price-input" value="${price}" required oninput="calculateTotal(${itemIndex})">
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

    if (productId) {
        onProductChange(itemIndex);
    }

    itemIndex++;
    calculateGrandTotal();
}

function onProductChange(idx) {
    const row = document.getElementById(`row-${idx}`);
    if (!row) return;

    const select = row.querySelector('.product-select');
    const selectedOption = select.options[select.selectedIndex];
    const priceInput = row.querySelector('.price-input');

    if (selectedOption && selectedOption.dataset.price) {
        priceInput.value = selectedOption.dataset.price;
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

    const grandTotal = document.getElementById('grandTotal');
    if (grandTotal) {
        grandTotal.textContent = formatNumber(sum) + ' đ';
    }
}

function removeRow(idx) {
    const row = document.getElementById(`row-${idx}`);
    if (row) {
        row.remove();
        calculateGrandTotal();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const addBtn = document.getElementById('btn-add-item');
    if (addBtn) {
        addBtn.addEventListener('click', () => addRow());
    }

    // Thêm mặc định 1 dòng sản phẩm đầu tiên
    addRow();

    const form = document.getElementById('receiptForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const rows = document.querySelectorAll('#itemsBody tr');
            if (rows.length === 0) {
                e.preventDefault();
                if (typeof Swal !== 'undefined') {
                    Swal.fire('Thông báo', 'Vui lòng thêm ít nhất một sản phẩm cần nhập kho!', 'warning');
                } else {
                    alert('Vui lòng thêm ít nhất một sản phẩm cần nhập kho!');
                }
            }
        });
    }
});
