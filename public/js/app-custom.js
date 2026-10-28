/**
 * Xác nhận xóa bản ghi với SweetAlert2
 * @param {string} formId
 * @param {string} message
 */
function confirmDelete(formId, message = 'Bạn có chắc chắn muốn xóa bản ghi này không?') {
    if (typeof Swal === 'undefined') {
        if (confirm(message)) {
            document.getElementById(formId).submit();
        }
        return;
    }

    Swal.fire({
        title: 'Xác nhận xóa?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Đồng ý xóa',
        cancelButtonText: 'Hủy bỏ'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}
