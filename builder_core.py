# -*- coding: utf-8 -*-
"""
Tập lệnh chính tạo Báo cáo Đồ án Chuyên ngành chuẩn mẫu
Trường Cao đẳng Lý Tự Trọng Thành Phố Hồ Chí Minh
Khoa: Công nghệ Thông tin
Lớp: 25C2-LTM1 - Khóa: 2025
Sinh viên: Thái Anh Kiệt & Trần Phúc Khang
GVHD: Th.S. Mai Chiếm Tuấn
"""

import os
import sys
import docx
from docx.shared import Inches, Pt, RGBColor
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.enum.table import WD_TABLE_ALIGNMENT, WD_ALIGN_VERTICAL
from docx.oxml import OxmlElement, parse_xml
from docx.oxml.ns import nsdecls, qn

from report_builder_utils import set_cell_background, set_cell_margins, set_table_borders, add_callout, add_code_snippet

DOCX_FILE = r"E:\Laravel_Inventory_Management_System\BAO_CAO_DO_AN_CHUYEN_NGANH.docx"
MD_FILE = r"E:\Laravel_Inventory_Management_System\BAO_CAO_DO_AN_CHUYEN_NGANH.md"
PDF_FILE = r"E:\Laravel_Inventory_Management_System\BAO_CAO_DO_AN_CHUYEN_NGANH.pdf"

md_output = []

def log_md(text=""):
    md_output.append(text)

def create_styled_doc():
    doc = docx.Document()
    
    # Canh lề chuẩn: Trái 3cm, Phải 2cm, Trên 2cm, Dưới 2cm
    for s in doc.sections:
        s.top_margin = Inches(0.79)
        s.bottom_margin = Inches(0.79)
        s.left_margin = Inches(1.18)
        s.right_margin = Inches(0.79)
        s.page_width = Inches(8.27)  # A4
        s.page_height = Inches(11.69)
        
    normal = doc.styles['Normal']
    normal.font.name = 'Times New Roman'
    normal.font.size = Pt(13)
    normal.font.color.rgb = RGBColor(0, 0, 0)
    normal.paragraph_format.line_spacing = 1.3
    normal.paragraph_format.space_after = Pt(6)
    normal.paragraph_format.alignment = WD_ALIGN_PARAGRAPH.JUSTIFY
    
    return doc

print("Init styled doc function.")
