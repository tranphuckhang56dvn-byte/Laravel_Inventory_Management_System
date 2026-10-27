@extends('layouts.app')

@section('title', 'Tài liệu RESTful API')
@section('page_title', 'Tài Liệu Kỹ Thuật RESTful API & Laravel Sanctum')

@section('content')
<div class="row g-4">
    <!-- Cột bên trái: Hướng dẫn nhanh xác thực Sanctum -->
    <div class="col-lg-4">
        <div class="card card-custom p-4 sticky-top" style="top: 20px;">
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="p-2 bg-primary bg-opacity-10 text-primary rounded-3">
                    <i class="fa-solid fa-key fs-5"></i>
                </div>
                <h6 class="fw-bold mb-0 text-dark">Cơ chế xác thực Sanctum</h6>
            </div>
            <p class="small text-muted mb-3">
                Hệ thống API sử dụng <strong>Laravel Sanctum Bearer Token</strong>. Mọi yêu cầu (ngoại trừ login) cần truyền Header:
            </p>
            <div class="bg-dark text-light p-3 rounded-3 small font-monospace mb-3">
                Authorization: Bearer &lt;your_token&gt;<br>
                Accept: application/json
            </div>
            <div class="alert alert-info py-2 px-3 small mb-3">
                <i class="fa-solid fa-circle-info me-1"></i> <strong>Lưu ý:</strong> Khi đang đăng nhập trên trình duyệt Web, bạn có thể mở trực tiếp các đường dẫn API (như <code>/api/products</code>, <code>/api/categories</code>, <code>/api/suppliers</code>) để xem dữ liệu JSON mà không bị lỗi <em>Unauthenticated</em>.
            </div>

            <h6 class="fw-bold small text-dark mb-2">Tài khoản kiểm thử Postman:</h6>
            <div class="p-3 bg-light rounded-3 small font-monospace mb-3">
                <div><strong>Admin:</strong> admin@kho.vn / admin123</div>
                <div class="mt-1"><strong>Staff:</strong> staff@kho.vn / staff123</div>
            </div>

            <div class="alert alert-info py-2 small mb-0">
                <i class="fa-solid fa-circle-info me-1"></i> Sử dụng công cụ <strong>Postman</strong> để import các endpoint bên phải và thực hiện kiểm thử tự động.
            </div>
        </div>
    </div>

    <!-- Cột bên phải: Chi tiết các Endpoint RESTful -->
    <div class="col-lg-8">
        <div class="card card-custom mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-lock text-primary me-2"></i>1. Xác thực người dùng (Authentication)
                </h6>
            </div>
            <div class="card-body p-4">
                <!-- Endpoint Login -->
                <div class="border rounded-3 p-3 mb-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-success font-monospace px-2 py-1">POST</span>
                        <code class="fw-bold text-dark fs-6">/api/auth/login</code>
                        <span class="badge bg-light text-secondary border ms-auto">Public</span>
                    </div>
                    <p class="small text-muted mb-2">Đăng nhập tài khoản và nhận mã Sanctum Access Token.</p>
                    <div class="small fw-semibold text-secondary mb-1">Request Body (JSON):</div>
                    <pre class="bg-dark text-light p-3 rounded-3 small font-monospace mb-2">{
  "email": "admin@kho.vn",
  "password": "admin123"
}</pre>
                    <div class="small fw-semibold text-secondary mb-1">Response 200 OK:</div>
                    <pre class="bg-light p-3 rounded-3 small font-monospace mb-0">{
  "success": true,
  "message": "Đăng nhập thành công.",
  "access_token": "1|nUj951lqJzS2P4...",
  "token_type": "Bearer",
  "user": { "id": 1, "name": "Thái Anh Kiệt (Admin)", "role": "admin" }
}</pre>
                </div>

                <!-- Endpoint Me & Logout -->
                <div class="border rounded-3 p-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-primary font-monospace px-2 py-1">GET</span>
                        <code class="fw-bold text-dark fs-6">/api/auth/me</code>
                        <span class="badge bg-warning text-dark border ms-auto">Sanctum Token</span>
                    </div>
                    <p class="small text-muted mb-2">Lấy thông tin người dùng đang đăng nhập.</p>

                    <div class="d-flex align-items-center gap-2 mt-3 mb-2">
                        <span class="badge bg-success font-monospace px-2 py-1">POST</span>
                        <code class="fw-bold text-dark fs-6">/api/auth/logout</code>
                        <span class="badge bg-warning text-dark border ms-auto">Sanctum Token</span>
                    </div>
                    <p class="small text-muted mb-0">Thu hồi và hủy bỏ Access Token hiện tại.</p>
                </div>
            </div>
        </div>

        <div class="card card-custom mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-chart-pie text-success me-2"></i>2. Thống kê & Dashboard
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="border rounded-3 p-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-primary font-monospace px-2 py-1">GET</span>
                        <code class="fw-bold text-dark fs-6">/api/dashboard/stats</code>
                        <span class="badge bg-warning text-dark border ms-auto">Sanctum Token</span>
                    </div>
                    <p class="small text-muted mb-2">Lấy các chỉ số KPI, biểu đồ xuất nhập kho 6 tháng, cơ cấu danh mục, và cảnh báo tồn kho.</p>
                </div>
            </div>
        </div>

        <div class="card card-custom mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-box-open text-warning me-2"></i>3. Quản lý Sản phẩm (Products API)
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-bordered small align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">Method</th>
                                <th style="width: 280px;">Endpoint</th>
                                <th>Mô tả</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge bg-primary">GET</span></td>
                                <td><code>/api/products</code></td>
                                <td>Danh sách sản phẩm (hỗ trợ lọc: <code>?keyword=...&category_id=...&low_stock=true</code>)</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-primary">GET</span></td>
                                <td><code>/api/products/low-stock</code></td>
                                <td>Danh sách các sản phẩm đang có tồn kho <code>current_stock &lt; min_stock</code></td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-success">POST</span></td>
                                <td><code>/api/products</code></td>
                                <td>Tạo mới sản phẩm (yêu cầu sku, name, category_id, unit, purchase_price, selling_price, min_stock)</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-primary">GET</span></td>
                                <td><code>/api/products/{id}</code></td>
                                <td>Xem chi tiết sản phẩm và 20 lịch sử biến động gần nhất</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-info text-dark">PUT</span></td>
                                <td><code>/api/products/{id}</code></td>
                                <td>Cập nhật thông tin sản phẩm</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-danger">DELETE</span></td>
                                <td><code>/api/products/{id}</code></td>
                                <td>Xóa sản phẩm (Admin, chỉ xóa được khi chưa có lịch sử giao dịch)</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-warning text-dark">POST</span></td>
                                <td><code>/api/products/{id}/adjust-stock</code></td>
                                <td>Kiểm kê / Điều chỉnh tồn kho với Pessimistic Locking (Admin &amp; Thủ kho)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card card-custom mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-cart-arrow-down text-info me-2"></i>4. Nghiệp vụ Nhập & Xuất Kho (Transaction + Pessimistic Locking)
                </h6>
            </div>
            <div class="card-body p-4">
                <!-- API Nhập kho -->
                <div class="border rounded-3 p-3 mb-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-success font-monospace px-2 py-1">POST</span>
                        <code class="fw-bold text-dark fs-6">/api/goods-receipts</code>
                        <span class="badge bg-success text-white border ms-auto"><i class="fa-solid fa-lock me-1"></i>DB Transaction + Lock</span>
                    </div>
                    <p class="small text-muted mb-2">Tạo phiếu nhập kho, khóa hàng (lockForUpdate), tăng tồn kho thực tế và ghi Audit Log.</p>
                    <div class="small fw-semibold text-secondary mb-1">Request Payload:</div>
                    <pre class="bg-dark text-light p-3 rounded-3 small font-monospace mb-0">{
  "supplier_id": 1,
  "receipt_date": "2026-10-27",
  "note": "Nhập kho linh kiện đối tác FPT",
  "items": [
    {
      "product_id": 1,
      "quantity": 20,
      "unit_price": 850000,
      "note": "Hàng nguyên seal"
    }
  ]
}</pre>
                </div>

                <!-- API Xuất kho -->
                <div class="border rounded-3 p-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-success font-monospace px-2 py-1">POST</span>
                        <code class="fw-bold text-dark fs-6">/api/goods-issues</code>
                        <span class="badge bg-success text-white border ms-auto"><i class="fa-solid fa-lock me-1"></i>Safe Concurrency Lock</span>
                    </div>
                    <p class="small text-muted mb-2">Tạo phiếu xuất kho, khóa hàng kiểm tra số dư tồn khả dụng (tránh âm kho), trừ tồn và ghi Audit Log.</p>
                    <div class="small fw-semibold text-secondary mb-1">Request Payload:</div>
                    <pre class="bg-dark text-light p-3 rounded-3 small font-monospace mb-0">{
  "customer_name": "Công ty TNHH Giải pháp Số",
  "issue_date": "2026-10-27",
  "reason": "Xuất bán",
  "items": [
    {
      "product_id": 1,
      "quantity": 5,
      "unit_price": 1100000
    }
  ]
}</pre>
                </div>
            </div>
        </div>

        <div class="card card-custom">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-clock-rotate-left text-secondary me-2"></i>5. Nhật ký Biến động kho (Audit Logs API)
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="border rounded-3 p-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-primary font-monospace px-2 py-1">GET</span>
                        <code class="fw-bold text-dark fs-6">/api/inventory-logs</code>
                        <span class="badge bg-warning text-dark border ms-auto">Sanctum Token</span>
                    </div>
                    <p class="small text-muted mb-0">Truy vấn toàn bộ lịch sử biến động kho. Hỗ trợ tham số lọc: <code>?product_id=...&type=in|out|adjust&from_date=...&to_date=...</code></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
