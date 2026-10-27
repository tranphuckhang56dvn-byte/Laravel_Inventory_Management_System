# Hệ Thống Quản Lý Nhập - Xuất - Tồn Kho (WMS)
> **Đồ Án Chuyên Ngành Ngành Lập Trình Máy Tính**  
> **Ứng dụng Laravel Framework & RESTful API**

---

## 👨‍💻 Thông Tin Sinh Viên Thực Hiện
* **Sinh viên 1:** Thái Anh Kiệt – **MSSV:** 25002447 – **Lớp:** 25C2-LTM1
* **Sinh viên 2:** Trần Phúc Khang – **MSSV:** 25002446 – **Lớp:** 25C2-LTM1
* **Khoa:** Công Nghệ Thông Tin  
* **Học kỳ:** HK1 (2026 - 2027) | **Năm học:** 2025 - 2026

---

## 🌟 Điểm Nổi Bật Của Hệ Thống
1. **Toàn Vẹn Dữ Liệu Tuyệt Đối (Database Transaction & Pessimistic Locking):**
   - Áp dụng `DB::transaction()` kết hợp `lockForUpdate()` trên Model `Product` khi lập phiếu nhập và phiếu xuất.
   - Triệt tiêu hoàn toàn hiện tượng **Race Condition** (tranh chấp tài nguyên) và **âm kho** khi nhiều thủ kho cùng xuất/nhập một mặt hàng đồng thời.
2. **Xác Thực API Chuẩn RESTful Với Laravel Sanctum:**
   - Cung cấp 28 API Endpoints chuẩn RESTful cho bên thứ ba hoặc Mobile App tích hợp.
   - Quản lý State qua Bearer Token có khả năng thu hồi an toàn.
3. **Phân Quyền Theo Vai Trò (RBAC - Role-Based Access Control):**
   - Vai trò **Quản trị viên (Admin)**: Toàn quyền quản lý hệ thống, quản lý tài khoản người dùng, xóa dữ liệu, kiểm kê/điều chỉnh kho.
   - Vai trò **Thủ kho (Warehouse Staff)**: Lập phiếu nhập kho, lập phiếu xuất kho, theo dõi tồn kho, tra cứu nhật ký biến động.
4. **Nhật Ký Biến Động Kho (Inventory Audit Log):**
   - Ghi nhận chi tiết từng giao dịch: Số lượng trước biến động (`quantity_before`), số lượng thay đổi (`quantity_change`), số lượng sau biến động (`quantity_after`), người thực hiện, thời gian chính xác tới từng giây.
5. **Dashboard Trực Quan & Cảnh Báo Tồn Kho Tối Thiểu (`min_stock`):**
   - Biểu đồ **Chart.js** trực quan hóa doanh số nhập/xuất 6 tháng gần nhất và cơ cấu danh mục hàng hóa.
   - Tự động phát hiện và cảnh báo các sản phẩm có `current_stock <= min_stock`.

---

## 🔑 Tài Khoản Đăng Nhập Mẫu

| Vai trò | Họ tên | Email | Mật khẩu | Ghi chú |
| :--- | :--- | :--- | :--- | :--- |
| **Admin** | Thái Anh Kiệt | `admin@kho.vn` | `admin123` | Quản trị viên cao nhất |
| **Thủ kho** | Trần Phúc Khang | `staff@kho.vn` | `staff123` | Nhân viên kho |
| **Thủ kho phụ** | Nguyễn Văn An | `nhanvien@kho.vn` | `password` | Nhân viên kho |

*(Giao diện đăng nhập web có sẵn các nút bấm một chạm tự động điền tài khoản để tiện demo chấm bài).*

---

## 🚀 Hướng Dẫn Cài Đặt & Chạy Ứng Dụng

### Yêu Cầu Môi Trường
- PHP >= 8.2 (Khuyên dùng PHP 8.3 trên Laragon / XAMPP)
- Composer >= 2.0
- Extension PHP: `pdo_sqlite`, `pdo_mysql`, `mbstring`, `openssl`, `curl`

### Các Bước Khởi Chạy Nhanh:
Mở terminal PowerShell tại thư mục dự án `E:\do_an_kho`:

```powershell
# 1. Cấu hình biến môi trường PHP & Composer của Laragon (nếu chưa có trong PATH)
$env:Path = "E:\laragon\bin\php\php-8.3.33-Win32-vs16-x64;E:\laragon\bin\composer;E:\laragon\bin\nodejs\node-v22;E:\laragon\bin\git\cmd;" + $env:Path

# 2. Khởi tạo Database và nạp dữ liệu mẫu
php artisan migrate:fresh --seed

# 3. Chạy Server phát triển
php artisan serve
```

Truy cập hệ thống tại trình duyệt: **`http://localhost:8000`**

---

## 🛠 Kiểm Thử Tự Động (Automated Testing)
Dự án đã tích hợp sẵn bộ kiểm thử chức năng tự động (PHPUnit Feature Tests) tại `tests/Feature/InventorySystemTest.php`:
- Kiểm tra đăng nhập Web & cấp Sanctum Token API
- Kiểm tra Transaction & Pessimistic Locking khi Nhập kho
- Kiểm tra Khóa hàng và ngăn chặn xuất kho vượt quá số lượng tồn
- Kiểm tra Cảnh báo tồn kho dưới `min_stock`
- Kiểm tra Phân quyền RBAC (Staff bị chặn truy cập trang Quản lý Người dùng)
- Kiểm tra Tính năng Kiểm kê điều chỉnh kho

Chạy lệnh kiểm thử:
```powershell
php artisan test
```
*Kết quả: **11/11 Tests Passed**, **41 Assertions Passed** (100% đạt chuẩn).*

---

## 📡 Danh Mục RESTful API Chính

| Method | Endpoint | Quyền | Chức năng |
| :--- | :--- | :---: | :--- |
| `POST` | `/api/auth/login` | Public | Đăng nhập nhận Sanctum Token |
| `GET` | `/api/auth/me` | Sanctum | Xem thông tin tài khoản hiện tại |
| `POST` | `/api/auth/logout` | Sanctum | Thu hồi Access Token |
| `GET` | `/api/dashboard/stats` | Sanctum | Lấy số liệu thống kê & biểu đồ Dashboard |
| `GET` | `/api/products` | Sanctum | Danh sách sản phẩm (hỗ trợ lọc từ khóa, danh mục) |
| `GET` | `/api/products/low-stock` | Sanctum | Danh sách sản phẩm dưới ngưỡng an toàn `min_stock` |
| `POST` | `/api/products` | Sanctum | Thêm sản phẩm mới |
| `POST` | `/api/products/{id}/adjust-stock` | Admin | Kiểm kê / điều chỉnh tồn kho (Pessimistic Lock) |
| `GET` | `/api/goods-receipts` | Sanctum | Danh sách phiếu nhập kho |
| `POST` | `/api/goods-receipts` | Sanctum | **Lập phiếu nhập (Transaction + Pessimistic Lock)** |
| `GET` | `/api/goods-issues` | Sanctum | Danh sách phiếu xuất kho |
| `POST` | `/api/goods-issues` | Sanctum | **Lập phiếu xuất (Transaction + Pessimistic Lock + Ngừa âm kho)** |
| `GET` | `/api/inventory-logs` | Sanctum | Tra cứu nhật ký biến động kho (Audit Trail) |

### Kiểm Thử Bằng Postman
File Postman Collection được chuẩn bị sẵn tại: [`postman_collection.json`](./postman_collection.json).
Mở Postman -> Chọn **Import** -> Chọn file `postman_collection.json` -> Chạy request `Login - Admin` (Token sẽ tự động lưu và gắn vào tất cả các request còn lại).

---

## 🗄 Cấu Trúc Cơ Sở Dữ Liệu
Hệ thống mặc định sử dụng **SQLite** (`database/database.sqlite`) để chấm bài chạy ngay không cần cài đặt phức tạp.

Nếu muốn chuyển sang **MySQL** (trên Laragon / XAMPP):
1. Mở file `.env`
2. Đổi các dòng cấu hình database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=do_an_kho
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Tạo database `do_an_kho` trong phpMyAdmin hoặc HeidiSQL, sau đó chạy:
   ```powershell
   php artisan migrate:fresh --seed
   ```
