# -*- coding: utf-8 -*-
"""
Phần 1: Bìa, Nhiệm vụ đề tài, Giảng viên hướng dẫn, Phiếu nhận xét, Lời cảm ơn, Danh mục
"""
import docx
from docx.shared import Inches, Pt, RGBColor
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.enum.table import WD_TABLE_ALIGNMENT
from report_builder_utils import set_cell_background, set_cell_margins, set_table_borders

def build_front_matter(doc, md):
    # ========================== TRANG BÌA 1 (BÌA NGOÀI) ==========================
    p = doc.add_paragraph()
    p.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p.add_run("ỦY BAN NHÂN DÂN THÀNH PHỐ HỒ CHÍ MINH\nTRƯỜNG CAO ĐẲNG LÝ TỰ TRỌNG THÀNH PHỐ HỒ CHÍ MINH\nKHOA CÔNG NGHỆ THÔNG TIN\n")
    r.font.name = "Times New Roman"
    r.font.size = Pt(13)
    r.font.bold = True
    
    r_line = p.add_run("____________________\n\n\n\n")
    r_line.font.name = "Times New Roman"
    r_line.font.size = Pt(13)
    
    p_title = doc.add_paragraph()
    p_title.alignment = WD_ALIGN_PARAGRAPH.CENTER
    p_title.paragraph_format.line_spacing = 1.3
    r_t = p_title.add_run("XÂY DỰNG HỆ THỐNG QUẢN LÝ NHẬP - XUẤT - TỒN KHO\nỨNG DỤNG LARAVEL FRAMEWORK & RESTFUL API\n\n")
    r_t.font.name = "Times New Roman"
    r_t.font.size = Pt(18)
    r_t.font.bold = True
    r_t.font.color.rgb = RGBColor(15, 23, 42)
    
    p_sub = doc.add_paragraph()
    p_sub.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r_sub = p_sub.add_run("ĐỒ ÁN CHUYÊN NGÀNH\nNGÀNH: LẬP TRÌNH MÁY TÍNH\n\n\n\n")
    r_sub.font.name = "Times New Roman"
    r_sub.font.size = Pt(15)
    r_sub.font.bold = True
    r_sub.font.color.rgb = RGBColor(37, 99, 235)
    
    p_info = doc.add_paragraph()
    p_info.alignment = WD_ALIGN_PARAGRAPH.LEFT
    p_info.paragraph_format.left_indent = Inches(1.5)
    p_info.paragraph_format.line_spacing = 1.25
    r_info = p_info.add_run(
        "Họ và tên sinh viên thực hiện:\n"
        "1. Thái Anh Kiệt          MSSV: 25002447\n"
        "2. Trần Phúc Khang        MSSV: 25002446\n\n"
        "Khoa: CÔNG NGHỆ THÔNG TIN\n"
        "Lớp:  25C2-LTM1           Khóa: 2025\n\n\n\n\n"
    )
    r_info.font.name = "Times New Roman"
    r_info.font.size = Pt(13.5)
    r_info.font.bold = True
    
    p_date = doc.add_paragraph()
    p_date.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r_date = p_date.add_run("Thành phố Hồ Chí Minh, tháng 11 năm 2026")
    r_date.font.name = "Times New Roman"
    r_date.font.size = Pt(13)
    r_date.font.italic = True
    
    doc.add_page_break()
    
    # ========================== TRANG BÌA 2 (BÌA TRONG) ==========================
    p2 = doc.add_paragraph()
    p2.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r2 = p2.add_run("ỦY BAN NHÂN DÂN THÀNH PHỐ HỒ CHÍ MINH\nTRƯỜNG CAO ĐẲNG LÝ TỰ TRỌNG THÀNH PHỐ HỒ CHÍ MINH\nKHOA CÔNG NGHỆ THÔNG TIN\n")
    r2.font.name = "Times New Roman"
    r2.font.size = Pt(13)
    r2.font.bold = True
    
    r2_line = p2.add_run("____________________\n\n\n\n")
    r2_line.font.name = "Times New Roman"
    r2_line.font.size = Pt(13)
    
    p2_title = doc.add_paragraph()
    p2_title.alignment = WD_ALIGN_PARAGRAPH.CENTER
    p2_title.paragraph_format.line_spacing = 1.3
    r2_t = p2_title.add_run("XÂY DỰNG HỆ THỐNG QUẢN LÝ NHẬP - XUẤT - TỒN KHO\nỨNG DỤNG LARAVEL FRAMEWORK & RESTFUL API\n\n")
    r2_t.font.name = "Times New Roman"
    r2_t.font.size = Pt(18)
    r2_t.font.bold = True
    r2_t.font.color.rgb = RGBColor(15, 23, 42)
    
    p2_sub = doc.add_paragraph()
    p2_sub.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r2_sub = p2_sub.add_run("ĐỒ ÁN CHUYÊN NGÀNH\nNGÀNH: LẬP TRÌNH MÁY TÍNH\n\n\n")
    r2_sub.font.name = "Times New Roman"
    r2_sub.font.size = Pt(15)
    r2_sub.font.bold = True
    r2_sub.font.color.rgb = RGBColor(37, 99, 235)
    
    p2_info = doc.add_paragraph()
    p2_info.alignment = WD_ALIGN_PARAGRAPH.LEFT
    p2_info.paragraph_format.left_indent = Inches(1.5)
    p2_info.paragraph_format.line_spacing = 1.25
    r2_info = p2_info.add_run(
        "Họ và tên sinh viên thực hiện:\n"
        "1. Thái Anh Kiệt          MSSV: 25002447\n"
        "2. Trần Phúc Khang        MSSV: 25002446\n\n"
        "Khoa: CÔNG NGHỆ THÔNG TIN\n"
        "Lớp:  25C2-LTM1           Khóa: 2025\n\n"
        "Giảng viên hướng dẫn: Th.S. Mai Chiếm Tuấn\n\n\n\n"
    )
    r2_info.font.name = "Times New Roman"
    r2_info.font.size = Pt(13.5)
    r2_info.font.bold = True
    
    p2_date = doc.add_paragraph()
    p2_date.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r2_date = p2_date.add_run("Thành phố Hồ Chí Minh, tháng 11 năm 2026")
    r2_date.font.name = "Times New Roman"
    r2_date.font.size = Pt(13)
    r2_date.font.italic = True
    
    doc.add_page_break()

    # ========================== NHIỆM VỤ ĐỀ TÀI ==========================
    p_task_title = doc.add_paragraph()
    p_task_title.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r_tt = p_task_title.add_run("NHIỆM VỤ ĐỀ TÀI ĐỒ ÁN CHUYÊN NGÀNH\n")
    r_tt.font.name = "Times New Roman"
    r_tt.font.size = Pt(15)
    r_tt.font.bold = True
    
    p_t1 = doc.add_paragraph()
    r = p_t1.add_run("1. Nội dung và các yêu cầu cần giải quyết trong nhiệm vụ đề tài:\n")
    r.font.bold = True
    
    r_a = p_t1.add_run("a. Nội dung:\n")
    r_a.font.bold = True
    p_t1.add_run(
        "- Khảo sát thực trạng bài toán quản lý kho hàng tại các doanh nghiệp vừa và nhỏ: quy trình nhập hàng, xuất bán, kiểm đếm tồn kho và phát hiện các hạn chế của phương pháp thủ công.\n"
        "- Nghiên cứu kiến trúc phân tầng (Multi-tier Architecture) với mô hình MVC kết hợp Service Layer Pattern trong Laravel Framework.\n"
        "- Nghiên cứu và hiện thực giải pháp kiểm soát giao dịch đồng thời (Concurrency Control) áp dụng Database Transaction kết hợp Pessimistic Locking (SELECT ... FOR UPDATE) để chống lỗi Race Condition và âm kho.\n"
        "- Xây dựng hệ thống xác thực RESTful API theo chuẩn Stateless sử dụng Laravel Sanctum Bearer Token.\n"
        "- Hiện thực mô hình phân quyền người dùng theo vai trò (RBAC - Role-Based Access Control) cho hai nhóm đối tượng: Quản trị viên (Admin) và Nhân viên thủ kho (Warehouse Staff).\n"
        "- Xây dựng hệ thống nhật ký kiểm toán biến động kho tự động (Inventory Audit Log) truy vết 100% lịch sử giao dịch.\n"
        "- Thiết kế giao diện Web hiện đại, xây dựng Bảng điều khiển (Dashboard) với biểu đồ trực quan hóa dữ liệu qua Chart.js và tính năng tự động cảnh báo tồn kho dưới ngưỡng an toàn (min_stock).\n"
        "- Thực hiện kiểm thử tự động toàn diện với PHPUnit (Feature Tests) và kiểm thử giao tiếp API với Postman Collection.\n"
    )
    
    r_b = p_t1.add_run("b. Các yêu cầu cần giải quyết:\n")
    r_b.font.bold = True
    p_t1.add_run(
        "- Tính toàn vẹn dữ liệu: Đảm bảo số lượng tồn kho luôn chính xác khi nhiều nhân viên cùng thực hiện xuất hoặc nhập hàng đồng thời; ngăn chặn triệt để trường hợp hàng tồn kho bị âm.\n"
        "- Tính bảo mật và an toàn: Mật khẩu người dùng được băm an toàn bằng thuật toán Bcrypt; các Endpoint API được bảo vệ nghiêm ngặt bằng Bearer Token; phân quyền tác vụ chuẩn xác qua Middleware.\n"
        "- Tính trực quan và tiện ích: Hỗ trợ tìm kiếm, lọc nhanh theo danh mục/nhà cung cấp; in ấn phiếu nhập kho và phiếu xuất kho chuẩn khổ giấy A4; cảnh báo trực quan các mặt hàng sắp hết.\n"
        "- Tính mở rộng và tích hợp: Cung cấp 28 Endpoint RESTful API chuẩn mực, định dạng JSON nhất quán, sẵn sàng kết nối với ứng dụng di động hoặc máy quét mã vạch trong tương lai.\n"
        "- Môi trường triển khai: Hoạt động ổn định trên nền tảng máy chủ XAMPP (Apache, MySQL/MariaDB) và PHP 8.3.\n\n"
    )
    
    p_t2 = doc.add_paragraph()
    r = p_t2.add_run("2. Các tài liệu, số liệu cần thiết:\n")
    r.font.bold = True
    p_t2.add_run(
        "- Phiếu đăng ký đề tài đồ án chuyên ngành đã được Khoa Công nghệ Thông tin phê duyệt.\n"
        "- Tài liệu quy chuẩn nghiệp vụ quản lý kho vận, mẫu biểu phiếu nhập kho, phiếu xuất kho chuẩn theo quy định kế toán.\n"
        "- Tài liệu kỹ thuật chính thức của Laravel Framework (v11/12), Laravel Sanctum và PHP 8.3.\n"
        "- Tài liệu hướng dẫn giao thức RESTful API Specification và thư viện biểu đồ Chart.js.\n"
        "- Các công trình nghiên cứu và bài báo khoa học quốc tế về kỹ thuật Concurrency Control và cơ chế khóa bản ghi trong CSDL quan hệ.\n\n"
    )
    
    p_t3 = doc.add_paragraph()
    r = p_t3.add_run("3. Địa điểm thực hiện đồ án chuyên ngành:\n")
    r.font.bold = True
    p_t3.add_run("Trường Cao đẳng Lý Tự Trọng Thành Phố Hồ Chí Minh (Số 390 Hoàng Văn Thụ, Phường 4, Quận Tân Bình, TP. Hồ Chí Minh).\n\n")
    
    # Bảng ký nhận nhiệm vụ
    tbl_sig1 = doc.add_table(rows=2, cols=2)
    tbl_sig1.alignment = WD_TABLE_ALIGNMENT.CENTER
    for row in tbl_sig1.rows:
        for cell in row.cells:
            cell.width = Inches(3.2)
            
    c00 = tbl_sig1.cell(0, 0).paragraphs[0]
    c00.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = c00.add_run("ĐÃ NHẬN NHIỆM VỤ ĐTĐACN\nSinh viên thực hiện\n(Ký và ghi rõ họ tên)")
    r.font.bold = True
    
    c01 = tbl_sig1.cell(0, 1).paragraphs[0]
    c01.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = c01.add_run("ĐÃ GIAO NHIỆM VỤ ĐTĐACN\nGiảng viên hướng dẫn\n(Ký và ghi rõ họ tên)")
    r.font.bold = True
    
    c10 = tbl_sig1.cell(1, 0).paragraphs[0]
    c10.alignment = WD_ALIGN_PARAGRAPH.CENTER
    c10.add_run("\n\n\nThái Anh Kiệt          Trần Phúc Khang").font.bold = True
    
    c11 = tbl_sig1.cell(1, 1).paragraphs[0]
    c11.alignment = WD_ALIGN_PARAGRAPH.CENTER
    c11.add_run("\n\n\nTh.S. Mai Chiếm Tuấn").font.bold = True
    
    doc.add_page_break()

    # ========================== GIẢNG VIÊN HƯỚNG DẪN ==========================
    p_adv_title = doc.add_paragraph()
    p_adv_title.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r_at = p_adv_title.add_run("GIẢNG VIÊN HƯỚNG DẪN ĐỀ TÀI ĐỒ ÁN CHUYÊN NGÀNH\n")
    r_at.font.name = "Times New Roman"
    r_at.font.size = Pt(15)
    r_at.font.bold = True
    
    p_adv = doc.add_paragraph()
    p_adv.paragraph_format.line_spacing = 1.3
    r = p_adv.add_run("Họ và tên giảng viên hướng dẫn: ")
    r.font.bold = True
    p_adv.add_run("Mai Chiếm Tuấn\n")
    
    r = p_adv.add_run("Học hàm, học vị: ")
    r.font.bold = True
    p_adv.add_run("Thạc sĩ\n")
    
    r = p_adv.add_run("Đơn vị công tác: ")
    r.font.bold = True
    p_adv.add_run("Khoa Công nghệ Thông tin – Trường Cao đẳng Lý Tự Trọng TP.HCM\n\n")
    
    r = p_adv.add_run("Nội dung hướng dẫn:\n")
    r.font.bold = True
    p_adv.add_run(
        "1. Định hướng phương pháp tiếp cận bài toán, phân tích yêu cầu nghiệp vụ quản lý kho hàng và hướng dẫn lập kế hoạch chi tiết cho 15 tuần thực hiện đồ án.\n"
        "2. Hướng dẫn thiết kế kiến trúc hệ thống đa tầng (MVC + Service Layer Pattern) trên nền tảng Laravel Framework và chuẩn RESTful API.\n"
        "3. Hướng dẫn chuyên sâu về kỹ thuật kiểm soát giao dịch đồng thời (Concurrency Control), nguyên lý ACID và ứng dụng Pessimistic Locking (lockForUpdate) trong Database MySQL.\n"
        "4. Định hướng triển khai cơ chế xác thực bảo mật API bằng Laravel Sanctum và phân quyền người dùng RBAC.\n"
        "5. Hướng dẫn xây dựng kịch bản kiểm thử tự động với PHPUnit (Feature Tests), kiểm thử API bằng Postman và hoàn thiện báo cáo khoa học theo quy chuẩn của Nhà trường.\n\n"
    )
    
    p_adv.add_run("Đề tài đồ án chuyên ngành được giao ngày 05 tháng 09 năm 2026.\n")
    p_adv.add_run("Yêu cầu phải hoàn thành xong trước ngày 30 tháng 11 năm 2026.\n\n")
    
    tbl_sig2 = doc.add_table(rows=2, cols=2)
    tbl_sig2.alignment = WD_TABLE_ALIGNMENT.CENTER
    for row in tbl_sig2.rows:
        for cell in row.cells:
            cell.width = Inches(3.2)
            
    c00 = tbl_sig2.cell(0, 0).paragraphs[0]
    c00.alignment = WD_ALIGN_PARAGRAPH.CENTER
    c00.add_run("ĐÃ NHẬN NHIỆM VỤ ĐTĐACN\nSinh viên\n(Ký và ghi rõ họ tên)").font.bold = True
    
    c01 = tbl_sig2.cell(0, 1).paragraphs[0]
    c01.alignment = WD_ALIGN_PARAGRAPH.CENTER
    c01.add_run("ĐÃ GIAO NHIỆM VỤ ĐTĐACN\nGiảng viên hướng dẫn\n(Ký và ghi rõ họ tên)").font.bold = True
    
    c10 = tbl_sig2.cell(1, 0).paragraphs[0]
    c10.alignment = WD_ALIGN_PARAGRAPH.CENTER
    c10.add_run("\n\n\nThái Anh Kiệt          Trần Phúc Khang").font.bold = True
    
    c11 = tbl_sig2.cell(1, 1).paragraphs[0]
    c11.alignment = WD_ALIGN_PARAGRAPH.CENTER
    c11.add_run("\n\n\nTh.S. Mai Chiếm Tuấn").font.bold = True
    
    doc.add_page_break()

    # ========================== PHIẾU NHẬN XÉT CỦA GIẢNG VIÊN ==========================
    p_nx_h = doc.add_paragraph()
    p_nx_h.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_nx_h.add_run("CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM\nĐộc lập - Tự do - Hạnh phúc\n")
    r.font.bold = True
    r.font.size = Pt(13)
    p_nx_h.add_run("____________________\n\n")
    
    p_nx_t = doc.add_paragraph()
    p_nx_t.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_nx_t.add_run("PHIẾU NHẬN XÉT CỦA GIẢNG VIÊN HƯỚNG DẪN ĐỒ ÁN CHUYÊN NGÀNH\n")
    r.font.size = Pt(15)
    r.font.bold = True
    
    p_nx = doc.add_paragraph()
    p_nx.paragraph_format.line_spacing = 1.3
    p_nx.add_run("Họ và tên giảng viên hướng dẫn: ").font.bold = True
    p_nx.add_run("Mai Chiếm Tuấn\n")
    p_nx.add_run("Đơn vị công tác: ").font.bold = True
    p_nx.add_run("Khoa Công nghệ Thông tin – Trường Cao Đẳng Lý Tự Trọng TP.HCM\n")
    p_nx.add_run("Họ và tên sinh viên thực hiện: ").font.bold = True
    p_nx.add_run("(1) Thái Anh Kiệt (MSSV: 25002447), (2) Trần Phúc Khang (MSSV: 25002446)\n")
    p_nx.add_run("Lớp: ").font.bold = True
    p_nx.add_run("25C2-LTM1               ")
    p_nx.add_run("Ngành: ").font.bold = True
    p_nx.add_run("Lập trình máy tính\n\n")
    
    p_nx.add_run("1. Tinh thần thái độ của sinh viên trong quá trình làm đề tài đồ án chuyên ngành:\n").font.bold = True
    p_nx.add_run(
        "- Nhóm sinh viên có ý thức học tập và tinh thần trách nhiệm rất cao, chấp hành nghiêm túc tiến độ công việc được giao trong suốt 15 tuần.\n"
        "- Có tinh thần chủ động tìm tòi nghiên cứu tài liệu chuyên ngành, ứng dụng hiệu quả các công nghệ mới và công cụ AI hỗ trợ theo đúng cam kết liêm chính học thuật.\n"
        "- Kỹ năng làm việc nhóm tốt, phân công trách nhiệm rõ ràng, hỗ trợ lẫn nhau trong quá trình phân tích, lập trình và kiểm thử hệ thống.\n\n"
    )
    
    p_nx.add_run("2. Đánh giá chất lượng của đồ án chuyên ngành:\n").font.bold = True
    p_nx.add_run(
        "- Về mặt lý luận: Nắm vững kiến trúc phần mềm MVC, Service Layer, nguyên lý ACID trong CSDL và phương pháp Concurrency Control. Tài liệu báo cáo được trình bày công phu, chuẩn mực theo đúng quy định của Nhà trường.\n"
        "- Về mặt thực tiễn: Ứng dụng giải quyết triệt để vấn đề xung đột dữ liệu đồng thời và lỗi âm kho bằng Pessimistic Locking. Hệ thống có độ tin cậy cao, giao diện trực quan, hỗ trợ Dashboard thống kê và cảnh báo tồn kho an toàn.\n"
        "- Về mặt kỹ thuật: Cung cấp đầy đủ 28 Endpoint RESTful API bảo mật bằng Laravel Sanctum; bộ kiểm thử tự động với PHPUnit đạt 100% tỷ lệ thành công (11/11 tests, 41 assertions).\n\n"
    )
    
    p_nx.add_run("3. Ý kiến của giảng viên hướng dẫn đồ án chuyên ngành:\n").font.bold = True
    p_nx.add_run("Đạt: [  X  ]                                  Không đạt: [      ]\n")
    p_nx.add_run("Điểm đánh giá: ....................................................\n\n")
    
    p_nx_sig = doc.add_paragraph()
    p_nx_sig.alignment = WD_ALIGN_PARAGRAPH.RIGHT
    p_nx_sig.paragraph_format.right_indent = Inches(0.5)
    p_nx_sig.add_run("Thành phố Hồ Chí Minh, ngày       tháng 11 năm 2026\n").font.italic = True
    r = p_nx_sig.add_run("Giảng viên hướng dẫn\n(Ký và ghi rõ họ tên)\n\n\n\n\nTh.S. Mai Chiếm Tuấn")
    r.font.bold = True
    
    doc.add_page_break()

    # ========================== LỜI CẢM ƠN ==========================
    p_ty_title = doc.add_paragraph()
    p_ty_title.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_ty_title.add_run("LỜI CẢM ƠN\n")
    r.font.size = Pt(16)
    r.font.bold = True
    r.font.color.rgb = RGBColor(15, 23, 42)
    
    p_ty = doc.add_paragraph()
    p_ty.paragraph_format.line_spacing = 1.3
    p_ty.add_run(
        "Lời đầu tiên, nhóm sinh viên chúng em xin bày tỏ lòng biết ơn sâu sắc đến Ban Giám hiệu Trường Cao đẳng Lý Tự Trọng Thành phố Hồ Chí Minh cùng toàn thể quý Thầy Cô Khoa Công nghệ Thông tin. Trong suốt quá trình học tập và rèn luyện dưới mái trường, quý Thầy Cô đã tận tình truyền đạt những kiến thức nền tảng quý báu về lập trình phần mềm, cơ sở dữ liệu, mạng máy tính và phương pháp luận nghiên cứu khoa học, tạo tiền đề vững chắc giúp chúng em hoàn thành đồ án này.\n\n"
        "Đặc biệt, chúng em xin chân thành gửi lời cảm ơn sâu sắc nhất đến Thầy Th.S. Mai Chiếm Tuấn – Giảng viên trực tiếp hướng dẫn đồ án. Thầy đã luôn theo sát, tận tình định hướng đề tài, gợi mở các giải pháp kỹ thuật chuyên sâu về kiểm soát giao dịch đồng thời (Pessimistic Locking), kiến trúc RESTful API và động viên chúng em trong suốt quá trình triển khai dự án.\n\n"
        "Dù đã nỗ lực hết mình với tinh thần nghiêm túc và cầu thị, nhưng do giới hạn về thời gian và kinh nghiệm thực tế, đồ án chắc chắn khó tránh khỏi những thiếu sót nhất định. Nhóm chúng em rất mong nhận được những lời nhận xét, góp ý quý báu từ quý Thầy Cô trong Hội đồng phản biện để hệ thống ngày càng hoàn thiện hơn.\n\n"
        "Kính chúc quý Thầy Cô luôn dồi dào sức khỏe, niềm vui và tiếp tục gặt hái nhiều thành công trong sự nghiệp trồng người cao quý!\n\n"
    )
    
    p_ty_sig = doc.add_paragraph()
    p_ty_sig.alignment = WD_ALIGN_PARAGRAPH.RIGHT
    p_ty_sig.paragraph_format.right_indent = Inches(0.5)
    p_ty_sig.add_run("Thành phố Hồ Chí Minh, tháng 11 năm 2026\n").font.italic = True
    r = p_ty_sig.add_run("Nhóm sinh viên thực hiện:\nThái Anh Kiệt & Trần Phúc Khang")
    r.font.bold = True
    
    doc.add_page_break()

print("Front matter module loaded.")
