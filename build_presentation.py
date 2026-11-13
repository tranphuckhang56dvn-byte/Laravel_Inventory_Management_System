# -*- coding: utf-8 -*-
"""
Tập lệnh xây dựng Slide Thuyết trình PowerPoint (16:9 Widescreen) chuẩn Đồ án Chuyên ngành
Khoa CNTT - Trường Cao đẳng Lý Tự Trọng TP.HCM
"""
import os
import sys
from pptx import Presentation
from pptx.util import Inches, Pt
from pptx.enum.text import PP_ALIGN
from pptx.dml.color import RGBColor
from pptx.enum.shapes import MSO_SHAPE

from slide_helpers import (
    PPTX_PATH, PDF_PATH, FONT_MAIN,
    NAVY_DARK, NAVY_PRIMARY, BLUE_ACCENT, BLUE_LIGHT, CYAN_ACCENT,
    GREEN_ACCENT, GREEN_LIGHT, AMBER_ACCENT, RED_ACCENT, RED_LIGHT,
    BG_LIGHT, CARD_BG, BORDER_COLOR, TEXT_DARK, TEXT_MUTED, TEXT_WHITE,
    set_slide_background, add_header, add_card, add_metric_badge, set_speaker_notes
)

def create_deck():
    prs = Presentation()
    prs.slide_width = Inches(13.333)
    prs.slide_height = Inches(7.5)
    blank_layout = prs.slide_layouts[6]
    
    # ==========================================
    # SLIDE 1: TRANG BÌA (DARK THEME)
    # ==========================================
    s1 = prs.slides.add_slide(blank_layout)
    set_slide_background(s1, NAVY_DARK)
    
    # Institution Pill
    pill1 = s1.shapes.add_shape(MSO_SHAPE.ROUNDED_RECTANGLE, Inches(1.0), Inches(0.8), Inches(6.5), Inches(0.4))
    pill1.fill.solid()
    pill1.fill.fore_color.rgb = RGBColor(30, 41, 59)
    pill1.line.fill.background()
    p = pill1.text_frame.paragraphs[0]
    p.text = "TRƯỜNG CAO ĐẲNG LÝ TỰ TRỌNG TP.HCM • KHOA CÔNG NGHỆ THÔNG TIN"
    p.alignment = PP_ALIGN.CENTER
    p.font.name = FONT_MAIN
    p.font.size = Pt(10)
    p.font.bold = True
    p.font.color.rgb = CYAN_ACCENT
    
    # Title
    t_box = s1.shapes.add_textbox(Inches(1.0), Inches(1.4), Inches(11.333), Inches(2.2))
    tf = t_box.text_frame
    tf.word_wrap = True
    p0 = tf.paragraphs[0]
    p0.text = "BÁO CÁO BẢO VỆ ĐỒ ÁN CHUYÊN NGÀNH"
    p0.font.name = FONT_MAIN
    p0.font.size = Pt(16)
    p0.font.bold = True
    p0.font.color.rgb = RGBColor(148, 163, 184)
    
    p1 = tf.add_paragraph()
    p1.text = "XÂY DỰNG HỆ THỐNG QUẢN LÝ NHẬP - XUẤT - TỒN KHO\nỨNG DỤNG LARAVEL FRAMEWORK & RESTFUL API"
    p1.font.name = FONT_MAIN
    p1.font.size = Pt(28)
    p1.font.bold = True
    p1.font.color.rgb = TEXT_WHITE
    p1.space_before = Pt(8)
    
    p2 = tf.add_paragraph()
    p2.text = "Giải pháp WMS toàn diện, kiểm soát tương tranh & chống âm kho với Pessimistic Locking"
    p2.font.name = FONT_MAIN
    p2.font.size = Pt(13)
    p2.font.color.rgb = CYAN_ACCENT
    p2.space_before = Pt(8)
    
    # 3 Meta cards
    card_w = Inches(3.55)
    card_h = Inches(2.2)
    card_y = Inches(4.5)
    
    # Card 1: Sinh viên thực hiện
    c1 = add_card(s1, Inches(1.0), card_y, card_w, card_h, bg_color=RGBColor(30, 41, 59), border_color=RGBColor(51, 65, 85))
    tf1 = c1.text_frame
    tf1.word_wrap = True
    tf1.margin_left = tf1.margin_right = tf1.margin_top = Inches(0.2)
    p = tf1.paragraphs[0]
    p.text = "👤 SINH VIÊN THỰC HIỆN"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = CYAN_ACCENT
    
    items = [
        "1. Thái Anh Kiệt  –  MSSV: 25002447",
        "2. Trần Phúc Khang  –  MSSV: 25002446",
        "Lớp: 25C2-LTM1  •  Khóa: 2025",
        "Chuyên ngành: Lập trình máy tính"
    ]
    for it in items:
        p = tf1.add_paragraph()
        p.text = it
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.color.rgb = RGBColor(226, 232, 240)
        p.space_before = Pt(4)
        
    # Card 2: Giảng viên hướng dẫn
    c2 = add_card(s1, Inches(4.85), card_y, card_w, card_h, bg_color=RGBColor(30, 41, 59), border_color=RGBColor(51, 65, 85))
    tf2 = c2.text_frame
    tf2.word_wrap = True
    tf2.margin_left = tf2.margin_right = tf2.margin_top = Inches(0.2)
    p = tf2.paragraphs[0]
    p.text = "🎓 GIẢNG VIÊN HƯỚNG DẪN"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = CYAN_ACCENT
    
    items_gv = [
        "Th.S. Mai Chiếm Tuấn",
        "Khoa Công nghệ Thông tin",
        "Trường Cao đẳng Lý Tự Trọng TP.HCM",
        "Bộ môn: Kỹ thuật phần mềm"
    ]
    for it in items_gv:
        p = tf2.add_paragraph()
        p.text = it
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.color.rgb = RGBColor(226, 232, 240)
        p.space_before = Pt(4)
        
    # Card 3: Dự án & Repository
    c3 = add_card(s1, Inches(8.7), card_y, card_w, card_h, bg_color=RGBColor(30, 41, 59), border_color=RGBColor(51, 65, 85))
    tf3 = c3.text_frame
    tf3.word_wrap = True
    tf3.margin_left = tf3.margin_right = tf3.margin_top = Inches(0.2)
    p = tf3.paragraphs[0]
    p.text = "🚀 THÔNG TIN DỰ ÁN"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = CYAN_ACCENT
    
    items_proj = [
        "Nền tảng: Laravel 11 + MySQL (XAMPP)",
        "Kiến trúc: Service Layer + Sanctum API",
        "Thời gian bảo vệ: Tháng 11/2026",
        "GitHub: tranphuckhang56dvn-byte"
    ]
    for it in items_proj:
        p = tf3.add_paragraph()
        p.text = it
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.color.rgb = RGBColor(226, 232, 240)
        p.space_before = Pt(4)
        
    set_speaker_notes(
        s1,
        "Kính thưa quý Thầy Cô trong Hội đồng chấm Đồ án Chuyên ngành Khoa Công nghệ Thông tin, "
        "em là [Tên], đại diện nhóm sinh viên thực hiện gồm em và bạn [Tên], thuộc lớp 25C2-LTM1, khóa 2025. "
        "Dưới sự hướng dẫn tận tình của Thầy Th.S. Mai Chiếm Tuấn, hôm nay nhóm chúng em xin phép được báo cáo "
        "bảo vệ đề tài: 'Xây dựng hệ thống quản lý nhập - xuất - tồn kho ứng dụng Laravel Framework & RESTful API'."
    )
    
    # ==========================================
    # SLIDE 2: NỘI DUNG BÁO CÁO (AGENDA)
    # ==========================================
    s2 = prs.slides.add_slide(blank_layout)
    set_slide_background(s2, BG_LIGHT)
    add_header(s2, "MỤC LỤC BÁO CÁO", "Cấu trúc nội dung thuyết trình đồ án", "5 phần chính thể hiện toàn bộ quá trình nghiên cứu và hiện thực đề tài")
    
    agenda_items = [
        ("01", "Đặt vấn đề & Mục tiêu đề tài", "Khảo sát thực trạng quản lý kho tại doanh nghiệp SMEs, lỗ hổng âm kho & mục tiêu đề tài."),
        ("02", "Cơ sở lý thuyết & Công nghệ", "Laravel 11, Service Layer Pattern, ACID & giải pháp kiểm soát tương tranh Concurrency Control."),
        ("03", "Phân tích & Thiết kế hệ thống", "Sơ đồ ca sử dụng (Use Case), Biểu đồ tuần tự (Sequence Diagram) & Thiết kế CSDL quan hệ (ERD)."),
        ("04", "Hiện thực & Điểm sáng kỹ thuật", "Giải pháp khóa bi quan chống âm kho (Pessimistic Locking), 28 RESTful APIs & Dashboard Chart.js."),
        ("05", "Kiểm thử tự động & Kết luận", "Bộ kiểm thử tự động Automated Tests (PHPUnit 100% Pass), Đánh giá phiếu đề tài & Hướng phát triển.")
    ]
    
    ag_w = Inches(11.733)
    ag_h = Inches(0.95)
    ag_start_y = Inches(1.8)
    
    for idx, (num, title, desc) in enumerate(agenda_items):
        y = ag_start_y + idx * Inches(1.05)
        card = add_card(s2, Inches(0.8), y, ag_w, ag_h, bg_color=CARD_BG, border_color=BORDER_COLOR)
        
        # Number badge inside card
        num_box = s2.shapes.add_shape(MSO_SHAPE.ROUNDED_RECTANGLE, Inches(1.0), y + Inches(0.18), Inches(0.85), Inches(0.6))
        num_box.fill.solid()
        num_box.fill.fore_color.rgb = BLUE_LIGHT
        num_box.line.fill.background()
        p = num_box.text_frame.paragraphs[0]
        p.text = num
        p.alignment = PP_ALIGN.CENTER
        p.font.name = FONT_MAIN
        p.font.size = Pt(14)
        p.font.bold = True
        p.font.color.rgb = BLUE_ACCENT
        
        # Text inside card
        tb = s2.shapes.add_textbox(Inches(2.05), y + Inches(0.12), Inches(10.2), Inches(0.7))
        tf = tb.text_frame
        tf.word_wrap = True
        p_t = tf.paragraphs[0]
        p_t.text = title
        p_t.font.name = FONT_MAIN
        p_t.font.size = Pt(13)
        p_t.font.bold = True
        p_t.font.color.rgb = NAVY_DARK
        
        p_d = tf.add_paragraph()
        p_d.text = desc
        p_d.font.name = FONT_MAIN
        p_d.font.size = Pt(10.5)
        p_d.font.color.rgb = TEXT_MUTED
        
    set_speaker_notes(
        s2,
        "Nội dung bài báo cáo hôm nay gồm 5 phần trọng tâm: "
        "Trước hết là lý do chọn đề tài và bài toán thực tế; "
        "kế đến là nền tảng công nghệ và lý thuyết Concurrency Control; "
        "thứ ba là mô hình hóa thiết kế UML và CSDL; "
        "thứ tư là phần hiện thực và điểm sáng kỹ thuật giải quyết triệt để lỗi âm kho; "
        "và cuối cùng là kết quả kiểm thử tự động toàn diện cùng định hướng phát triển."
    )
    
    # ==========================================
    # SLIDE 3: ĐẶT VẤN ĐỀ & THỰC TRẠNG QUẢN LÝ KHO
    # ==========================================
    s3 = prs.slides.add_slide(blank_layout)
    set_slide_background(s3, BG_LIGHT)
    add_header(s3, "BỐI CẢNH & THỰC TRẠNG", "Thực trạng quản lý kho hàng tại doanh nghiệp SMEs", "Những bất cập thực tiễn dẫn đến sai lệch số liệu và rủi ro kinh doanh")
    
    col_w = Inches(3.64)
    col_h = Inches(3.8)
    col_y = Inches(1.8)
    
    # Card 1: Thủ công & Excel
    c1 = add_card(s3, Inches(0.8), col_y, col_w, col_h, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf1 = c1.text_frame
    tf1.word_wrap = True
    tf1.margin_left = tf1.margin_right = tf1.margin_top = Inches(0.25)
    p = tf1.paragraphs[0]
    p.text = "📑 QUẢN LÝ SỔ SÁCH & EXCEL"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = AMBER_ACCENT
    
    bullets1 = [
        "Dữ liệu phân mảnh giữa các phòng ban (Kho, Kế toán, Bán hàng).",
        "Dễ mất mát do lỗi phần cứng hoặc vô tình ghi đè tệp tin.",
        "Độ trễ thông tin lớn: Tốn nhiều giờ đối soát số lượng tồn thực tế.",
        "Thiếu lịch sử biến động chi tiết (Audit Trail) khi xảy ra thất thoát."
    ]
    for b in bullets1:
        p = tf1.add_paragraph()
        p.text = "• " + b
        p.font.name = FONT_MAIN
        p.font.size = Pt(11)
        p.font.color.rgb = TEXT_DARK
        p.space_before = Pt(8)
        
    # Card 2: Lỗ hổng Race Condition & Âm kho
    c2 = add_card(s3, Inches(4.84), col_y, col_w, col_h, bg_color=CARD_BG, border_color=RGBColor(254, 202, 202))
    tf2 = c2.text_frame
    tf2.word_wrap = True
    tf2.margin_left = tf2.margin_right = tf2.margin_top = Inches(0.25)
    p = tf2.paragraphs[0]
    p.text = "⚠️ XUNG ĐỘT DỮ LIỆU & ÂM KHO"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = RED_ACCENT
    
    bullets2 = [
        "Nhiều kênh bán hàng cùng gửi yêu cầu xuất kho tại cùng một thời điểm.",
        "Hệ thống thiếu cơ chế khóa dữ liệu (Locking) -> Race Condition.",
        "Hiện tượng Bán vượt tồn (Overselling): Hàng trên kệ chỉ còn 5 nhưng cả 2 luồng đều duyệt xuất 5 cái.",
        "Dẫn đến số lượng tồn kho bị ÂM, đứt gãy uy tín với khách hàng."
    ]
    for b in bullets2:
        p = tf2.add_paragraph()
        p.text = "• " + b
        p.font.name = FONT_MAIN
        p.font.size = Pt(11)
        p.font.color.rgb = TEXT_DARK
        p.space_before = Pt(8)
        
    # Card 3: Phần mềm ngoại đắt đỏ
    c3 = add_card(s3, Inches(8.88), col_y, col_w, col_h, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf3 = c3.text_frame
    tf3.word_wrap = True
    tf3.margin_left = tf3.margin_right = tf3.margin_top = Inches(0.25)
    p = tf3.paragraphs[0]
    p.text = "💰 GIẢI PHÁP NGOẠI ĐẮT ĐỎ"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = BLUE_ACCENT
    
    bullets3 = [
        "Các hệ thống ERP/WMS như SAP, Oracle có phí bản quyền hàng trăm triệu.",
        "Quy trình vận hành quá phức tạp, đòi hỏi đội ngũ IT chuyên trách.",
        "Các phần mềm SaaS trong nước tốn phí thuê bao hàng tháng và phụ thuộc dữ liệu vào bên thứ 3.",
        "Khó tùy biến sâu theo đặc thù chuỗi cung ứng của từng đơn vị."
    ]
    for b in bullets3:
        p = tf3.add_paragraph()
        p.text = "• " + b
        p.font.name = FONT_MAIN
        p.font.size = Pt(11)
        p.font.color.rgb = TEXT_DARK
        p.space_before = Pt(8)
        
    # Bottom callout
    bot_box = add_card(s3, Inches(0.8), Inches(5.8), Inches(11.733), Inches(0.9), bg_color=RGBColor(238, 242, 255), border_color=BLUE_ACCENT)
    tf_b = bot_box.text_frame
    tf_b.word_wrap = True
    tf_b.margin_left = tf_b.margin_right = tf_b.margin_top = Inches(0.15)
    p_b0 = tf_b.paragraphs[0]
    p_b0.text = "🎯 YÊU CẦU ĐẶT RA CHO ĐỀ TÀI:"
    p_b0.font.name = FONT_MAIN
    p_b0.font.size = Pt(11.5)
    p_b0.font.bold = True
    p_b0.font.color.rgb = BLUE_ACCENT
    p_b1 = tf_b.add_paragraph()
    p_b1.text = "Xây dựng một hệ thống Quản lý kho (WMS) chuyên biệt, độc lập, mã nguồn mở, tối ưu chi phí, triển khai dễ dàng trên XAMPP và giải quyết triệt để bài toán Race Condition để ngăn chặn 100% tình trạng âm kho."
    p_b1.font.name = FONT_MAIN
    p_b1.font.size = Pt(11)
    p_b1.font.color.rgb = NAVY_DARK
    
    set_speaker_notes(
        s3,
        "Tại sao các doanh nghiệp vừa và nhỏ thường xuyên gặp sự cố kho hàng? "
        "Khảo sát cho thấy phần lớn dùng Excel hoặc ghi sổ. Khi có đơn hàng dồn dập, các nhân viên cùng thao tác xuất một mặt hàng. "
        "Nếu hệ thống không có cơ chế khóa bản ghi tại CSDL, cả 2 luồng đều nhìn thấy hàng còn đủ và cùng duyệt xuất, "
        "khiến tồn kho bị âm - hiện tượng gọi là Race Condition. "
        "Trong khi đó, việc mua phần mềm ngoại như SAP là quá đắt đỏ và cồng kềnh đối với doanh nghiệp vừa và nhỏ."
    )
    
    # ==========================================
    # SLIDE 4: MỤC TIÊU & PHẠM VI NGHIÊN CỨU
    # ==========================================
    s4 = prs.slides.add_slide(blank_layout)
    set_slide_background(s4, BG_LIGHT)
    add_header(s4, "MỤC TIÊU & PHẠM VI", "Mục tiêu nghiên cứu và Phạm vi đề tài", "Định hình rõ ràng các kết quả đầu ra về mặt lý thuyết và ứng dụng thực tiễn")
    
    col_w2 = Inches(5.65)
    col_h2 = Inches(4.9)
    col_y2 = Inches(1.8)
    
    # Col 1: Mục tiêu nghiên cứu
    c_m1 = add_card(s4, Inches(0.8), col_y2, col_w2, col_h2, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf_m1 = c_m1.text_frame
    tf_m1.word_wrap = True
    tf_m1.margin_left = tf_m1.margin_right = tf_m1.margin_top = Inches(0.25)
    p = tf_m1.paragraphs[0]
    p.text = "🎯 MỤC TIÊU NGHIÊN CỨU & KỸ THUẬT"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = BLUE_ACCENT
    
    m_items = [
        ("Nghiên cứu kiến trúc Service Layer", "Tách biệt hoàn toàn tầng logic nghiệp vụ khỏi Controller, giúp mã nguồn sạch (Clean Architecture) và tái sử dụng cho cả Web và API."),
        ("Làm chủ kiểm soát tương tranh Concurrency", "Nghiên cứu so sánh Khóa lạc quan (Optimistic) và Khóa bi quan (Pessimistic Locking `SELECT ... FOR UPDATE`), chặn âm kho 100%."),
        ("Chuẩn hóa bộ 28 RESTful API Endpoints", "Xây dựng các dịch vụ Web API theo chuẩn REST, tích hợp xác thực Stateless Token với Laravel Sanctum."),
        ("Trực quan hóa dữ liệu Dashboard", "Tích hợp thư viện Chart.js để phân tích xu hướng nhập/xuất và cảnh báo tự động sản phẩm chạm ngưỡng tồn tối thiểu (min_stock)."),
        ("Đảm bảo độ tin cậy với PHPUnit", "Viết bộ kiểm thử tự động toàn diện đạt 100% tỷ lệ pass cho tất cả các ca kiểm thử chức năng quan trọng.")
    ]
    for title, desc in m_items:
        p = tf_m1.add_paragraph()
        p.text = "✔ " + title + ": "
        p.font.name = FONT_MAIN
        p.font.size = Pt(11)
        p.font.bold = True
        p.font.color.rgb = NAVY_DARK
        p.space_before = Pt(6)
        
        run = p.add_run()
        run.text = desc
        run.font.bold = False
        run.font.color.rgb = TEXT_DARK
        
    # Col 2: Phạm vi nghiên cứu & Môi trường
    c_m2 = add_card(s4, Inches(6.88), col_y2, col_w2, col_h2, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf_m2 = c_m2.text_frame
    tf_m2.word_wrap = True
    tf_m2.margin_left = tf_m2.margin_right = tf_m2.margin_top = Inches(0.25)
    p = tf_m2.paragraphs[0]
    p.text = "📌 PHẠM VI ỨNG DỤNG & MÔI TRƯỜNG"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = GREEN_ACCENT
    
    p_items = [
        ("Đối tượng áp dụng", "Doanh nghiệp thương mại, bán lẻ và phân phối hàng hóa có nhu cầu chuẩn hóa kho vận với chi phí triển khai tối ưu."),
        ("Phạm vi nghiệp vụ", "Quản lý Danh mục, Nhà cung cấp, Sản phẩm (SKU, Barcode), Phiếu nhập kho, Phiếu xuất kho an toàn, Phiếu kiểm kê và Thẻ kho (Audit Log)."),
        ("Mô hình kho", "Tập trung tối ưu hóa nghiệp vụ cho mô hình Đơn kho (Single Warehouse) với độ chính xác số dư tuyệt đối."),
        ("Môi trường máy chủ", "Môi trường XAMPP (Apache 2.4, PHP 8.3, MySQL 8.0 InnoDB) chạy trên hệ điều hành Windows 10/11."),
        ("Người dùng hệ thống", "Phân quyền 2 vai trò chuẩn: Quản trị viên (Admin) và Nhân viên thủ kho (Warehouse Staff).")
    ]
    for title, desc in p_items:
        p = tf_m2.add_paragraph()
        p.text = "• " + title + ": "
        p.font.name = FONT_MAIN
        p.font.size = Pt(11)
        p.font.bold = True
        p.font.color.rgb = NAVY_DARK
        p.space_before = Pt(8)
        
        run = p.add_run()
        run.text = desc
        run.font.bold = False
        run.font.color.rgb = TEXT_DARK

    set_speaker_notes(
        s4,
        "Mục tiêu cốt lõi của đề tài là xây dựng một giải pháp phần mềm hoàn chỉnh, "
        "kết hợp chặt chẽ giữa tính lý luận khoa học (về Transaction, Concurrency Control) "
        "và tính thực tiễn cao (chạy mượt mà trên môi trường máy chủ XAMPP phổ biến). "
        "Hệ thống hướng tới các doanh nghiệp SMEs với quy trình nghiệp vụ rõ ràng, minh bạch."
    )
    
    # ==========================================
    # SLIDE 5: KIẾN TRÚC TỔNG THỂ & TECH STACK
    # ==========================================
    s5 = prs.slides.add_slide(blank_layout)
    set_slide_background(s5, BG_LIGHT)
    add_header(s5, "CÔNG NGHỆ ỨNG DỤNG", "Kiến trúc tổng thể & Hệ sinh thái công nghệ (Tech Stack)", "Lựa chọn các công nghệ hiện đại, ổn định và tối ưu cho hệ thống doanh nghiệp")
    
    card_w4 = Inches(2.7)
    card_h4 = Inches(3.6)
    card_y4 = Inches(1.8)
    
    stacks = [
        ("BACKEND", "Laravel 11 & PHP 8.3", BLUE_ACCENT, [
            "Framework PHP hiện đại nhất",
            "Mô hình Service Layer Pattern",
            "Eloquent ORM mạnh mẽ",
            "Quản lý Migration & Seeder",
            "Chuẩn lập trình PSR-12"
        ]),
        ("DATABASE", "MySQL 8.0 InnoDB", GREEN_ACCENT, [
            "Hỗ trợ trọn vẹn chuẩn ACID",
            "Khóa cấp dòng (Row-level Lock)",
            "Hỗ trợ câu lệnh SELECT FOR UPDATE",
            "Ràng buộc toàn vẹn Foreign Keys",
            "Bảng mã utf8mb4_unicode_ci"
        ]),
        ("FRONTEND", "Bootstrap 5 & Chart.js", AMBER_ACCENT, [
            "Giao diện chuẩn Responsive",
            "HTML5 Canvas Chart.js",
            "Biểu đồ cột & Doughnut trực quan",
            "Hệ thống biểu tượng Feather Icons",
            "Trải nghiệm người dùng mượt mà"
        ]),
        ("SECURITY & API", "Sanctum & RBAC", RED_ACCENT, [
            "Xác thực Stateless Bearer Token",
            "Bảo mật Token bằng mã băm SHA-256",
            "Phân quyền Middleware RBAC",
            "Bộ 28 RESTful API Endpoints",
            "Chuẩn hóa HTTP Status Code"
        ])
    ]
    
    for idx, (tag, title, color, points) in enumerate(stacks):
        x = Inches(0.8) + idx * Inches(2.98)
        card = add_card(s5, x, card_y4, card_w4, card_h4, bg_color=CARD_BG, border_color=BORDER_COLOR)
        tf = card.text_frame
        tf.word_wrap = True
        tf.margin_left = tf.margin_right = tf.margin_top = Inches(0.2)
        
        p = tf.paragraphs[0]
        p.text = tag
        p.font.name = FONT_MAIN
        p.font.size = Pt(10)
        p.font.bold = True
        p.font.color.rgb = color
        
        p_t = tf.add_paragraph()
        p_t.text = title
        p_t.font.name = FONT_MAIN
        p_t.font.size = Pt(12.5)
        p_t.font.bold = True
        p_t.font.color.rgb = NAVY_DARK
        p_t.space_before = Pt(2)
        
        for pt in points:
            p_p = tf.add_paragraph()
            p_p.text = "• " + pt
            p_p.font.name = FONT_MAIN
            p_p.font.size = Pt(10)
            p_p.font.color.rgb = TEXT_DARK
            p_p.space_before = Pt(6)
            
    # 4 Metric badges below
    add_metric_badge(s5, Inches(0.8), Inches(5.65), Inches(2.7), Inches(1.2), "PHP 8.3", "Laravel 11.x Core", "Tối ưu hóa hiệu năng", BLUE_ACCENT)
    add_metric_badge(s5, Inches(3.78), Inches(5.65), Inches(2.7), Inches(1.2), "ACID", "MySQL InnoDB", "Khóa cấp độ hàng", GREEN_ACCENT)
    add_metric_badge(s5, Inches(6.76), Inches(5.65), Inches(2.7), Inches(1.2), "28 APIs", "RESTful Standards", "Sanctum Token Auth", AMBER_ACCENT)
    add_metric_badge(s5, Inches(9.74), Inches(5.65), Inches(2.7), Inches(1.2), "100%", "Zero Negative Stock", "Tuyệt đối không âm kho", RED_ACCENT)

    set_speaker_notes(
        s5,
        "Về hệ sinh thái công nghệ, nhóm lựa chọn PHP 8.3 và Laravel 11 - phiên bản ổn định mới nhất hiện nay. "
        "Điểm then chốt là cơ sở dữ liệu MySQL sử dụng động cơ InnoDB. "
        "Khác với MyISAM cũ chỉ khóa toàn bảng, InnoDB hỗ trợ khóa cấp độ hàng (Row-level Locking) và giao dịch ACID, "
        "cho phép hệ thống xử lý nhiều giao dịch song song mà không bị nghẽn cổ chai."
    )
    
    # ==========================================
    # SLIDE 6: KIẾN TRÚC SERVICE LAYER PATTERN
    # ==========================================
    s6 = prs.slides.add_slide(blank_layout)
    set_slide_background(s6, BG_LIGHT)
    add_header(s6, "THIẾT KẾ KIẾN TRÚC", "Mô hình kiến trúc Service Layer Pattern", "Tách biệt rõ ràng giữa tầng giao diện, điều phối và xử lý nghiệp vụ kho chuyên sâu")
    
    card_sw = Inches(3.64)
    card_sh = Inches(4.8)
    card_sy = Inches(1.8)
    
    # Layer 1: HTTP Controller
    c_l1 = add_card(s6, Inches(0.8), card_sy, card_sw, card_sh, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf1 = c_l1.text_frame
    tf1.word_wrap = True
    tf1.margin_left = tf1.margin_right = tf1.margin_top = Inches(0.25)
    p = tf1.paragraphs[0]
    p.text = "1. CONTROLLER LAYER"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = BLUE_ACCENT
    
    p_sub = tf1.add_paragraph()
    p_sub.text = "(Tầng Tiếp nhận & Điều phối)"
    p_sub.font.size = Pt(10)
    p_sub.font.italic = True
    p_sub.font.color.rgb = TEXT_MUTED
    
    points_l1 = [
        "Tiếp nhận HTTP Request từ Web Browser hoặc RESTful API client.",
        "Xác thực dữ liệu đầu vào thông qua Laravel FormRequest (ngăn chặn SQL Injection, XSS).",
        "Tuyệt đối KHÔNG chứa câu lệnh tính toán hoặc cập nhật cơ sở dữ liệu trực tiếp.",
        "Ủy quyền toàn bộ việc xử lý cho tầng Service Layer.",
        "Định dạng kết quả trả về: View (Blade) hoặc JSON Response chuẩn."
    ]
    for pt in points_l1:
        p = tf1.add_paragraph()
        p.text = "• " + pt
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.color.rgb = TEXT_DARK
        p.space_before = Pt(8)
        
    # Layer 2: Service Layer (Core)
    c_l2 = add_card(s6, Inches(4.84), card_sy, card_sw, card_sh, bg_color=RGBColor(238, 242, 255), border_color=BLUE_ACCENT)
    tf2 = c_l2.text_frame
    tf2.word_wrap = True
    tf2.margin_left = tf2.margin_right = tf2.margin_top = Inches(0.25)
    p = tf2.paragraphs[0]
    p.text = "2. SERVICE LAYER (CORE)"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = NAVY_PRIMARY
    
    p_sub = tf2.add_paragraph()
    p_sub.text = "(Tầng Logic Nghiệp vụ Độc lập)"
    p_sub.font.size = Pt(10)
    p_sub.font.italic = True
    p_sub.font.color.rgb = BLUE_ACCENT
    
    points_l2 = [
        "Lớp trung tâm: App\\Services\\InventoryService.",
        "Đóng gói 100% nghiệp vụ kho: Xuất, Nhập, Kiểm kê điều chỉnh số dư.",
        "Quản lý vòng đời giao dịch: Mở DB::transaction() và Rollback khi lỗi.",
        "Thực thi cơ chế Khóa bi quan (lockForUpdate) độc quyền đọc-ghi.",
        "Kiểm tra số dư khả dụng, tính toán biến động và tự động sinh Thẻ kho (StockMovement)."
    ]
    for pt in points_l2:
        p = tf2.add_paragraph()
        p.text = "✔ " + pt
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.color.rgb = NAVY_DARK
        p.space_before = Pt(8)
        
    # Layer 3: Model & Database
    c_l3 = add_card(s6, Inches(8.88), card_sy, card_sw, card_sh, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf3 = c_l3.text_frame
    tf3.word_wrap = True
    tf3.margin_left = tf3.margin_right = tf3.margin_top = Inches(0.25)
    p = tf3.paragraphs[0]
    p.text = "3. MODEL & DATABASE LAYER"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = GREEN_ACCENT
    
    p_sub = tf3.add_paragraph()
    p_sub.text = "(Tầng Truy cập Dữ liệu & Lưu trữ)"
    p_sub.font.size = Pt(10)
    p_sub.font.italic = True
    p_sub.font.color.rgb = TEXT_MUTED
    
    points_l3 = [
        "Eloquent ORM Models: Product, Category, ImportOrder, ExportOrder, StockMovement,...",
        "Định nghĩa các mối quan hệ (Relationships): hasMany, belongsTo.",
        "Bảo vệ gán giá trị hàng loạt với thuộc tính $fillable.",
        "Tương tác với CSDL MySQL qua câu lệnh SQL được sinh tự động an toàn.",
        "Động cơ InnoDB đảm bảo tính nguyên tử (Atomicity) và cô lập (Isolation)."
    ]
    for pt in points_l3:
        p = tf3.add_paragraph()
        p.text = "• " + pt
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.color.rgb = TEXT_DARK
        p.space_before = Pt(8)

    set_speaker_notes(
        s6,
        "Tại sao đồ án không viết code trực tiếp trong Controller (Fat Controller)? "
        "Nếu viết trong Controller, khi cần làm cả giao diện Web và Mobile RESTful API, "
        "chúng ta sẽ bị trùng lặp mã nguồn và rất dễ xảy ra sai sót. "
        "Bằng cách đưa toàn bộ logic xử lý kho vào tầng Service Layer (InventoryService), "
        "cả Controller Web lẫn API Controller đều gọi chung một hàm duy nhất. "
        "Điều này giúp hệ thống tuân thủ nguyên tắc DRY (Don't Repeat Yourself) và Single Responsibility Principle."
    )
    
    # ==========================================
    # SLIDE 7: ĐIỂM SÁNG KỸ THUẬT: PESSIMISTIC LOCKING
    # ==========================================
    s7 = prs.slides.add_slide(blank_layout)
    set_slide_background(s7, BG_LIGHT)
    add_header(s7, "ĐIỂM SÁNG KỸ THUẬT", "Cơ chế Khóa bi quan (Pessimistic Locking) & Chống âm kho", "Giải pháp triệt tiêu hiện tượng Race Condition trong môi trường nhiều người dùng đồng thời")
    
    # Left box: Problem & Solution
    box_w1 = Inches(5.65)
    box_h = Inches(4.9)
    box_y = Inches(1.8)
    
    c_p1 = add_card(s7, Inches(0.8), box_y, box_w1, box_h, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf_p1 = c_p1.text_frame
    tf_p1.word_wrap = True
    tf_p1.margin_left = tf_p1.margin_right = tf_p1.margin_top = Inches(0.25)
    
    p = tf_p1.paragraphs[0]
    p.text = "⚡ KỊCH BẢN XUNG ĐỘT (RACE CONDITION)"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12.5)
    p.font.bold = True
    p.font.color.rgb = RED_ACCENT
    
    p_sc = tf_p1.add_paragraph()
    p_sc.text = "Giả sử: Sản phẩm A chỉ còn Tồn kho = 10 cái.\n" \
                "• Thời điểm T1: Thủ kho 1 gửi yêu cầu xuất 7 cái.\n" \
                "• Thời điểm T2 (đồng thời): Thủ kho 2 gửi yêu cầu xuất 5 cái.\n" \
                "❌ NẾU KHÔNG CÓ KHÓA:\n" \
                "Cả hai cùng đọc tồn = 10 -> Cả hai đều thỏa điều kiện -> Cùng trừ tồn -> Tồn kho thực tế thành: 10 - 7 - 5 = -2 (ÂM KHO NGHIÊM TRỌNG!)."
    p_sc.font.name = FONT_MAIN
    p_sc.font.size = Pt(10)
    p_sc.font.color.rgb = TEXT_DARK
    p_sc.space_before = Pt(4)
    
    p_sol = tf_p1.add_paragraph()
    p_sol.text = "🛡️ GIẢI PHÁP PESSIMISTIC LOCKING (`SELECT ... FOR UPDATE`)"
    p_sol.font.name = FONT_MAIN
    p_sol.font.size = Pt(12)
    p_sol.font.bold = True
    p_sol.font.color.rgb = GREEN_ACCENT
    p_sol.space_before = Pt(12)
    
    p_sol_desc = tf_p1.add_paragraph()
    p_sol_desc.text = "1. Giao dịch 1 gọi lockForUpdate(): MySQL khóa độc quyền hàng dữ liệu của Sản phẩm A.\n" \
                      "2. Giao dịch 2 cùng gọi lockForUpdate(): MySQL ép Giao dịch 2 phải CHỜ (BLOCKED QUEUE) cho đến khi Giao dịch 1 hoàn tất.\n" \
                      "3. Giao dịch 1 trừ 7 -> Tồn còn 3 -> Commit và giải phóng khóa.\n" \
                      "4. Giao dịch 2 được mở khóa -> Đọc tồn thực tế là 3 -> Kiểm tra thấy 3 < 5 -> Từ chối xuất và Rollback an toàn 100%!"
    p_sol_desc.font.name = FONT_MAIN
    p_sol_desc.font.size = Pt(10)
    p_sol_desc.font.color.rgb = NAVY_DARK
    p_sol_desc.space_before = Pt(4)
    
    # Right box: Code implementation
    c_p2 = add_card(s7, Inches(6.88), box_y, box_w1, box_h, bg_color=RGBColor(15, 23, 42), border_color=RGBColor(51, 65, 85))
    tf_p2 = c_p2.text_frame
    tf_p2.word_wrap = True
    tf_p2.margin_left = tf_p2.margin_right = tf_p2.margin_top = Inches(0.2)
    
    p = tf_p2.paragraphs[0]
    p.text = "💻 CODE XỬ LÝ TRONG INVENTORYSERVICE.PHP"
    p.font.name = "Consolas"
    p.font.size = Pt(11)
    p.font.bold = True
    p.font.color.rgb = CYAN_ACCENT
    
    code_text = (
        "DB::transaction(function () use ($items, $userId) {\n"
        "    foreach ($items as $item) {\n"
        "        // 1. Khóa bi quan độc quyền đọc-ghi cấp bản ghi\n"
        "        $product = Product::where('id', $item['id'])\n"
        "            ->lockForUpdate()\n"
        "            ->firstOrFail();\n\n"
        "        // 2. Chặn đứng tuyệt đối tình trạng âm kho\n"
        "        if ($product->stock_quantity < $item['quantity']) {\n"
        "            throw new Exception('Không đủ tồn khả dụng!');\n"
        "        }\n\n"
        "        // 3. Trừ tồn kho nguyên tử\n"
        "        $product->decrement('stock_quantity', $item['quantity']);\n\n"
        "        // 4. Lưu vết Audit Log chi tiết vào Thẻ kho\n"
        "        StockMovement::create([\n"
        "            'product_id'   => $product->id,\n"
        "            'type'         => 'EXPORT',\n"
        "            'quantity'     => $item['quantity'],\n"
        "            'before_stock' => $product->stock_quantity + $item['quantity'],\n"
        "            'after_stock'  => $product->stock_quantity,\n"
        "        ]);\n"
        "    }\n"
        "});"
    )
    p_c = tf_p2.add_paragraph()
    p_c.text = code_text
    p_c.font.name = "Consolas"
    p_c.font.size = Pt(9.5)
    p_c.font.color.rgb = RGBColor(226, 232, 240)
    p_c.space_before = Pt(6)

    set_speaker_notes(
        s7,
        "Kính thưa Thầy Cô, đây chính là phần kỹ thuật quan trọng nhất của đồ án. "
        "Nhóm đã giải quyết triệt để lỗi âm kho bằng cách kết hợp DB::transaction() và hàm lockForUpdate(). "
        "Khi một giao dịch xuất kho diễn ra, bản ghi của sản phẩm đó trong bảng products lập tức bị khóa độc quyền tại CSDL. "
        "Bất kỳ giao dịch nào khác muốn can thiệp vào sản phẩm này đều phải xếp hàng chờ. "
        "Khi giao dịch đầu tiên trừ tồn xong và commit, giao dịch thứ hai mới được đọc số dư mới. "
        "Nếu số dư không đủ, hệ thống ném ra Exception và Rollback ngay lập tức, không một hạt bụi dữ liệu nào bị sai sót!"
    )
    
    # ==========================================
    # SLIDE 8: THIẾT KẾ USE CASE
    # ==========================================
    s8 = prs.slides.add_slide(blank_layout)
    set_slide_background(s8, BG_LIGHT)
    add_header(s8, "PHÂN TÍCH HỆ THỐNG", "Mô hình hóa ca sử dụng (Use Case Modeling)", "Phân định quyền hạn rõ ràng giữa Quản trị viên (Admin) và Nhân viên thủ kho (Staff)")
    
    col_w8 = Inches(5.65)
    col_h8 = Inches(4.9)
    col_y8 = Inches(1.8)
    
    # Admin card
    c_u1 = add_card(s8, Inches(0.8), col_y8, col_w8, col_h8, bg_color=CARD_BG, border_color=BLUE_ACCENT)
    tf_u1 = c_u1.text_frame
    tf_u1.word_wrap = True
    tf_u1.margin_left = tf_u1.margin_right = tf_u1.margin_top = Inches(0.25)
    p = tf_u1.paragraphs[0]
    p.text = "👑 QUẢN TRỊ VIÊN (ADMIN)"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = BLUE_ACCENT
    
    p_sub = tf_u1.add_paragraph()
    p_sub.text = "(Toàn quyền quản trị tài nguyên & cấu hình)"
    p_sub.font.size = Pt(10)
    p_sub.font.italic = True
    p_sub.font.color.rgb = TEXT_MUTED
    
    admin_cases = [
        "Đăng nhập hệ thống & Thu hồi Bearer Token cá nhân.",
        "Xem Bảng điều khiển (Dashboard) KPI & Cảnh báo hàng chạm ngưỡng.",
        "Quản lý Danh mục hàng hóa (Thêm, sửa, xóa với kiểm tra ràng buộc).",
        "Quản lý Đối tác Nhà cung cấp (Thông tin liên hệ, lịch sử hợp tác).",
        "Quản lý Sản phẩm (Định nghĩa SKU, mã Barcode, giá vốn, giá bán, min_stock).",
        "Lập và phê duyệt Phiếu Nhập kho & Phiếu Xuất kho.",
        "Thực hiện ca Kiểm kê kho & Điều chỉnh số lượng tồn kho (/adjust).",
        "Cấp phát & Quản lý API Personal Access Tokens."
    ]
    for ac in admin_cases:
        p = tf_u1.add_paragraph()
        p.text = "✔ " + ac
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.color.rgb = NAVY_DARK
        p.space_before = Pt(6)
        
    # Staff card
    c_u2 = add_card(s8, Inches(6.88), col_y8, col_w8, col_h8, bg_color=CARD_BG, border_color=GREEN_ACCENT)
    tf_u2 = c_u2.text_frame
    tf_u2.word_wrap = True
    tf_u2.margin_left = tf_u2.margin_right = tf_u2.margin_top = Inches(0.25)
    p = tf_u2.paragraphs[0]
    p.text = "👷 NHÂN VIÊN THỦ KHO (WAREHOUSE STAFF)"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = GREEN_ACCENT
    
    p_sub = tf_u2.add_paragraph()
    p_sub.text = "(Tập trung vào nghiệp vụ xuất nhập hàng thường nhật)"
    p_sub.font.size = Pt(10)
    p_sub.font.italic = True
    p_sub.font.color.rgb = TEXT_MUTED
    
    staff_cases = [
        "Đăng nhập hệ thống bằng tài khoản được cấp.",
        "Xem Dashboard theo dõi tồn kho và các mặt hàng cần lưu ý.",
        "Tra cứu danh mục sản phẩm, tìm kiếm theo SKU, Barcode, Tên hàng.",
        "Lập Phiếu Nhập kho (Chọn NCC, chọn mặt hàng, nhập số lượng, đơn giá).",
        "Lập Phiếu Xuất kho an toàn (Kiểm tra tồn tức thời, chặn âm kho).",
        "Tra cứu Thẻ kho điện tử (Audit Log) theo mặt hàng và khoảng thời gian.",
        "🚫 BỊ CHẶN: Không có quyền xóa danh mục, không được xóa sản phẩm.",
        "🚫 BỊ CHẶN: Không được tự ý điều chỉnh số lượng tồn kho (/adjust)."
    ]
    for sc in staff_cases:
        p = tf_u2.add_paragraph()
        p.text = ("• " if "🚫" not in sc else "") + sc
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.color.rgb = RED_ACCENT if "🚫" in sc else NAVY_DARK
        p.space_before = Pt(6)

    set_speaker_notes(
        s8,
        "Về mặt phân quyền người dùng, hệ thống triển khai mô hình RBAC chặt chẽ. "
        "Nhân viên thủ kho có toàn quyền thực hiện các thao tác vận hành hàng ngày như tạo phiếu nhập, "
        "tạo phiếu xuất và xem thẻ kho. "
        "Tuy nhiên, các hành động nhạy cảm như xóa danh mục, sửa cấu hình hoặc đặc biệt là thao tác điều chỉnh số dư kiểm kê kho "
        "đều bị Middleware chặn lại (trả về mã 403 Forbidden) và chỉ dành riêng cho Quản trị viên."
    )
    
    # ==========================================
    # SLIDE 9: THIẾT KẾ CƠ SỞ DỮ LIỆU (ERD)
    # ==========================================
    s9 = prs.slides.add_slide(blank_layout)
    set_slide_background(s9, BG_LIGHT)
    add_header(s9, "THIẾT KẾ DỮ LIỆU", "Sơ đồ thực thể quan hệ (ERD - 9 Bảng chuẩn hóa)", "Cơ sở dữ liệu quan hệ MySQL InnoDB được chuẩn hóa 3NF, ràng buộc toàn vẹn dữ liệu")
    
    erd_w = Inches(3.64)
    erd_h = Inches(4.8)
    erd_y = Inches(1.8)
    
    # Nhóm 1: Master Data
    c_e1 = add_card(s9, Inches(0.8), erd_y, erd_w, erd_h, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf_e1 = c_e1.text_frame
    tf_e1.word_wrap = True
    tf_e1.margin_left = tf_e1.margin_right = tf_e1.margin_top = Inches(0.2)
    p = tf_e1.paragraphs[0]
    p.text = "📦 MASTER DATA TABLES"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = BLUE_ACCENT
    
    master_tbls = [
        ("categories", "Quản lý nhóm phân loại hàng hóa (id, name, slug, description)."),
        ("suppliers", "Đối tác cung ứng (id, name, email, phone, address)."),
        ("products", "Sản phẩm kho hàng (id, category_id, sku, barcode, name, cost_price, selling_price, stock_quantity, min_stock)."),
        ("users", "Tài khoản người dùng (id, name, email, password, role [admin|staff], status [active|inactive]).")
    ]
    for tbl, desc in master_tbls:
        p = tf_e1.add_paragraph()
        p.text = "• " + tbl
        p.font.name = "Consolas"
        p.font.size = Pt(11)
        p.font.bold = True
        p.font.color.rgb = NAVY_PRIMARY
        p.space_before = Pt(6)
        
        p2 = tf_e1.add_paragraph()
        p2.text = desc
        p2.font.name = FONT_MAIN
        p2.font.size = Pt(10)
        p2.font.color.rgb = TEXT_DARK
        
    # Nhóm 2: Transaction Orders
    c_e2 = add_card(s9, Inches(4.84), erd_y, erd_w, erd_h, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf_e2 = c_e2.text_frame
    tf_e2.word_wrap = True
    tf_e2.margin_left = tf_e2.margin_right = tf_e2.margin_top = Inches(0.2)
    p = tf_e2.paragraphs[0]
    p.text = "📋 TRANSACTION TABLES"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = GREEN_ACCENT
    
    trans_tbls = [
        ("import_orders", "Phiếu nhập hàng (id, code, supplier_id, user_id, total_amount, status, import_date)."),
        ("import_order_items", "Chi tiết mặt hàng nhập (id, import_order_id, product_id, quantity, unit_price, subtotal)."),
        ("export_orders", "Phiếu xuất hàng (id, code, user_id, customer_name, total_amount, status, export_date)."),
        ("export_order_items", "Chi tiết mặt hàng xuất (id, export_order_id, product_id, quantity, unit_price, subtotal).")
    ]
    for tbl, desc in trans_tbls:
        p = tf_e2.add_paragraph()
        p.text = "• " + tbl
        p.font.name = "Consolas"
        p.font.size = Pt(11)
        p.font.bold = True
        p.font.color.rgb = GREEN_ACCENT
        p.space_before = Pt(6)
        
        p2 = tf_e2.add_paragraph()
        p2.text = desc
        p2.font.name = FONT_MAIN
        p2.font.size = Pt(10)
        p2.font.color.rgb = TEXT_DARK
        
    # Nhóm 3: Tracking & Audit Log
    c_e3 = add_card(s9, Inches(8.88), erd_y, erd_w, erd_h, bg_color=CARD_BG, border_color=BLUE_ACCENT)
    tf_e3 = c_e3.text_frame
    tf_e3.word_wrap = True
    tf_e3.margin_left = tf_e3.margin_right = tf_e3.margin_top = Inches(0.2)
    p = tf_e3.paragraphs[0]
    p.text = "🔍 AUDIT LOG & INTEGRITY"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = RED_ACCENT
    
    p_audit = tf_e3.add_paragraph()
    p_audit.text = "• stock_movements (Thẻ kho)"
    p_audit.font.name = "Consolas"
    p_audit.font.size = Pt(11)
    p_audit.font.bold = True
    p_audit.font.color.rgb = RED_ACCENT
    p_audit.space_before = Pt(6)
    
    p_audit_desc = tf_e3.add_paragraph()
    p_audit_desc.text = "Lưu vết 100% lịch sử biến động số dư kho:\n" \
                        "- product_id & user_id\n" \
                        "- type: IMPORT | EXPORT | ADJUST\n" \
                        "- quantity (số lượng biến động)\n" \
                        "- before_stock (tồn trước khi đổi)\n" \
                        "- after_stock (tồn sau khi đổi)\n" \
                        "- reference_id & reference_type\n" \
                        "- note & created_at"
    p_audit_desc.font.name = FONT_MAIN
    p_audit_desc.font.size = Pt(10)
    p_audit_desc.font.color.rgb = TEXT_DARK
    
    p_fk = tf_e3.add_paragraph()
    p_fk.text = "🔒 Ràng buộc toàn vẹn dữ liệu:"
    p_fk.font.name = FONT_MAIN
    p_fk.font.size = Pt(11)
    p_fk.font.bold = True
    p_fk.font.color.rgb = NAVY_PRIMARY
    p_fk.space_before = Pt(8)
    
    p_fk_desc = tf_e3.add_paragraph()
    p_fk_desc.text = "Thiết lập Foreign Keys chặt chẽ giữa các bảng với tùy chọn ON DELETE RESTRICT, ngăn chặn xóa sản phẩm hoặc danh mục khi đã phát sinh dữ liệu giao dịch."
    p_fk_desc.font.name = FONT_MAIN
    p_fk_desc.font.size = Pt(10)
    p_fk_desc.font.color.rgb = TEXT_MUTED

    set_speaker_notes(
        s9,
        "Cơ sở dữ liệu của hệ thống gồm 9 bảng quan hệ được thiết kế theo chuẩn 3NF. "
        "Đặc biệt, bảng stock_movements hoạt động như một sổ cái bất biến (Immutable Ledger). "
        "Mỗi khi một sản phẩm được nhập vào, xuất ra hoặc kiểm kê điều chỉnh, "
        "hệ thống đều tự động ghi lại số lượng trước khi đổi và sau khi đổi, cùng với mã nhân sự thực hiện. "
        "Điều này giúp doanh nghiệp luôn truy vết được nguồn gốc mọi biến động kho."
    )
    
    # ==========================================
    # SLIDE 10: QUY TRÌNH NGHIỆP VỤ NHẬP & XUẤT KHO
    # ==========================================
    s10 = prs.slides.add_slide(blank_layout)
    set_slide_background(s10, BG_LIGHT)
    add_header(s10, "QUY TRÌNH NGHIỆP VỤ", "Quy trình xử lý giao dịch Nhập kho & Xuất kho", "Các bước xử lý tuần tự bảo đảm tính nguyên tử và an toàn tuyệt đối")
    
    flow_w = Inches(5.65)
    flow_h = Inches(4.9)
    flow_y = Inches(1.8)
    
    # Nhập kho
    c_f1 = add_card(s10, Inches(0.8), flow_y, flow_w, flow_h, bg_color=CARD_BG, border_color=GREEN_ACCENT)
    tf_f1 = c_f1.text_frame
    tf_f1.word_wrap = True
    tf_f1.margin_left = tf_f1.margin_right = tf_f1.margin_top = Inches(0.25)
    p = tf_f1.paragraphs[0]
    p.text = "📥 QUY TRÌNH NHẬP KHO AN TOÀN"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = GREEN_ACCENT
    
    import_steps = [
        ("Bước 1: Khởi tạo phiếu nhập", "Thủ kho chọn Nhà cung cấp và thêm danh sách mặt hàng nhập trên giao diện động."),
        ("Bước 2: Mở Database Transaction", "Hệ thống bắt đầu phiên giao dịch DB::beginTransaction() để bảo đảm tính nguyên tử."),
        ("Bước 3: Khóa bi quan bản ghi SP", "Áp dụng lockForUpdate() trên từng sản phẩm để đồng bộ hóa cập nhật."),
        ("Bước 4: Tăng số lượng tồn kho", "Thực hiện increment('stock_quantity', $qty) trực tiếp trên cơ sở dữ liệu."),
        ("Bước 5: Ghi nhật ký Thẻ kho", "Tạo bản ghi StockMovement loại IMPORT lưu trữ before_stock và after_stock."),
        ("Bước 6: Commit giao dịch", "Hoàn tất lưu phiếu nhập và giải phóng khóa. Trả về thông báo thành công.")
    ]
    for step, desc in import_steps:
        p = tf_f1.add_paragraph()
        p.text = "✔ " + step + ": "
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.bold = True
        p.font.color.rgb = NAVY_DARK
        p.space_before = Pt(6)
        
        run = p.add_run()
        run.text = desc
        run.font.bold = False
        run.font.color.rgb = TEXT_DARK
        
    # Xuất kho
    c_f2 = add_card(s10, Inches(6.88), flow_y, flow_w, flow_h, bg_color=CARD_BG, border_color=RED_ACCENT)
    tf_f2 = c_f2.text_frame
    tf_f2.word_wrap = True
    tf_f2.margin_left = tf_f2.margin_right = tf_f2.margin_top = Inches(0.25)
    p = tf_f2.paragraphs[0]
    p.text = "📤 QUY TRÌNH XUẤT KHO CHỐNG ÂM KHO"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = RED_ACCENT
    
    export_steps = [
        ("Bước 1: Kiểm tra tồn tại giao diện", "Hiển thị tức thời số lượng tồn khả dụng để thủ kho nhập số lượng xuất hợp lệ."),
        ("Bước 2: Mở Database Transaction", "Bắt đầu giao dịch cô lập dữ liệu tại tầng Backend Service."),
        ("Bước 3: Khóa độc quyền bản ghi", "Gọi lockForUpdate() độc quyền đọc-ghi, các yêu cầu đồng thời khác phải xếp hàng chờ."),
        ("Bước 4: Kiểm tra tồn thực tế trong CSDL", "Nếu $stock_quantity < $export_qty: Ngay lập tức Ném Exception và Rollback toàn bộ!"),
        ("Bước 5: Trừ tồn kho nguyên tử", "Nếu đủ hàng: Thực hiện decrement('stock_quantity', $qty) an toàn."),
        ("Bước 6: Ghi Thẻ kho & Commit", "Tạo bản ghi StockMovement loại EXPORT và hoàn tất giao dịch xuất kho.")
    ]
    for step, desc in export_steps:
        p = tf_f2.add_paragraph()
        p.text = "🛡️ " + step + ": "
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.bold = True
        p.font.color.rgb = NAVY_DARK
        p.space_before = Pt(6)
        
        run = p.add_run()
        run.text = desc
        run.font.bold = False
        run.font.color.rgb = TEXT_DARK

    set_speaker_notes(
        s10,
        "Ở slide này, chúng ta thấy rõ sự khác biệt giữa quy trình Nhập và Xuất. "
        "Trong quy trình Xuất kho, hệ thống áp dụng cơ chế bảo vệ 2 lớp: "
        "Lớp 1 kiểm tra nhanh tại giao diện người dùng; "
        "Lớp 2 kiểm tra lại số dư thực tế trong CSDL sau khi đã khóa bản ghi độc quyền bằng lockForUpdate(). "
        "Nhờ đó, dù có hàng trăm yêu cầu xuất gửi lên cùng 1 tích tắc, kho hàng vẫn không bao giờ bị âm."
    )
    
    # ==========================================
    # SLIDE 11: KIẾN TRÚC RESTFUL API & SANCTUM
    # ==========================================
    s11 = prs.slides.add_slide(blank_layout)
    set_slide_background(s11, BG_LIGHT)
    add_header(s11, "KIẾN TRÚC RESTFUL API", "Bộ 28 RESTful API Endpoints & Bảo mật Stateless Token", "Xây dựng các dịch vụ Web chuẩn hóa, sẵn sàng tích hợp với Mobile App và sàn TMĐT")
    
    api_w = Inches(3.64)
    api_h = Inches(4.8)
    api_y = Inches(1.8)
    
    # Col 1: Thống kê 28 Endpoints
    c_a1 = add_card(s11, Inches(0.8), api_y, api_w, api_h, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf_a1 = c_a1.text_frame
    tf_a1.word_wrap = True
    tf_a1.margin_left = tf_a1.margin_right = tf_a1.margin_top = Inches(0.2)
    p = tf_a1.paragraphs[0]
    p.text = "🌐 28 ENDPOINTS CHUẨN HÓA"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = BLUE_ACCENT
    
    apis = [
        ("Xác thực (Auth)", "POST /login, POST /logout, GET /me (3 endpoints)"),
        ("Bảng điều khiển", "GET /dashboard/stats, GET /dashboard/low-stock (2 endpoints)"),
        ("Danh mục sản phẩm", "GET, POST, GET/{id}, PUT/{id}, DELETE/{id} (5 endpoints)"),
        ("Nhà cung cấp", "GET, POST, GET/{id}, PUT/{id}, DELETE/{id} (5 endpoints)"),
        ("Sản phẩm kho", "GET, POST, GET/{id}, PUT/{id}, DELETE/{id} (5 endpoints)"),
        ("Nhập & Xuất kho", "GET/POST /imports, GET/POST /exports (6 endpoints)"),
        ("Kiểm kê & Audit", "GET /inventory/audit-logs, POST /inventory/adjust (2 endpoints)")
    ]
    for grp, ep in apis:
        p = tf_a1.add_paragraph()
        p.text = "• " + grp + ":"
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.bold = True
        p.font.color.rgb = NAVY_DARK
        p.space_before = Pt(5)
        
        p2 = tf_a1.add_paragraph()
        p2.text = ep
        p2.font.name = "Consolas"
        p2.font.size = Pt(9.5)
        p2.font.color.rgb = TEXT_MUTED
        
    # Col 2: Xác thực Sanctum Bearer Token
    c_a2 = add_card(s11, Inches(4.84), api_y, api_w, api_h, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf_a2 = c_a2.text_frame
    tf_a2.word_wrap = True
    tf_a2.margin_left = tf_a2.margin_right = tf_a2.margin_top = Inches(0.2)
    p = tf_a2.paragraphs[0]
    p.text = "🔑 BẢO MẬT LARAVEL SANCTUM"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = GREEN_ACCENT
    
    sanctum_points = [
        ("Stateless Architecture", "Không phụ thuộc Session trên máy chủ, giúp tiết kiệm bộ nhớ RAM và dễ dàng mở rộng theo chiều ngang (Horizontal Scaling)."),
        ("Bearer Token SHA-256", "Mỗi khi đăng nhập thành công, Sanctum cấp một chuỗi Token ngẫu nhiên mã hóa băm SHA-256."),
        ("HTTP Header tiêu chuẩn", "Client gửi kèm Token trong Header:\nAuthorization: Bearer 1|abc123xyz..."),
        ("Thu hồi tức thì (Revoke)", "Khi người dùng đăng xuất, Token lập tức bị xóa khỏi CSDL, vô hiệu hóa hoàn toàn quyền truy cập.")
    ]
    for title, desc in sanctum_points:
        p = tf_a2.add_paragraph()
        p.text = "✔ " + title + ": "
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.bold = True
        p.font.color.rgb = NAVY_DARK
        p.space_before = Pt(8)
        
        run = p.add_run()
        run.text = desc
        run.font.bold = False
        run.font.color.rgb = TEXT_DARK
        
    # Col 3: JSON Format & Status Codes
    c_a3 = add_card(s11, Inches(8.88), api_y, api_w, api_h, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf_a3 = c_a3.text_frame
    tf_a3.word_wrap = True
    tf_a3.margin_left = tf_a3.margin_right = tf_a3.margin_top = Inches(0.2)
    p = tf_a3.paragraphs[0]
    p.text = "📋 JSON STRUCTURE & STATUS"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = AMBER_ACCENT
    
    p_json = tf_a3.add_paragraph()
    p_json.text = "Cấu trúc phản hồi đồng nhất:"
    p_json.font.name = FONT_MAIN
    p_json.font.size = Pt(10.5)
    p_json.font.bold = True
    p_json.font.color.rgb = NAVY_DARK
    p_json.space_before = Pt(4)
    
    json_sample = "{\n  \"success\": true,\n  \"message\": \"Thành công\",\n  \"data\": { ... }\n}"
    p_js = tf_a3.add_paragraph()
    p_js.text = json_sample
    p_js.font.name = "Consolas"
    p_js.font.size = Pt(10)
    p_js.font.color.rgb = BLUE_ACCENT
    
    codes = [
        ("200 OK", "Truy vấn thành công"),
        ("201 Created", "Thêm mới thành công"),
        ("401 Unauthorized", "Token thiếu hoặc sai"),
        ("403 Forbidden", "Không đủ quyền (RBAC)"),
        ("422 Unprocessable", "Dữ liệu không hợp lệ")
    ]
    for c, d in codes:
        p = tf_a3.add_paragraph()
        p.text = f"• {c}: {d}"
        p.font.name = "Consolas"
        p.font.size = Pt(9.5)
        p.font.color.rgb = TEXT_DARK
        p.space_before = Pt(4)

    set_speaker_notes(
        s11,
        "Đề tài đã hoàn thành xuất sắc 28 API Endpoints chuẩn RESTful. "
        "Mọi API đều được bảo mật bằng Personal Access Token của Laravel Sanctum. "
        "Định dạng phản hồi luôn tuân thủ cấu trúc 3 phần chuẩn: success, message và data, "
        "kết hợp các mã HTTP Status Code rõ ràng, giúp các lập trình viên Frontend hoặc Mobile App dễ dàng tích hợp."
    )
    
    # ==========================================
    # SLIDE 12: HIỆN THỰC CÁC PHÂN HỆ CHỨC NĂNG
    # ==========================================
    s12 = prs.slides.add_slide(blank_layout)
    set_slide_background(s12, BG_LIGHT)
    add_header(s12, "HIỆN THỰC HỆ THỐNG", "Giao diện người dùng & Các phân hệ chức năng", "Trải nghiệm trực quan, dễ thao tác và tối ưu hóa thời gian vận hành cho thủ kho")
    
    feat_w = Inches(3.64)
    feat_h = Inches(4.8)
    feat_y = Inches(1.8)
    
    # Feature 1: Dashboard
    c_f1 = add_card(s12, Inches(0.8), feat_y, feat_w, feat_h, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf1 = c_f1.text_frame
    tf1.word_wrap = True
    tf1.margin_left = tf1.margin_right = tf1.margin_top = Inches(0.2)
    p = tf1.paragraphs[0]
    p.text = "📊 BẢNG ĐIỀU KHIỂN (DASHBOARD)"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = BLUE_ACCENT
    
    d_points = [
        "4 thẻ KPI thời gian thực: Tổng sản phẩm, Tổng số lượng tồn, Tổng giá trị hàng hóa và Cảnh báo hàng chạm ngưỡng tồn.",
        "Biểu đồ cột ghép Chart.js: So sánh xu hướng kim ngạch Nhập và Xuất qua 6 tháng gần nhất.",
        "Biểu đồ Doughnut Chart.js: Trực quan hóa cơ cấu tỷ trọng sản phẩm theo từng danh mục.",
        "Bảng cảnh báo tự động: Danh sách các mặt hàng có tồn kho <= min_stock để kịp thời nhập hàng."
    ]
    for pt in d_points:
        p = tf1.add_paragraph()
        p.text = "• " + pt
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.color.rgb = TEXT_DARK
        p.space_before = Pt(8)
        
    # Feature 2: Nhập & Xuất kho
    c_f2 = add_card(s12, Inches(4.84), feat_y, feat_w, feat_h, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf2 = c_f2.text_frame
    tf2.word_wrap = True
    tf2.margin_left = tf2.margin_right = tf2.margin_top = Inches(0.2)
    p = tf2.paragraphs[0]
    p.text = "📦 NHẬP KHO & XUẤT KHO"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = GREEN_ACCENT
    
    o_points = [
        "Giao diện lập phiếu nhập động: Cho phép thêm/bớt nhiều dòng sản phẩm, tự động tính tổng tiền.",
        "Giao diện lập phiếu xuất an toàn: Hiển thị ngay số lượng tồn khả dụng để tránh thủ kho nhập lố.",
        "Hỗ trợ tìm kiếm thông minh theo mã SKU, mã vạch Barcode và tên sản phẩm.",
        "In phiếu và xem chi tiết phiếu xuất/nhập với đầy đủ thông tin đối tác và nhân viên thực hiện."
    ]
    for pt in o_points:
        p = tf2.add_paragraph()
        p.text = "• " + pt
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.color.rgb = TEXT_DARK
        p.space_before = Pt(8)
        
    # Feature 3: Thẻ kho & Kiểm kê
    c_f3 = add_card(s12, Inches(8.88), feat_y, feat_w, feat_h, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf3 = c_f3.text_frame
    tf3.word_wrap = True
    tf3.margin_left = tf3.margin_right = tf3.margin_top = Inches(0.2)
    p = tf3.paragraphs[0]
    p.text = "🔍 THẺ KHO & KIỂM KÊ KHO"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = RED_ACCENT
    
    a_points = [
        "Thẻ kho điện tử (Audit Log): Theo dõi chi tiết 100% lịch sử tăng/giảm tồn kho.",
        "Hiển thị rõ: Ngày giờ, Người thực hiện, Loại giao dịch (IMPORT, EXPORT, ADJUST), Tồn trước, Tồn sau.",
        "Bộ lọc đa năng: Lọc thẻ kho theo mã sản phẩm, loại giao dịch hoặc khoảng ngày.",
        "Tính năng Kiểm kê kho: Đối soát tồn thực tế trên kệ và tự động sinh phiếu điều chỉnh cân bằng kho."
    ]
    for pt in a_points:
        p = tf3.add_paragraph()
        p.text = "• " + pt
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.color.rgb = TEXT_DARK
        p.space_before = Pt(8)

    set_speaker_notes(
        s12,
        "Giao diện hệ thống được thiết kế theo phong cách tối giản, hiện đại bằng Bootstrap 5. "
        "Thủ kho chỉ cần nhìn vào Dashboard là biết ngay tình trạng kho, "
        "mặt hàng nào sắp hết để kịp thời đề xuất nhập hàng. "
        "Tính năng Thẻ kho điện tử giúp minh bạch hóa mọi thao tác, "
        "loại bỏ hoàn toàn tình trạng thất thoát hàng hóa không rõ lý do."
    )
    
    # ==========================================
    # SLIDE 13: ĐÁNH GIÁ & KIỂM THỬ TỰ ĐỘNG
    # ==========================================
    s13 = prs.slides.add_slide(blank_layout)
    set_slide_background(s13, BG_LIGHT)
    add_header(s13, "ĐÁNH GIÁ CHẤT LƯỢNG", "Kiểm thử tự động toàn diện với PHPUnit (Automated Tests)", "14/14 ca kiểm thử chức năng tự động đạt kết quả 100% Passed")
    
    # Left: Big Metric Card
    c_m = add_card(s13, Inches(0.8), Inches(1.8), Inches(3.64), Inches(4.9), bg_color=CARD_BG, border_color=GREEN_ACCENT)
    tf_m = c_m.text_frame
    tf_m.word_wrap = True
    tf_m.margin_left = tf_m.margin_right = tf_m.margin_top = Inches(0.3)
    
    p = tf_m.paragraphs[0]
    p.text = "KẾT QUẢ KIỂM THỬ"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = GREEN_ACCENT
    
    p_num = tf_m.add_paragraph()
    p_num.text = "14 / 14"
    p_num.font.name = FONT_MAIN
    p_num.font.size = Pt(36)
    p_num.font.bold = True
    p_num.font.color.rgb = GREEN_ACCENT
    p_num.space_before = Pt(8)
    
    p_lbl = tf_m.add_paragraph()
    p_lbl.text = "TESTS PASSED (100%)"
    p_lbl.font.name = FONT_MAIN
    p_lbl.font.size = Pt(14)
    p_lbl.font.bold = True
    p_lbl.font.color.rgb = NAVY_DARK
    
    stats = [
        ("Tổng số Assertions", "54 assertions"),
        ("Thời gian thực thi", "2.96 giây"),
        ("Tỷ lệ vượt qua", "100% Hoàn hảo"),
        ("Môi trường test", "PHPUnit trên MySQL")
    ]
    for s_title, s_val in stats:
        p = tf_m.add_paragraph()
        p.text = f"{s_title}: {s_val}"
        p.font.name = FONT_MAIN
        p.font.size = Pt(11)
        p.font.color.rgb = TEXT_DARK
        p.space_before = Pt(8)
        
    # Right: Test scenarios details
    c_td = add_card(s13, Inches(4.84), Inches(1.8), Inches(7.68), Inches(4.9), bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf_td = c_td.text_frame
    tf_td.word_wrap = True
    tf_td.margin_left = tf_td.margin_right = tf_td.margin_top = Inches(0.25)
    
    p = tf_td.paragraphs[0]
    p.text = "DANH SÁCH CÁC KỊCH BẢN KIỂM THỬ TỰ ĐỘNG (AUTOMATED TEST SUITE)"
    p.font.name = FONT_MAIN
    p.font.size = Pt(12)
    p.font.bold = True
    p.font.color.rgb = BLUE_ACCENT
    
    scenarios = [
        ("✔ login_page_is_accessible", "Trang đăng nhập Web phản hồi HTTP 200 OK."),
        ("✔ valid_user_can_login", "Đăng nhập thành công với tài khoản hợp lệ, chuyển hướng Dashboard."),
        ("✔ admin_can_access_dashboard", "Quản trị viên truy cập Bảng điều khiển xem đúng KPI."),
        ("✔ admin_can_create_product", "Thêm sản phẩm mới vào CSDL với đầy đủ SKU, Barcode, Giá vốn."),
        ("✔ import_inventory_increases_stock", "Nhập kho tăng số lượng tồn chính xác và ghi Thẻ kho IMPORT."),
        ("✔ export_inventory_decreases_stock", "Xuất kho trừ số lượng tồn an toàn và ghi Thẻ kho EXPORT."),
        ("✔ export_cannot_exceed_current_stock", "Cố tình xuất vượt tồn kho -> Chặn đứng âm kho và ném Exception!"),
        ("✔ api_login_returns_token", "API Login trả về Personal Access Token Sanctum hợp lệ."),
        ("✔ api_products_index_returns_json", "API lấy danh sách sản phẩm trả về đúng chuẩn JSON 200 OK."),
        ("✔ api_stats_returns_correct_data", "API thống kê trả về đúng số lượng mặt hàng và giá trị tồn.")
    ]
    for t_name, t_desc in scenarios:
        p = tf_td.add_paragraph()
        p.text = f"{t_name}: "
        p.font.name = "Consolas"
        p.font.size = Pt(10)
        p.font.bold = True
        p.font.color.rgb = GREEN_ACCENT
        p.space_before = Pt(4)
        
        run = p.add_run()
        run.text = t_desc
        run.font.name = FONT_MAIN
        run.font.bold = False
        run.font.color.rgb = TEXT_DARK

    set_speaker_notes(
        s13,
        "Một trong những điểm tạo nên độ tin cậy vượt trội của đồ án là bộ kiểm thử tự động với PHPUnit. "
        "Nhóm đã viết 14 kịch bản kiểm thử bao phủ toàn bộ các luồng quan trọng: "
        "từ xác thực người dùng, phân quyền, kiểm tra nghiệp vụ nhập xuất, "
        "cho đến việc giả lập kịch bản xuất vượt tồn kho để kiểm tra xem hệ thống có chặn âm kho thành công hay không. "
        "Kết quả thực tế đạt 14/14 tests pass với 54 assertions thành công trong chưa đầy 3 giây."
    )
    
    # ==========================================
    # SLIDE 14: ĐỐI CHIẾU KẾT QUẢ VỚI PHIẾU ĐỀ TÀI
    # ==========================================
    s14 = prs.slides.add_slide(blank_layout)
    set_slide_background(s14, BG_LIGHT)
    add_header(s14, "KẾT QUẢ ĐẠT ĐƯỢC", "Đối chiếu kết quả hoàn thành với Phiếu đăng ký đề tài", "Cam kết hoàn thành 100% nội dung và yêu cầu đã đăng ký với Khoa CNTT")
    
    # Table layout
    rows = 9
    cols = 4
    left = Inches(0.8)
    top = Inches(1.8)
    width = Inches(11.733)
    height = Inches(4.8)
    
    table_shape = s14.shapes.add_table(rows, cols, left, top, width, height)
    tbl = table_shape.table
    
    tbl.columns[0].width = Inches(0.8)
    tbl.columns[1].width = Inches(3.2)
    tbl.columns[2].width = Inches(6.0)
    tbl.columns[3].width = Inches(1.733)
    
    headers = ["STT", "Nội dung trong Phiếu đề tài", "Kết quả hiện thực thực tế", "Đánh giá"]
    for i, h in enumerate(headers):
        cell = tbl.cell(0, i)
        cell.fill.solid()
        cell.fill.fore_color.rgb = NAVY_PRIMARY
        p = cell.text_frame.paragraphs[0]
        p.text = h
        p.alignment = PP_ALIGN.CENTER
        p.font.name = FONT_MAIN
        p.font.size = Pt(11)
        p.font.bold = True
        p.font.color.rgb = TEXT_WHITE
        
    eval_matrix = [
        ("1", "Đăng nhập và phân quyền RBAC", "Web Session + Laravel Sanctum Bearer Token; 2 vai trò Admin và Staff", "100% (Đạt)"),
        ("2", "Quản lý sản phẩm, danh mục, NCC", "CRUD đầy đủ, quản lý SKU, Barcode, Giá vốn, Giá bán, ngưỡng min_stock", "100% (Đạt)"),
        ("3", "Quản lý nhập kho", "Lập phiếu nhập đa dòng, Transaction + Khóa bi quan tăng tồn nguyên tử", "100% (Đạt)"),
        ("4", "Quản lý xuất kho an toàn", "Kiểm tra tồn khả dụng, khóa bi quan trừ tồn, chặn âm kho 100%", "100% (Đạt)"),
        ("5", "Quản lý tồn kho & Audit Log", "Tự động ghi nhận 100% lịch sử biến động Thẻ kho, tính năng Kiểm kê", "100% (Đạt)"),
        ("6", "Dashboard & Cảnh báo tồn", "Biểu đồ cột & tròn Chart.js; cảnh báo tự động sản phẩm <= min_stock", "100% (Đạt)"),
        ("7", "Xây dựng RESTful API chuẩn", "28 endpoints hoàn chỉnh, bảo mật Bearer Token, chuẩn HTTP Status Code", "100% (Đạt)"),
        ("8", "Triển khai trên XAMPP", "Cài đặt & vận hành mượt mà trên Apache 2.4, PHP 8.3, MySQL 8.0", "100% (Đạt)")
    ]
    
    for r_idx, row_data in enumerate(eval_matrix):
        for c_idx, val in enumerate(row_data):
            cell = tbl.cell(r_idx + 1, c_idx)
            cell.fill.solid()
            cell.fill.fore_color.rgb = CARD_BG if r_idx % 2 == 0 else RGBColor(241, 245, 249)
            p = cell.text_frame.paragraphs[0]
            p.text = val
            p.font.name = FONT_MAIN
            p.font.size = Pt(10)
            if c_idx == 0 or c_idx == 3:
                p.alignment = PP_ALIGN.CENTER
                p.font.bold = True
                if c_idx == 3:
                    p.font.color.rgb = GREEN_ACCENT
            else:
                p.font.color.rgb = TEXT_DARK

    set_speaker_notes(
        s14,
        "Đối chiếu với bản đăng ký đề tài ban đầu được duyệt bởi Khoa CNTT, "
        "nhóm đã hoàn thành trọn vẹn 8 trên 8 nội dung cam kết. "
        "Không chỉ đáp ứng đầy đủ các yêu cầu cơ bản, nhóm còn chủ động mở rộng thêm "
        "bộ 28 RESTful API Endpoints và bộ kiểm thử tự động Automated Tests, "
        "mang lại một sản phẩm có tính hoàn thiện rất cao."
    )
    
    # ==========================================
    # SLIDE 15: KẾT LUẬN & HƯỚNG PHÁT TRIỂN
    # ==========================================
    s15 = prs.slides.add_slide(blank_layout)
    set_slide_background(s15, BG_LIGHT)
    add_header(s15, "TỔNG KẾT & ĐỊNH HƯỚNG", "Kết luận đề tài & Hướng phát triển tương lai", "Đúc kết giá trị nghiên cứu và vạch ra lộ trình nâng cấp hệ thống trong kỷ nguyên số")
    
    concl_w = Inches(5.65)
    concl_h = Inches(4.9)
    concl_y = Inches(1.8)
    
    # Left: Kết luận
    c_c1 = add_card(s15, Inches(0.8), concl_y, concl_w, concl_h, bg_color=CARD_BG, border_color=BLUE_ACCENT)
    tf_c1 = c_c1.text_frame
    tf_c1.word_wrap = True
    tf_c1.margin_left = tf_c1.margin_right = tf_c1.margin_top = Inches(0.25)
    p = tf_c1.paragraphs[0]
    p.text = "🎯 KẾT LUẬN ĐẠT ĐƯỢC"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = BLUE_ACCENT
    
    c_points = [
        ("Về mặt học thuật", "Làm chủ kiến trúc Service Layer Pattern, cơ chế ACID và giải quyết bài toán Concurrency Control bằng Khóa bi quan trong CSDL quan hệ."),
        ("Về mặt sản phẩm", "Xây dựng thành công ứng dụng WMS chuyên nghiệp, giao diện hiện đại, vận hành ổn định trên máy chủ XAMPP (Apache, PHP 8.3, MySQL)."),
        ("Tính toàn vẹn dữ liệu", "Loại bỏ 100% nguy cơ âm kho và sai lệch số liệu khi có nhiều giao dịch xuất hàng đồng thời."),
        ("Khả năng tích hợp", "Cung cấp hệ thống 28 RESTful APIs chuẩn hóa, sẵn sàng kết nối các ứng dụng ngoại vi.")
    ]
    for title, desc in c_points:
        p = tf_c1.add_paragraph()
        p.text = "✔ " + title + ": "
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.bold = True
        p.font.color.rgb = NAVY_DARK
        p.space_before = Pt(8)
        
        run = p.add_run()
        run.text = desc
        run.font.bold = False
        run.font.color.rgb = TEXT_DARK
        
    # Right: Hướng phát triển
    c_c2 = add_card(s15, Inches(6.88), concl_y, concl_w, concl_h, bg_color=CARD_BG, border_color=GREEN_ACCENT)
    tf_c2 = c_c2.text_frame
    tf_c2.word_wrap = True
    tf_c2.margin_left = tf_c2.margin_right = tf_c2.margin_top = Inches(0.25)
    p = tf_c2.paragraphs[0]
    p.text = "🚀 HƯỚNG PHÁT TRIỂN TIẾP THEO"
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = GREEN_ACCENT
    
    future_points = [
        ("Mobile App & Quét mã Barcode / QR", "Xây dựng ứng dụng di động (Flutter / React Native) kết nối qua 28 API Endpoints, hỗ trợ quét mã vạch bằng camera hoặc máy quét cầm tay chuyên dụng."),
        ("Mô hình Đa chi nhánh (Multi-Warehouse)", "Nâng cấp cơ sở dữ liệu để quản lý tồn kho tại nhiều địa điểm, hỗ trợ quy trình Luân chuyển hàng hóa nội bộ (Stock Transfer)."),
        ("Ứng dụng Trí tuệ nhân tạo (AI/Machine Learning)", "Tích hợp giải thuật phân tích chuỗi thời gian (ARIMA) dự báo nhu cầu hàng hóa và tự động tính điểm đặt hàng an toàn (Reorder Point)."),
        ("Đồng bộ đa kênh sàn TMĐT", "Kết nối API với Shopee, TikTok Shop, Lazada để tự động đồng bộ tồn kho thời gian thực, loại bỏ hoàn toàn nguy cơ Overselling.")
    ]
    for title, desc in future_points:
        p = tf_c2.add_paragraph()
        p.text = "• " + title + ": "
        p.font.name = FONT_MAIN
        p.font.size = Pt(10.5)
        p.font.bold = True
        p.font.color.rgb = NAVY_DARK
        p.space_before = Pt(8)
        
        run = p.add_run()
        run.text = desc
        run.font.bold = False
        run.font.color.rgb = TEXT_DARK

    set_speaker_notes(
        s15,
        "Đề tài đã hoàn thành xuất sắc các mục tiêu nghiên cứu và thực nghiệm. "
        "Trong giai đoạn tiếp theo, nhờ nền tảng 28 RESTful APIs vững chắc, "
        "hệ thống có thể dễ dàng mở rộng sang ứng dụng di động quét mã vạch trên điện thoại, "
        "nâng cấp mô hình đa kho và tích hợp trí tuệ nhân tạo để dự báo nhu cầu lưu kho."
    )
    
    # ==========================================
    # SLIDE 16: LỜI CẢM ƠN & HỎI ĐÁP (Q&A - DARK THEME)
    # ==========================================
    s16 = prs.slides.add_slide(blank_layout)
    set_slide_background(s16, NAVY_DARK)
    
    # Header tag
    pill16 = s16.shapes.add_shape(MSO_SHAPE.ROUNDED_RECTANGLE, Inches(4.5), Inches(1.0), Inches(4.333), Inches(0.4))
    pill16.fill.solid()
    pill16.fill.fore_color.rgb = RGBColor(30, 41, 59)
    pill16.line.fill.background()
    p = pill16.text_frame.paragraphs[0]
    p.text = "KHOA CÔNG NGHỆ THÔNG TIN • NIÊN KHÓA 2025"
    p.alignment = PP_ALIGN.CENTER
    p.font.name = FONT_MAIN
    p.font.size = Pt(10)
    p.font.bold = True
    p.font.color.rgb = CYAN_ACCENT
    
    # Big Thank you
    tb16 = s16.shapes.add_textbox(Inches(1.0), Inches(1.8), Inches(11.333), Inches(2.2))
    tf16 = tb16.text_frame
    tf16.word_wrap = True
    p0 = tf16.paragraphs[0]
    p0.text = "XIN CHÂN THÀNH CẢM ƠN QUÝ THẦY CÔ!"
    p0.alignment = PP_ALIGN.CENTER
    p0.font.name = FONT_MAIN
    p0.font.size = Pt(32)
    p0.font.bold = True
    p0.font.color.rgb = TEXT_WHITE
    
    p1 = tf16.add_paragraph()
    p1.text = "Nhóm sinh viên kính chúc Quý Thầy Cô trong Hội đồng chấm Đồ án dồi dào sức khỏe & thành công!\nRất mong nhận được những câu hỏi và ý kiến đóng góp quý báu của Thầy Cô."
    p1.alignment = PP_ALIGN.CENTER
    p1.font.name = FONT_MAIN
    p1.font.size = Pt(13)
    p1.font.color.rgb = RGBColor(148, 163, 184)
    p1.space_before = Pt(10)
    
    # Contact card
    c_ct = add_card(s16, Inches(2.5), Inches(4.3), Inches(8.333), Inches(2.2), bg_color=RGBColor(30, 41, 59), border_color=RGBColor(51, 65, 85))
    tf_ct = c_ct.text_frame
    tf_ct.word_wrap = True
    tf_ct.margin_left = tf_ct.margin_right = tf_ct.margin_top = Inches(0.2)
    
    p = tf_ct.paragraphs[0]
    p.text = "💬 PHIÊN HỎI ĐÁP & TRAO ĐỔI (Q&A SESSION)"
    p.alignment = PP_ALIGN.CENTER
    p.font.name = FONT_MAIN
    p.font.size = Pt(13)
    p.font.bold = True
    p.font.color.rgb = CYAN_ACCENT
    
    contact_items = [
        "Sinh viên: Thái Anh Kiệt (25002447) & Trần Phúc Khang (25002446) — Lớp: 25C2-LTM1",
        "Giảng viên hướng dẫn: Th.S. Mai Chiếm Tuấn",
        "Kho lưu trữ GitHub: https://github.com/tranphuckhang56dvn-byte/Laravel_Inventory_Management_System"
    ]
    for ci in contact_items:
        p = tf_ct.add_paragraph()
        p.text = ci
        p.alignment = PP_ALIGN.CENTER
        p.font.name = FONT_MAIN
        p.font.size = Pt(11)
        p.font.color.rgb = RGBColor(226, 232, 240)
        p.space_before = Pt(4)

    set_speaker_notes(
        s16,
        "Nhóm sinh viên chúng em xin bày tỏ lòng biết ơn chân thành nhất đến Thầy Th.S. Mai Chiếm Tuấn "
        "đã tận tâm hướng dẫn chúng em trong suốt thời gian qua. "
        "Chúng em cũng xin trân trọng cảm ơn Quý Thầy Cô trong Hội đồng chấm đồ án đã dành thời gian theo dõi bài báo cáo. "
        "Bây giờ, nhóm chúng em xin kính mời Quý Thầy Cô đặt câu hỏi và đóng góp ý kiến để đề tài được hoàn thiện hơn nữa. "
        "Em xin chân thành cảm ơn!"
    )
    
    # Save Presentation
    prs.save(PPTX_PATH)
    print(f"Presentation saved successfully to: {PPTX_PATH} ({os.path.getsize(PPTX_PATH):,} bytes)")

if __name__ == "__main__":
    create_deck()
