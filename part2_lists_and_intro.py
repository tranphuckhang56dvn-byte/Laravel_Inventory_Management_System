# -*- coding: utf-8 -*-
"""
Phần 2: Mục lục, Danh mục hình, Danh mục bảng, Danh mục viết tắt, Mở đầu
"""
import docx
from docx.shared import Inches, Pt, RGBColor
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.enum.table import WD_TABLE_ALIGNMENT
from report_builder_utils import set_cell_background, set_cell_margins, set_table_borders

def build_lists_and_intro(doc, md):
    # ========================== MỤC LỤC ==========================
    p_toc = doc.add_paragraph()
    p_toc.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_toc.add_run("MỤC LỤC\n")
    r.font.size = Pt(16)
    r.font.bold = True
    r.font.color.rgb = RGBColor(15, 23, 42)
    
    toc_items = [
        ("LỜI CẢM ƠN", "i"),
        ("DANH MỤC HÌNH", "iv"),
        ("DANH MỤC BẢNG", "v"),
        ("DANH MỤC CÁC TỪ VIẾT TẮT", "vi"),
        ("MỞ ĐẦU", "1"),
        ("CHƯƠNG 1. TỔNG QUAN VỀ BÀI TOÁN QUẢN LÝ NHẬP - XUẤT - TỒN KHO", "4"),
        ("   1.1. Thực trạng và quy trình quản lý kho hàng trong doanh nghiệp", "4"),
        ("       1.1.1. Quy trình quản lý danh mục và nhà cung cấp", "4"),
        ("       1.1.2. Quy trình lập và xử lý phiếu nhập kho", "5"),
        ("       1.1.3. Quy trình lập và xử lý phiếu xuất kho", "6"),
        ("       1.1.4. Quy trình kiểm kê định kỳ và điều chỉnh tồn kho", "7"),
        ("   1.2. Các hạn chế và thách thức của phương pháp thủ công", "8"),
        ("       1.2.1. Sai lệch số liệu và thiếu tính tức thời (Real-time)", "8"),
        ("       1.2.2. Xung đột đồng thời (Race Condition) và rủi ro âm kho", "9"),
        ("       1.2.3. Khó khăn trong truy vết sai phạm (Audit Trail)", "10"),
        ("       1.2.4. Cảnh báo tồn kho dưới ngưỡng an toàn bị chậm trễ", "10"),
        ("   1.3. Đề xuất giải pháp xây dựng hệ thống trên nền tảng Web & RESTful API", "11"),
        ("       1.3.1. Mô hình kiến trúc giải pháp", "11"),
        ("       1.3.2. Phạm vi và giới hạn của đề tài", "12"),
        ("CHƯƠNG 2. CƠ SỞ LÝ THUYẾT VÀ CÔNG NGHỆ ỨNG DỤNG", "13"),
        ("   2.1. Framework Laravel và kiến trúc phần mềm", "13"),
        ("       2.1.1. Tổng quan về Laravel Framework và PHP 8.3", "13"),
        ("       2.1.2. Mô hình MVC (Model - View - Controller)", "14"),
        ("       2.1.3. Mẫu thiết kế Service Layer Pattern trong xử lý kho", "15"),
        ("   2.2. Kiểm soát giao dịch đồng thời (Concurrency Control)", "16"),
        ("       2.2.1. Khái niệm Giao dịch (Transaction) và thuộc tính ACID", "16"),
        ("       2.2.2. Hiện tượng Race Condition và Lost Update trong ứng dụng kho vận", "17"),
        ("       2.2.3. Phân tích so sánh Optimistic Locking và Pessimistic Locking", "18"),
        ("       2.2.4. Ứng dụng Pessimistic Locking (lockForUpdate) trong Laravel", "19"),
        ("   2.3. Xác thực và bảo mật RESTful API với Laravel Sanctum", "20"),
        ("       2.3.1. Tổng quan về kiến trúc RESTful API", "20"),
        ("       2.3.2. Cơ chế xác thực Bearer Token của Laravel Sanctum", "21"),
        ("   2.4. Mô hình phân quyền truy cập theo vai trò (RBAC)", "22"),
        ("       2.4.1. Lý thuyết kiểm soát truy cập theo vai trò (Role-Based Access Control)", "22"),
        ("       2.4.2. Hiện thực Middleware phân quyền trong hệ thống", "23"),
        ("   2.5. Hệ quản trị CSDL MySQL trên môi trường XAMPP và công cụ Chart.js", "24"),
        ("       2.5.1. Môi trường XAMPP và hệ quản trị MariaDB / MySQL", "24"),
        ("       2.5.2. Thư viện biểu đồ Chart.js", "25"),
        ("CHƯƠNG 3. PHÂN TÍCH VÀ THIẾT KẾ HỆ THỐNG", "26"),
        ("   3.1. Phân tích yêu cầu hệ thống", "26"),
        ("       3.1.1. Yêu cầu chức năng (Functional Requirements)", "26"),
        ("       3.1.2. Yêu cầu phi chức năng (Non-Functional Requirements)", "27"),
        ("   3.2. Thiết kế mô hình Use Case", "28"),
        ("       3.2.1. Sơ đồ Use Case tổng quát", "28"),
        ("       3.2.2. Đặc tả các Use Case chính", "29"),
        ("   3.3. Thiết kế luồng xử lý và sơ đồ tuần tự (Sequence Diagram)", "31"),
        ("       3.3.1. Sơ đồ tuần tự nghiệp vụ Nhập kho (Goods Receipt)", "31"),
        ("       3.3.2. Sơ đồ tuần tự nghiệp vụ Xuất kho an toàn (Safe Goods Issue)", "32"),
        ("       3.3.3. Sơ đồ tuần tự Kiểm kê & Điều chỉnh tồn kho (Stock Adjustment)", "33"),
        ("   3.4. Thiết kế cơ sở dữ liệu", "34"),
        ("       3.4.1. Sơ đồ quan hệ thực thể (ERD)", "34"),
        ("       3.4.2. Đặc tả chi tiết các bảng cơ sở dữ liệu", "35"),
        ("   3.5. Thiết kế kiến trúc RESTful API", "39"),
        ("       3.5.1. Quy ước đặt tên endpoint và cấu trúc Response JSON", "39"),
        ("       3.5.2. Danh mục các Endpoint chính của hệ thống", "40"),
        ("CHƯƠNG 4. HIỆN THỰC HỆ THỐNG VÀ KẾT QUẢ ĐẠT ĐƯỢC", "42"),
        ("   4.1. Môi trường triển khai và tổ chức mã nguồn", "42"),
        ("       4.1.1. Cấu hình môi trường máy chủ XAMPP", "42"),
        ("       4.1.2. Cấu trúc thư mục dự án Laravel", "43"),
        ("   4.2. Hiện thực các phân hệ chức năng", "44"),
        ("       4.2.1. Phân hệ Xác thực & Phân quyền RBAC", "44"),
        ("       4.2.2. Phân hệ Bảng điều khiển (Dashboard) và Thống kê trực quan", "45"),
        ("       4.2.3. Phân hệ Quản lý Danh mục, Nhà cung cấp và Sản phẩm", "46"),
        ("       4.2.4. Phân hệ Nhập kho với Database Transaction & Pessimistic Locking", "47"),
        ("       4.2.5. Phân hệ Xuất kho an toàn & Cảnh báo tồn kho dưới ngưỡng (min_stock)", "48"),
        ("       4.2.6. Phân hệ Nhật ký biến động kho (Inventory Audit Log)", "49"),
        ("       4.2.7. Phân hệ Quản lý Tài khoản người dùng (Dành cho Quản trị viên)", "50"),
        ("   4.3. Hiện thực hệ thống RESTful API và tài liệu tương tác", "51"),
        ("   4.4. Kiểm thử hệ thống và đánh giá", "52"),
        ("       4.4.1. Kịch bản kiểm thử tự động với PHPUnit (Feature Tests)", "52"),
        ("       4.4.2. Kết quả thực thi kiểm thử tự động", "53"),
        ("       4.4.3. Kiểm thử RESTful API bằng Postman Collection", "54"),
        ("   4.5. Đánh giá kết quả đạt được so với phiếu đăng ký đề tài", "55"),
        ("KẾT LUẬN VÀ KIẾN NGHỊ", "56"),
        ("   1. Kết luận", "56"),
        ("   2. Kiến nghị và hướng phát triển", "57"),
        ("DANH MỤC TÀI LIỆU THAM KHẢO", "58"),
        ("PHỤ LỤC", "60"),
        ("   Phụ lục 1: Hướng dẫn cài đặt và vận hành hệ thống trên môi trường XAMPP", "60"),
        ("   Phụ lục 2: Mã nguồn cốt lõi Service Layer xử lý Concurrency & Pessimistic Locking", "62"),
        ("   Phụ lục 3: Bảng tra cứu 28 Endpoint RESTful API của hệ thống", "65"),
    ]
    
    for title, page in toc_items:
        p = doc.add_paragraph()
        p.paragraph_format.line_spacing = 1.15
        p.paragraph_format.space_after = Pt(2)
        r_t = p.add_run(title)
        if not title.startswith("   "):
            r_t.font.bold = True
        # Dot leader effect
        dots_count = max(5, 75 - len(title))
        p.add_run(" " + "." * dots_count + " ")
        r_p = p.add_run(page)
        r_p.font.bold = True
        
    doc.add_page_break()

    # ========================== DANH MỤC HÌNH ==========================
    p_fig = doc.add_paragraph()
    p_fig.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_fig.add_run("DANH MỤC HÌNH\n")
    r.font.size = Pt(16)
    r.font.bold = True
    r.font.color.rgb = RGBColor(15, 23, 42)
    
    fig_items = [
        ("Hình 1", "Mô hình kiến trúc phân tầng MVC kết hợp Service Layer Pattern trong Laravel", "15"),
        ("Hình 2", "Hiện tượng tranh chấp tài nguyên (Race Condition) và Lost Update khi thao tác đồng thời", "17"),
        ("Hình 3", "Cơ chế Pessimistic Locking với câu lệnh SELECT ... FOR UPDATE trên cơ sở dữ liệu", "19"),
        ("Hình 4", "Quy trình cấp phát và xác thực Stateless Bearer Token qua Laravel Sanctum", "21"),
        ("Hình 5", "Mô hình phân quyền truy cập theo vai trò (RBAC) với Middleware CheckRole", "23"),
        ("Hình 6", "Sơ đồ Use Case tổng quát của hệ thống Quản lý Nhập - Xuất - Tồn kho", "28"),
        ("Hình 7", "Sơ đồ tuần tự (Sequence Diagram) quy trình Lập phiếu nhập kho an toàn", "31"),
        ("Hình 8", "Sơ đồ tuần tự (Sequence Diagram) quy trình Lập phiếu xuất kho và kiểm soát âm kho", "32"),
        ("Hình 9", "Sơ đồ tuần tự (Sequence Diagram) quy trình Kiểm kê và Điều chỉnh tồn kho", "33"),
        ("Hình 10", "Sơ đồ quan hệ thực thể (Entity Relationship Diagram - ERD) cơ sở dữ liệu", "34"),
        ("Hình 11", "Giao diện Đăng nhập hệ thống và tính năng một chạm tài khoản Demo", "44"),
        ("Hình 12", "Giao diện Bảng điều khiển (Dashboard) và biểu đồ thống kê Chart.js", "45"),
        ("Hình 13", "Giao diện Danh sách và bộ lọc tìm kiếm sản phẩm", "46"),
        ("Hình 14", "Giao diện Cảnh báo tồn kho dưới ngưỡng an toàn (min_stock)", "48"),
        ("Hình 15", "Giao diện Lập phiếu nhập kho nhiều mặt hàng tự động tính tiền", "47"),
        ("Hình 16", "Mẫu in phiếu nhập kho chuẩn khổ giấy A4", "47"),
        ("Hình 17", "Giao diện Lập phiếu xuất kho và kiểm tra tồn kho thời gian thực", "48"),
        ("Hình 18", "Mẫu in phiếu xuất kho chuẩn khổ giấy A4", "48"),
        ("Hình 19", "Giao diện Nhật ký biến động kho (Inventory Audit Log)", "49"),
        ("Hình 20", "Giao diện Quản lý người dùng và phân quyền vai trò (Admin)", "50"),
        ("Hình 21", "Giao diện Tài liệu tương tác RESTful API trên Web (/docs/api)", "51"),
        ("Hình 22", "Kết quả thực thi kiểm thử tự động toàn diện với PHPUnit (11/11 tests pass)", "53"),
        ("Hình 23", "Kiểm thử bộ sưu tập API tự động qua Postman Collection", "54"),
    ]
    
    for f_id, f_name, page in fig_items:
        p = doc.add_paragraph()
        p.paragraph_format.line_spacing = 1.15
        p.paragraph_format.space_after = Pt(2)
        r_id = p.add_run(f"{f_id}: ")
        r_id.font.bold = True
        p.add_run(f"{f_name} ")
        dots = "." * max(5, 70 - len(f_id) - len(f_name))
        p.add_run(f"{dots} ")
        p.add_run(page).font.bold = True
        
    doc.add_page_break()

    # ========================== DANH MỤC BẢNG ==========================
    p_tbl = doc.add_paragraph()
    p_tbl.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_tbl.add_run("DANH MỤC BẢNG\n")
    r.font.size = Pt(16)
    r.font.bold = True
    r.font.color.rgb = RGBColor(15, 23, 42)
    
    tbl_items = [
        ("Bảng 1", "So sánh đặc tính giữa Optimistic Locking và Pessimistic Locking", "18"),
        ("Bảng 2", "Phân công nhiệm vụ và tỷ lệ đóng góp của thành viên nhóm", "2"),
        ("Bảng 3", "Đặc tả cấu trúc bảng dữ liệu users (Tài khoản & Phân quyền)", "35"),
        ("Bảng 4", "Đặc tả cấu trúc bảng dữ liệu categories (Danh mục hàng hóa)", "35"),
        ("Bảng 5", "Đặc tả cấu trúc bảng dữ liệu suppliers (Nhà cung cấp)", "36"),
        ("Bảng 6", "Đặc tả cấu trúc bảng dữ liệu products (Hàng hóa & Ngưỡng min_stock)", "36"),
        ("Bảng 7", "Đặc tả cấu trúc bảng dữ liệu goods_receipts (Phiếu nhập kho)", "37"),
        ("Bảng 8", "Đặc tả cấu trúc bảng dữ liệu goods_receipt_items (Chi tiết hàng nhập)", "37"),
        ("Bảng 9", "Đặc tả cấu trúc bảng dữ liệu goods_issues (Phiếu xuất kho)", "38"),
        ("Bảng 10", "Đặc tả cấu trúc bảng dữ liệu goods_issue_items (Chi tiết hàng xuất)", "38"),
        ("Bảng 11", "Đặc tả cấu trúc bảng dữ liệu inventory_logs (Nhật ký kiểm toán biến động kho)", "39"),
        ("Bảng 12", "Quy chuẩn mã trạng thái phản hồi HTTP trong hệ thống RESTful API", "39"),
        ("Bảng 13", "Danh mục tổng hợp các Endpoint RESTful API chính của hệ thống", "40"),
        ("Bảng 14", "Bảng tổng hợp kịch bản và kết quả kiểm thử tự động với PHPUnit", "53"),
        ("Bảng 15", "Đánh giá mức độ hoàn thành chức năng so với phiếu đăng ký ban đầu", "55"),
    ]
    
    for t_id, t_name, page in tbl_items:
        p = doc.add_paragraph()
        p.paragraph_format.line_spacing = 1.15
        p.paragraph_format.space_after = Pt(2)
        p.add_run(f"{t_id}: ").font.bold = True
        p.add_run(f"{t_name} ")
        dots = "." * max(5, 70 - len(t_id) - len(t_name))
        p.add_run(f"{dots} ")
        p.add_run(page).font.bold = True
        
    doc.add_page_break()

    # ========================== DANH MỤC CÁC TỪ VIẾT TẮT ==========================
    p_abbr = doc.add_paragraph()
    p_abbr.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_abbr.add_run("DANH MỤC CÁC TỪ VIẾT TẮT\n")
    r.font.size = Pt(16)
    r.font.bold = True
    r.font.color.rgb = RGBColor(15, 23, 42)
    
    abbr_data = [
        ("API", "Application Programming Interface", "Giao diện lập trình ứng dụng cho phép các phần mềm giao tiếp với nhau."),
        ("ACID", "Atomicity, Consistency, Isolation, Durability", "Bốn thuộc tính bảo đảm tính tin cậy tuyệt đối của các giao dịch trong cơ sở dữ liệu."),
        ("CRUD", "Create, Read, Update, Delete", "Bốn thao tác cơ bản trong quản trị dữ liệu: Thêm, Đọc, Sửa và Xóa."),
        ("ERD", "Entity Relationship Diagram", "Sơ đồ thể hiện mối quan hệ giữa các thực thể trong cơ sở dữ liệu quan hệ."),
        ("HTTP/HTTPS", "Hypertext Transfer Protocol / Secure", "Giao thức truyền tải siêu văn bản an toàn trên mạng Internet."),
        ("JSON", "JavaScript Object Notation", "Định dạng trao đổi dữ liệu chuẩn dạng văn bản gọn nhẹ, dễ đọc đối với cả con người và máy tính."),
        ("MVC", "Model - View - Controller", "Mô hình kiến trúc phần mềm phân tách ứng dụng thành 3 thành phần logic độc lập."),
        ("ORM", "Object-Relational Mapping", "Kỹ thuật ánh xạ các bản ghi trong CSDL quan hệ thành các đối tượng hướng đối tượng trong mã nguồn."),
        ("RBAC", "Role-Based Access Control", "Mô hình kiểm soát truy cập và phân chia quyền hạn người dùng dựa trên vai trò nghiệp vụ."),
        ("REST", "Representational State Transfer", "Kiểu kiến trúc phần mềm hướng tài nguyên sử dụng các phương thức chuẩn của giao thức HTTP."),
        ("SKU", "Stock Keeping Unit", "Mã đơn vị lưu kho duy nhất dùng để phân loại và định danh từng mặt hàng cụ thể."),
        ("UI / UX", "User Interface / User Experience", "Giao diện người dùng và Trải nghiệm người dùng trong thiết kế phần mềm."),
        ("WMS", "Warehouse Management System", "Hệ thống phần mềm quản lý toàn diện các hoạt động vận hành kho bãi hàng hóa."),
        ("XAMPP", "Cross-Platform, Apache, MariaDB, PHP, Perl", "Bộ công cụ phần mềm máy chủ mã nguồn mở tích hợp phổ biến trên Windows."),
    ]
    
    tbl_a = doc.add_table(rows=len(abbr_data) + 1, cols=3)
    tbl_a.alignment = WD_TABLE_ALIGNMENT.CENTER
    set_table_borders(tbl_a)
    
    headers = ["Từ viết tắt", "Tên đầy đủ (Tiếng Anh)", "Ý nghĩa / Diễn giải"]
    for i, h in enumerate(headers):
        cell = tbl_a.cell(0, i)
        set_cell_background(cell, "E2E8F0")
        set_cell_margins(cell, 120, 120, 150, 150)
        p = cell.paragraphs[0]
        p.alignment = WD_ALIGN_PARAGRAPH.CENTER
        p.add_run(h).font.bold = True
        
    for row_idx, (abbr, full, desc) in enumerate(abbr_data):
        row = tbl_a.rows[row_idx + 1]
        
        c0 = row.cells[0]
        set_cell_margins(c0, 100, 100, 120, 120)
        p0 = c0.paragraphs[0]
        p0.alignment = WD_ALIGN_PARAGRAPH.CENTER
        p0.add_run(abbr).font.bold = True
        
        c1 = row.cells[1]
        set_cell_margins(c1, 100, 100, 120, 120)
        p1 = c1.paragraphs[0]
        p1.add_run(full)
        
        c2 = row.cells[2]
        set_cell_margins(c2, 100, 100, 120, 120)
        p2 = c2.paragraphs[0]
        p2.add_run(desc)
        
    doc.add_page_break()

    # ========================== MỞ ĐẦU ==========================
    p_intro_title = doc.add_paragraph()
    p_intro_title.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_intro_title.add_run("MỞ ĐẦU\n")
    r.font.size = Pt(16)
    r.font.bold = True
    r.font.color.rgb = RGBColor(15, 23, 42)
    
    p = doc.add_paragraph()
    p.add_run("a. Lý do chọn đề tài (Tính cấp thiết của đề tài):\n").font.bold = True
    p.add_run(
        "Trong bối cảnh nền kinh tế số và hoạt động thương mại đa kênh bùng nổ mạnh mẽ, kho hàng đóng vai trò là 'trái tim' trong chuỗi cung ứng của mọi doanh nghiệp thương mại và phân phối. Hiệu quả quản lý kho ảnh hưởng trực tiếp đến tốc độ luân chuyển dòng vốn, chất lượng dịch vụ khách hàng và khả năng cạnh tranh trên thị trường.\n\n"
        "Tuy nhiên, khảo sát thực tế tại nhiều doanh nghiệp vừa và nhỏ cho thấy phương pháp quản lý kho truyền thống bằng sổ sách hoặc các bảng tính Excel rời rạc đang bộc lộ những nhược điểm hết sức nghiêm trọng: số liệu không được cập nhật theo thời gian thực; việc đối chiếu dữ liệu giữa các bộ phận mất rất nhiều thời gian; không thể kiểm soát và truy vết khi xảy ra thất thoát hàng hóa. Đặc biệt nguy hiểm là khi có nhiều nhân viên kho hoặc các kênh bán hàng cùng lúc thực hiện giao dịch xuất - nhập hàng cho cùng một mặt hàng, sự thiếu vắng cơ chế khóa bản ghi (locking) tất yếu dẫn đến hiện tượng tranh chấp tài nguyên (Race Condition), ghi đè dữ liệu sai lệch và xuất hiện tình trạng hàng tồn kho bị âm (Lost Updates).\n\n"
        "Xuất phát từ yêu cầu thực tiễn cấp bách đó, đề tài "
    )
    p.add_run("“Xây dựng Hệ thống Quản lý Nhập - Xuất - Tồn kho ứng dụng Laravel Framework & RESTful API”").font.bold = True
    p.add_run(
        " được lựa chọn nghiên cứu và triển khai nhằm cung cấp một giải pháp phần mềm quản lý kho tập trung, an toàn, chính xác và có khả năng tích hợp mở rộng cao.\n\n"
    )
    
    p = doc.add_paragraph()
    p.add_run("b. Mục đích nghiên cứu:\n").font.bold = True
    p.add_run(
        "Mục đích cao nhất của đề tài là xây dựng hoàn chỉnh một hệ thống Web Application quản lý Nhập - Xuất - Tồn kho đạt chuẩn doanh nghiệp; ứng dụng thành công kỹ thuật Database Transaction kết hợp Pessimistic Locking (Khóa bi quan) để triệt tiêu hoàn toàn rủi ro sai lệch dữ liệu đồng thời; đồng thời xây dựng hệ thống RESTful API chuẩn mực bảo mật bằng Laravel Sanctum phục vụ kết nối linh hoạt với các nền tảng ứng dụng ngoại vi.\n\n"
    )
    
    p = doc.add_paragraph()
    p.add_run("c. Đối tượng nghiên cứu:\n").font.bold = True
    p.add_run(
        "- Đối tượng nghiệp vụ: Quy trình quản lý sản phẩm, danh mục, nhà cung cấp, quy trình lập và duyệt phiếu nhập kho, phiếu xuất kho, quản lý số dư tồn kho, cảnh báo thiếu hụt hàng hóa và cơ chế lưu nhật ký kiểm toán (Inventory Audit Log).\n"
        "- Đối tượng công nghệ: Framework mã nguồn mở Laravel (PHP 8.3), hệ quản trị cơ sở dữ liệu quan hệ MySQL/MariaDB trên môi trường máy chủ XAMPP, cơ chế khóa độc quyền bản ghi dữ liệu (SELECT ... FOR UPDATE), cơ chế xác thực Token Stateless (Laravel Sanctum), phân quyền vai trò người dùng (RBAC) và thư viện đồ họa Chart.js.\n\n"
    )
    
    p = doc.add_paragraph()
    p.add_run("d. Nhiệm vụ nghiên cứu:\n").font.bold = True
    p.add_run(
        "1. Khảo sát, phân tích chi tiết quy trình luân chuyển hàng hóa thực tế và đặc tả các yêu cầu chức năng, phi chức năng của hệ thống WMS.\n"
        "2. Thiết kế cơ sở dữ liệu quan hệ chuẩn 3NF, thiết kế sơ đồ Use Case, sơ đồ tuần tự (Sequence Diagram) thể hiện rõ luồng xử lý khóa dữ liệu an toàn.\n"
        "3. Lập trình hiện thực hóa các phân hệ chức năng trên nền tảng Laravel Framework tuân thủ mô hình MVC và Service Layer Pattern.\n"
        "4. Xây dựng bộ RESTful API với 28 endpoint hoàn chỉnh, xác thực bằng Bearer Token và tích hợp trang tài liệu API tương tác trực quan.\n"
        "5. Viết kịch bản và thực thi kiểm thử tự động toàn diện với PHPUnit (Feature Tests) và kiểm thử API bằng Postman Collection.\n\n"
    )
    
    p = doc.add_paragraph()
    p.add_run("e. Phương pháp nghiên cứu:\n").font.bold = True
    p.add_run(
        "- Phương pháp nghiên cứu lý thuyết: Nghiên cứu các tài liệu khoa học, sách chuyên khảo về nguyên lý hệ quản trị cơ sở dữ liệu, tiêu chuẩn giao dịch ACID, các thuật toán kiểm soát tương tranh (Concurrency Control Protocols) và chuẩn thiết kế phần mềm hướng dịch vụ REST.\n"
        "- Phương pháp thực nghiệm: Triển khai cài đặt hệ thống trên môi trường máy chủ XAMPP thực tế, tạo dựng dữ liệu giả lập có độ phức tạp cao, chạy thử nghiệm các kịch bản giao dịch đồng thời và đánh giá hiệu năng bằng các công cụ kiểm thử tự động chuyên nghiệp.\n\n"
    )
    
    p = doc.add_paragraph()
    p.add_run("f. Các kết quả đạt được của đề tài:\n").font.bold = True
    p.add_run(
        "1. Xây dựng hoàn chỉnh hệ thống phần mềm quản lý kho với giao diện người dùng trực quan, thân thiện, tương thích trên các trình duyệt hiện đại.\n"
        "2. Giải quyết triệt để bài toán tranh chấp tài nguyên và chống âm kho nhờ cơ chế Database Transaction + Pessimistic Locking (lockForUpdate).\n"
        "3. Xây dựng hệ thống Inventory Audit Log tự động truy vết 100% các biến động số dư kho (loại giao dịch, số lượng trước/thay đổi/sau, người thực hiện, thời gian chi tiết).\n"
        "4. Cung cấp Dashboard thống kê trực quan với biểu đồ Chart.js và tính năng tự động cảnh báo tồn kho dưới ngưỡng an toàn (min_stock).\n"
        "5. Xây dựng 28 Endpoint RESTful API chuẩn mực, có tài liệu tra cứu API trực tuyến và bộ sưu tập Postman Collection tích hợp sẵn.\n"
        "6. Bộ kiểm thử tự động với PHPUnit đạt tỷ lệ pass tuyệt đối 100% (11/11 Feature Tests, 41 Assertions thành công).\n\n"
    )
    
    p = doc.add_paragraph()
    p.add_run("g. Kết cấu của Đồ án:\n").font.bold = True
    p.add_run(
        "Báo cáo đồ án chuyên ngành được tổ chức thành các phần và chương chính như sau:\n"
        "- Mở đầu: Trình bày rõ tính cấp thiết, mục đích, đối tượng, nhiệm vụ, phương pháp nghiên cứu, kết quả đạt được và bố cục đồ án.\n"
        "- Chương 1: Tổng quan về bài toán quản lý nhập - xuất - tồn kho: Khảo sát thực trạng nghiệp vụ, phân tích các hạn chế của phương pháp thủ công và đề xuất giải pháp hệ thống.\n"
        "- Chương 2: Cơ sở lý thuyết và công nghệ ứng dụng: Trình bày cơ sở lý thuyết về Laravel Framework, mô hình Service Layer, kỹ thuật kiểm soát giao dịch đồng thời (ACID, Pessimistic Locking), cơ chế xác thực RESTful API với Laravel Sanctum, mô hình phân quyền RBAC và môi trường XAMPP.\n"
        "- Chương 3: Phân tích và thiết kế hệ thống: Đặc tả yêu cầu chức năng/phi chức năng, sơ đồ Use Case, các sơ đồ tuần tự (Sequence Diagram), thiết kế cơ sở dữ liệu (ERD) và thiết kế kiến trúc RESTful API.\n"
        "- Chương 4: Hiện thực hệ thống và kết quả đạt được: Giới thiệu cấu trúc mã nguồn dự án, giao diện các phân hệ chính, hệ thống API, kết quả kiểm thử tự động với PHPUnit, kiểm thử Postman và đánh giá đối chiếu với mục tiêu đề ra.\n"
        "- Kết luận và kiến nghị: Đánh giá tổng kết các thành tựu của đồ án, chỉ ra những hạn chế còn tồn đọng và đề xuất định hướng phát triển trong tương lai.\n"
        "- Danh mục tài liệu tham khảo: Liệt kê các tài liệu nghiên cứu, sách chuyên khảo và bài báo khoa học theo chuẩn trích dẫn quốc tế APA 6th.\n"
        "- Phụ lục: Cung cấp hướng dẫn cài đặt trên môi trường XAMPP, mã nguồn cốt lõi xử lý nghiệp vụ Transaction & Locking và danh mục chi tiết 28 API Endpoints.\n"
    )
    
    doc.add_page_break()

print("Part 2 module loaded.")
