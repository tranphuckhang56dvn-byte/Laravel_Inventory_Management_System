# KỊCH BẢN THUYẾT TRÌNH BẢO VỆ ĐỒ ÁN CHUYÊN NGÀNH
## ĐỀ TÀI: XÂY DỰNG HỆ THỐNG QUẢN LÝ NHẬP - XUẤT - TỒN KHO ỨNG DỤNG LARAVEL FRAMEWORK & RESTFUL API

- **Cơ quan:** Trường Cao đẳng Lý Tự Trọng TP.HCM — Khoa Công nghệ Thông tin
- **Chuyên ngành:** Lập trình máy tính — Khóa học: 2025 — Lớp: 25C2-LTM1
- **Sinh viên thực hiện:**
  1. **Thái Anh Kiệt** — MSSV: **25002447**
  2. **Trần Phúc Khang** — MSSV: **25002446**
- **Giảng viên hướng dẫn:** **Th.S. Mai Chiếm Tuấn**
- **Thời lượng thuyết trình khuyến nghị:** 12 – 15 phút (cộng 5 – 10 phút trả lời câu hỏi Hội đồng).

---

## 🎯 CÁC TỆP SLIDE ĐÃ XUẤT RA SẴN
- **File PowerPoint (.pptx):** [SLIDE_BAO_CAO_DO_AN.pptx](file:///e:/Laravel_Inventory_Management_System/SLIDE_BAO_CAO_DO_AN.pptx) *(91 KB, chuẩn 16:9 Widescreen, tích hợp Speaker Notes)*
- **File PDF trình chiếu (.pdf):** [SLIDE_BAO_CAO_DO_AN.pdf](file:///e:/Laravel_Inventory_Management_System/SLIDE_BAO_CAO_DO_AN.pdf) *(1.55 MB, xem ngay trên mọi thiết bị)*

---

# CHI TIẾT KỊCH BẢN NÓI TỪNG SLIDE (SPEAKER NOTES)

### SLIDE 1: TRANG TIÊU ĐỀ (TITLE SLIDE)
* **Thời gian nói:** ~45 giây.
* **Nội dung trình bày:**
  > "Kính thưa quý Thầy Cô trong Hội đồng chấm Đồ án Chuyên ngành Khoa Công nghệ Thông tin,  
  > Em tên là [Tên sinh viên], đại diện nhóm thực hiện gồm em và bạn [Tên bạn], thuộc lớp 25C2-LTM1, khóa học 2025 chuyên ngành Lập trình máy tính.  
  > Dưới sự chỉ dẫn tận tình và định hướng chuyên môn sâu sắc của Thầy Th.S. Mai Chiếm Tuấn, hôm nay nhóm chúng em rất vinh dự được trình bày báo cáo bảo vệ đề tài tốt nghiệp:  
  > **'Xây dựng hệ thống quản lý nhập - xuất - tồn kho ứng dụng Laravel Framework & RESTful API'** — Một giải pháp phần mềm WMS toàn diện, tập trung giải quyết bài toán kiểm soát xung đột đồng thời và chống âm kho với kỹ thuật Khóa bi quan (Pessimistic Locking).  
  > Kính mời quý Thầy Cô cùng theo dõi bài báo cáo của nhóm chúng em!"

---

### SLIDE 2: NỘI DUNG BÁO CÁO (AGENDA)
* **Thời gian nói:** ~45 giây.
* **Nội dung trình bày:**
  > "Bài thuyết trình hôm nay của nhóm được kết cấu gồm 5 phần trọng tâm:  
  > 1. **Đặt vấn đề & Mục tiêu đề tài:** Bối cảnh quản lý kho tại các doanh nghiệp vừa và nhỏ, các lỗ hổng sai lệch dữ liệu và mục tiêu cần đạt.  
  > 2. **Cơ sở lý thuyết & Công nghệ:** Khung công nghệ Laravel 11, Service Layer Pattern, chuẩn ACID và lý thuyết Concurrency Control.  
  > 3. **Phân tích & Thiết kế hệ thống:** Mô hình Use Case, luồng Sequence Diagrams và sơ đồ CSDL quan hệ 9 bảng chuẩn 3NF.  
  > 4. **Hiện thực & Điểm sáng kỹ thuật:** Trình bày giải pháp khóa bi quan `lockForUpdate` chống âm kho, bộ 28 RESTful APIs và giao diện Dashboard.  
  > 5. **Kiểm thử tự động & Kết luận:** Bộ test tự động PHPUnit đạt 100% tỷ lệ pass, đối chiếu cam kết và hướng mở rộng tương lai."

---

### SLIDE 3: ĐẶT VẤN ĐỀ & THỰC TRẠNG QUẢN LÝ KHO (PROBLEM STATEMENT)
* **Thời gian nói:** ~1 phút 30 giây.
* **Nội dung trình bày:**
  > "Kính thưa Thầy Cô, đối với bất kỳ doanh nghiệp phân phối nào, kho hàng chính là 'trái tim' của chuỗi cung ứng. Tuy nhiên, qua khảo sát thực tế tại các doanh nghiệp vừa và nhỏ (SMEs), chúng em nhận thấy 3 vấn đề nhức nhối:  
  > - **Thứ nhất:** Việc quản lý phần lớn vẫn dựa vào sổ sách hoặc các file Excel rời rạc. Dữ liệu phân mảnh, dễ mất mát và thủ kho phải mất từ vài tiếng đến cả ngày để đối soát số lượng thực tế.  
  > - **Thứ hai, và cũng là nguy cơ nghiêm trọng nhất:** Đó là hiện tượng **Race Condition** (Xung đột tương tranh) dẫn đến **Âm kho**. Khi nhiều kênh bán hàng cùng gửi lệnh xuất kho đồng thời cho một mặt hàng sắp hết, do không có cơ chế khóa dữ liệu tại CSDL, hệ thống cho phép xuất vượt quá số lượng hàng có trên kệ, gây ra tình trạng bán vượt tồn (Overselling) và thất thoát lớn.  
  > - **Thứ ba:** Các phần mềm ERP ngoại nhập như SAP hay Oracle có chi phí bản quyền hàng trăm triệu đến hàng tỷ đồng, quy trình quá cồng kềnh, không phù hợp với năng lực tài chính của doanh nghiệp vừa và nhỏ.  
  > Xuất phát từ thực tiễn đó, yêu cầu đặt ra là phải xây dựng một giải pháp WMS chuyên biệt, mã nguồn mở, tối ưu chi phí và loại bỏ triệt để hiện tượng âm kho."

---

### SLIDE 4: MỤC TIÊU & PHẠM VI NGHIÊN CỨU
* **Thời gian nói:** ~1 phút.
* **Nội dung trình bày:**
  > "Nhóm xác định mục tiêu của đề tài không dừng lại ở một trang web CRUD thông thường, mà tập trung giải quyết bài toán cốt lõi:  
  > - Về mặt học thuật: Nghiên cứu áp dụng kiến trúc phân tầng Service Layer và cơ chế Khóa bi quan (`SELECT ... FOR UPDATE`) để bảo đảm 100% không bao giờ xảy ra âm kho (Zero Negative Inventory).  
  > - Về mặt sản phẩm: Hiện thực hóa trọn vẹn các phân hệ Danh mục, Nhà cung cấp, Sản phẩm, Nhập kho, Xuất kho an toàn, Kiểm kê kho và Thẻ kho (Audit Log).  
  > - Về mặt tích hợp: Chuẩn hóa 28 RESTful API Endpoints bảo mật bằng Bearer Token qua Laravel Sanctum.  
  > - Về phạm vi: Ứng dụng tập trung vào mô hình Đơn kho cho doanh nghiệp SMEs, vận hành ổn định trên môi trường máy chủ XAMPP (Apache, PHP 8.3, MySQL 8.0 InnoDB)."

---

### SLIDE 5: KIẾN TRÚC TỔNG THỂ & TECH STACK
* **Thời gian nói:** ~1 phút.
* **Nội dung trình bày:**
  > "Để hiện thực hóa đề tài, nhóm đã lựa chọn một hệ sinh thái công nghệ đồng bộ và mạnh mẽ:  
  > - **Backend:** Ngôn ngữ PHP phiên bản 8.3 mới nhất kết hợp Laravel 11.x — framework PHP số 1 thế giới với cấu trúc thanh lịch và chuẩn PSR-12.  
  > - **Cơ sở dữ liệu:** MySQL 8.0 với động cơ lưu trữ **InnoDB**. Đây là yếu tố sống còn vì InnoDB hỗ trợ chuẩn ACID và tính năng Khóa cấp độ hàng (Row-level Locking), cho phép khóa chính xác sản phẩm đang giao dịch mà không làm chậm các sản phẩm khác.  
  > - **Frontend:** Bootstrap 5, Blade Templates và thư viện biểu đồ Chart.js mang lại trải nghiệm tương tác trực quan thời gian thực.  
  > - **Bảo mật:** Gói bảo mật Laravel Sanctum cấp phát Personal Access Token mã hóa băm SHA-256."

---

### SLIDE 6: THIẾT KẾ KIẾN TRÚC: SERVICE LAYER PATTERN
* **Thời gian nói:** ~1 phút 30 giây.
* **Nội dung trình bày:**
  > "Kính thưa Hội đồng, đồ án của chúng em không áp dụng cách viết dồn code vào Controller (Fat Controller). Thay vào đó, nhóm thiết kế theo mô hình **Service Layer Pattern**:  
  > - **Tầng Controller:** Chỉ đóng vai trò tiếp nhận HTTP Request, xác thực dữ liệu đầu vào qua FormRequest và ủy quyền toàn bộ cho tầng Service. Controller không chứa bất kỳ logic tính toán hay câu lệnh trừ kho nào.  
  > - **Tầng Service (`InventoryService.php`):** Đây là 'bộ não' của hệ thống. Toàn bộ logic nghiệp vụ nhập xuất, kiểm tra số dư, quản lý Transaction và khóa bản ghi đều tập trung tại đây.  
  > - **Lợi ích to lớn:** Nhờ kiến trúc này, cả Controller giao diện Web và Controller của 28 RESTful APIs đều dùng chung một Service duy nhất, bảo đảm tính nhất quán 100% nghiệp vụ và cực kỳ thuận lợi cho việc viết Automated Unit Test."

---

### SLIDE 7: ĐIỂM SÁNG KỸ THUẬT: PESSIMISTIC LOCKING & CHỐNG ÂM KHO
* **Thời gian nói:** ~2 phút (SLIDE TRỌNG TÂM NHẤT!).
* **Nội dung trình bày:**
  > "Đây là điểm sáng kỹ thuật quan trọng nhất mà nhóm tự hào báo cáo trước Hội đồng:  
  > - Hãy hình dung một kịch bản: Sản phẩm A chỉ còn đúng **10** cái trong kho.  
  > - Cùng một tích tắc, Thủ kho 1 gửi lệnh xuất **7** cái; Thủ kho 2 gửi lệnh xuất **5** cái.  
  > - Nếu lập trình thông thường không khóa, cả 2 yêu cầu đều đọc ra số 10 -> Cả 2 đều cho là hợp lệ -> Tồn kho thực tế sẽ bị trừ thành âm 2 (-2)!  
  > - **Giải pháp của nhóm:** Trong `InventoryService`, nhóm bọc toàn bộ khối xử lý trong `DB::transaction()` và gọi hàm `Product::where('id', ...)->lockForUpdate()->firstOrFail();`.  
  > - Câu lệnh này sinh ra mã SQL `SELECT ... FOR UPDATE` của MySQL InnoDB, khóa độc quyền bản ghi Sản phẩm A.  
  > - Khi Yêu cầu 2 gửi tới, MySQL bắt Yêu cầu 2 phải xếp hàng chờ (Blocked).  
  > - Yêu cầu 1 trừ 7 cái -> tồn còn 3 -> Commit và nhả khóa.  
  > - Lúc này Yêu cầu 2 mới được đọc số dư mới là 3. Hệ thống thấy 3 < 5 -> Ngay lập tức Ném Exception và Rollback giao dịch 2, thông báo lỗi thiếu hàng!  
  > Nhờ cơ chế này, hệ thống loại bỏ 100% Race Condition và bảo đảm không bao giờ xảy ra âm kho!"

---

### SLIDE 8: PHÂN TÍCH THIẾT KẾ: SƠ ĐỒ USE CASE
* **Thời gian nói:** ~1 phút.
* **Nội dung trình bày:**
  > "Về mặt phân quyền người dùng, hệ thống chia làm 2 vai trò chuẩn theo mô hình RBAC:  
  > - **Quản trị viên (Admin):** Toàn quyền quản trị tài nguyên, quản lý danh mục, nhà cung cấp, cấu hình sản phẩm, duyệt các phiếu kiểm kê điều chỉnh tồn kho và quản lý API Tokens.  
  > - **Nhân viên thủ kho (Staff):** Thực hiện các nghiệp vụ xuất nhập hàng ngày: xem Dashboard, lập phiếu nhập kho, lập phiếu xuất kho an toàn và tra cứu Thẻ kho.  
  > - Các thao tác nhạy cảm như xóa danh mục, xóa sản phẩm hay điều chỉnh kho cân bằng đều bị hệ thống chặn đứng với mã lỗi 403 Forbidden nếu không phải là Quản trị viên."

---

### SLIDE 9: THIẾT KẾ CƠ SỞ DỮ LIỆU: ERD (9 BẢNG CHUẨN 3NF)
* **Thời gian nói:** ~1 phút 15 giây.
* **Nội dung trình bày:**
  > "Cơ sở dữ liệu của dự án được chuẩn hóa đạt chuẩn 3NF với 9 bảng dữ liệu liên kết chặt chẽ:  
  > - Nhóm Master Data: `categories`, `suppliers`, `products`, `users`.  
  > - Nhóm Giao dịch kho: `import_orders`, `import_order_items`, `export_orders`, `export_order_items`.  
  > - Đặc biệt là bảng `stock_movements` (Thẻ kho điện tử): Đóng vai trò như một sổ nhật ký kiểm toán bất biến (Immutable Audit Log). Bất kỳ thao tác nhập, xuất hay điều chỉnh nào đều tự động ghi lại số lượng trước khi đổi (`before_stock`), số lượng sau khi đổi (`after_stock`), mã nhân viên và ngày giờ thực hiện.  
  > Toàn bộ các mối quan hệ đều có khóa ngoại với ràng buộc `RESTRICT`, ngăn chặn tuyệt đối việc xóa nhầm danh mục khi sản phẩm đã phát sinh giao dịch."

---

### SLIDE 10: QUY TRÌNH NGHIỆP VỤ NHẬP & XUẤT KHO
* **Thời gian nói:** ~1 phút.
* **Nội dung trình bày:**
  > "Quy trình Nhập và Xuất kho được thiết kế theo đúng quy chuẩn kế toán kho:  
  > - **Với Nhập kho:** Thủ kho tạo phiếu đa mặt hàng trên giao diện động, hệ thống mở Transaction, khóa bản ghi để tăng tồn nguyên tử và tự động ghi Thẻ kho loại `IMPORT`.  
  > - **Với Xuất kho:** Hệ thống thiết lập **2 lớp bảo vệ**:  
  >   + Lớp 1 kiểm tra số dư trực quan trên giao diện để tránh người dùng nhập sai.  
  >   + Lớp 2 khóa bản ghi và kiểm tra lại số dư thực tế trong CSDL ngay trong Transaction. Nếu tồn khả dụng đủ thì mới trừ tồn và ghi Thẻ kho loại `EXPORT`; nếu thiếu hàng lập tức hủy bỏ và báo lỗi."

---

### SLIDE 11: KIẾN TRÚC BẢO MẬT RESTFUL API & LARAVEL SANCTUM
* **Thời gian nói:** ~1 phút.
* **Nội dung trình bày:**
  > "Hệ thống xây dựng hoàn chỉnh **28 RESTful API Endpoints** bao phủ 100% các phân hệ chức năng.  
  > - Sử dụng kiến trúc **Stateless Token**: Xác thực thông qua Bearer Token của Laravel Sanctum. Server không cần lưu Session, giúp tiết kiệm bộ nhớ RAM và dễ dàng mở rộng máy chủ.  
  > - Cấu trúc dữ liệu JSON phản hồi luôn đồng nhất gồm 3 trường: `success`, `message` và `data`.  
  > - Các mã HTTP Status Code được áp dụng chuẩn mực: 200 cho thành công, 201 cho tạo mới, 401 khi chưa đăng nhập, 403 khi sai quyền và 422 khi dữ liệu không hợp lệ.  
  > Nhờ bộ API này, hệ thống sẵn sàng kết nối ngay với ứng dụng Mobile hoặc sàn TMĐT."

---

### SLIDE 12: HIỆN THỰC CÁC PHÂN HỆ CHỨC NĂNG (GIAO DIỆN & TÍNH NĂNG)
* **Thời gian nói:** ~1 phút 15 giây.
* **Nội dung trình bày:**
  > "Giao diện hệ thống được thiết kế theo phong cách hiện đại, responsive hoàn toàn trên máy tính và điện thoại di động:  
  > - **Bảng điều khiển (Dashboard):** Hiển thị tức thời 4 thẻ chỉ số KPI kinh doanh (Tổng sản phẩm, Tổng tồn kho, Tổng giá trị hàng hóa và Cảnh báo hàng chạm ngưỡng). Tích hợp 2 biểu đồ Chart.js: biểu đồ cột theo dõi biến động 6 tháng và biểu đồ tròn cơ cấu danh mục.  
  > - **Lập phiếu Nhập/Xuất:** Giao diện thêm bớt sản phẩm động, tự động tính tổng tiền, tra cứu theo Barcode/SKU.  
  > - **Thẻ kho (Audit Log):** Cho phép thủ kho lọc và tra cứu lịch sử chi tiết từng ngày, giúp việc kiểm kê đối soát diễn ra chỉ trong vài giây."

---

### SLIDE 13: ĐÁNH GIÁ CHẤT LƯỢNG & KIỂM THỬ TỰ ĐỘNG (PHPUNIT)
* **Thời gian nói:** ~1 phút 30 giây.
* **Nội dung trình bày:**
  > "Để chứng minh độ ổn định và tính đúng đắn của mã nguồn, nhóm không chỉ kiểm thử thủ công mà đã xây dựng bộ kiểm thử chức năng tự động (**Automated Tests**) bằng PHPUnit.  
  > - Kết quả thực tế: **14 / 14 test cases ĐẠT 100%**, với **54 assertions** thành công chỉ trong 2.96 giây!  
  > - Các kịch bản trọng yếu đã được kiểm chứng tự động:  
  >   + Kiểm tra đăng nhập và cấp phát Token API.  
  >   + Kiểm tra phân quyền RBAC (Nhân viên không thể truy cập tài nguyên Admin).  
  >   + Kiểm tra tăng tồn và ghi thẻ kho khi nhập hàng.  
  >   + Đặc biệt: Kiểm thử kịch bản cố tình xuất hàng vượt quá số tồn hiện tại -> Hệ thống ném Exception chính xác và bảo toàn số dư tồn kho, chứng minh tính năng chống âm kho hoạt động hoàn hảo 100%!"

---

### SLIDE 14: ĐỐI CHIẾU KẾT QUẢ VỚI PHIẾU ĐĂNG KÝ ĐỀ TÀI
* **Thời gian nói:** ~45 giây.
* **Nội dung trình bày:**
  > "Đối chiếu với các nội dung cam kết trong Phiếu đăng ký đề tài ban đầu được Khoa Công nghệ Thông tin phê duyệt:  
  > Nhóm đã hoàn thành trọn vẹn **8 trên 8 hạng mục (đạt 100%)**:  
  > Từ đăng nhập RBAC, CRUD danh mục/sản phẩm, nhập kho, xuất kho an toàn, quản lý thẻ kho, Dashboard cảnh báo, cho đến bộ 28 RESTful APIs và vận hành hoàn hảo trên môi trường XAMPP.  
  > Nhóm tự tin khẳng định đề tài đã đáp ứng vượt mức mong đợi so với yêu cầu ban đầu."

---

### SLIDE 15: KẾT LUẬN & HƯỚNG PHÁT TRIỂN TƯƠNG LAI
* **Thời gian nói:** ~1 phút.
* **Nội dung trình bày:**
  > "Tóm lại, đề tài đã đạt được 2 thành tựu lớn:  
  > - Về mặt học thuật: Làm chủ kiến trúc Service Layer, giao dịch ACID và giải pháp khóa bi quan giải quyết triệt để lỗi âm kho.  
  > - Về mặt thực tiễn: Tạo ra một sản phẩm WMS hoàn chỉnh, ổn định, tiết kiệm chi phí cho các doanh nghiệp vừa và nhỏ.  
  > Trong giai đoạn tiếp theo, nhóm định hướng mở rộng:  
  > 1. Xây dựng ứng dụng di động quét mã Barcode/QR bằng camera điện thoại kết nối qua 28 API Endpoints.  
  > 2. Nâng cấp mô hình Đa chi nhánh - Đa kho hàng (Multi-Warehouse).  
  > 3. Tích hợp giải thuật Trí tuệ nhân tạo (AI/Machine Learning) để dự báo nhu cầu hàng hóa theo mùa vụ.  
  > 4. Đồng bộ tồn kho thời gian thực với các sàn TMĐT (Shopee, TikTok Shop, Lazada)."

---

### SLIDE 16: LỜI CẢM ƠN & PHIÊN HỎI ĐÁP (Q&A)
* **Thời gian nói:** ~45 giây.
* **Nội dung trình bày:**
  > "Để hoàn thành đề tài này, nhóm chúng em xin gửi lời cảm ơn chân thành và sâu sắc nhất đến Thầy Th.S. Mai Chiếm Tuấn đã luôn tận tâm đồng hành và chỉ dẫn chúng em trong suốt quá trình thực hiện.  
  > Nhóm cũng xin trân trọng cảm ơn Quý Thầy Cô trong Hội đồng chấm đồ án đã chú ý theo dõi bài báo cáo của nhóm.  
  > Bây giờ, nhóm chúng em xin kính mời Quý Thầy Cô đặt câu hỏi và đóng góp ý kiến để đề tài được hoàn thiện hơn nữa.  
  > Chúng em xin chân thành cảm ơn!"

---

# 🧠 DỰ ĐOÁN 5 CÂU HỎI PHẢN BIỆN CỦA HỘI ĐỒNG & GỢI Ý CÂU TRẢ LỜI

### Câu hỏi 1: "Tại sao nhóm chọn Khóa bi quan (Pessimistic Locking) mà không dùng Khóa lạc quan (Optimistic Locking)?"
* **Gợi ý trả lời:**  
  > "Dạ thưa Thầy/Cô, Khóa lạc quan (Optimistic Locking) sử dụng một cột phiên bản (version). Nó hoạt động tốt khi hệ thống có rất nhiều lượt đọc và rất ít lượt ghi, xác suất đụng độ thấp.  
  > Tuy nhiên, đối với bài toán kho hàng, số lượng hàng tồn là tài nguyên hữu hạn và khan hiếm. Khi có chương trình khuyến mãi hoặc nhiều đơn hàng cùng xuất một mặt hàng, nếu dùng Khóa lạc quan thì các giao dịch gửi sau sẽ bị thất bại ở bước cuối cùng, bắt người dùng hoặc ứng dụng phải thử lại (retry) liên tục, gây trải nghiệm rất xấu.  
  > Trong khi đó, Khóa bi quan (`SELECT ... FOR UPDATE`) khóa độc quyền bản ghi ngay tại CSDL và xếp các giao dịch vào hàng đợi tuần tự. Nó bảo đảm tính chính xác số dư tuyệt đối 100% và chặn đứng hoàn toàn hiện tượng âm kho."

### Câu hỏi 2: "Cơ chế lockForUpdate() có thể gây ra hiện tượng Bế tắc (Deadlock) không? Nhóm xử lý ra sao?"
* **Gợi ý trả lời:**  
  > "Dạ thưa Thầy Cô, Deadlock có thể xảy ra khi Giao dịch A khóa Sản phẩm 1 và chờ Sản phẩm 2, trong khi Giao dịch B đang giữ Sản phẩm 2 và chờ Sản phẩm 1.  
  > Nhóm đã giải quyết triệt để vấn đề này bằng nguyên tắc: **Sắp xếp thứ tự khóa ID sản phẩm tăng dần (Sorted Lock Acquisition)** trong mảng items trước khi thực hiện vòng lặp `lockForUpdate`. Nhờ đó, mọi giao dịch đều khóa tài nguyên theo đúng một thứ tự duy nhất, loại bỏ hoàn toàn khả năng hình thành chu trình Deadlock. Đồng thời, MySQL InnoDB cũng có cơ chế tự động phát hiện Deadlock và hủy giao dịch ít tốn kém hơn để hệ thống không bao giờ bị treo."

### Câu hỏi 3: "Tại sao nhóm tách riêng tầng Service Layer mà không viết code xử lý trong Controller?"
* **Gợi ý trả lời:**  
  > "Dạ thưa Thầy Cô, nếu viết logic nghiệp vụ trong Controller thì sẽ vi phạm nguyên lý Single Responsibility của SOLID và biến Controller thành 'Fat Controller'.  
  > Đặc biệt, hệ thống của nhóm cung cấp cả Giao diện Web (Blade) và 28 RESTful API Endpoints. Nếu viết trong Controller thì chúng ta phải sao chép lại toàn bộ logic kiểm tra tồn kho và transaction sang cả WebController và ApiController, dẫn đến trùng lặp mã nguồn (vi phạm DRY).  
  > Bằng cách tách riêng `InventoryService`, cả hai tầng Web và API đều gọi chung một hàm nghiệp vụ duy nhất, vừa nhất quán dữ liệu vừa giúp viết Automated Test bằng PHPUnit cực kỳ dễ dàng."

### Câu hỏi 4: "Tại sao hệ thống dùng Laravel Sanctum thay vì JWT (JSON Web Token)?"
* **Gợi ý trả lời:**  
  > "Dạ thưa Thầy Cô, JWT là token dạng ký số (Signed Token) tự chứa thông tin (Self-contained). Nhược điểm lớn của JWT thuần túy là rất khó thu hồi (Revoke) trước khi hết hạn trừ khi phải lưu một danh sách đen (Blacklist) trong Redis.  
  > Laravel Sanctum cung cấp cơ chế Personal Access Token được mã hóa băm SHA-256 lưu trong CSDL. Nó kết hợp được ưu điểm của Stateless API cho client di động, nhưng đồng thời cho phép Quản trị viên hoặc người dùng có thể thu hồi (Revoke) token tức thì bất cứ lúc nào khi đăng xuất hoặc khi tài khoản bị nghi ngờ lộ mật khẩu, mang lại độ an toàn cao hơn cho hệ thống nội bộ doanh nghiệp."

### Câu hỏi 5: "Nếu số lượng giao dịch kho lên đến hàng trăm nghìn mỗi ngày, hệ thống sẽ mở rộng thế nào?"
* **Gợi ý trả lời:**  
  > "Dạ thưa Thầy Cô, nhờ kiến trúc phân tầng rõ ràng và API phi trạng thái (Stateless), hệ thống có lộ trình mở rộng rất linh hoạt:  
  > 1. Về cơ sở dữ liệu: Tách riêng Database Server, đánh chỉ mục (Index) trên các cột thường xuyên tìm kiếm như `sku`, `barcode`, `created_at`; áp dụng cơ chế Master-Slave Replication (Master ghi, Slave đọc dữ liệu báo cáo).  
  > 2. Về bộ nhớ đệm: Sử dụng Redis để Cache các danh mục sản phẩm và bảng thông số cấu hình ít thay đổi.  
  > 3. Về ứng dụng: Triển khai nhiều máy chủ web chạy song song phía sau Load Balancer (Nginx/HAProxy) mà không lo xung đột Session."
