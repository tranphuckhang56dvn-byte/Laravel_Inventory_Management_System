@extends('layouts.app')

@section('title', 'Bảng điều khiển kho')
@section('page_title', 'Bảng Điều Khiển & Thống Kê')

@section('content')
<div class="row g-3 mb-4">
    <!-- Stat 1: Tổng sản phẩm -->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom p-3 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Tổng mặt hàng</span>
                    <h3 class="fw-bold mt-1 mb-0 text-dark">{{ number_format($totalProducts) }}</h3>
                    <small class="text-muted"><i class="fa-solid fa-box text-primary me-1"></i>Sản phẩm đang quản lý</small>
                </div>
                <div class="p-3 rounded-4 bg-primary bg-opacity-10 text-primary">
                    <i class="fa-solid fa-boxes-stacked fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 2: Tổng tồn kho -->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom p-3 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Tổng số lượng tồn</span>
                    <h3 class="fw-bold mt-1 mb-0 text-dark">{{ number_format($totalStock) }}</h3>
                    <small class="text-success"><i class="fa-solid fa-cubes-stacked me-1"></i>Đơn vị hiện có trong kho</small>
                </div>
                <div class="p-3 rounded-4 bg-success bg-opacity-10 text-success">
                    <i class="fa-solid fa-warehouse fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 3: Tổng giá trị kho -->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom p-3 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Ước tính giá trị kho</span>
                    <h3 class="fw-bold mt-1 mb-0 text-dark">{{ number_format($totalStockValue) }} <span class="fs-6 fw-normal text-muted">đ</span></h3>
                    <small class="text-muted"><i class="fa-solid fa-coins text-warning me-1"></i>Tính theo giá vốn nhập</small>
                </div>
                <div class="p-3 rounded-4 bg-warning bg-opacity-10 text-warning">
                    <i class="fa-solid fa-sack-dollar fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 4: Cảnh báo tồn thấp -->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-custom p-3 h-100 border-{{ $lowStockCount > 0 ? 'danger' : 'light' }}">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Cảnh báo tồn tối thiểu</span>
                    <h3 class="fw-bold mt-1 mb-0 {{ $lowStockCount > 0 ? 'text-danger' : 'text-dark' }}">
                        {{ $lowStockCount }}
                    </h3>
                    <small class="{{ $lowStockCount > 0 ? 'text-danger fw-semibold' : 'text-muted' }}">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i>
                        {{ $lowStockCount > 0 ? 'Cần bổ sung hàng gấp' : 'Tồn kho ở mức an toàn' }}
                    </small>
                </div>
                <div class="p-3 rounded-4 bg-danger bg-opacity-10 text-danger">
                    <i class="fa-solid fa-bell fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="row g-3 mb-4">
    <!-- Chart: Biến động xuất nhập kho 6 tháng -->
    <div class="col-xl-8">
        <div class="card card-custom p-3 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-chart-line text-primary me-2"></i>Biểu Đồ Xu Hướng Nhập - Xuất Kho</h6>
                    <small class="text-muted">Tổng giá trị giao dịch nhập kho vs xuất kho qua các tháng (VNĐ)</small>
                </div>
                <span class="badge bg-light text-secondary border">6 tháng gần nhất</span>
            </div>
            <div style="position: relative; height: 300px;">
                <canvas id="monthlyFlowChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart: Phân bổ danh mục -->
    <div class="col-xl-4">
        <div class="card card-custom p-3 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-chart-pie text-success me-2"></i>Cơ Cấu Mặt Hàng</h6>
                    <small class="text-muted">Tỷ trọng sản phẩm theo danh mục</small>
                </div>
            </div>
            <div style="position: relative; height: 300px;" class="d-flex align-items-center justify-content-center">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <!-- Cảnh báo tồn kho dưới min_stock -->
    <div class="col-lg-6">
        <div class="card card-custom h-100">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold mb-0 text-danger">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i> Danh Sách Cảnh Báo Tồn Kho Dưới Ngưỡng (min_stock)
                    </h6>
                    <small class="text-muted">Sản phẩm có tồn kho thấp cần lập kế hoạch đặt thêm</small>
                </div>
                <a href="{{ route('products.low-stock') }}" class="btn btn-sm btn-outline-danger">Xem tất cả</a>
            </div>
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Danh mục</th>
                            <th class="text-center">Tồn / Tối thiểu</th>
                            <th class="text-end">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStockProducts as $lp)
                            <tr>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $lp->name }}</div>
                                    <small class="text-muted font-monospace">{{ $lp->sku }}</small>
                                </td>
                                <td>
                                    <span class="badge badge-subtle-primary">{{ $lp->category->name ?? 'N/A' }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger rounded-pill px-2 py-1 fs-6">
                                        {{ $lp->current_stock }}
                                    </span>
                                    <span class="text-muted small">/ {{ $lp->min_stock }} {{ $lp->unit }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('receipts.create') }}" class="btn btn-sm btn-outline-primary" title="Tạo phiếu nhập">
                                        <i class="fa-solid fa-cart-plus"></i> Nhập hàng
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="fa-solid fa-check-circle text-success fs-3 mb-2 d-block"></i>
                                    Tuyệt vời! Tất cả sản phẩm đều đảm bảo ngưỡng an toàn.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Biến động kho gần nhất (Audit Log) -->
    <div class="col-lg-6">
        <div class="card card-custom h-100">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="fa-solid fa-clock-rotate-left text-primary me-1"></i> Nhật Ký Biến Động Kho Gần Nhất
                    </h6>
                    <small class="text-muted">Truy vết kiểm toán giao dịch (Inventory Audit Log)</small>
                </div>
                <a href="{{ route('inventory.logs') }}" class="btn btn-sm btn-outline-primary">Xem toàn bộ</a>
            </div>
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Thời gian / Mã</th>
                            <th>Mặt hàng</th>
                            <th class="text-center">Biến động</th>
                            <th class="text-center">Tồn mới</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentLogs as $log)
                            <tr>
                                <td>
                                    <div class="small fw-semibold text-dark">{{ $log->created_at->format('d/m/Y H:i') }}</div>
                                    <small class="font-monospace text-primary">{{ $log->reference_code ?? 'N/A' }}</small>
                                </td>
                                <td>
                                    <div class="small fw-semibold text-truncate" style="max-width: 160px;" title="{{ $log->product->name ?? '' }}">
                                        {{ $log->product->name ?? 'N/A' }}
                                    </div>
                                    <small class="text-muted">{{ $log->user->name ?? 'Hệ thống' }}</small>
                                </td>
                                <td class="text-center">
                                    @if($log->type === 'in')
                                        <span class="badge badge-subtle-success">
                                            <i class="fa-solid fa-arrow-down me-1"></i>+{{ $log->quantity_change }}
                                        </span>
                                    @elseif($log->type === 'out')
                                        <span class="badge badge-subtle-danger">
                                            <i class="fa-solid fa-arrow-up me-1"></i>{{ $log->quantity_change }}
                                        </span>
                                    @else
                                        <span class="badge badge-subtle-warning">
                                            <i class="fa-solid fa-arrows-rotate me-1"></i>{{ $log->quantity_change > 0 ? '+'.$log->quantity_change : $log->quantity_change }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center fw-bold">
                                    {{ $log->quantity_after }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Chưa có giao dịch biến động nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // 1. Monthly Flow Chart (Chart.js)
    const ctxFlow = document.getElementById('monthlyFlowChart').getContext('2d');
    new Chart(ctxFlow, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [
                {
                    label: 'Giá trị nhập kho (VNĐ)',
                    data: {!! json_encode($chartReceipts) !!},
                    backgroundColor: 'rgba(37, 99, 235, 0.75)',
                    borderColor: '#2563eb',
                    borderWidth: 1,
                    borderRadius: 6,
                },
                {
                    label: 'Giá trị xuất kho (VNĐ)',
                    data: {!! json_encode($chartIssues) !!},
                    backgroundColor: 'rgba(16, 185, 129, 0.75)',
                    borderColor: '#10b981',
                    borderWidth: 1,
                    borderRadius: 6,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + new Intl.NumberFormat('vi-VN').format(context.raw) + ' đ';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(val) {
                            return (val / 1000000).toFixed(0) + ' Tr';
                        }
                    }
                }
            }
        }
    });

    // 2. Category Breakdown Chart (Chart.js)
    const ctxCat = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCat, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($catLabels) !!},
            datasets: [{
                data: {!! json_encode($catData) !!},
                backgroundColor: [
                    '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899', '#06b6d4'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection
