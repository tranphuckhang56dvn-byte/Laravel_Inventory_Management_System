<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hệ Thống Quản Lý Kho') - WMS Laravel</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- App Custom CSS -->
    <link href="{{ asset('css/app-custom.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <aside id="sidebar" class="d-flex flex-column flex-shrink-0">
            <div class="p-3 border-bottom border-secondary border-opacity-25 text-white d-flex align-items-center gap-3">
                <div class="rounded-3 bg-primary p-2 text-white shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fa-solid fa-boxes-stacked fs-5"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold tracking-tight">KHO VẬN WMS</h6>
                    <small class="text-secondary" style="font-size: 0.75rem;">Laravel 11 & RESTful API</small>
                </div>
            </div>

            <div class="py-3 flex-grow-1 overflow-y-auto">
                <div class="px-3 mb-2 text-uppercase text-secondary fw-bold" style="font-size: 0.7rem; letter-spacing: 0.08em;">
                    Tổng quan
                </div>
                <ul class="nav flex-column mb-3">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-chart-pie fa-fw"></i>
                            <span>Bảng điều khiển</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.low-stock') }}" class="nav-link {{ request()->routeIs('products.low-stock') ? 'active' : '' }}">
                            <i class="fa-solid fa-triangle-exclamation fa-fw text-warning"></i>
                            <span>Cảnh báo tồn kho</span>
                            @php
                                $sidebarAlertCount = \App\Models\Product::lowStock()->count();
                            @endphp
                            @if($sidebarAlertCount > 0)
                                <span class="badge bg-danger rounded-pill ms-auto px-2">{{ $sidebarAlertCount }}</span>
                            @endif
                        </a>
                    </li>
                </ul>

                <div class="px-3 mb-2 text-uppercase text-secondary fw-bold" style="font-size: 0.7rem; letter-spacing: 0.08em;">
                    Nghiệp vụ kho
                </div>
                <ul class="nav flex-column mb-3">
                    <li class="nav-item">
                        <a href="{{ route('receipts.index') }}" class="nav-link {{ request()->routeIs('receipts.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-cart-arrow-down fa-fw"></i>
                            <span>Nhập kho</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('issues.index') }}" class="nav-link {{ request()->routeIs('issues.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-truck-ramp-box fa-fw"></i>
                            <span>Xuất kho</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('inventory.logs') }}" class="nav-link {{ request()->routeIs('inventory.logs') ? 'active' : '' }}">
                            <i class="fa-solid fa-clock-rotate-left fa-fw"></i>
                            <span>Nhật ký biến động</span>
                        </a>
                    </li>
                </ul>

                <div class="px-3 mb-2 text-uppercase text-secondary fw-bold" style="font-size: 0.7rem; letter-spacing: 0.08em;">
                    Danh mục dữ liệu
                </div>
                <ul class="nav flex-column mb-3">
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.index', 'products.create', 'products.edit', 'products.show') ? 'active' : '' }}">
                            <i class="fa-solid fa-box-archive fa-fw"></i>
                            <span>Sản phẩm</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-tags fa-fw"></i>
                            <span>Danh mục</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-building-wheat fa-fw"></i>
                            <span>Nhà cung cấp</span>
                        </a>
                    </li>
                </ul>

                <div class="px-3 mb-2 text-uppercase text-secondary fw-bold" style="font-size: 0.7rem; letter-spacing: 0.08em;">
                    Hệ thống & Tích hợp
                </div>
                <ul class="nav flex-column">
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users-gear fa-fw"></i>
                                <span>Tài khoản & Phân quyền</span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('docs.api') }}" class="nav-link {{ request()->routeIs('docs.api') ? 'active' : '' }}">
                            <i class="fa-solid fa-network-wired fa-fw text-info"></i>
                            <span>Tài liệu RESTful API</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- User Info Sidebar Footer -->
            <div class="p-3 border-top border-secondary border-opacity-25 bg-black bg-opacity-25 text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar bg-primary rounded-circle text-white d-flex align-items-center justify-content-center fw-bold" style="width: 36px; height: 36px;">
                            {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="text-truncate" style="max-width: 130px;">
                            <div class="fw-semibold small text-truncate">{{ auth()->user()->name ?? 'Người dùng' }}</div>
                            <span class="badge {{ auth()->user()->isAdmin() ? 'bg-danger' : 'bg-primary' }} text-white" style="font-size: 0.65rem;">
                                {{ auth()->user()->isAdmin() ? 'Quản trị viên' : 'Thủ kho' }}
                            </span>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm text-secondary hover-text-white p-1" title="Đăng xuất">
                            <i class="fa-solid fa-arrow-right-from-bracket fs-6"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Topbar -->
            <header class="topbar d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <h5 class="mb-0 fw-bold text-dark">@yield('page_title', 'Hệ Thống Quản Lý Kho')</h5>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('docs.api') }}" class="btn btn-sm btn-outline-primary d-none d-md-inline-flex align-items-center gap-1">
                        <i class="fa-solid fa-code"></i> API Sanctum
                    </a>
                    <a href="{{ route('receipts.create') }}" class="btn btn-sm btn-outline-success d-inline-flex align-items-center gap-1">
                        <i class="fa-solid fa-plus"></i> Nhập kho
                    </a>
                    <a href="{{ route('issues.create') }}" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i> Xuất kho
                    </a>
                </div>
            </header>

            <!-- Main Body -->
            <main class="p-4 flex-grow-1">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 d-flex align-items-center gap-2 mb-4" role="alert">
                        <i class="fa-solid fa-circle-check fs-5"></i>
                        <div>{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 d-flex align-items-center gap-2 mb-4" role="alert">
                        <i class="fa-solid fa-triangle-exclamation fs-5"></i>
                        <div>{{ session('error') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-warning alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                        <div class="fw-bold mb-1"><i class="fa-solid fa-circle-exclamation me-1"></i> Vui lòng kiểm tra lại thông tin:</div>
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-top py-3 px-4 text-center text-muted small mt-auto">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <strong>Đồ án chuyên ngành CNTT:</strong> Xây dựng Hệ thống Quản lý Nhập - Xuất - Tồn kho ứng dụng Laravel Framework & RESTful API
                    </div>
                    <div>
                        Sinh viên thực hiện: <strong>Thái Anh Kiệt (25002447)</strong> & <strong>Trần Phúc Khang (25002446)</strong> - Lớp 25C2-LTM1
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- App Custom JS -->
    <script src="{{ asset('js/app-custom.js') }}"></script>
    @yield('scripts')
</body>
</html>
