# -*- coding: utf-8 -*-
"""
Tập lệnh Tổng hợp Master Báo Cáo Đồ Án Chuyên Ngành
Trường Cao đẳng Lý Tự Trọng TP.HCM
Xuất ra trọn bộ: DOCX, PDF và Markdown
"""
import os
import sys
import time

sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))

from builder_core import create_styled_doc
from part1_front_matter import build_front_matter
from part2_lists_and_intro import build_lists_and_intro
from part3_chapter1_and_chapter2 import build_chapter1_and_chapter2
from part4_chapter3_and_chapter4 import build_chapter3_and_chapter4
from part5_conclusion_refs_appendix import build_conclusion_refs_appendix
from generate_markdown_report import generate_markdown

DOCX_OUT = r"E:\Laravel_Inventory_Management_System\BAO_CAO_DO_AN_CHUYEN_NGANH.docx"
PDF_OUT = r"E:\Laravel_Inventory_Management_System\BAO_CAO_DO_AN_CHUYEN_NGANH.pdf"
MD_OUT = r"E:\Laravel_Inventory_Management_System\BAO_CAO_DO_AN_CHUYEN_NGANH.md"

def main():
    print("=== BẮT ĐẦU TẠO BÁO CÁO ĐỒ ÁN CHUYÊN NGÀNH HOÀN CHỈNH ===")
    
    # 1. Tạo tài liệu Word theo chuẩn mẫu Lý Tự Trọng
    print("[1/3] Khởi tạo tài liệu Word (.docx)...")
    doc = create_styled_doc()
    
    print("  -> Đang xây dựng Phần 1: Trang bìa, Nhiệm vụ đề tài, Phiếu nhận xét, Lời cảm ơn...")
    build_front_matter(doc, None)
    
    print("  -> Đang xây dựng Phần 2: Mục lục, Danh mục hình/bảng/từ viết tắt, Mở đầu...")
    build_lists_and_intro(doc, None)
    
    print("  -> Đang xây dựng Phần 3: Chương 1 (Tổng quan) & Chương 2 (Cơ sở lý thuyết & Công nghệ)...")
    build_chapter1_and_chapter2(doc, None)
    
    print("  -> Đang xây dựng Phần 4: Chương 3 (Phân tích & Thiết kế) & Chương 4 (Hiện thực & Kiểm thử)...")
    build_chapter3_and_chapter4(doc, None)
    
    print("  -> Đang xây dựng Phần 5: Kết luận & Kiến nghị, Tài liệu tham khảo APA 6th & 3 Phụ lục...")
    build_conclusion_refs_appendix(doc, None)
    
    doc.save(DOCX_OUT)
    print(f"  ==> Đã lưu file DOCX thành công tại: {DOCX_OUT} ({os.path.getsize(DOCX_OUT):,} bytes)")
    
    # 2. Tạo tài liệu Markdown (.md)
    print("[2/3] Đang tạo tài liệu Markdown (.md)...")
    generate_markdown()
    print(f"  ==> Đã lưu file Markdown thành công tại: {MD_OUT} ({os.path.getsize(MD_OUT):,} bytes)")
    
    # 3. Xuất file PDF bằng Word COM Automation
    print("[3/3] Đang chuyển đổi sang định dạng PDF (.pdf) thông qua Microsoft Word...")
    try:
        import win32com.client
        word = win32com.client.DispatchEx("Word.Application")
        word.Visible = False
        in_docx_abs = os.path.abspath(DOCX_OUT)
        out_pdf_abs = os.path.abspath(PDF_OUT)
        
        doc_word = word.Documents.Open(in_docx_abs)
        doc_word.SaveAs(out_pdf_abs, FileFormat=17) # 17 = wdFormatPDF
        doc_word.Close()
        word.Quit()
        print(f"  ==> Đã chuyển đổi PDF thành công tại: {PDF_OUT} ({os.path.getsize(PDF_OUT):,} bytes)")
    except Exception as e:
        print(f"  [CẢNH BÁO] Chuyển đổi PDF gặp lỗi: {e}")
        
    print("=== TOÀN BỘ QUÁ TRÌNH TẠO BÁO CÁO ĐÃ HOÀN TẤT THÀNH CÔNG! ===")

if __name__ == "__main__":
    main()
