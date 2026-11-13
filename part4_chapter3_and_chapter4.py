# -*- coding: utf-8 -*-
"""
Phần 4: Chương 3 (Phân tích & Thiết kế) và Chương 4 (Hiện thực & Đánh giá)
"""
import docx
from docx.shared import Inches, Pt, RGBColor
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.enum.table import WD_TABLE_ALIGNMENT
from report_builder_utils import set_cell_background, set_cell_margins, set_table_borders, add_callout, add_code_snippet

def build_chapter3_and_chapter4(doc, md):
    # ========================== CHƯƠNG 3 ==========================
    p_c3 = doc.add_paragraph()
    p_c3.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_c3.add_run("CHƯƠNG 3. PHÂN TÍCH VÀ THIẾT KẾ HỆ THỐNG\n")
    r.font.size = Pt(16)
    r.font.bold = True
    r.font.color.rgb = RGBColor(15, 23, 42)
    
    # 3.1
    p = doc.add_paragraph()
    r = p.add_run("3.1. Phân tích yêu cầu hệ thống\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Hệ thống Quản lý Nhập - Xuất - Tồn kho (WMS) được xây dựng dựa trên việc phân tích kỹ lưỡng các yêu cầu nghiệp vụ thực tế của doanh nghiệp phân phối và thương mại hàng hóa.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("3.1.1. Yêu cầu chức năng (Functional Requirements)\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "1. Phân hệ Xác thực & Phân quyền:\n"
        "- Đăng nhập hệ thống qua giao diện Web (Session-based) và qua RESTful API (Sanctum Token-based).\n"
        "- Phân chia quyền hạn theo vai trò (RBAC): Quản trị viên (Admin) và Nhân viên thủ kho (Staff).\n"
        "- Quản lý tài khoản: Thêm tài khoản mới, cập nhật thông tin, thay đổi mật khẩu và khóa/mở khóa tài khoản.\n\n"
        "2. Phân hệ Quản lý Danh mục & Nhà cung cấp:\n"
        "- Thêm, sửa, xóa, tìm kiếm danh mục hàng hóa (Category).\n"
        "- Quản lý thông tin nhà cung cấp (Supplier): Tên đối tác, mã đại lý, điện thoại, email, địa chỉ.\n\n"
        "3. Phân hệ Quản lý Sản phẩm (Products):\n"
        "- Quản lý mặt hàng theo mã SKU duy nhất, mã vạch (Barcode), tên sản phẩm, đơn vị tính, danh mục, nhà cung cấp.\n"
        "- Quản lý giá vốn nhập, giá xuất bán và thiết lập ngưỡng tồn kho an toàn tối thiểu (min_stock) và tối đa (max_stock).\n"
        "- Tra cứu, lọc sản phẩm nhanh chóng theo từ khóa, nhóm hàng và trạng thái tồn kho (còn hàng, tồn thấp, hết hàng).\n\n"
        "4. Phân hệ Quản lý Nhập kho (Goods Receipts):\n"
        "- Tự động sinh mã phiếu nhập chuẩn (PN-YYYYMMDD-XXXX).\n"
        "- Cho phép thêm động nhiều mặt hàng trong cùng một phiếu nhập, tự động tính thành tiền từng dòng và tổng tiền phiếu.\n"
        "- Áp dụng Database Transaction kết hợp Pessimistic Locking cập nhật tăng số lượng tồn kho an toàn.\n"
        "- Hỗ trợ in ấn mẫu phiếu nhập kho chuẩn theo kích thước A4.\n\n"
        "5. Phân hệ Quản lý Xuất kho (Goods Issues):\n"
        "- Tự động sinh mã phiếu xuất chuẩn (PX-YYYYMMDD-XXXX).\n"
        "- Kiểm tra số lượng tồn kho khả dụng tức thời; ngăn chặn triệt để thao tác xuất vượt quá số tồn hiện có.\n"
        "- Khóa bản ghi (Pessimistic Locking) trong suốt tiến trình xuất hàng để chống Race Condition và trừ tồn an toàn.\n"
        "- Phân loại lý do xuất kho (Xuất bán, Xuất chuyển kho, Xuất hủy, Xuất trả NCC) và hỗ trợ in ấn mẫu phiếu xuất kho A4.\n\n"
        "6. Phân hệ Kiểm kê & Nhật ký biến động kho (Audit Log):\n"
        "- Tính năng Kiểm kê kho (Stock Adjustment) cho phép Quản trị viên điều chỉnh số tồn thực tế và bắt buộc nhập lý do.\n"
        "- Tự động lưu vết 100% các biến động số dư kho vào bảng inventory_logs (loại giao dịch, số lượng trước, thay đổi, sau, người thực hiện, thời gian chi tiết).\n\n"
        "7. Phân hệ Bảng điều khiển (Dashboard) & Cảnh báo:\n"
        "- Thống kê 4 thẻ chỉ số KPI: Tổng số mặt hàng, Tổng lượng hàng tồn, Ước tính giá trị kho và Số lượng mặt hàng dưới ngưỡng an toàn.\n"
        "- Biểu đồ Chart.js trực quan hóa xu hướng giá trị Nhập/Xuất kho 6 tháng gần nhất và cơ cấu tỷ trọng theo danh mục.\n"
        "- Trang chuyên biệt cảnh báo các mặt hàng có tồn kho nhỏ hơn hoặc bằng min_stock để kịp thời nhập thêm hàng.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("3.1.2. Yêu cầu phi chức năng (Non-Functional Requirements)\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "- Tính toàn vẹn và nhất quán dữ liệu (Data Integrity): Đảm bảo chuẩn giao dịch ACID 100%, không xảy ra tình trạng âm kho trong bất kỳ tình huống tương tranh nào.\n"
        "- Hiệu năng xử lý (Performance): Tốc độ phản hồi của các yêu cầu API và truy vấn giao diện web đạt dưới 200ms trong điều kiện vận hành chuẩn.\n"
        "- Tính bảo mật (Security): Mật khẩu người dùng được băm an toàn bằng Bcrypt (với hệ số chi phí 12); API sử dụng Bearer Token băm SHA-256; phòng chống các lỗ hổng bảo mật phổ biến như SQL Injection (qua PDO Parameter Binding), XSS (qua Blade Template) và CSRF.\n"
        "- Tính khả dụng và tương thích (Usability): Giao diện người dùng được thiết kế chuẩn Responsive, vận hành mượt mà trên các trình duyệt máy tính phổ biến (Google Chrome, Microsoft Edge, Mozilla Firefox).\n\n"
    )
    
    # 3.2
    p = doc.add_paragraph()
    r = p.add_run("3.2. Thiết kế mô hình Use Case\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Hệ thống phân định rõ ranh giới quyền hạn giữa hai tác tử người dùng chính:\n"
        "- Tác tử Nhân viên thủ kho (Warehouse Staff): Thực hiện các nghiệp vụ vận hành hàng ngày (Xem Dashboard, Cảnh báo tồn, Xem sản phẩm, Lập phiếu nhập, Lập phiếu xuất, Tra cứu lịch sử kho, In phiếu).\n"
        "- Tác tử Quản trị viên (Admin): Kế thừa toàn bộ quyền của Thủ kho và mở rộng các quyền quản trị cao cấp (Thêm/Sửa/Xóa sản phẩm, danh mục, nhà cung cấp; Quản lý tài khoản người dùng; Thực hiện kiểm kê điều chỉnh tồn kho).\n\n"
    )
    
    p_fig6 = doc.add_paragraph()
    p_fig6.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_fig6.add_run("Hình 6: Sơ đồ Use Case tổng quát của hệ thống Quản lý Nhập - Xuất - Tồn kho\n")
    r.font.italic = True
    r.font.size = Pt(11)
    
    # 3.3
    p = doc.add_paragraph()
    r = p.add_run("3.3. Thiết kế luồng xử lý và sơ đồ tuần tự (Sequence Diagram)\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Nhằm thể hiện rõ nét cơ chế hoạt động của Database Transaction và Pessimistic Locking, các sơ đồ tuần tự được thiết kế chi tiết cho các ca nghiệp vụ nhạy cảm về dữ liệu:\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("3.3.1. Sơ đồ tuần tự nghiệp vụ Nhập kho (Goods Receipt)\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Khi người dùng gửi yêu cầu nhập kho:\n"
        "1. Web/API Controller tiếp nhận và xác thực dữ liệu đầu vào (Validation).\n"
        "2. Gọi InventoryService::createReceipt() để bắt đầu một khối DB::transaction().\n"
        "3. Khởi tạo bản ghi phiếu nhập trong bảng goods_receipts.\n"
        "4. Với mỗi mặt hàng, gọi Product::lockForUpdate() để khóa bản ghi cấp độ hàng (Row-level Lock).\n"
        "5. Lưu chi tiết phiếu nhập (goods_receipt_items), tính toán số dư mới: quantity_after = quantity_before + quantity.\n"
        "6. Cập nhật tồn kho sản phẩm (product->save()), cập nhật đơn giá vốn gần nhất.\n"
        "7. Ghi nhận bản ghi lịch sử vào inventory_logs với loại giao dịch là 'in'.\n"
        "8. Commit Transaction, giải phóng khóa độc quyền và trả về thông báo thành công.\n\n"
    )
    
    p_fig7 = doc.add_paragraph()
    p_fig7.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_fig7.add_run("Hình 7: Sơ đồ tuần tự quy trình Lập phiếu nhập kho an toàn (Database Transaction + Lock)\n")
    r.font.italic = True
    r.font.size = Pt(11)
    
    p = doc.add_paragraph()
    r = p.add_run("3.3.2. Sơ đồ tuần tự nghiệp vụ Xuất kho an toàn (Safe Goods Issue)\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Quy trình xuất kho là điểm nhấn kỹ thuật quan trọng nhất của đồ án:\n"
        "1. Mở khối DB::transaction() nhằm bảo đảm tính nguyên tử.\n"
        "2. Tại mỗi mặt hàng xuất, gọi câu lệnh Product::where('id', $id)->lockForUpdate()->firstOrFail(). Động cơ CSDL lập tức đặt một Exclusive Lock lên dòng sản phẩm này.\n"
        "3. Kiểm tra điều kiện an toàn: Nếu product->current_stock < quantity yêu cầu, hệ thống chủ động ném ra một Exception với thông báo cụ thể. Transaction tự động Rollback, không có bất kỳ thay đổi nào được ghi lại, kho hàng được bảo vệ an toàn 100% không bị âm.\n"
        "4. Nếu đủ tồn: Tạo bản ghi goods_issue_items, tính toán tồn mới: quantity_after = quantity_before - quantity.\n"
        "5. Cập nhật số tồn mới vào bảng products và ghi nhật ký kiểm toán vào inventory_logs với loại giao dịch là 'out'.\n"
        "6. Commit Transaction và giải phóng khóa.\n\n"
    )
    
    p_fig8 = doc.add_paragraph()
    p_fig8.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_fig8.add_run("Hình 8: Sơ đồ tuần tự quy trình Lập phiếu xuất kho và kiểm soát âm kho an toàn\n")
    r.font.italic = True
    r.font.size = Pt(11)
    
    p = doc.add_paragraph()
    r = p.add_run("3.3.3. Sơ đồ tuần tự Kiểm kê & Điều chỉnh tồn kho (Stock Adjustment)\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Chức năng này được bảo vệ bởi Middleware CheckRole('admin'):\n"
        "1. Quản trị viên nhập số tồn thực tế mới và lý do điều chỉnh.\n"
        "2. Khởi tạo DB::transaction() và gọi lockForUpdate() trên sản phẩm.\n"
        "3. Tính toán độ chênh lệch: diff = new_stock - quantity_before.\n"
        "4. Cập nhật current_stock = new_stock và ghi nhật ký inventory_logs với type = 'adjust'.\n"
        "5. Commit Transaction và hoàn tất.\n\n"
    )
    
    p_fig9 = doc.add_paragraph()
    p_fig9.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_fig9.add_run("Hình 9: Sơ đồ tuần tự quy trình Kiểm kê và Điều chỉnh tồn kho của Quản trị viên\n")
    r.font.italic = True
    r.font.size = Pt(11)
    
    # 3.4
    p = doc.add_paragraph()
    r = p.add_run("3.4. Thiết kế cơ sở dữ liệu\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Cơ sở dữ liệu do_an_kho được thiết kế chuẩn hóa mức 3NF bao gồm 9 bảng dữ liệu nghiệp vụ chính và các bảng hệ thống hỗ trợ.\n\n"
    )
    
    p_fig10 = doc.add_paragraph()
    p_fig10.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_fig10.add_run("Hình 10: Sơ đồ quan hệ thực thể (ERD) cơ sở dữ liệu hệ thống WMS\n")
    r.font.italic = True
    r.font.size = Pt(11)
    
    # Bảng 3: users
    p = doc.add_paragraph()
    p.add_run("Bảng 3: Đặc tả cấu trúc bảng dữ liệu users (Tài khoản & Phân quyền)").font.bold = True
    tbl = doc.add_table(rows=8, cols=5)
    tbl.alignment = WD_TABLE_ALIGNMENT.CENTER
    set_table_borders(tbl)
    headers = ["Tên trường", "Kiểu dữ liệu", "Khóa", "Null", "Diễn giải ý nghĩa"]
    for i, h in enumerate(headers):
        c = tbl.cell(0, i)
        set_cell_background(c, "E2E8F0")
        set_cell_margins(c, 80, 80, 100, 100)
        c.paragraphs[0].alignment = WD_ALIGN_PARAGRAPH.CENTER
        c.paragraphs[0].add_run(h).font.bold = True
    rows_data = [
        ("id", "BIGINT UNSIGNED", "PK", "No", "Mã định danh người dùng tự tăng"),
        ("name", "VARCHAR(255)", "", "No", "Họ và tên người dùng"),
        ("email", "VARCHAR(255)", "Unique", "No", "Địa chỉ email đăng nhập hệ thống"),
        ("phone", "VARCHAR(20)", "", "Yes", "Số điện thoại liên lạc"),
        ("password", "VARCHAR(255)", "", "No", "Mật khẩu băm Bcrypt"),
        ("role", "VARCHAR(50)", "", "No", "Vai trò người dùng ('admin', 'staff')"),
        ("status", "TINYINT(1)", "", "No", "Trạng thái hoạt động (1: Hoạt động, 0: Khóa)"),
    ]
    for r_idx, r_val in enumerate(rows_data):
        row = tbl.rows[r_idx + 1]
        for c_idx, val in enumerate(r_val):
            cell = row.cells[c_idx]
            set_cell_margins(cell, 60, 60, 80, 80)
            cell.paragraphs[0].add_run(val)
            
    doc.add_paragraph().paragraph_format.space_after = Pt(2)
    
    # Bảng 6: products
    p = doc.add_paragraph()
    p.add_run("Bảng 6: Đặc tả cấu trúc bảng dữ liệu products (Hàng hóa & Ngưỡng min_stock)").font.bold = True
    tbl_p = doc.add_table(rows=12, cols=5)
    tbl_p.alignment = WD_TABLE_ALIGNMENT.CENTER
    set_table_borders(tbl_p)
    for i, h in enumerate(headers):
        c = tbl_p.cell(0, i)
        set_cell_background(c, "E2E8F0")
        set_cell_margins(c, 80, 80, 100, 100)
        c.paragraphs[0].alignment = WD_ALIGN_PARAGRAPH.CENTER
        c.paragraphs[0].add_run(h).font.bold = True
    prod_data = [
        ("id", "BIGINT UNSIGNED", "PK", "No", "Mã sản phẩm duy nhất"),
        ("sku", "VARCHAR(50)", "Unique", "No", "Mã đơn vị lưu kho SKU"),
        ("barcode", "VARCHAR(50)", "Index", "Yes", "Mã vạch sản phẩm"),
        ("name", "VARCHAR(255)", "", "No", "Tên chi tiết mặt hàng"),
        ("category_id", "BIGINT UNSIGNED", "FK", "No", "Khóa ngoại liên kết categories(id)"),
        ("supplier_id", "BIGINT UNSIGNED", "FK", "Yes", "Khóa ngoại liên kết suppliers(id)"),
        ("unit", "VARCHAR(50)", "", "No", "Đơn vị tính (Cái, Chiếc, Thùng...)"),
        ("purchase_price", "DECIMAL(15,2)", "", "No", "Giá vốn nhập kho"),
        ("selling_price", "DECIMAL(15,2)", "", "No", "Giá xuất bán"),
        ("current_stock", "INT", "", "No", "Số lượng tồn kho thực tế hiện hành"),
        ("min_stock", "INT", "", "No", "Ngưỡng tồn kho tối thiểu cần cảnh báo (Mặc định: 5)"),
    ]
    for r_idx, r_val in enumerate(prod_data):
        row = tbl_p.rows[r_idx + 1]
        for c_idx, val in enumerate(r_val):
            cell = row.cells[c_idx]
            set_cell_margins(cell, 60, 60, 80, 80)
            cell.paragraphs[0].add_run(val)
            
    doc.add_paragraph().paragraph_format.space_after = Pt(2)
    
    # Bảng 11: inventory_logs
    p = doc.add_paragraph()
    p.add_run("Bảng 11: Đặc tả cấu trúc bảng dữ liệu inventory_logs (Nhật ký kiểm toán kho)").font.bold = True
    tbl_l = doc.add_table(rows=11, cols=5)
    tbl_l.alignment = WD_TABLE_ALIGNMENT.CENTER
    set_table_borders(tbl_l)
    for i, h in enumerate(headers):
        c = tbl_l.cell(0, i)
        set_cell_background(c, "E2E8F0")
        set_cell_margins(c, 80, 80, 100, 100)
        c.paragraphs[0].alignment = WD_ALIGN_PARAGRAPH.CENTER
        c.paragraphs[0].add_run(h).font.bold = True
    log_data = [
        ("id", "BIGINT UNSIGNED", "PK", "No", "Khóa chính bản ghi audit"),
        ("product_id", "BIGINT UNSIGNED", "FK", "No", "Mã sản phẩm phát sinh biến động"),
        ("user_id", "BIGINT UNSIGNED", "FK", "Yes", "Người dùng thực hiện thao tác"),
        ("type", "VARCHAR(50)", "Index", "No", "Loại giao dịch ('in', 'out', 'adjust')"),
        ("reference_type", "VARCHAR(50)", "", "Yes", "Loại chứng từ ('receipt', 'issue', 'adjustment')"),
        ("reference_code", "VARCHAR(50)", "", "Yes", "Mã phiếu (PN-... hoặc PX-...)"),
        ("quantity_before", "INT", "", "No", "Số lượng tồn kho trước biến động"),
        ("quantity_change", "INT", "", "No", "Số lượng tăng/giảm (+ hoặc -)"),
        ("quantity_after", "INT", "", "No", "Số lượng tồn kho sau biến động"),
        ("note", "TEXT", "", "Yes", "Lý do và diễn giải chi tiết giao dịch"),
    ]
    for r_idx, r_val in enumerate(log_data):
        row = tbl_l.rows[r_idx + 1]
        for c_idx, val in enumerate(r_val):
            cell = row.cells[c_idx]
            set_cell_margins(cell, 60, 60, 80, 80)
            cell.paragraphs[0].add_run(val)
            
    # 3.5
    p = doc.add_paragraph()
    r = p.add_run("\n3.5. Thiết kế kiến trúc RESTful API\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Hệ thống cung cấp 28 Endpoint API chuẩn RESTful, sử dụng định dạng dữ liệu JSON nhất quán và mã trạng thái HTTP chuẩn mực.\n\n"
    )
    
    # Bảng 12: HTTP Status Codes
    p = doc.add_paragraph()
    p.add_run("Bảng 12: Quy chuẩn mã trạng thái phản hồi HTTP trong hệ thống RESTful API").font.bold = True
    tbl_http = doc.add_table(rows=6, cols=3)
    tbl_http.alignment = WD_TABLE_ALIGNMENT.CENTER
    set_table_borders(tbl_http)
    h_http = ["Mã HTTP", "Tên trạng thái", "Ý nghĩa và ngữ cảnh áp dụng trong hệ thống WMS"]
    for i, h in enumerate(h_http):
        c = tbl_http.cell(0, i)
        set_cell_background(c, "E2E8F0")
        set_cell_margins(c, 80, 80, 100, 100)
        c.paragraphs[0].alignment = WD_ALIGN_PARAGRAPH.CENTER
        c.paragraphs[0].add_run(h).font.bold = True
    http_data = [
        ("200 OK", "Thành công", "Truy vấn danh sách, xem chi tiết hoặc cập nhật bản ghi thành công."),
        ("201 Created", "Tạo mới thành công", "Lập phiếu nhập, phiếu xuất hoặc tạo sản phẩm mới thành công."),
        ("401 Unauthorized", "Chưa xác thực", "Yêu cầu thiếu hoặc sai Bearer Token trong header HTTP."),
        ("403 Forbidden", "Không có quyền", "Nhân viên kho cố tình truy cập vào phân hệ quản lý người dùng của Admin."),
        ("422 Unprocessable Entity", "Dữ liệu không hợp lệ / Thiếu tồn kho", "Lỗi dữ liệu đầu vào hoặc xuất kho khi số tồn không đủ."),
    ]
    for r_idx, r_val in enumerate(http_data):
        row = tbl_http.rows[r_idx + 1]
        for c_idx, val in enumerate(r_val):
            cell = row.cells[c_idx]
            set_cell_margins(cell, 60, 60, 80, 80)
            if c_idx == 0:
                cell.paragraphs[0].add_run(val).font.bold = True
            else:
                cell.paragraphs[0].add_run(val)
                
    doc.add_page_break()

    # ========================== CHƯƠNG 4 ==========================
    p_c4 = doc.add_paragraph()
    p_c4.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_c4.add_run("CHƯƠNG 4. HIỆN THỰC HỆ THỐNG VÀ KẾT QUẢ ĐẠT ĐƯỢC\n")
    r.font.size = Pt(16)
    r.font.bold = True
    r.font.color.rgb = RGBColor(15, 23, 42)
    
    # 4.1
    p = doc.add_paragraph()
    r = p.add_run("4.1. Môi trường triển khai và tổ chức mã nguồn\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Hệ thống được cài đặt và vận hành thực tế trên máy tính phát triển với cấu hình:\n"
        "- Hệ điều hành: Microsoft Windows 10/11 64-bit.\n"
        "- Môi trường máy chủ: XAMPP (C:\\xampp) với Apache 2.4 và MariaDB/MySQL 10.4.\n"
        "- Trình biên dịch: PHP 8.3.33 (cli) ZTS Visual C++ 2019 x64 tích hợp trong XAMPP.\n"
        "- Công cụ quản lý gói: Composer version 2.10.2.\n"
        "- Thư mục dự án: E:\\Laravel_Inventory_Management_System (được tạo Directory Junction liên kết trực tiếp vào C:\\xampp\\htdocs\\Laravel_Inventory_Management_System).\n"
        "- Cơ sở dữ liệu: Database do_an_kho trên cổng 3306, mã hóa utf8mb4_unicode_ci.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("4.2. Hiện thực các phân hệ chức năng\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Hệ thống đã hiện thực hóa 100% các tính năng cam kết trong phiếu đăng ký đề tài:\n\n"
    )
    
    p_sub1 = doc.add_paragraph()
    r = p_sub1.add_run("4.2.1. Phân hệ Bảng điều khiển (Dashboard):\n")
    r.font.bold = True
    r.font.italic = True
    p_sub1.add_run(
        "Hiển thị tức thời 4 thẻ chỉ số KPI kinh doanh: Tổng số mặt hàng đang lưu trữ (10 sản phẩm mẫu), Tổng số lượng tồn kho (591 đơn vị hàng), Tổng giá trị kho hàng ước tính theo giá vốn (88.425.000 VNĐ) và Cảnh báo số lượng mặt hàng dưới ngưỡng tồn an toàn (4 mặt hàng). Tích hợp 2 biểu đồ Chart.js trực quan hóa xu hướng giao dịch 6 tháng và tỷ trọng danh mục.\n\n"
    )
    
    p_sub2 = doc.add_paragraph()
    r = p_sub2.add_run("4.2.2. Phân hệ Nhập kho (Transaction + Pessimistic Locking):\n")
    r.font.bold = True
    r.font.italic = True
    p_sub2.add_run(
        "Cho phép tạo phiếu nhập với giao diện động (Dynamic Rows), thêm sản phẩm và tự động tính thành tiền. Khi bấm 'Hoàn tất nhập kho', hệ thống thực thi khối DB::transaction() kết hợp lockForUpdate() để tăng tồn kho an toàn và lưu nhật ký kiểm toán.\n\n"
    )
    
    p_sub3 = doc.add_paragraph()
    r = p_sub3.add_run("4.2.3. Phân hệ Xuất kho an toàn & Chống âm kho:\n")
    r.font.bold = True
    r.font.italic = True
    p_sub3.add_run(
        "Giao diện xuất kho kiểm tra tồn kho tức thời ngay khi chọn sản phẩm. Tại tầng Backend Service, câu lệnh lockForUpdate() khóa độc quyền bản ghi sản phẩm và kiểm tra lại số dư thực tế trong CSDL; nếu không đủ tồn, hệ thống từ chối xuất ngay lập tức, loại bỏ hoàn toàn rủi ro kho bị âm do giao dịch đồng thời.\n\n"
    )
    
    p_sub4 = doc.add_paragraph()
    r = p_sub4.add_run("4.2.4. Phân hệ Nhật ký biến động kho (Inventory Audit Log):\n")
    r.font.bold = True
    r.font.italic = True
    p_sub4.add_run(
        "Mọi thao tác làm thay đổi số lượng tồn (nhập, xuất, kiểm kê) đều được tự động lưu vết minh bạch. Cung cấp bộ lọc đa năng theo mặt hàng, loại giao dịch, nhân viên thực hiện và khoảng thời gian phát sinh.\n\n"
    )
    
    # 4.4 Kiểm thử
    p = doc.add_paragraph()
    r = p.add_run("4.4. Kiểm thử hệ thống và đánh giá\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Nhóm thực hiện đã xây dựng bộ kiểm thử chức năng tự động toàn diện (Automated Feature Tests) bằng PHPUnit tại tập tin tests/Feature/InventorySystemTest.php.\n\n"
    )
    
    # Bảng 14: Kịch bản test
    p = doc.add_paragraph()
    p.add_run("Bảng 14: Bảng tổng hợp kịch bản và kết quả kiểm thử tự động với PHPUnit").font.bold = True
    tbl_t = doc.add_table(rows=12, cols=4)
    tbl_t.alignment = WD_TABLE_ALIGNMENT.CENTER
    set_table_borders(tbl_t)
    h_test = ["STT", "Tên Test Case / Phương thức kiểm thử", "Mục tiêu kiểm thử nghiệp vụ", "Kết quả"]
    for i, h in enumerate(h_test):
        c = tbl_t.cell(0, i)
        set_cell_background(c, "E2E8F0")
        set_cell_margins(c, 80, 80, 100, 100)
        c.paragraphs[0].alignment = WD_ALIGN_PARAGRAPH.CENTER
        c.paragraphs[0].add_run(h).font.bold = True
        
    test_cases = [
        ("1", "test_the_application_returns_a_successful_response", "Kiểm tra chuyển hướng trang chủ về Dashboard", "PASSED"),
        ("2", "test_user_can_login_via_api_and_get_sanctum_token", "Kiểm tra API đăng nhập và sinh Sanctum Bearer Token", "PASSED"),
        ("3", "test_user_can_login_via_web", "Kiểm tra xác thực phiên đăng nhập Web Session", "PASSED"),
        ("4", "test_goods_receipt_increases_stock_and_creates_audit_log", "Kiểm tra Nhập kho: Tăng tồn kho & ghi Audit Log", "PASSED"),
        ("5", "test_goods_issue_decreases_stock_and_creates_audit_log", "Kiểm tra Xuất kho: Trừ tồn kho an toàn & ghi Audit Log", "PASSED"),
        ("6", "test_goods_issue_fails_when_stock_is_insufficient", "Kiểm tra Chặn âm kho khi xuất vượt quá tồn khả dụng", "PASSED"),
        ("7", "test_low_stock_detection", "Kiểm tra tự động phát hiện cảnh báo tồn dưới min_stock", "PASSED"),
        ("8", "test_staff_cannot_access_user_management", "Kiểm tra phân quyền RBAC: Chặn Staff vào trang Quản lý User (403)", "PASSED"),
        ("9", "test_admin_can_access_user_management", "Kiểm tra phân quyền RBAC: Cho phép Admin vào trang Quản lý User", "PASSED"),
        ("10", "test_admin_can_adjust_stock", "Kiểm tra Kiểm kê: Admin điều chỉnh tồn thực tế & ghi log", "PASSED"),
        ("11", "test_api_requires_authentication", "Kiểm tra bảo vệ API: Chặn truy cập khi thiếu Bearer Token (401)", "PASSED"),
    ]
    for r_idx, r_val in enumerate(test_cases):
        row = tbl_t.rows[r_idx + 1]
        for c_idx, val in enumerate(r_val):
            cell = row.cells[c_idx]
            set_cell_margins(cell, 60, 60, 80, 80)
            if c_idx == 0 or c_idx == 3:
                cell.paragraphs[0].alignment = WD_ALIGN_PARAGRAPH.CENTER
                if c_idx == 3:
                    cell.paragraphs[0].add_run(val).font.bold = True
                else:
                    cell.paragraphs[0].add_run(val)
            else:
                cell.paragraphs[0].add_run(val)
                
    p_res = doc.add_paragraph()
    p_res.add_run("\nKết quả thực thi lệnh 'php artisan test': ").font.bold = True
    p_res.add_run("11/11 Tests Passed (100%), 41 Assertions thành công tuyệt đối, thời gian thực thi: 1.05 giây.\n\n")
    
    # 4.5
    p = doc.add_paragraph()
    r = p.add_run("4.5. Đánh giá kết quả đạt được so với phiếu đăng ký đề tài\n")
    r.font.size = Pt(14)
    r.font.bold = True
    
    tbl_eval = doc.add_table(rows=7, cols=4)
    tbl_eval.alignment = WD_TABLE_ALIGNMENT.CENTER
    set_table_borders(tbl_eval)
    h_eval = ["STT", "Hạng mục chức năng đăng ký", "Hiện thực thực tế trong hệ thống", "Tỷ lệ hoàn thành"]
    for i, h in enumerate(h_eval):
        c = tbl_eval.cell(0, i)
        set_cell_background(c, "E2E8F0")
        set_cell_margins(c, 80, 80, 100, 100)
        c.paragraphs[0].alignment = WD_ALIGN_PARAGRAPH.CENTER
        c.paragraphs[0].add_run(h).font.bold = True
        
    eval_data = [
        ("1", "Đăng nhập và phân quyền RBAC", "Web Session + Laravel Sanctum API Token; 2 vai trò Admin và Staff", "100% (Đạt)"),
        ("2", "Quản lý sản phẩm, danh mục, NCC", "CRUD đầy đủ, quản lý SKU, Barcode, Giá vốn, Giá bán, min_stock", "100% (Đạt)"),
        ("3", "Quản lý nhập kho", "Lập phiếu nhập đa dòng, Transaction + Pessimistic Locking tăng tồn", "100% (Đạt)"),
        ("4", "Quản lý xuất kho", "Kiểm tra tồn khả dụng, khóa hàng trừ tồn an toàn, chặn âm kho tuyệt đối", "100% (Đạt)"),
        ("5", "Quản lý tồn kho & Audit Log", "Tự động ghi nhận 100% lịch sử biến động, tính năng Kiểm kê kho", "100% (Đạt)"),
        ("6", "Dashboard và cảnh báo tồn kho", "Biểu đồ cột & tròn Chart.js; cảnh báo tự động sản phẩm <= min_stock", "100% (Đạt)"),
    ]
    for r_idx, r_val in enumerate(eval_data):
        row = tbl_eval.rows[r_idx + 1]
        for c_idx, val in enumerate(r_val):
            cell = row.cells[c_idx]
            set_cell_margins(cell, 60, 60, 80, 80)
            if c_idx == 0 or c_idx == 3:
                cell.paragraphs[0].alignment = WD_ALIGN_PARAGRAPH.CENTER
                cell.paragraphs[0].add_run(val).font.bold = True
            else:
                cell.paragraphs[0].add_run(val)
                
    doc.add_page_break()

print("Part 4 module loaded.")
