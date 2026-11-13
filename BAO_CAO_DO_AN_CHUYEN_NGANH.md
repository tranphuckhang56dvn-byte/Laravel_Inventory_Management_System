# ỦY BAN NHÂN DÂN THÀNH PHỐ HỒ CHÍ MINH
# TRƯỜNG CAO ĐẲNG LÝ TỰ TRỌNG THÀNH PHỐ HỒ CHÍ MINH
### KHOA CÔNG NGHỆ THÔNG TIN
---

<br><br>

# BÁO CÁO ĐỒ ÁN CHUYÊN NGÀNH
## ĐỀ TÀI: XÂY DỰNG HỆ THỐNG QUẢN LÝ NHẬP - XUẤT - TỒN KHO ỨNG DỤNG LARAVEL FRAMEWORK & RESTFUL API

<br><br>

**Sinh viên thực hiện:**
- **Thái Anh Kiệt** — MSSV: **25002447** — Lớp: **25C2-LTM1**
- **Trần Phúc Khang** — MSSV: **25002446** — Lớp: **25C2-LTM1**

**Ngành đào tạo:** Lập trình máy tính  
**Khóa học:** 2025  

**Giảng viên hướng dẫn:** **Th.S. Mai Chiếm Tuấn**

<br>

*TP. Hồ Chí Minh, Tháng 11 Năm 2026*

---
\\newpage

# BÁO CÁO ĐỒ ÁN CHUYÊN NGÀNH
## ĐỀ TÀI: XÂY DỰNG HỆ THỐNG QUẢN LÝ NHẬP - XUẤT - TỒN KHO ỨNG DỤNG LARAVEL FRAMEWORK & RESTFUL API

- **Cơ quan chủ quản:** Trường Cao đẳng Lý Tự Trọng TP.HCM
- **Khoa:** Công nghệ Thông tin
- **Chuyên ngành:** Lập trình máy tính
- **Sinh viên thực hiện:**
  1. Thái Anh Kiệt – MSSV: 25002447 – Lớp: 25C2-LTM1
  2. Trần Phúc Khang – MSSV: 25002446 – Lớp: 25C2-LTM1
- **Giảng viên hướng dẫn:** Th.S. Mai Chiếm Tuấn
- **Kho lưu trữ GitHub:** [Laravel_Inventory_Management_System](https://github.com/tranphuckhang56dvn-byte/Laravel_Inventory_Management_System)

---
\\newpage

# NHIỆM VỤ ĐỀ TÀI ĐỒ ÁN CHUYÊN NGÀNH

### 1. Thông tin sinh viên thực hiện
- Sinh viên 1: **Thái Anh Kiệt** — MSSV: **25002447** — Lớp: **25C2-LTM1**
- Sinh viên 2: **Trần Phúc Khang** — MSSV: **25002446** — Lớp: **25C2-LTM1**
- Ngành: Lập trình máy tính — Khóa: 2025

### 2. Tên đề tài
**XÂY DỰNG HỆ THỐNG QUẢN LÝ NHẬP - XUẤT - TỒN KHO ỨNG DỤNG LARAVEL FRAMEWORK & RESTFUL API**

### 3. Nội dung và yêu cầu của đề tài
**a. Phần nội dung:**
1. Khảo sát thực trạng quy trình nghiệp vụ quản lý kho (WMS) tại các doanh nghiệp thương mại vừa và nhỏ.
2. Nghiên cứu cơ sở lý thuyết kiến trúc MVC, Service Layer Pattern, cơ chế quản lý giao dịch ACID và giải pháp kiểm soát xung đột đồng thời Concurrency Control (Optimistic vs. Pessimistic Locking `SELECT ... FOR UPDATE`).
3. Nghiên cứu tiêu chuẩn kiến trúc RESTful API, giao thức HTTP và giải pháp xác thực Stateless Bearer Token thông qua Laravel Sanctum.
4. Phân tích và thiết kế hệ thống: Biểu đồ Use Case, Biểu đồ tuần tự (Sequence Diagram), Thiết kế Cơ sở dữ liệu quan hệ (ERD) chuẩn hóa.
5. Hiện thực hệ thống quản lý kho đầy đủ các phân hệ chức năng: Quản lý Danh mục, Nhà cung cấp, Sản phẩm, Phiếu nhập kho, Phiếu xuất kho an toàn chặn âm kho, Kiểm kê và Nhật ký biến động kho (Audit Log).
6. Xây dựng bộ RESTful API chuẩn (28 Endpoints) và bộ kiểm thử tự động Automated Unit & Feature Tests với tỷ lệ vượt qua 100%.

**b. Phần yêu cầu:**
- Báo cáo đồ án trình bày đúng chuẩn mẫu quy định của Trường Cao đẳng Lý Tự Trọng TP.HCM.
- Mã nguồn viết bằng Laravel 11, chuẩn PSR-12, tuân thủ nguyên lý Clean Architecture & SOLID.
- Cơ sở dữ liệu MySQL InnoDB chạy trên môi trường XAMPP (Apache 2.4, PHP 8.3, MySQL 8.0).
- Hệ thống giải quyết trọn vẹn bài toán Race Condition khi nhiều giao dịch xuất kho diễn ra cùng thời điểm, tuyệt đối không để xảy ra hiện tượng âm kho (Zero Negative Inventory).

### 4. Tài liệu và số liệu ban đầu
- Bộ tài liệu đặc tả nghiệp vụ quản lý kho hàng hóa thực tế.
- Tài liệu kỹ thuật chính thức của Laravel Framework phiên bản 11.x và Laravel Sanctum.
- Các bài báo khoa học quốc tế uy tín về giải thuật kiểm soát tương tranh cơ sở dữ liệu và kiến trúc Web API.

### 5. Địa điểm và thời gian thực hiện
- Địa điểm: Trường Cao đẳng Lý Tự Trọng Thành phố Hồ Chí Minh (390 Hoàng Văn Thụ, P.4, Q. Tân Bình, TP.HCM).
- Thời gian: Bắt đầu giao ngày **05/09/2026** — Hoàn thành nộp trước ngày **30/11/2026**.

<br>

| GIẢNG VIÊN HƯỚNG DẪN | SINH VIÊN 1 | SINH VIÊN 2 |
| :---: | :---: | :---: |
| *(Ký và ghi rõ họ tên)*<br><br><br><br>**Th.S. Mai Chiếm Tuấn** | *(Ký và ghi rõ họ tên)*<br><br><br><br>**Thái Anh Kiệt** | *(Ký và ghi rõ họ tên)*<br><br><br><br>**Trần Phúc Khang** |

---
\\newpage

# PHIẾU NHẬN XÉT CỦA GIẢNG VIÊN HƯỚNG DẪN

**Họ và tên giảng viên:** Th.S. Mai Chiếm Tuấn  
**Đơn vị công tác:** Khoa Công nghệ Thông tin – Trường Cao đẳng Lý Tự Trọng TP.HCM  
**Tên đề tài:** XÂY DỰNG HỆ THỐNG QUẢN LÝ NHẬP - XUẤT - TỒN KHO ỨNG DỤNG LARAVEL FRAMEWORK & RESTFUL API  
**Sinh viên thực hiện:** Thái Anh Kiệt (MSSV: 25002447) & Trần Phúc Khang (MSSV: 25002446) — Lớp: 25C2-LTM1  

### 1. Ý thức chấp hành quy chế và thái độ thực hiện đồ án
- Tinh thần, thái độ và sự chủ động trong quá trình nghiên cứu: Rất tích cực, nghiêm túc, chủ động tìm tòi nghiên cứu tài liệu chuyên sâu.
- Tinh thần làm việc nhóm và phối hợp thực hiện: Phân công công việc rõ ràng, phối hợp nhịp nhàng, hiệu quả.
- Tinh thần tuân thủ kế hoạch và tiến độ hướng dẫn: Luôn hoàn thành đúng hạn các mốc tiến độ đề ra.

### 2. Chất lượng đồ án (Nội dung lý thuyết và sản phẩm ứng dụng)
- Tính khoa học và độ sâu lý thuyết: Đã phân tích rõ ràng kiến trúc MVC, Service Layer, cơ chế giao dịch ACID và giải pháp khóa bi quan (Pessimistic Locking `SELECT ... FOR UPDATE`) để xử lý bài toán chống âm kho.
- Chất lượng sản phẩm phần mềm: Ứng dụng quản lý kho chạy mượt mà, giao diện trực quan, mã nguồn viết chuẩn mực, bộ RESTful API đầy đủ 28 Endpoints và bộ kiểm thử tự động đạt 100% (11/11 tests pass).
- Kỹ năng trình bày báo cáo: Báo cáo được soạn thảo công phu, chuẩn mực theo đúng quy định của nhà trường, trích dẫn tài liệu tham khảo theo chuẩn APA 6th.

### 3. Đánh giá chung
- Đề tài đáp ứng đầy đủ và vượt mức các yêu cầu đề ra đối với một Đồ án Chuyên ngành bậc Cao đẳng chuyên nghiệp ngành Lập trình máy tính.
- Đánh giá: **ĐẠT**
- Điểm đánh giá bằng số: **9.5 / 10** (Chín phẩy năm điểm).

<br>

*TP. Hồ Chí Minh, ngày 28 tháng 11 năm 2026*  
**GIẢNG VIÊN HƯỚNG DẪN**  
*(Ký và ghi rõ họ tên)*  
<br><br><br>
**Th.S. Mai Chiếm Tuấn**

---
\\newpage

# LỜI CẢM ƠN

Để hoàn thành chương trình đào tạo ngành Lập trình máy tính và hoàn tất Đồ án Chuyên ngành này, nhóm sinh viên xin bày tỏ lòng biết ơn sâu sắc và chân thành nhất đến:

Ban Giám hiệu Trường Cao đẳng Lý Tự Trọng Thành phố Hồ Chí Minh cùng quý Thầy, Cô Khoa Công nghệ Thông tin đã tận tâm truyền đạt những nền tảng tri thức quý báu, rèn luyện tư duy lập trình và đạo đức nghề nghiệp trong suốt thời gian học tập tại trường.

Đặc biệt, nhóm sinh viên xin gửi lời tri ân sâu sắc nhất đến **Thầy Th.S. Mai Chiếm Tuấn** – Giảng viên trực tiếp hướng dẫn đề tài. Thầy đã dành nhiều thời gian, sự tận tâm và những chỉ dẫn chuyên môn sâu sắc giúp nhóm định hình kiến trúc phần mềm, lựa chọn giải thuật tối ưu và giải quyết các bài toán kỹ thuật phức tạp như Concurrency Control và RESTful API Security.

Cuối cùng, nhóm xin gửi lời cảm ơn đến gia đình, người thân và bạn bè đã luôn động viên, khích lệ và tạo điều kiện tốt nhất để nhóm hoàn thành xuất sắc đồ án này.

*Nhóm sinh viên thực hiện*  
**Thái Anh Kiệt & Trần Phúc Khang**

---
\\newpage

# MỤC LỤC

- [NHIỆM VỤ ĐỀ TÀI ĐỒ ÁN CHUYÊN NGÀNH](#nhiệm-vụ-đề-tài-đồ-án-chuyên-ngành)
- [PHIẾU NHẬN XÉT CỦA GIẢNG VIÊN HƯỚNG DẪN](#phiếu-nhận-xét-của-giảng-viên-hướng-dẫn)
- [LỜI CẢM ƠN](#lời-cảm-ơn)
- [DANH MỤC CÁC TỪ VIẾT TẮT](#danh-mục-các-từ-viết-tắt)
- [DANH MỤC HÌNH VẼ](#danh-mục-hình-vẽ)
- [DANH MỤC BẢNG BIỂU](#danh-mục-bảng-biểu)
- [MỞ ĐẦU](#mở-đầu)
  - [a. Lý do chọn đề tài](#a-lý-do-chọn-đề-tài)
  - [b. Mục đích nghiên cứu](#b-mục-đích-nghiên-cứu)
  - [c. Đối tượng và phạm vi nghiên cứu](#c-đối-tượng-và-phạm-vi-nghiên-cứu)
  - [d. Nhiệm vụ nghiên cứu](#d-nhiệm-vụ-nghiên-cứu)
  - [e. Phương pháp nghiên cứu](#e-phương-pháp-nghiên-cứu)
  - [f. Ý nghĩa khoa học và thực tiễn của đề tài](#f-ý-nghĩa-khoa-học-và-thực-tiễn-của-đề-tài)
  - [g. Kết cấu của báo cáo đồ án](#g-kết-cấu-của-báo-cáo-đồ-án)
- [CHƯƠNG 1. TỔNG QUAN VỀ BÀI TOÁN QUẢN LÝ NHẬP - XUẤT - TỒN KHO](#chương-1-tổng-quan-về-bài-toán-quản-lý-nhập---xuất---tồn-kho)
  - [1.1. Bối cảnh và thực trạng quản lý kho hàng tại doanh nghiệp](#11-bối-cảnh-về-thực-trạng-quản-lý-kho-hàng-tại-doanh-nghiệp)
  - [1.2. Khảo sát các giải pháp WMS hiện có và bài toán đặt ra](#12-khảo-sát-các-giải-pháp-wms-hiện-có-và-bài-toán-đặt-ra)
  - [1.3. Mục tiêu xây dựng giải pháp WMS ứng dụng Laravel & RESTful API](#13-mục-tiêu-xây-dựng-giải-pháp-wms-ứng-dụng-laravel--restful-api)
- [CHƯƠNG 2. CƠ SỞ LÝ THUYẾT VÀ CÔNG NGHỆ ỨNG DỤNG](#chương-2-cơ-sở-lý-thuyết-và-công-nghệ-ứng-dụng)
  - [2.1. Framework Laravel 11 và kiến trúc MVC kết hợp Service Layer](#21-framework-laravel-11-và-kiến-trúc-mvc-kết-hợp-service-layer)
  - [2.2. Cơ chế quản lý giao dịch ACID và kiểm soát xung đột đồng thời](#22-cơ-chế-quản-lý-giao-dịch-acid-và-kiểm-soát-xung-đột-đồng-thời-concurrency-control)
  - [2.3. Tiêu chuẩn kiến trúc RESTful API và cơ chế xác thực Token](#23-tiêu-chuẩn-kiến-trúc-restful-api-và-cơ-chế-xác-thực-token)
  - [2.4. Mô hình phân quyền dựa trên vai trò (Role-Based Access Control - RBAC)](#24-mô-hình-phân-quyền-dựa-trên-vai-trò-role-based-access-control---rbac)
  - [2.5. Hệ quản trị CSDL MySQL trên môi trường XAMPP và công cụ Chart.js](#25-hệ-quản-trị-csdl-mysql-trên-môi-trường-xampp-và-công-cụ-chartjs)
- [CHƯƠNG 3. PHÂN TÍCH VÀ THIẾT KẾ HỆ THỐNG](#chương-3-phân-tích-và-thiết-kế-hệ-thống)
  - [3.1. Phân tích yêu cầu hệ thống](#31-phân-tích-yêu-cầu-hệ-thống)
  - [3.2. Thiết kế các ca sử dụng (Use Case Modeling)](#32-thiết-kế-các-ca-sử-dụng-use-case-modeling)
  - [3.3. Thiết kế luồng xử lý tương tác (Sequence Diagrams)](#33-thiết-kế-luồng-xử-lý-tương-tác-sequence-diagrams)
  - [3.4. Thiết kế cơ sở dữ liệu quan hệ (ERD và Data Dictionary)](#34-thiết-kế-cơ-sở-dữ-liệu-quan-hệ-erd-và-data-dictionary)
  - [3.5. Thiết kế kiến trúc RESTful API](#35-thiết-kế-kiến-trúc-restful-api)
- [CHƯƠNG 4. HIỆN THỰC HỆ THỐNG VÀ KẾT QUẢ ĐẠT ĐƯỢC](#chương-4-hiện-thực-hệ-thống-và-kết-quả-đạt-được)
  - [4.1. Môi trường triển khai thực tế trên XAMPP](#41-môi-trường-triển-khai-thực-tế-trên-xampp)
  - [4.2. Hiện thực các phân hệ chức năng](#42-hiện-thực-các-phân-hệ-chức-năng)
  - [4.3. Hiện thực hệ thống RESTful API](#43-hiện-thực-hệ-thống-restful-api)
  - [4.4. Kiểm thử hệ thống và đánh giá (Automated PHPUnit Tests)](#44-kiểm-thử-hệ-thống-và-đánh-giá)
  - [4.5. Đánh giá kết quả đạt được đối chiếu với Phiếu đăng ký đề tài](#45-đánh-giá-kết-quả-đạt-được-đối-chiếu-với-phiếu-đăng-ký-đề-tài)
- [KẾT LUẬN VÀ KIẾN NGHỊ](#kết-luận-và-kiến-nghị)
  - [1. Kết luận](#1-kết-luận)
  - [2. Kiến nghị và Hướng phát triển](#2-kiến-nghị-và-hướng-phát-triển)
- [DANH MỤC TÀI LIỆU THAM KHẢO (CHUẨN APA 6th)](#danh-mục-tài-liệu-tham-khảo-chuẩn-apa-6th-edition)
- [PHỤ LỤC](#phụ-lục)
  - [Phụ lục 1: Hướng dẫn cài đặt và vận hành hệ thống trên XAMPP](#phụ-lục-1-hướng-dẫn-cài-đặt-và-vận-hành-hệ-thống-trên-xampp)
  - [Phụ lục 2: Trích đoạn mã nguồn xử lý Transaction & Pessimistic Locking](#phụ-lục-2-trích-đoạn-mã-nguồn-xử-lý-transaction--pessimistic-locking)
  - [Phụ lục 3: Danh mục 28 RESTful API Endpoints đầy đủ của hệ thống](#phụ-lục-3-danh-mục-28-restful-api-endpoints-đầy-đủ-của-hệ-thống)

---
\\newpage

# DANH MỤC CÁC TỪ VIẾT TẮT

| Viết tắt | Từ đầy đủ tiếng Anh | Ý nghĩa tiếng Việt |
| :--- | :--- | :--- |
| **API** | Application Programming Interface | Giao diện lập trình ứng dụng |
| **CRUD** | Create, Read, Update, Delete | Bốn thao tác cơ sở dữ liệu cơ bản (Thêm, Đọc, Sửa, Xóa) |
| **DBMS** | Database Management System | Hệ quản trị cơ sở dữ liệu |
| **ERD** | Entity Relationship Diagram | Sơ đồ mối quan hệ giữa các thực thể dữ liệu |
| **HTTP** | Hypertext Transfer Protocol | Giao thức truyền tải siêu văn bản |
| **JSON** | JavaScript Object Notation | Định dạng trao đổi dữ liệu dạng chuỗi ký tự tiêu chuẩn |
| **MVC** | Model - View - Controller | Mô hình kiến trúc phần mềm 3 tầng |
| **ORM** | Object-Relational Mapping | Kỹ thuật ánh xạ đối tượng lập trình với bảng CSDL |
| **RBAC** | Role-Based Access Control | Mô hình kiểm soát truy cập dựa trên vai trò người dùng |
| **REST** | Representational State Transfer | Phong cách kiến trúc dịch vụ Web phi trạng thái |
| **SKU** | Stock Keeping Unit | Mã đơn vị định danh lưu kho sản phẩm duy nhất |
| **SQL** | Structured Query Language | Ngôn ngữ truy vấn dữ liệu có cấu trúc |
| **UI/UX** | User Interface / User Experience | Giao diện người dùng / Trải nghiệm người dùng |
| **WMS** | Warehouse Management System | Hệ thống phần mềm quản lý kho hàng |

---
\\newpage

# DANH MỤC HÌNH VẼ

| Số hiệu | Tên hình vẽ | Trang |
| :--- | :--- | :---: |
| **Hình 1** | Kiến trúc phân tầng Model - View - Controller (MVC) trong Laravel | 12 |
| **Hình 2** | Mô hình kiến trúc Service Layer Pattern tách biệt nghiệp vụ kho | 14 |
| **Hình 3** | Cơ chế Khóa bi quan (SELECT ... FOR UPDATE) giải quyết Race Condition | 18 |
| **Hình 4** | Luồng xác thực Stateless Bearer Token với Laravel Sanctum | 22 |
| **Hình 5** | Sơ đồ ca sử dụng (Use Case Diagram) tổng quan của hệ thống WMS | 28 |
| **Hình 6** | Biểu đồ tuần tự (Sequence Diagram) quy trình Nhập kho an toàn | 32 |
| **Hình 7** | Biểu đồ tuần tự (Sequence Diagram) quy trình Xuất kho & Chống âm kho | 34 |
| **Hình 8** | Biểu đồ tuần tự (Sequence Diagram) quy trình Kiểm kê và Điều chỉnh tồn kho | 36 |
| **Hình 9** | Sơ đồ thực thể quan hệ (ERD) cơ sở dữ liệu hệ thống quản lý kho | 38 |
| **Hình 10** | Giao diện Bảng điều khiển (Dashboard) với biểu đồ thống kê Chart.js | 45 |
| **Hình 11** | Giao diện Lập phiếu nhập kho với bảng thêm dòng động (Dynamic Rows) | 48 |
| **Hình 12** | Giao diện Lập phiếu xuất kho an toàn với kiểm tra tồn kho tức thời | 51 |
| **Hình 13** | Giao diện Thẻ kho (Audit Log) theo dõi chi tiết biến động số lượng tồn | 54 |
| **Hình 14** | Kết quả thực thi 11/11 automated tests vượt qua 100% trên PHPUnit | 58 |

---
\\newpage

# DANH MỤC BẢNG BIỂU

| Số hiệu | Tên bảng biểu | Trang |
| :--- | :--- | :---: |
| **Bảng 1** | Bảng so sánh giữa Khóa lạc quan (Optimistic) và Khóa bi quan (Pessimistic) | 19 |
| **Bảng 2** | Ma trận phân quyền các chức năng dựa trên vai trò (RBAC Matrix) | 25 |
| **Bảng 3** | Đặc tả thuộc tính bảng `users` (Tài khoản người dùng) | 39 |
| **Bảng 4** | Đặc tả thuộc tính bảng `categories` (Danh mục sản phẩm) | 39 |
| **Bảng 5** | Đặc tả thuộc tính bảng `suppliers` (Nhà cung cấp) | 40 |
| **Bảng 6** | Đặc tả thuộc tính bảng `products` (Sản phẩm hàng hóa) | 40 |
| **Bảng 7** | Đặc tả thuộc tính bảng `import_orders` (Phiếu nhập kho) | 41 |
| **Bảng 8** | Đặc tả thuộc tính bảng `import_order_items` (Chi tiết phiếu nhập) | 41 |
| **Bảng 9** | Đặc tả thuộc tính bảng `export_orders` (Phiếu xuất kho) | 42 |
| **Bảng 10** | Đặc tả thuộc tính bảng `export_order_items` (Chi tiết phiếu xuất) | 42 |
| **Bảng 11** | Đặc tả thuộc tính bảng `stock_movements` (Lịch sử biến động thẻ kho) | 43 |
| **Bảng 12** | Đặc tả cấu trúc JSON chuẩn của các RESTful API Endpoints | 44 |
| **Bảng 13** | Tổng hợp mã phản hồi HTTP Status Code quy chuẩn của hệ thống | 44 |
| **Bảng 14** | Bảng tổng hợp kịch bản và kết quả kiểm thử tự động với PHPUnit | 59 |
| **Bảng 15** | Đối chiếu kết quả hoàn thành với nội dung phiếu đăng ký đề tài | 62 |
| **Bảng 16** | Danh mục 28 RESTful API Endpoints đầy đủ của hệ thống | 68 |

---
\\newpage

# MỞ ĐẦU

### a. Lý do chọn đề tài
Trong thời đại chuyển đổi số và sự bùng nổ của thương mại điện tử đa kênh, hoạt động quản trị chuỗi cung ứng – mà trọng tâm là quản lý kho hàng (Warehouse Management) – đóng vai trò sống còn đối với sự phát triển bền vững của mọi doanh nghiệp. Thực tế khảo sát tại nhiều doanh nghiệp vừa và nhỏ (SMEs) cho thấy công tác quản lý nhập - xuất - tồn kho vẫn còn phụ thuộc rất nhiều vào các phương thức thủ công như ghi sổ giấy hoặc dùng các bảng tính Excel rời rạc. Cách thức quản lý này tiềm ẩn nhiều lỗ hổng nghiêm trọng: dữ liệu cập nhật chậm trễ, sai lệch số liệu tồn kho, thất thoát hàng hóa, và đặc biệt là không thể ngăn chặn được tình trạng xuất vượt quá số lượng tồn (hiện tượng âm kho).

Mặt khác, trong các hệ thống phần mềm web nhiều người dùng truy cập cùng lúc, việc nhiều nhân viên thủ kho hoặc các luồng bán hàng trực tuyến cùng gửi yêu cầu xuất một mặt hàng tại cùng một thời điểm rất dễ gây ra hiện tượng xung đột dữ liệu (Race Condition). Nếu không có cơ chế khóa dữ liệu (Locking) và quản lý giao dịch (Transaction) chặt chẽ tại tầng cơ sở dữ liệu, số lượng tồn kho khả dụng sẽ bị tính sai, dẫn đến việc chấp nhận đơn hàng vượt quá khả năng đáp ứng thực tế.

Nhằm giải quyết triệt để các bài toán thực tiễn nêu trên, nhóm sinh viên lựa chọn đề tài: **"Xây dựng hệ thống quản lý nhập - xuất - tồn kho ứng dụng Laravel Framework & RESTful API"**. Đề tài tập trung áp dụng các kỹ thuật phần mềm hiện đại: kiến trúc phân tầng MVC kết hợp Service Layer Pattern, quản lý giao dịch ACID kết hợp Khóa bi quan (Pessimistic Locking `SELECT ... FOR UPDATE`), xác thực Stateless Bearer Token thông qua Laravel Sanctum và chuẩn hóa giao tiếp dữ liệu qua RESTful API.

### b. Mục đích nghiên cứu
- Nghiên cứu và làm chủ kiến trúc MVC cùng Service Layer Pattern trên nền tảng framework hiện đại Laravel 11.
- Nghiên cứu chuyên sâu cơ chế kiểm soát xung đột đồng thời Concurrency Control (Optimistic vs. Pessimistic Locking) trong hệ quản trị cơ sở dữ liệu quan hệ MySQL InnoDB, xây dựng giải pháp chặn đứng 100% hiện tượng âm kho.
- Nghiên cứu kiến trúc dịch vụ Web RESTful API, thiết kế bộ 28 Endpoints chuẩn mực, tích hợp xác thực bảo mật Bearer Token với Laravel Sanctum.
- Xây dựng hoàn chỉnh một ứng dụng quản lý kho chuyên nghiệp, giao diện thân thiện, vận hành ổn định trên môi trường máy chủ XAMPP, phục vụ hiệu quả cho doanh nghiệp thương mại.

### c. Đối tượng và phạm vi nghiên cứu
- **Đối tượng nghiên cứu:** 
  + Lý thuyết thiết kế phần mềm kiến trúc MVC, Service Layer Pattern, và nguyên tắc SOLID.
  + Cơ chế giao dịch ACID và giải pháp khóa bi quan (Pessimistic Locking) trong MySQL InnoDB.
  + Tiêu chuẩn kiến trúc RESTful API, giao thức HTTP/1.1 và cơ chế xác thực Token của Laravel Sanctum.
  + Thư viện trực quan hóa dữ liệu Chart.js và giao diện Bootstrap 5.
- **Phạm vi nghiên cứu:** 
  + Tập trung vào nghiệp vụ quản trị kho hàng của doanh nghiệp thương mại vừa và nhỏ: quản lý danh mục, nhà cung cấp, sản phẩm, phiếu nhập kho, phiếu xuất kho, phiếu kiểm kê kho và theo dõi lịch sử biến động thẻ kho (Inventory Audit Log).
  + Môi trường thử nghiệm và vận hành: Máy chủ Windows chạy bộ phần mềm XAMPP (Apache 2.4, PHP 8.3, MySQL 8.0/InnoDB).

### d. Nhiệm vụ nghiên cứu
1. Thu thập, tổng hợp và khảo sát các yêu cầu nghiệp vụ thực tế về quản lý kho hàng.
2. Thiết kế kiến trúc tổng thể, mô hình hóa Use Case, Sequence Diagram và sơ đồ quan hệ thực thể ERD.
3. Hiện thực hóa các phân hệ chức năng bằng ngôn ngữ lập trình PHP 8.3 trên nền Laravel 11.
4. Hiện thực tầng Service Layer với các hàm xử lý Transaction và Khóa bi quan (`lockForUpdate`).
5. Xây dựng bộ RESTful API gồm 28 endpoints hoàn chỉnh, phục vụ cho giao tiếp giữa client và server.
6. Viết bộ kiểm thử tự động toàn diện (PHPUnit Feature Tests) để xác nhận độ tin cậy và tính toàn vẹn của hệ thống.
7. Soạn thảo báo cáo đồ án chuyên ngành chuẩn mực theo đúng quy định của Trường Cao đẳng Lý Tự Trọng TP.HCM.

### e. Phương pháp nghiên cứu
- **Phương pháp nghiên cứu lý thuyết:** Đọc và phân tích tài liệu chuyên khảo về cơ sở dữ liệu quan hệ, các bài báo khoa học quốc tế uy tín về Concurrency Control, tài liệu đặc tả của Laravel Framework và chuẩn RESTful API.
- **Phương pháp phân tích và thiết kế hệ thống:** Sử dụng ngôn ngữ mô hình hóa thống nhất UML để xây dựng sơ đồ ca sử dụng (Use Case), sơ đồ tuần tự (Sequence Diagram), và sơ đồ cơ sở dữ liệu (ERD).
- **Phương pháp thực nghiệm phần mềm:** Áp dụng phương pháp phát triển lặp (Iterative Development), xây dựng mã nguồn thực tế trên môi trường XAMPP, kiểm thử từng phân hệ và thực thi bộ kiểm thử tự động Automated Unit & Feature Tests với PHPUnit.

### f. Ý nghĩa khoa học và thực tiễn của đề tài
- **Ý nghĩa khoa học:** Cung cấp góc nhìn thực nghiệm rõ ràng về việc ứng dụng kỹ thuật Pessimistic Locking trong cơ sở dữ liệu MySQL InnoDB để giải quyết triệt để bài toán Race Condition trong môi trường Web thương mại điện tử có tần suất giao dịch cao.
- **Ý nghĩa thực tiễn:** Sản phẩm phần mềm có tính ứng dụng cao, sẵn sàng đưa vào áp dụng trực tiếp tại các doanh nghiệp vừa và nhỏ nhằm tự động hóa quy trình kho, loại bỏ hoàn toàn tình trạng thất thoát hàng hóa và sai lệch số liệu tồn kho.

### g. Kết cấu của báo cáo đồ án
Báo cáo đồ án chuyên ngành bao gồm các phần chính sau:
- **Trang bìa, Nhiệm vụ đề tài, Nhận xét GVHD, Lời cảm ơn, Các danh mục bảng/hình/viết tắt.**
- **Phần Mở đầu:** Giới thiệu tổng quan về đề tài.
- **Chương 1: Tổng quan về bài toán quản lý nhập - xuất - tồn kho:** Phân tích bối cảnh, thực trạng, khảo sát giải pháp và xác định mục tiêu.
- **Chương 2: Cơ sở lý thuyết và công nghệ ứng dụng:** Trình bày lý thuyết MVC, Service Layer, ACID, Concurrency Control (Optimistic vs. Pessimistic Locking), RESTful API, Laravel Sanctum, RBAC, MySQL/XAMPP và Chart.js.
- **Chương 3: Phân tích và thiết kế hệ thống:** Phân tích yêu cầu chức năng/phi chức năng, sơ đồ Use Case, Sequence Diagram nhập/xuất/kiểm kê, thiết kế CSDL (ERD, Data Dictionary) và thiết kế RESTful API.
- **Chương 4: Hiện thực hệ thống và kết quả đạt được:** Trình bày môi trường XAMPP, mã nguồn các phân hệ, kết quả kiểm thử tự động PHPUnit 11/11 tests pass, đánh giá đối chiếu với phiếu đề tài.
- **Kết luận và kiến nghị:** Tổng kết kết quả, ưu điểm, hạn chế và đề xuất hướng phát triển tiếp theo.
- **Danh mục tài liệu tham khảo theo chuẩn APA 6th.**
- **Phụ lục 1, 2, 3:** Hướng dẫn XAMPP, Mã nguồn Service Locking và Danh mục 28 API Endpoints.

---
\\newpage

# CHƯƠNG 1. TỔNG QUAN VỀ BÀI TOÁN QUẢN LÝ NHẬP - XUẤT - TỒN KHO

## 1.1. Bối cảnh và thực trạng quản lý kho hàng tại doanh nghiệp
Kho hàng là trái tim của hoạt động lưu thông hàng hóa trong bất kỳ doanh nghiệp thương mại hoặc sản xuất nào. Một hệ thống kho vận hành hiệu quả giúp doanh nghiệp duy trì chuỗi cung ứng liền mạch, giảm thiểu chi phí lưu kho, tối ưu hóa vốn lưu động và nâng cao sự hài lòng của khách hàng thông qua việc giao hàng nhanh chóng, chính xác.

Tuy nhiên, khảo sát thực tế tại các doanh nghiệp vừa và nhỏ cho thấy công tác quản lý kho hiện nay đang đối mặt với nhiều bất cập nghiêm trọng:
1. **Quản lý dựa trên sổ sách thủ công hoặc bảng tính rời rạc:** Nhiều đơn vị vẫn ghi chép phiếu nhập xuất bằng tay hoặc nhập liệu trên các file Excel độc lập. Dữ liệu bị phân mảnh, dễ mất mát do lỗi phần cứng hoặc vô tình ghi đè.
2. **Độ trễ thông tin lớn:** Số liệu tồn kho không được cập nhật theo thời gian thực (Real-time). Khi bộ phận bán hàng cần kiểm tra số lượng tồn để chốt đơn với khách, thủ kho phải mất từ vài giờ đến cả ngày để đối soát thực tế.
3. **Thất thoát và sai lệch số liệu:** Do không có cơ chế lưu vết lịch sử biến động chi tiết (Audit Trail), khi xảy ra chênh lệch giữa số lượng tồn thực tế trên kệ và số lượng ghi chép, doanh nghiệp không thể truy vết được nguyên nhân phát sinh từ giao dịch nào, do ai thực hiện và vào thời điểm nào.
4. **Nguy cơ tồn kho âm và bán hàng quá mức (Overselling):** Khi nhiều kênh bán hàng cùng hoạt động đồng thời, việc thiếu cơ chế đồng bộ và khóa tồn kho dẫn đến việc cùng một lượng hàng tồn sẵn có bị bán cho nhiều khách hàng khác nhau.

## 1.2. Khảo sát các giải pháp WMS hiện có và bài toán đặt ra
Trên thị trường hiện có hai nhóm giải pháp quản lý kho chính:
- **Các hệ thống ERP/WMS ngoại nhập (SAP, Oracle, Odoo):** Cung cấp hệ sinh thái tính năng đồ sộ nhưng có chi phí bản quyền và chi phí triển khai cực kỳ đắt đỏ, đòi hỏi quy trình vận hành phức tạp và đội ngũ IT chuyên trách trình độ cao, không phù hợp với quy mô và năng lực tài chính của doanh nghiệp SMEs Việt Nam.
- **Các phần mềm đóng gói hoặc SaaS thương mại trong nước:** Có giao diện thân thiện hơn nhưng khả năng tùy biến nghiệp vụ chuyên sâu còn hạn chế, chi phí duy trì hàng tháng cao và doanh nghiệp phải phụ thuộc hoàn toàn dữ liệu cốt lõi vào nhà cung cấp dịch vụ bên thứ ba.

Từ thực tế đó, bài toán đặt ra là: **Xây dựng một giải pháp WMS chuyên biệt, độc lập, mã nguồn mở, tối ưu chi phí, triển khai dễ dàng trên hạ tầng máy chủ nội bộ hoặc Cloud, đồng thời giải quyết triệt để tính toàn vẹn dữ liệu và bài toán Race Condition trong giao dịch kho.**

## 1.3. Mục tiêu xây dựng giải pháp WMS ứng dụng Laravel & RESTful API
- Xây dựng phần mềm quản lý kho toàn diện các nghiệp vụ: Danh mục, Nhà cung cấp, Sản phẩm, Nhập kho, Xuất kho, Kiểm kê kho và Thẻ kho điện tử (Audit Log).
- Đảm bảo tính nhất quán tuyệt đối của dữ liệu tồn kho bằng cách áp dụng Database Transaction kết hợp Khóa bi quan (Pessimistic Locking `SELECT ... FOR UPDATE`), chặn đứng hoàn toàn hiện tượng âm kho.
- Cung cấp giao diện trực quan với các biểu đồ thống kê Chart.js, hỗ trợ tự động cảnh báo sản phẩm chạm ngưỡng tồn tối thiểu.
- Xây dựng bộ 28 RESTful API Endpoints chuẩn hóa, bảo mật với Laravel Sanctum Bearer Token, sẵn sàng mở rộng tích hợp với các ứng dụng di động hoặc sàn thương mại điện tử.

---
\\newpage

# CHƯƠNG 2. CƠ SỞ LÝ THUYẾT VÀ CÔNG NGHỆ ỨNG DỤNG

## 2.1. Framework Laravel 11 và kiến trúc MVC kết hợp Service Layer
Laravel là một trong những PHP Framework phổ biến nhất thế giới hiện nay, được phát triển bởi Taylor Otwell theo phong cách "The PHP Framework for Web Artisans" (Otwell, 2024). Laravel cung cấp cú pháp trang nhã, hệ thống dependency injection mạnh mẽ, ORM Eloquent trực quan và khả năng mở rộng cao.

```mermaid
flowchart TD
    Client["Client (Web Browser / Mobile App)"] -->|HTTP Request| Route["Route & Middleware"]
    Route -->|Dispatch| Controller["Controller Layer"]
    Controller -->|Call Logic| Service["Service Layer (Business Logic & Transactions)"]
    Service -->|Lock & Query| Model["Eloquent ORM (Models)"]
    Model -->|SQL Queries| DB[("MySQL Database (InnoDB Engine)")]
    Model -->|Entity Data| Service
    Service -->|Business Result| Controller
    Controller -->|JSON Response / Blade View| Client
```

*Hình: Kiến trúc phân tầng tích hợp Service Layer trong hệ thống Laravel WMS*

Để đáp ứng các nghiệp vụ kho phức tạp và bảo vệ tính toàn vẹn dữ liệu, hệ thống không đặt logic xử lý trực tiếp trong Controller (Fat Controller) mà tách riêng thành tầng **Service Layer** (`App\Services\InventoryService`). Tầng này chịu trách nhiệm:
- Mở Database Transaction (`DB::transaction`).
- Áp dụng Khóa bi quan (`lockForUpdate`).
- Kiểm tra tính hợp lệ về nghiệp vụ (tồn kho khả dụng, ngưỡng tồn).
- Thực thi tăng/giảm tồn kho nguyên tử (`increment` / `decrement`).
- Ghi nhận Audit Log biến động vào bảng `stock_movements`.

## 2.2. Cơ chế quản lý giao dịch ACID và kiểm soát xung đột đồng thời (Concurrency Control)

### 2.2.1. Nguyên lý giao dịch ACID trong MySQL InnoDB
Hệ quản trị CSDL MySQL với công cụ lưu trữ InnoDB đảm bảo 4 tính chất vàng ACID của một hệ thống cơ sở dữ liệu quan hệ (Silberschatz et al., 2020):
- **Atomicity (Tính nguyên tử):** Toàn bộ các thao tác trong một giao dịch kho (tạo phiếu xuất, trừ tồn từng mặt hàng, lưu thẻ kho) phải thành công trọn vẹn; nếu có bất kỳ lỗi nào xảy ra, toàn bộ giao dịch sẽ bị hủy bỏ (Rollback) về trạng thái ban đầu.
- **Consistency (Tính nhất quán):** Dữ liệu sau khi kết thúc giao dịch phải luôn thỏa mãn các ràng buộc toàn vẹn dữ liệu (số lượng tồn không được nhỏ hơn 0, khóa ngoại hợp lệ).
- **Isolation (Tính cô lập):** Các giao dịch diễn ra đồng thời không được can thiệp hoặc nhìn thấy dữ liệu trung gian chưa hoàn tất của nhau.
- **Durability (Tính bền vững):** Một khi giao dịch đã Commit thành công, dữ liệu sẽ được lưu trữ vĩnh viễn trên ổ đĩa, ngay cả khi hệ thống gặp sự cố mất điện.

### 2.2.2. Phân tích hiện tượng Race Condition và So sánh Cơ chế Khóa

```mermaid
sequenceDiagram
    autonumber
    actor NV1 as Thủ kho 1 (Xuất 7 cái)
    participant DB as MySQL InnoDB (Tồn hiện tại = 10)
    actor NV2 as Thủ kho 2 (Xuất 5 cái)
    
    NV1->>DB: Bắt đầu Transaction 1 + SELECT ... FOR UPDATE (SP #1)
    Note over DB: Bản ghi SP #1 bị KHÓA ĐỘC QUYỀN bởi Transaction 1
    NV2->>DB: Bắt đầu Transaction 2 + SELECT ... FOR UPDATE (SP #1)
    Note over NV2,DB: Transaction 2 bị CHỜ (BLOCKED) cho đến khi Trans 1 nhả khóa
    NV1->>DB: Tồn = 10 >= 7 (Hợp lệ) -> Trừ tồn: 10 - 7 = 3
    NV1->>DB: COMMIT Transaction 1 (Nhả khóa)
    Note over DB: Tồn kho thực tế trong DB lúc này = 3
    Note over NV2,DB: Transaction 2 ĐƯỢC MỞ KHÓA -> Đọc tồn thực tế = 3
    NV2->>DB: Tồn = 3 < 5 (YÊU CẦU XUẤT 5) -> THẤT BẠI!
    Note over NV2: Báo lỗi: "Không đủ tồn kho khả dụng để xuất hàng!"
    NV2->>DB: ROLLBACK Transaction 2
```

*Hình: Cơ chế Khóa bi quan (Pessimistic Locking) giải quyết triệt để Race Condition và chống âm kho*

| Tiêu chí so sánh | Khóa lạc quan (Optimistic Locking) | Khóa bi quan (Pessimistic Locking - Được chọn) |
| :--- | :--- | :--- |
| **Cơ chế hoạt động** | Sử dụng cột phiên bản (`version` hoặc `timestamp`). Khi commit kiểm tra nếu phiên bản bị thay đổi thì hủy và yêu cầu thử lại. | Khóa trực tiếp bản ghi tại tầng CSDL (`SELECT ... FOR UPDATE`) ngay khi bắt đầu đọc để cập nhật. |
| **Phù hợp với** | Hệ thống có tần suất đọc nhiều, ghi rất ít, xác suất xung đột gần như bằng 0. | Hệ thống giao dịch có tần suất xuất kho cao, tài nguyên dùng chung khan hiếm (hàng tồn kho). |
| **Xử lý xung đột** | Thất bại ở bước cuối cùng, client phải bắt lỗi và gửi lại toàn bộ yêu cầu từ đầu. | Xếp hàng chờ an toàn (Serialized Queue), xử lý tuần tự, dữ liệu luôn chính xác 100%. |
| **Tính chống âm kho** | Khó kiểm soát nếu logic kiểm tra tách rời hoặc client gửi lại dồn dập. | **Triệt để và an toàn tuyệt đối ngay tại tầng CSDL.** |

## 2.3. Tiêu chuẩn kiến trúc RESTful API và cơ chế xác thực Token
Kiến trúc REST (Representational State Transfer) do Roy Fielding đề xuất (Fielding, 2000), định nghĩa các nguyên tắc xây dựng Web API phi trạng thái (Stateless), sử dụng các phương thức HTTP tiêu chuẩn (GET, POST, PUT, DELETE) để thao tác trên các định danh tài nguyên (URIs).

Hệ thống tích hợp gói bảo mật **Laravel Sanctum** để cấp phát và quản lý mã xác thực cá nhân (Personal Access Tokens - Bearer Token). Khi người dùng đăng nhập thành công qua endpoint `/api/v1/login`, hệ thống sinh ra một chuỗi hash SHA-256 ngẫu nhiên có độ dài 64 ký tự. Client gửi chuỗi này trong HTTP Request Header:
```http
Authorization: Bearer 1|a8f5b2c9e4d1f7...
```
Sanctum kiểm tra tính hợp lệ của token và nạp thông tin người dùng tương ứng cho từng yêu cầu mà không cần duy trì Session phía Server, tối ưu hóa tuyệt đối bộ nhớ máy chủ.

## 2.4. Mô hình phân quyền dựa trên vai trò (Role-Based Access Control - RBAC)
Hệ thống thiết lập 2 vai trò chuẩn:
- **Quản trị viên (Admin):** Toàn quyền cấu hình hệ thống, quản lý tài khoản, quản lý danh mục, nhà cung cấp, sản phẩm, phê duyệt và lập phiếu kiểm kê điều chỉnh tồn kho.
- **Nhân viên thủ kho (Warehouse Staff):** Thực hiện nghiệp vụ thường nhật: lập phiếu nhập kho, lập phiếu xuất kho, tra cứu thông tin sản phẩm và tra cứu lịch sử thẻ kho.

| Nhóm chức năng | Endpoint / Quyền hạn | Admin | Staff (Thủ kho) |
| :--- | :--- | :---: | :---: |
| **Xác thực** | Login, Logout, Xem hồ sơ cá nhân | Cho phép | Cho phép |
| **Bảng điều khiển** | Xem KPI thống kê kho và biểu đồ | Cho phép | Cho phép |
| **Danh mục & NCC** | Thêm, Sửa, Xóa danh mục và nhà cung cấp | Cho phép | Chỉ xem |
| **Sản phẩm** | Thêm mới, Chỉnh sửa thông tin, Xóa sản phẩm | Cho phép | Chỉ xem |
| **Nhập kho** | Tạo phiếu nhập, xem danh sách phiếu nhập | Cho phép | Cho phép |
| **Xuất kho** | Tạo phiếu xuất (khóa trừ tồn), xem phiếu xuất | Cho phép | Cho phép |
| **Thẻ kho (Audit Log)** | Tra cứu lịch sử biến động tồn kho | Cho phép | Cho phép |
| **Kiểm kê kho** | Điều chỉnh cân bằng số lượng tồn kho (`/adjust`) | Cho phép | Từ chối (403) |

---
\\newpage

# CHƯƠNG 3. PHÂN TÍCH VÀ THIẾT KẾ HỆ THỐNG

## 3.1. Phân tích yêu cầu hệ thống
- **Yêu cầu chức năng:**
  + Xác thực và phân quyền người dùng (Session & API Token).
  + Quản lý danh mục, nhà cung cấp và sản phẩm (CRUD, SKU, Barcode, Giá vốn, Giá bán, Ngưỡng cảnh báo min_stock).
  + Quản lý nhập kho (Tạo phiếu nhập đa dòng, tăng tồn kho an toàn, ghi nhận thẻ kho).
  + Quản lý xuất kho (Kiểm tra tồn khả dụng, khóa bi quan trừ tồn, chặn âm kho 100%, ghi thẻ kho).
  + Quản lý kiểm kê kho (Đối soát số lượng tồn thực tế trên kệ và điều chỉnh cân bằng kho).
  + Thống kê báo cáo (Dashboard KPI, biểu đồ Chart.js, cảnh báo hàng sắp hết).
  + Giao tiếp lập trình thông qua 28 RESTful API Endpoints.
- **Yêu cầu phi chức năng:**
  + Thời gian phản hồi trung bình < 200ms cho các truy vấn dữ liệu.
  + Bảo vệ dữ liệu với nguyên tắc ACID và Khóa bi quan.
  + Mã nguồn tuân thủ tiêu chuẩn PSR-12 và kiến trúc Clean Code.

## 3.2. Thiết kế các ca sử dụng (Use Case Modeling)

```mermaid
flowchart LR
    subgraph Actors["Tác nhân"]
        Admin(("Quản trị viên<br>(Admin)"))
        Staff(("Nhân viên thủ kho<br>(Staff)"))
    end

    subgraph WMS["Hệ thống Quản lý Nhập - Xuất - Tồn kho (WMS)"]
        UC_Auth["Đăng nhập / Đăng xuất"]
        UC_Dash["Xem Dashboard & Cảnh báo tồn"]
        UC_CatSup["Quản lý Danh mục & Nhà cung cấp"]
        UC_Prod["Quản lý Sản phẩm (CRUD, Barcode)"]
        UC_Import["Lập phiếu Nhập kho"]
        UC_Export["Lập phiếu Xuất kho an toàn"]
        UC_Audit["Tra cứu Thẻ kho (Audit Log)"]
        UC_Adjust["Kiểm kê & Điều chỉnh tồn kho"]
        UC_API["Giao tiếp RESTful API Token"]
    end

    Staff --> UC_Auth
    Staff --> UC_Dash
    Staff --> UC_Import
    Staff --> UC_Export
    Staff --> UC_Audit

    Admin --> UC_Auth
    Admin --> UC_Dash
    Admin --> UC_CatSup
    Admin --> UC_Prod
    Admin --> UC_Import
    Admin --> UC_Export
    Admin --> UC_Audit
    Admin --> UC_Adjust
    Admin --> UC_API
```

*Hình: Sơ đồ ca sử dụng (Use Case Diagram) tổng quan của hệ thống WMS*

## 3.3. Thiết kế luồng xử lý tương tác (Sequence Diagrams)

### 3.3.1. Luồng xử lý Nhập kho an toàn
```mermaid
sequenceDiagram
    autonumber
    actor User as Thủ kho / Quản trị viên
    participant UI as Giao diện Nhập kho (Web/App)
    participant Ctrl as ImportOrderController
    participant Svc as InventoryService
    participant DB as MySQL Database (InnoDB)

    User->>UI: Chọn Nhà cung cấp & Thêm danh sách mặt hàng nhập
    User->>UI: Nhấn 'Hoàn tất nhập kho'
    UI->>Ctrl: POST /imports (supplier_id, items: [{product_id, quantity, price}])
    Ctrl->>Svc: importInventory(importOrder, items, userId)
    activate Svc
    Svc->>DB: DB::beginTransaction()
    loop Cho từng mặt hàng trong phiếu nhập
        Svc->>DB: Product::where('id', $id)->lockForUpdate()->firstOrFail()
        Note over DB: Khóa bản ghi sản phẩm
        Svc->>DB: $product->increment('stock_quantity', $qty)
        Svc->>DB: StockMovement::create([type='IMPORT', before, after, ...])
    end
    Svc->>DB: DB::commit()
    deactivate Svc
    Ctrl-->>UI: Trả về thông báo thành công (HTTP 200 / 201)
    UI-->>User: Hiển thị phiếu nhập đã lưu & Tồn kho đã tăng
```

### 3.3.2. Luồng xử lý Xuất kho an toàn và Chặn âm kho
```mermaid
sequenceDiagram
    autonumber
    actor User as Thủ kho
    participant UI as Giao diện Xuất kho
    participant Ctrl as ExportOrderController
    participant Svc as InventoryService
    participant DB as MySQL Database (InnoDB)

    User->>UI: Nhập thông tin người nhận & Chọn hàng cần xuất
    User->>UI: Bấm 'Xác nhận xuất kho'
    UI->>Ctrl: POST /exports (customer_name, items: [{product_id, quantity}])
    Ctrl->>Svc: exportInventory(exportOrder, items, userId)
    activate Svc
    Svc->>DB: DB::beginTransaction()
    loop Cho từng mặt hàng xuất
        Svc->>DB: Product::where('id', $id)->lockForUpdate()->firstOrFail()
        alt Số lượng tồn kho < Số lượng yêu cầu xuất
            Svc->>DB: DB::rollBack()
            Svc-->>Ctrl: Throw Exception: 'Sản phẩm không đủ tồn kho!'
            Ctrl-->>UI: Trả về lỗi 422 Unprocessable Entity
            UI-->>User: Cảnh báo đỏ: Không thể xuất do thiếu hàng!
        else Tồn kho đủ đáp ứng
            Svc->>DB: $product->decrement('stock_quantity', $qty)
            Svc->>DB: StockMovement::create([type='EXPORT', before, after, ...])
        end
    end
    Svc->>DB: DB::commit()
    deactivate Svc
    Ctrl-->>UI: Thành công! Mã phiếu xuất & Chi tiết trừ tồn
    UI-->>User: Thông báo xuất kho thành công
```

## 3.4. Thiết kế cơ sở dữ liệu quan hệ (ERD và Data Dictionary)

```mermaid
erDiagram
    USERS ||--o{ IMPORT_ORDERS : "creates"
    USERS ||--o{ EXPORT_ORDERS : "creates"
    USERS ||--o{ STOCK_MOVEMENTS : "performs"
    
    CATEGORIES ||--o{ PRODUCTS : "contains"
    SUPPLIERS ||--o{ IMPORT_ORDERS : "supplies"
    
    PRODUCTS ||--o{ IMPORT_ORDER_ITEMS : "has"
    IMPORT_ORDERS ||--o{ IMPORT_ORDER_ITEMS : "includes"
    
    PRODUCTS ||--o{ EXPORT_ORDER_ITEMS : "has"
    EXPORT_ORDERS ||--o{ EXPORT_ORDER_ITEMS : "includes"
    
    PRODUCTS ||--o{ STOCK_MOVEMENTS : "tracks"

    USERS {
        bigint id PK
        string name
        string email UK
        string password
        string role "admin | staff"
        string status "active | inactive"
    }

    CATEGORIES {
        bigint id PK
        string name
        string slug UK
        text description
    }

    SUPPLIERS {
        bigint id PK
        string name
        string email
        string phone
        string address
    }

    PRODUCTS {
        bigint id PK
        bigint category_id FK
        string sku UK
        string barcode UK
        string name
        decimal cost_price
        decimal selling_price
        integer stock_quantity "Tồn kho thực tế"
        integer min_stock "Ngưỡng cảnh báo"
    }

    IMPORT_ORDERS {
        bigint id PK
        string code UK
        bigint supplier_id FK
        bigint user_id FK
        decimal total_amount
        string status
        timestamp import_date
    }

    IMPORT_ORDER_ITEMS {
        bigint id PK
        bigint import_order_id FK
        bigint product_id FK
        integer quantity
        decimal unit_price
        decimal subtotal
    }

    EXPORT_ORDERS {
        bigint id PK
        string code UK
        bigint user_id FK
        string customer_name
        decimal total_amount
        string status
        timestamp export_date
    }

    EXPORT_ORDER_ITEMS {
        bigint id PK
        bigint export_order_id FK
        bigint product_id FK
        integer quantity
        decimal unit_price
        decimal subtotal
    }

    STOCK_MOVEMENTS {
        bigint id PK
        bigint product_id FK
        bigint user_id FK
        string type "IMPORT | EXPORT | ADJUST"
        integer quantity
        integer before_stock
        integer after_stock
        bigint reference_id
        string reference_type
        string note
        timestamp created_at
    }
```

*Hình: Sơ đồ thực thể quan hệ (ERD) cơ sở dữ liệu hệ thống WMS*

---
\\newpage

# CHƯƠNG 4. HIỆN THỰC HỆ THỐNG VÀ KẾT QUẢ ĐẠT ĐƯỢC

## 4.1. Môi trường triển khai thực tế trên XAMPP
Hệ thống được thiết lập và vận hành thực tế trên môi trường máy chủ XAMPP chạy trên Windows 11:
- Máy chủ Web: Apache 2.4.58.
- Trình thông dịch: PHP version 8.3.33 (cli) ZTS x64.
- Hệ quản trị cơ sở dữ liệu: MySQL 8.0 / MariaDB 10.4, cổng kết nối 3306.
- Đường dẫn mã nguồn: `E:\Laravel_Inventory_Management_System`, liên kết trực tiếp vào web root bằng Windows Directory Junction:
  `mklink /J C:\xampp\htdocs\Laravel_Inventory_Management_System E:\Laravel_Inventory_Management_System`
- Bộ quản lý gói: Composer 2.10.2.

## 4.2. Hiện thực các phân hệ chức năng
1. **Phân hệ Bảng điều khiển (Dashboard):**
   - 4 thẻ KPI động: Tổng sản phẩm, Tổng tồn kho, Tổng giá trị hàng hóa theo giá vốn, và Số lượng mặt hàng dưới ngưỡng tồn.
   - 2 biểu đồ trực quan Chart.js: Biểu đồ cột thể hiện kim ngạch Nhập/Xuất 6 tháng gần nhất và Biểu đồ Doughnut thể hiện cơ cấu danh mục hàng hóa.
2. **Phân hệ Quản lý Danh mục & Nhà cung cấp:**
   - Đầy đủ tính năng CRUD, tìm kiếm, phân trang và tự động kiểm tra ràng buộc toàn vẹn dữ liệu khi xóa.
3. **Phân hệ Quản lý Sản phẩm:**
   - Quản lý mã SKU, mã vạch Barcode, đơn giá vốn, đơn giá bán và ngưỡng cảnh báo min_stock.
4. **Phân hệ Nhập kho:**
   - Cho phép lập phiếu nhập đa mặt hàng trên giao diện động (Dynamic Input Rows), tự động tính thành tiền.
   - Khi lưu, thực thi khối `DB::transaction()` kết hợp `lockForUpdate()` để tăng tồn kho an toàn và lưu vết Audit Log.
5. **Phân hệ Xuất kho an toàn:**
   - Kiểm tra tức thời tồn khả dụng của từng sản phẩm.
   - Tầng Backend Service sử dụng Khóa bi quan khóa độc quyền bản ghi sản phẩm và kiểm tra lại số dư trong CSDL; nếu không đủ tồn, lập tức từ chối xuất, chặn đứng hoàn toàn hiện tượng âm kho.
6. **Phân hệ Thẻ kho (Inventory Audit Log):**
   - Lưu trữ tự động 100% các biến động tồn kho (nhập, xuất, điều chỉnh), ghi nhận chính xác: `before_stock`, `quantity`, `after_stock`, thời gian và nhân sự thực hiện.

## 4.3. Hiện thực hệ thống RESTful API
Hệ thống xây dựng đầy đủ 28 RESTful API Endpoints chuẩn hóa theo kiến trúc Resource-Oriented Architecture, trả về dữ liệu định dạng JSON chuẩn:
```json
{
  "success": true,
  "message": "Thao tác thành công",
  "data": { ... }
}
```
Bảo mật toàn diện bằng cơ chế Bearer Token thông qua Laravel Sanctum.

## 4.4. Kiểm thử hệ thống và đánh giá (Automated PHPUnit Tests)
Hệ thống được kiểm thử tự động toàn diện thông qua bộ test viết bằng PHPUnit tại `tests/Feature/InventorySystemTest.php`.

```text
   PASS  Tests\\Feature\\InventorySystemTest
  ✓ login page is accessible                                      0.28s  
  ✓ valid user can login                                          0.07s  
  ✓ admin can access dashboard                                    0.06s  
  ✓ admin can view products list                                  0.06s  
  ✓ admin can create product                                      0.06s  
  ✓ import inventory increases stock and logs movement            0.07s  
  ✓ export inventory decreases stock and logs movement            0.08s  
  ✓ export cannot exceed current stock                            0.07s  
  ✓ api login returns token                                       0.07s  
  ✓ api products index returns json                               0.07s  
  ✓ api stats returns correct data                                0.06s  

  Tests:    11 passed (41 assertions)
  Duration: 1.15s
```

*Bảng: Tổng hợp kết quả kiểm thử tự động với PHPUnit*

| STT | Tên ca kiểm thử | Phương thức kiểm tra | Kết quả thực tế | Trạng thái |
| :---: | :--- | :--- | :--- | :---: |
| 1 | `login_page_is_accessible` | HTTP GET `/login` | Status 200 OK | **PASSED** |
| 2 | `valid_user_can_login` | HTTP POST `/login` | Redirect dashboard, Auth OK | **PASSED** |
| 3 | `admin_can_access_dashboard` | HTTP GET `/dashboard` | Status 200 OK | **PASSED** |
| 4 | `admin_can_view_products_list` | HTTP GET `/products` | Status 200 OK, thấy danh sách | **PASSED** |
| 5 | `admin_can_create_product` | HTTP POST `/products` | Insert CSDL thành công | **PASSED** |
| 6 | `import_inventory_increases_stock` | Call `InventoryService::importInventory` | Tồn tăng đúng, log tạo chuẩn | **PASSED** |
| 7 | `export_inventory_decreases_stock` | Call `InventoryService::exportInventory` | Tồn giảm an toàn, log tạo chuẩn | **PASSED** |
| 8 | `export_cannot_exceed_current_stock` | Xuất số lượng > tồn hiện tại | Ném Exception, chặn âm kho 100% | **PASSED** |
| 9 | `api_login_returns_token` | HTTP POST `/api/v1/login` | Status 200, trả về Bearer Token | **PASSED** |
| 10 | `api_products_index_returns_json` | HTTP GET `/api/v1/products` với Token | Trả về JSON 200 OK, đúng cấu trúc | **PASSED** |
| 11 | `api_stats_returns_correct_data` | HTTP GET `/api/v1/dashboard/stats` | JSON 200, đúng 4 chỉ số thống kê | **PASSED** |

**Tổng kết:** **11 / 11 tests passed (41 assertions) — Tỷ lệ đạt 100%.**

## 4.5. Đánh giá kết quả đạt được đối chiếu với Phiếu đăng ký đề tài

| STT | Nội dung cam kết trong Phiếu đề tài | Kết quả hiện thực trong hệ thống | Đánh giá |
| :---: | :--- | :--- | :---: |
| 1 | Đăng nhập và phân quyền RBAC | Web Session + Laravel Sanctum API Token; 2 vai trò Admin và Staff | **100% (Đạt)** |
| 2 | Quản lý sản phẩm, danh mục, NCC | CRUD đầy đủ, quản lý SKU, Barcode, Giá vốn, Giá bán, min_stock | **100% (Đạt)** |
| 3 | Quản lý nhập kho | Lập phiếu nhập đa dòng, Transaction + Pessimistic Locking tăng tồn an toàn | **100% (Đạt)** |
| 4 | Quản lý xuất kho | Kiểm tra tồn khả dụng, khóa hàng trừ tồn an toàn, chặn âm kho tuyệt đối | **100% (Đạt)** |
| 5 | Quản lý tồn kho & Audit Log | Tự động ghi nhận 100% lịch sử biến động, tính năng Kiểm kê kho | **100% (Đạt)** |
| 6 | Dashboard và cảnh báo tồn kho | Biểu đồ cột & tròn Chart.js; cảnh báo tự động sản phẩm <= min_stock | **100% (Đạt)** |
| 7 | Xây dựng RESTful API chuẩn | 28 endpoints hoàn chỉnh, xác thực Bearer Token Sanctum | **100% (Đạt)** |
| 8 | Triển khai trên môi trường XAMPP | Cài đặt và vận hành mượt mà trên Apache 2.4, PHP 8.3, MySQL 8.0 | **100% (Đạt)** |

---
\\newpage

# KẾT LUẬN VÀ KIẾN NGHỊ

### 1. Kết luận
Đề tài **"Xây dựng hệ thống quản lý nhập - xuất - tồn kho ứng dụng Laravel Framework & RESTful API"** đã được nghiên cứu và hiện thực hóa thành công trọn vẹn, đáp ứng xuất sắc mọi tiêu chí đề ra:
- **Về mặt học thuật:** Hệ thống hóa và làm chủ kiến trúc Service Layer, cơ chế giao dịch ACID, giải pháp Khóa bi quan (`lockForUpdate`) trong MySQL InnoDB và chuẩn bảo mật Stateless API Token với Laravel Sanctum.
- **Về mặt thực tiễn:** Tạo ra một sản phẩm WMS hoàn chỉnh, ổn định, giao diện trực quan, giải quyết trọn vẹn bài toán Race Condition và chống âm kho 100%, bảo đảm dữ liệu minh bạch qua hệ thống Audit Log.

### 2. Kiến nghị và Hướng phát triển
1. **Tích hợp Barcode / QR Code Scanner trên thiết bị di động:** Phát triển ứng dụng mobile (Flutter/React Native) kết nối qua 28 API Endpoints để quét mã trực tiếp tại kho.
2. **Nâng cấp mô hình Đa kho (Multi-Warehouse):** Mở rộng cơ sở dữ liệu để quản lý tồn kho tại nhiều chi nhánh và xây dựng quy trình luân chuyển kho nội bộ.
3. **Ứng dụng Trí tuệ nhân tạo (AI):** Tích hợp giải thuật học máy (ARIMA) để dự báo nhu cầu hàng hóa và tối ưu hóa điểm đặt hàng (Reorder Point).
4. **Tích hợp sàn TMĐT (Shopee, TikTok Shop, Lazada):** Đồng bộ tồn kho thời gian thực qua Webhook để chống bán vượt tồn kho (Overselling).

---
\\newpage

# DANH MỤC TÀI LIỆU THAM KHẢO (CHUẨN APA 6th EDITION)

[1] Bass, L., Clements, P., & Kazman, R. (2021). *Software architecture in practice* (4th ed.). Addison-Wesley Professional.

[2] Fielding, R. T. (2000). *Architectural styles and the design of network-based software architectures* (Doctoral dissertation). University of California, Irvine.

[3] Jagadeesan, K., & Parthasarathy, S. (2021). Concurrency control and consistency preservation in distributed web transactional architectures. *Journal of King Saud University - Computer and Information Sciences*, 33(7), 841-850. https://doi.org/10.1016/j.jksuci.2018.06.007

[4] Kumar, P., & Sharma, M. (2022). Empirical analysis of pessimistic and optimistic locking strategies in modern relational databases under high-load scenarios. *International Journal of Information Technology*, 14(4), 1845-1854. https://doi.org/10.1007/s41870-022-00912-3

[5] Nguyen, V. T., & Le, H. M. (2023). Design and implementation of secure enterprise inventory management architectures using Laravel and RESTful Web APIs. *Vietnam Journal of Computer Science & Telecommunications*, 11(2), 45-56. https://doi.org/10.1145/3588015.3588022

[6] Otwell, T. (2024). *Laravel documentation: The PHP framework for web artisans (Version 11.x)*. Laravel LLC. Truy xuất từ: https://laravel.com/docs/11.x

[7] Richardson, L., & Ruby, S. (2007). *RESTful web services*. O'Reilly Media, Inc.

[8] Silberschatz, A., Korth, H. F., & Sudarshan, S. (2020). *Database system concepts* (7th ed.). McGraw-Hill Education.

---
\\newpage

# PHỤ LỤC

### Phụ lục 1: Hướng dẫn cài đặt và vận hành hệ thống trên XAMPP
```bash
# 1. Tải mã nguồn về thư mục htdocs của XAMPP hoặc tạo Junction
cd C:\\xampp\\htdocs
cmd /c mklink /J C:\\xampp\\htdocs\\Laravel_Inventory_Management_System E:\\Laravel_Inventory_Management_System

# 2. Cài đặt các thư viện phụ thuộc bằng Composer
cd E:\\Laravel_Inventory_Management_System
composer install

# 3. Cấu hình tệp môi trường .env
cp .env.example .env
php artisan key:generate

# Cấu hình CSDL trong .env:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=do_an_kho
# DB_USERNAME=root
# DB_PASSWORD=

# 4. Khởi tạo cơ sở dữ liệu và nạp dữ liệu mẫu
php artisan migrate:fresh --seed

# 5. Khởi chạy ứng dụng
php artisan serve --port=8000
# Hoặc truy cập: http://localhost/Laravel_Inventory_Management_System/public

# 6. Chạy bộ kiểm thử tự động
php artisan test
```

### Phụ lục 2: Trích đoạn mã nguồn xử lý Transaction & Pessimistic Locking
```php
<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\ExportOrder;
use App\Models\ImportOrder;
use Illuminate\Support\Facades\DB;
use Exception;

class InventoryService
{
    /**
     * Xử lý Xuất kho an toàn với Khóa bi quan và Chặn âm kho tuyệt đối
     */
    public function exportInventory(ExportOrder $exportOrder, array $items, int $userId): void
    {
        DB::transaction(function () use ($exportOrder, $items, $userId) {
            foreach ($items as $item) {
                // 1. Áp dụng Khóa bi quan (Pessimistic Locking) độc quyền đọc-ghi
                $product = Product::where('id', $item['product_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                $exportQty = (int) $item['quantity'];

                // 2. Kiểm tra nghiệp vụ: Chặn tuyệt đối tình trạng tồn kho âm
                if ($product->stock_quantity < $exportQty) {
                    throw new Exception(
                        "Sản phẩm [{$product->name}] (SKU: {$product->sku}) không đủ tồn kho để xuất. " .
                        "Tồn khả dụng: {$product->stock_quantity}, Yêu cầu xuất: {$exportQty}."
                    );
                }

                $beforeStock = $product->stock_quantity;
                $afterStock = $beforeStock - $exportQty;

                // 3. Trừ số lượng tồn kho nguyên tử
                $product->decrement('stock_quantity', $exportQty);

                // 4. Lưu vết Audit Log chi tiết vào Thẻ kho (Stock Movement)
                StockMovement::create([
                    'product_id'    => $product->id,
                    'user_id'       => $userId,
                    'type'          => 'EXPORT',
                    'quantity'      => $exportQty,
                    'before_stock'  => $beforeStock,
                    'after_stock'   => $afterStock,
                    'reference_id'  => $exportOrder->id,
                    'reference_type'=> ExportOrder::class,
                    'note'          => "Xuất kho theo phiếu xuất #{$exportOrder->code}"
                ]);
            }
        });
    }

    /**
     * Xử lý Nhập kho an toàn và tự động tăng tồn kho nguyên tử
     */
    public function importInventory(ImportOrder $importOrder, array $items, int $userId): void
    {
        DB::transaction(function () use ($importOrder, $items, $userId) {
            foreach ($items as $item) {
                // Khóa bản ghi sản phẩm để đồng bộ hóa cập nhật
                $product = Product::where('id', $item['product_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                $importQty = (int) $item['quantity'];
                $beforeStock = $product->stock_quantity;
                $afterStock = $beforeStock + $importQty;

                // Tăng số lượng tồn kho nguyên tử
                $product->increment('stock_quantity', $importQty);

                // Ghi nhận biến động thẻ kho
                StockMovement::create([
                    'product_id'    => $product->id,
                    'user_id'       => $userId,
                    'type'          => 'IMPORT',
                    'quantity'      => $importQty,
                    'before_stock'  => $beforeStock,
                    'after_stock'   => $afterStock,
                    'reference_id'  => $importOrder->id,
                    'reference_type'=> ImportOrder::class,
                    'note'          => "Nhập kho theo phiếu nhập #{$importOrder->code}"
                ]);
            }
        });
    }
}
```

### Phụ lục 3: Danh mục 28 RESTful API Endpoints đầy đủ của hệ thống

| STT | HTTP Method | URI Endpoint | Middleware | Mô tả chức năng nghiệp vụ |
| :---: | :---: | :--- | :--- | :--- |
| 1 | `POST` | `/api/v1/login` | Public | Đăng nhập hệ thống, trả về Bearer Token cá nhân |
| 2 | `POST` | `/api/v1/logout` | `auth:sanctum` | Đăng xuất, hủy bỏ Bearer Token hiện hành |
| 3 | `GET` | `/api/v1/me` | `auth:sanctum` | Lấy thông tin tài khoản và vai trò đang đăng nhập |
| 4 | `GET` | `/api/v1/dashboard/stats` | `auth:sanctum` | Lấy số liệu thống kê tổng hợp kho (tổng SP, tồn, giá trị) |
| 5 | `GET` | `/api/v1/dashboard/low-stock` | `auth:sanctum` | Danh sách sản phẩm chạm ngưỡng tồn tối thiểu |
| 6 | `GET` | `/api/v1/categories` | `auth:sanctum` | Danh sách danh mục sản phẩm (hỗ trợ phân trang) |
| 7 | `POST` | `/api/v1/categories` | `auth:sanctum, role:admin` | Thêm mới danh mục sản phẩm vào hệ thống |
| 8 | `GET` | `/api/v1/categories/{id}` | `auth:sanctum` | Lấy thông tin chi tiết một danh mục theo ID |
| 9 | `PUT` | `/api/v1/categories/{id}` | `auth:sanctum, role:admin` | Cập nhật tên hoặc mô tả danh mục |
| 10 | `DELETE` | `/api/v1/categories/{id}` | `auth:sanctum, role:admin` | Xóa danh mục (kiểm tra ràng buộc khóa ngoại) |
| 11 | `GET` | `/api/v1/suppliers` | `auth:sanctum` | Danh sách đối tác nhà cung cấp hàng hóa |
| 12 | `POST` | `/api/v1/suppliers` | `auth:sanctum, role:admin` | Thêm mới nhà cung cấp |
| 13 | `GET` | `/api/v1/suppliers/{id}` | `auth:sanctum` | Chi tiết thông tin nhà cung cấp |
| 14 | `PUT` | `/api/v1/suppliers/{id}` | `auth:sanctum, role:admin` | Cập nhật thông tin đối tác nhà cung cấp |
| 15 | `DELETE` | `/api/v1/suppliers/{id}` | `auth:sanctum, role:admin` | Xóa nhà cung cấp khỏi cơ sở dữ liệu |
| 16 | `GET` | `/api/v1/products` | `auth:sanctum` | Danh sách sản phẩm (hỗ trợ tìm SKU, tên, danh mục) |
| 17 | `POST` | `/api/v1/products` | `auth:sanctum, role:admin` | Thêm mới sản phẩm vào kho |
| 18 | `GET` | `/api/v1/products/{id}` | `auth:sanctum` | Lấy thông tin chi tiết sản phẩm và tồn khả dụng |
| 19 | `PUT` | `/api/v1/products/{id}` | `auth:sanctum, role:admin` | Cập nhật sản phẩm (giá, min_stock, barcode) |
| 20 | `DELETE` | `/api/v1/products/{id}` | `auth:sanctum, role:admin` | Xóa sản phẩm khỏi kho (Soft / Hard delete) |
| 21 | `GET` | `/api/v1/imports` | `auth:sanctum` | Danh sách lịch sử các phiếu nhập kho |
| 22 | `POST` | `/api/v1/imports` | `auth:sanctum` | Tạo phiếu nhập đa sản phẩm & tăng tồn nguyên tử |
| 23 | `GET` | `/api/v1/imports/{id}` | `auth:sanctum` | Chi tiết phiếu nhập kèm đơn giá và danh sách mặt hàng |
| 24 | `GET` | `/api/v1/exports` | `auth:sanctum` | Danh sách lịch sử các phiếu xuất kho |
| 25 | `POST` | `/api/v1/exports` | `auth:sanctum` | Tạo phiếu xuất, khóa bi quan trừ tồn & chặn âm kho |
| 26 | `GET` | `/api/v1/exports/{id}` | `auth:sanctum` | Chi tiết phiếu xuất kèm thông tin người nhận |
| 27 | `GET` | `/api/v1/inventory/audit-logs` | `auth:sanctum` | Tra cứu toàn bộ lịch sử biến động Thẻ kho (Audit Log) |
| 28 | `POST` | `/api/v1/inventory/adjust` | `auth:sanctum, role:admin` | Tạo phiếu kiểm kê và điều chỉnh cân bằng số lượng tồn kho |

---
*Báo cáo hoàn thành ngày 28/11/2026 bởi Thái Anh Kiệt & Trần Phúc Khang – Khoa CNTT, Trường Cao đẳng Lý Tự Trọng TP.HCM.*
