# Hệ Thống Quản Lý Nhập - Xuất - Tồn Kho (IMS - Inventory Management System)
> **Đồ Án Chuyên Ngành Ngành Lập Trình Máy Tính**  
> **Ứng dụng Laravel Framework & RESTful API (Chạy trên môi trường XAMPP)**

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

## 🚀 Hướng Dẫn Cài Đặt & Chạy Ứng Dụng Trên XAMPP

### Môi Trường Chạy Local (XAMPP & phpMyAdmin)
* **Thư mục cài đặt XAMPP:** `C:\xampp`
* **PHP:** `C:\xampp\php` (PHP 8.3)
* **Cơ sở dữ liệu:** **MySQL / MariaDB trên phpMyAdmin** (Port 3306, Database: `laravel_inventory_management_system`, User: `root`, Password: rỗng)
* **Quản trị CSDL trực quan:** Truy cập phpMyAdmin tại **`http://localhost/phpmyadmin`**
* **Thư mục Web Root:** Dự án đã được liên kết trực tiếp vào `C:\xampp\htdocs\Laravel_Inventory_Management_System`.

### Các Bước Khởi Chạy:
1. Mở **XAMPP Control Panel** (`C:\xampp\xampp-control.exe`), bấm **Start** cho cả **Apache** và **MySQL**.
2. **Cách 1 - Nhanh nhất (1-Click):**
   - Click đúp vào file [`chay_local.bat`](./chay_local.bat) ngay tại thư mục dự án `E:\Laravel_Inventory_Management_System`.
3. **Cách 2 - Chạy qua PowerShell/CMD:**
   - Mở PowerShell tại thư mục dự án `E:\Laravel_Inventory_Management_System`:
   ```powershell
   # Nạp đường dẫn PHP & Git của XAMPP
   $env:Path = "C:\xampp\php;C:\Program Files\Git\cmd;" + $env:Path

   # Khởi tạo và nạp dữ liệu mẫu ban đầu vào phpMyAdmin:
   php artisan migrate:fresh --seed

   # Khởi chạy server phát triển
   php artisan serve
   ```

Truy cập hệ thống tại: **`http://localhost:8000`**

*(Hoặc truy cập trực tiếp qua máy chủ Apache của XAMPP tại: `http://localhost/Laravel_Inventory_Management_System/public`)*

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
$env:Path = "C:\xampp\php;C:\Program Files\Git\cmd;" + $env:Path
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
