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

/**
 * Điều khiển Sidebar dạng drawer trên màn hình nhỏ (Mobile / Tablet)
 */
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('sidebarBackdrop');
    const toggleBtn = document.getElementById('sidebarToggle');
    const closeBtn = document.getElementById('sidebarClose');

    if (!sidebar) {
        return;
    }

    const openSidebar = () => {
        sidebar.classList.add('show');
        if (backdrop) backdrop.classList.add('show');
        document.body.style.overflow = 'hidden';
    };

    const closeSidebar = () => {
        sidebar.classList.remove('show');
        if (backdrop) backdrop.classList.remove('show');
        document.body.style.overflow = '';
    };

    if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
    if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
    if (backdrop) backdrop.addEventListener('click', closeSidebar);

    sidebar.querySelectorAll('.nav-link').forEach((link) => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 992) {
                closeSidebar();
            }
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar.classList.contains('show')) {
            closeSidebar();
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992 && sidebar.classList.contains('show')) {
            closeSidebar();
        }
    });
});
