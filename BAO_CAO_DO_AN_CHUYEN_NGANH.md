# BÁO CÁO ĐỒ ÁN CHUYÊN NGÀNH
## NGÀNH LẬP TRÌNH MÁY TÍNH - KHÓA 2025

---

### **TÊN ĐỀ TÀI:**
# XÂY DỰNG HỆ THỐNG QUẢN LÝ NHẬP - XUẤT - TỒN KHO ỨNG DỤNG LARAVEL FRAMEWORK & RESTFUL API

---

### **THÔNG TIN NHÓM SINH VIÊN THỰC HIỆN:**
1. **Thái Anh Kiệt** – MSSV: **25002447** – Lớp: **25C2-LTM1** (Nhiệm vụ: Backend / Architecture / Transaction & Locking / API Sanctum)
2. **Trần Phúc Khang** – MSSV: **25002446** – Lớp: **25C2-LTM1** (Nhiệm vụ: Frontend / UI / RESTful Integration / Testing / Docs)

* **Khoa:** CÔNG NGHỆ THÔNG TIN
* **Học kỳ:** HK1 (2026 - 2027) | **Năm học:** 2025 - 2026

---

## MỤC LỤC
1. [LỜI CẢM ƠN & LỜI MỞ ĐẦU](#1-lời-cảm-ơn--lời-mở-đầu)
2. [CHƯƠNG 1: TỔNG QUAN & KHẢO SÁT BÀI TOÁN THỰC TẾ](#chương-1-tổng-quan--khảo-sát-bài-toán-thực-tế)
3. [CHƯƠNG 2: CƠ SỞ LÝ THUYẾT & CÔNG NGHỆ ỨNG DỤNG](#chương-2-cơ-sở-lý-thuyết--công-nghệ-ứng-dụng)
4. [CHƯƠNG 3: PHÂN TÍCH & THIẾT KẾ HỆ THỐNG](#chương-3-phân-tích--thiết-kế-hệ-thống)
5. [CHƯƠNG 4: HIỆN THỰC HỆ THỐNG & KẾT QUẢ ĐẠT ĐƯỢC](#chương-4-hiện-thực-hệ-thống--kết-quả-đạt-được)
6. [CHƯƠNG 5: KẾT LUẬN & HƯỚNG PHÁT TRIỂN](#chương-5-kết-luận--hướng-phát-triển)
7. [TÀI LIỆU THAM KHẢO](#tài-liệu-tham-khảo)

---

## 1. LỜI CẢM ƠN & LỜI MỞ ĐẦU

Trong bối cảnh kinh tế số và sự bùng nổ của chuỗi cung ứng hiện đại, việc quản lý kho hàng thủ công thông qua sổ sách truyền thống hoặc các file bảng tính rời rạc bộc lộ rất nhiều hạn chế: dễ sai sót số liệu, mất nhiều thời gian kiểm kê, thiếu khả năng truy vết lịch sử giao dịch và đặc biệt là không thể ngăn chặn lỗi chênh lệch tồn kho khi nhiều nhân viên cùng thao tác cùng một thời điểm.

Nhóm sinh viên thực hiện xin chân thành gửi lời cảm ơn sâu sắc đến quý Thầy Cô Khoa Công Nghệ Thông Tin đã truyền đạt kiến thức chuyên môn vững chắc về lập trình phần mềm, kiến trúc mạng và kỹ thuật cơ sở dữ liệu. Đồ án **"Xây dựng Hệ thống Quản lý Nhập - Xuất - Tồn kho ứng dụng Laravel Framework & RESTful API"** là thành quả của quá trình nghiên cứu, ứng dụng các kỹ thuật phần mềm tiên tiến vào giải quyết bài toán thực tế của doanh nghiệp.

---

## CHƯƠNG 1: TỔNG QUAN & KHẢO SÁT BÀI TOÁN THỰC TẾ

### 1.1. Lý do chọn đề tài
Quản lý kho là mắt xích sống còn của mọi doanh nghiệp thương mại, sản xuất và logistics. Một hệ thống quản lý kho (WMS - Warehouse Management System) hiệu quả không chỉ giúp nắm bắt chính xác số lượng hàng hóa sẵn có theo thời gian thực mà còn đảm bảo tối ưu chi phí lưu kho, tránh tình trạng đứt gãy nguồn hàng hoặc ứ đọng vốn.

### 1.2. Vấn đề thực tế cần giải quyết
1. **Xung đột giao dịch đồng thời (Concurrency & Race Condition):** Khi hai hoặc nhiều thủ kho cùng thực hiện xuất hoặc nhập cho cùng một mặt hàng tại cùng một thời điểm, nếu không có cơ chế khóa (locking) bản ghi, hệ thống sẽ đọc số liệu cũ, dẫn đến tình trạng số liệu ghi đè sai lệch và nguy hiểm nhất là **âm kho**.
2. **Thiếu khả năng truy vết kiểm toán (Audit Trail):** Khi xảy ra thất thoát hoặc chênh lệch hàng hóa, người quản lý không thể tra cứu ai đã thay đổi tồn kho, lúc mấy giờ, theo chứng từ nào và vì lý do gì.
3. **Cảnh báo thiếu hụt chậm trễ:** Không có cơ chế tự động theo dõi ngưỡng tồn tối thiểu (`min_stock`) để kịp thời thông báo mua bổ sung hàng hóa.
4. **Hạn chế trong việc tích hợp:** Các phần mềm cũ thiếu API mở chuẩn RESTful, gây khó khăn khi cần tích hợp với các hệ sinh thái bên thứ ba (máy quét mã vạch cầm tay, ứng dụng di động, sàn TMĐT).

### 1.3. Mục tiêu của đề tài
* **Mục tiêu tổng quát:** Xây dựng hoàn chỉnh một ứng dụng Web tập trung hỗ trợ nghiệp vụ Nhập - Xuất - Tồn kho; đảm bảo tính toàn vẹn dữ liệu tuyệt đối khi có nhiều người dùng thao tác đồng thời; cung cấp hệ thống báo cáo, Dashboard trực quan và hệ thống RESTful API chuẩn mực.
* **Mục tiêu cụ thể:**
  1. Quản lý danh mục hàng hóa, nhà cung cấp, thông tin sản phẩm và ngưỡng an toàn tồn kho.
  2. Xây dựng quy trình lập phiếu nhập kho, xuất kho an toàn áp dụng **Database Transaction** kết hợp **Pessimistic Locking (`lockForUpdate()`)**.
  3. Xây dựng hệ thống **Inventory Audit Log** ghi nhận chi tiết lịch sử từng lần biến động số lượng tồn.
  4. Triển khai cơ chế xác thực API bằng **Laravel Sanctum** và phân quyền người dùng theo vai trò **RBAC** (Admin, Warehouse Staff).
  5. Xây dựng **Dashboard** với biểu đồ thống kê xu hướng 6 tháng và cảnh báo tự động khi tồn kho xuống dưới ngưỡng an toàn.

---

## CHƯƠNG 2: CƠ SỞ LÝ THUYẾT & CÔNG NGHỆ ỨNG DỤNG

### 2.1. Laravel Framework
Laravel là PHP Framework mã nguồn mở hàng đầu thế giới với kiến trúc hiện đại, hỗ trợ mạnh mẽ ORM Eloquent, Database Migration, Database Seeder, Dependency Injection và mô hình MVC (Model - View - Controller). Hệ thống áp dụng thêm tầng **Service Layer (`InventoryService`)** để tách biệt toàn bộ nghiệp vụ xử lý kho phức tạp khỏi Controller, đảm bảo nguyên lý thiết kế Clean Architecture và Single Responsibility.

### 2.2. Giải quyết bài toán đồng thời bằng Database Transaction & Pessimistic Locking
Trong các ứng dụng giao dịch tài chính và kho vận, tính chất **ACID** (Atomicity, Consistency, Isolation, Durability) là yêu cầu bắt buộc:
* **Database Transaction (`DB::transaction`):** Đảm bảo việc thêm phiếu, cập nhật số dư tồn kho của các sản phẩm và ghi nhật ký kiểm toán phải thành công đồng thời 100%. Nếu một sản phẩm không đủ tồn kho hoặc có sự cố, toàn bộ tiến trình sẽ tự động `Rollback` về trạng thái ban đầu.
* **Pessimistic Locking (`SELECT ... FOR UPDATE`):**
  Trong Laravel Eloquent, phương thức `Product::where('id', $id)->lockForUpdate()->first()` sẽ đặt một Exclusive Lock (khóa độc quyền) lên hàng dữ liệu của sản phẩm đó trong cơ sở dữ liệu.
  * Mọi tiến trình khác muốn đọc hoặc cập nhật cùng dòng sản phẩm sẽ phải chờ cho đến khi Transaction hiện tại `Commit` hoặc `Rollback`.
  * Cơ chế này triệt tiêu hoàn toàn lỗi **Lost Updates** và **Race Conditions**, ngăn chặn triệt để hiện tượng xuất quá số lượng tồn (âm kho).

### 2.3. Xác thực RESTful API với Laravel Sanctum
Laravel Sanctum cung cấp hệ thống xác thực gọn nhẹ nhưng bảo mật tuyệt đối cho Single Page Applications (SPA), Mobile Apps và các dịch vụ token-based API. Khi người dùng đăng nhập thành công qua `/api/auth/login`, Sanctum sinh ra một chuỗi Bearer Token ngẫu nhiên có độ dài 64 ký tự được băm bằng SHA-256 lưu trong bảng `personal_access_tokens`. Mỗi yêu cầu tiếp theo chỉ cần đính kèm header `Authorization: Bearer <token>` để được cấp quyền truy cập.

### 2.4. Phân quyền theo vai trò (RBAC - Role-Based Access Control)
Hệ thống sử dụng Middleware `CheckRole` để kiểm tra quyền hạn của người dùng:
* **Admin (Quản trị viên):** Có toàn quyền đối với hệ thống, quản lý người dùng, phân quyền, thêm/sửa/xóa sản phẩm, nhà cung cấp, danh mục và thực hiện nghiệp vụ kiểm kê/điều chỉnh tồn kho.
* **Staff (Thủ kho):** Có quyền lập phiếu nhập kho, phiếu xuất kho, tra cứu tồn kho, xem danh sách sản phẩm và nhật ký biến động kho; không thể truy cập vào các trang cấu hình nhân sự hay xóa dữ liệu.

### 2.5. Trực quan hóa dữ liệu bằng Chart.js
Sử dụng thư viện **Chart.js** để hiển thị các biểu đồ tương tác:
* **Bar Chart / Line Chart:** Thống kê giá trị nhập kho so với giá trị xuất kho qua 6 tháng gần nhất.
* **Doughnut Chart:** Thể hiện cơ cấu tỷ trọng sản phẩm theo từng nhóm danh mục hàng hóa.

---

## CHƯƠNG 3: PHÂN TÍCH & THIẾT KẾ HỆ THỐNG

### 3.1. Phân tích chức năng hệ thống (Use Case)

```
+-------------------------------------------------------------------------------+
|                            HỆ THỐNG QUẢN LÝ KHO WMS                           |
+-------------------------------------------------------------------------------+
|                                                                               |
|   [Thủ Kho / Staff]                                                           |
|          |--- Đăng nhập hệ thống (Web & API Token)                           |
|          |--- Xem Dashboard & Cảnh báo tồn kho thấp (min_stock)               |
|          |--- Tra cứu danh mục, nhà cung cấp, sản phẩm                        |
|          |--- Lập phiếu nhập kho (Dynamic items, tự động tính tổng tiền)      |
|          |--- Lập phiếu xuất kho (Kiểm tra tồn an toàn, tự động trừ tồn)      |
|          |--- In phiếu nhập / phiếu xuất khổ A4 chuẩn                         |
|          |--- Tra cứu nhật ký biến động kho (Audit Log)                       |
|                                                                               |
|   [Quản Trị Viên / Admin] (Kế thừa toàn bộ quyền của Staff và mở rộng thêm)   |
|          |--- Thêm, Sửa, Xóa Sản phẩm, Danh mục, Nhà cung cấp                |
|          |--- Kiểm kê & Điều chỉnh tồn kho thực tế (Stock Adjustment)         |
|          |--- Quản lý danh sách tài khoản người dùng                          |
|          |--- Khóa / Mở khóa tài khoản & Phân vai trò Admin/Staff             |
+-------------------------------------------------------------------------------+
```

### 3.2. Sơ đồ tuần tự xử lý Xuất Kho an toàn (Sequence Diagram)

```
User (Staff)             Web/API Controller          InventoryService          Database (Product Table)
     |                           |                          |                             |
     |--- Gửi yêu cầu xuất kho ->|                          |                             |
     |    (product_id, qty=5)    |--- Gọi createIssue() --->|                             |
     |                           |                          |--- Mở DB::transaction() --->|
     |                           |                          |--- lockForUpdate() -------->| (Khóa độc quyền bản ghi)
     |                           |                          |<-- Trả về dữ liệu SP -------|
     |                           |                          |                             |
     |                           |                          |-- Kiểm tra: stock >= 5 ?    |
     |                           |                          |   [ĐỦ TỒN KHO]              |
     |                           |                          |-- Trừ: stock = stock - 5    |
     |                           |                          |--- Ghi goods_issues ------->|
     |                           |                          |--- Ghi goods_issue_items -->|
     |                           |                          |--- Ghi inventory_logs ----->| (Loại: 'out', -5)
     |                           |                          |--- Commit Transaction ----->| (Giải phóng khóa)
     |                           |<-- Trả về phiếu xuất ----|                             |
     |<-- Phản hồi thành công ---|                          |                             |
```

### 3.3. Thiết kế Cơ sở dữ liệu (Database Schema / ERD)

Cơ sở dữ liệu bao gồm 8 bảng chính được chuẩn hóa mức 3NF:

1. **`users`** (Người dùng & Phân quyền):
   * `id`: Khóa chính (Auto Increment)
   * `name`: Họ và tên người dùng
   * `email`: Địa chỉ email (Unique)
   * `password`: Mật khẩu băm Bcrypt
   * `phone`: Số điện thoại
   * `role`: Vai trò (`admin`, `staff`)
   * `status`: Trạng thái hoạt động (`true`/`false`)
   * `timestamps`

2. **`categories`** (Danh mục sản phẩm):
   * `id`, `code` (Unique), `name`, `description`, `status`, `timestamps`

3. **`suppliers`** (Nhà cung cấp):
   * `id`, `code` (Unique), `name`, `phone`, `email`, `address`, `status`, `timestamps`

4. **`products`** (Sản phẩm / Mặt hàng):
   * `id`: Khóa chính
   * `sku`: Mã sản phẩm nội bộ (Unique, index)
   * `barcode`: Mã vạch sản phẩm (Index)
   * `name`: Tên chi tiết sản phẩm
   * `category_id`: Khóa ngoại liên kết `categories(id)`
   * `supplier_id`: Khóa ngoại liên kết `suppliers(id)`
   * `unit`: Đơn vị tính (Cái, Hộp, Thùng, Kg...)
   * `purchase_price`: Giá vốn nhập (Decimal 15,2)
   * `selling_price`: Giá xuất bán (Decimal 15,2)
   * `current_stock`: Tồn kho thực tế hiện hành (Integer)
   * `min_stock`: Ngưỡng cảnh báo tồn tối thiểu (Integer, Default 5)
   * `max_stock`: Ngưỡng tồn tối đa (Integer, Default 1000)
   * `status`: Trạng thái kinh doanh (`true`/`false`)
   * `timestamps`

5. **`goods_receipts`** (Phiếu nhập kho):
   * `id`, `code` (Unique, e.g. PN-20261027-0001), `supplier_id` (FK), `user_id` (FK - người lập), `receipt_date`, `total_amount`, `status`, `note`, `timestamps`

6. **`goods_receipt_items`** (Chi tiết hàng nhập):
   * `id`, `goods_receipt_id` (FK, Cascade Delete), `product_id` (FK), `quantity`, `unit_price`, `total_price`, `note`, `timestamps`

7. **`goods_issues`** (Phiếu xuất kho):
   * `id`, `code` (Unique, e.g. PX-20261027-0001), `customer_name`, `user_id` (FK - người lập), `issue_date`, `total_amount`, `status`, `reason`, `note`, `timestamps`

8. **`goods_issue_items`** (Chi tiết hàng xuất):
   * `id`, `goods_issue_id` (FK, Cascade Delete), `product_id` (FK), `quantity`, `unit_price`, `total_price`, `note`, `timestamps`

9. **`inventory_logs`** (Nhật ký biến động kho - Audit Log):
   * `id`: Khóa chính
   * `product_id`: Khóa ngoại liên kết `products(id)`
   * `user_id`: Khóa ngoại liên kết `users(id)`
   * `type`: Loại biến động (`in`: nhập, `out`: xuất, `adjust`: kiểm kê điều chỉnh)
   * `reference_type`: Loại chứng từ (`receipt`, `issue`, `adjustment`, `initial`)
   * `reference_id`: Khóa chính của phiếu liên quan
   * `reference_code`: Mã chứng từ (PN-... hoặc PX-...)
   * `quantity_before`: Tồn kho trước giao dịch
   * `quantity_change`: Số lượng biến động (+ hoặc -)
   * `quantity_after`: Tồn kho sau giao dịch
   * `unit_price`: Đơn giá giao dịch
   * `note`: Diễn giải chi tiết lý do biến động
   * `created_at`: Thời điểm phát sinh giao dịch

---

## CHƯƠNG 4: HIỆN THỰC HỆ THỐNG & KẾT QUẢ ĐẠT ĐƯỢC

### 4.1. Môi trường triển khai & Kiến trúc thư mục mã nguồn
* **Môi trường Web Server:** XAMPP (`C:\xampp`) tích hợp Apache và PHP 8.3 (đã nạp extension `php_mongodb`).
* **Cơ sở dữ liệu chính:** **MongoDB** (Port 27017, Database: `laravel_inventory_management_system`, Driver: `mongodb/laravel-mongodb` v5.12).
* **Cơ sở dữ liệu dự phòng:** MySQL / MariaDB (Port 3306) trên XAMPP.
* **Thư mục Web Root:** Đã cấu hình Directory Junction liên kết trực tiếp vào `C:\xampp\htdocs\Laravel_Inventory_Management_System`.

Hệ thống được tổ chức chuyên nghiệp, tuân thủ nghiêm ngặt quy ước chuẩn của Laravel 11/12 và PSR-12:

```
E:\Laravel_Inventory_Management_System\
├── app\
│   ├── Http\
│   │   ├── Controllers\
│   │   │   ├── Api\         # 7 RESTful Controllers (Sanctum Token Auth)
│   │   │   └── Web\         # 8 Web Blade Controllers
│   │   └── Middleware\
│   │       └── CheckRole.php # Middleware phân quyền RBAC
│   ├── Models\              # 8 Eloquent Models (quan hệ, scopes, casts)
│   └── Services\
│       └── InventoryService.php # Lõi xử lý Transaction & Pessimistic Locking
├── database\
│   ├── migrations\          # 8 Database Migrations tạo bảng
│   └── seeders\
│       └── DatabaseSeeder.php # Khởi tạo dữ liệu mẫu phong phú
├── resources\views\         # Giao diện Blade hoàn chỉnh
│   ├── auth\login.blade.php
│   ├── dashboard\index.blade.php
│   ├── products\ (index, create, edit, show, low-stock)
│   ├── categories\index.blade.php
│   ├── suppliers\index.blade.php
│   ├── receipts\ (index, create, show)
│   ├── issues\ (index, create, show)
│   ├── inventory\logs.blade.php
│   ├── users\index.blade.php
│   └── docs\api.blade.php
├── routes\
│   ├── api.php              # 28 RESTful Endpoints
│   └── web.php              # Các routes điều hướng giao diện Web
├── tests\Feature\
│   └── InventorySystemTest.php # Bộ kiểm thử tự động 11 Tests đạt 100%
├── postman_collection.json  # File kiểm thử Postman tích hợp sẵn
└── README.md                # Tài liệu hướng dẫn cài đặt & vận hành
```

### 4.2. Đoạn mã nghiệp vụ cốt lõi: Concurrency & Pessimistic Locking
Tại file `app/Services/InventoryService.php`:

```php
public function createIssue(array $data, User $user): GoodsIssue
{
    return DB::transaction(function () use ($data, $user) {
        $code = $data['code'] ?? $this->generateIssueCode();
        $totalAmount = 0;

        $issue = GoodsIssue::create([
            'code' => $code,
            'customer_name' => $data['customer_name'] ?? 'Khách lẻ',
            'user_id' => $user->id,
            'issue_date' => $data['issue_date'] ?? date('Y-m-d'),
            'status' => 'completed',
            'reason' => $data['reason'] ?? 'Xuất bán',
            'note' => $data['note'] ?? null,
            'total_amount' => 0,
        ]);

        foreach ($data['items'] as $item) {
            // PESSIMISTIC LOCKING: Khóa hàng để kiểm tra và cập nhật tồn kho an toàn
            $product = Product::where('id', $item['product_id'])->lockForUpdate()->firstOrFail();

            $quantity = intval($item['quantity']);
            $unitPrice = floatval($item['unit_price'] ?? $product->selling_price);

            // Kiểm tra an toàn: Nếu tồn kho thực tế nhỏ hơn số lượng yêu cầu -> Dừng và Rollback
            if ($product->current_stock < $quantity) {
                throw new Exception("Sản phẩm '{$product->name}' không đủ tồn kho để xuất. Tồn hiện tại: {$product->current_stock}, Yêu cầu xuất: {$quantity}.");
            }

            $totalPrice = $quantity * $unitPrice;
            $totalAmount += $totalPrice;

            GoodsIssueItem::create([
                'goods_issue_id' => $issue->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
                'note' => $item['note'] ?? null,
            ]);

            // Trừ tồn kho và ghi nhật ký kiểm toán
            $before = $product->current_stock;
            $after = $before - $quantity;

            $product->current_stock = $after;
            $product->save();

            InventoryLog::create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'type' => 'out',
                'reference_type' => 'issue',
                'reference_id' => $issue->id,
                'reference_code' => $issue->code,
                'quantity_before' => $before,
                'quantity_change' => -$quantity,
                'quantity_after' => $after,
                'unit_price' => $unitPrice,
                'note' => 'Xuất kho theo phiếu ' . $issue->code . ' (' . $issue->reason . ')',
            ]);
        }

        $issue->update(['total_amount' => $totalAmount]);
        return $issue->fresh(['user', 'items.product']);
    });
}
```

### 4.3. Kết quả kiểm thử tự động (Automated Testing với PHPUnit)
Nhóm đã xây dựng bộ kiểm thử chức năng tự động `tests/Feature/InventorySystemTest.php`. Lệnh chạy:
```powershell
php artisan test
```
**Kết quả thực thi:**
* `test_the_application_returns_a_successful_response` -> PASSED
* `test_user_can_login_via_api_and_get_sanctum_token` -> PASSED
* `test_user_can_login_via_web` -> PASSED
* `test_goods_receipt_increases_stock_and_creates_audit_log` -> PASSED
* `test_goods_issue_decreases_stock_and_creates_audit_log` -> PASSED
* `test_goods_issue_fails_when_stock_is_insufficient` -> PASSED (Kiểm chứng thành công việc chặn âm kho)
* `test_low_stock_detection` -> PASSED (Kiểm chứng cảnh báo `min_stock`)
* `test_staff_cannot_access_user_management` -> PASSED (Kiểm chứng phân quyền RBAC)
* `test_admin_can_access_user_management` -> PASSED
* `test_admin_can_adjust_stock` -> PASSED
* **Tổng kết: 11/11 Tests Passed, 41 Assertions (100% đạt yêu cầu).**

---

## CHƯƠNG 5: KẾT LUẬN & HƯỚNG PHÁT TRIỂN

### 5.1. Kết quả đạt được so với Phiếu đăng ký đề tài
1. **Hoàn thành 100% các mục tiêu chức năng:** Quản lý sản phẩm, danh mục, nhà cung cấp, lập phiếu nhập, phiếu xuất, theo dõi tồn kho theo thời gian thực.
2. **Bảo vệ tính nhất quán dữ liệu:** Giải quyết triệt để vấn đề Race Condition và tranh chấp tài nguyên bằng Database Transaction và Pessimistic Locking (`lockForUpdate`).
3. **Kiểm toán minh bạch:** Hệ thống Inventory Audit Log ghi nhận chi tiết mọi biến động số dư.
4. **Bảo mật và phân quyền:** Đăng nhập xác thực bằng Session trên Web và Laravel Sanctum Bearer Token cho RESTful API, phân quyền theo vai trò RBAC (Admin, Staff).
5. **Giao diện trực quan:** Tích hợp biểu đồ thống kê Chart.js, cảnh báo tự động khi số lượng tồn xuống dưới ngưỡng an toàn `min_stock`, in ấn phiếu nhập xuất A4 chuẩn.

### 5.2. Hướng phát triển trong tương lai
* Tích hợp máy quét mã vạch qua Camera / Bluetooth Scanner để tăng tốc độ kiểm đếm hàng khi nhập và xuất kho.
* Bổ sung tính năng xuất báo cáo ra file Excel (.xlsx) và PDF tự động qua thư viện `phpoffice/phpspreadsheet` và `barryvdh/laravel-dompdf`.
* Phát triển ứng dụng Mobile App (Flutter / React Native) kết nối trực tiếp vào hệ thống RESTful API đã xây dựng sẵn.

---

## TÀI LIỆU THAM KHẢO
1. Laravel Documentation (v11.x & v12.x): https://laravel.com/docs
2. Laravel Sanctum Authentication Guide: https://laravel.com/docs/sanctum
3. Database Concurrency Control & Pessimistic Locking in RDBMS (MySQL / PostgreSQL / SQLite).
4. Chart.js Interactive Charting Library Documentation: https://www.chartjs.org/docs/
5. Clean Architecture & Service Pattern in Enterprise Web Applications.
