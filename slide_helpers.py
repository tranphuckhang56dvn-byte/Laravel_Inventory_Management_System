# -*- coding: utf-8 -*-
"""
Tập lệnh xây dựng Slide Thuyết trình PowerPoint (16:9 Widescreen)
Đề tài: XÂY DỰNG HỆ THỐNG QUẢN LÝ NHẬP - XUẤT - TỒN KHO ỨNG DỤNG LARAVEL FRAMEWORK & RESTFUL API
Trường Cao đẳng Lý Tự Trọng TP.HCM - Khoa Công nghệ Thông tin
Sinh viên: Thái Anh Kiệt & Trần Phúc Khang - GVHD: Th.S. Mai Chiếm Tuấn
"""

import os
import sys
from pptx import Presentation
from pptx.util import Inches, Pt
from pptx.enum.text import PP_ALIGN
from pptx.dml.color import RGBColor
from pptx.enum.shapes import MSO_SHAPE

PPTX_PATH = r"E:\Laravel_Inventory_Management_System\SLIDE_BAO_CAO_DO_AN.pptx"
PDF_PATH = r"E:\Laravel_Inventory_Management_System\SLIDE_BAO_CAO_DO_AN.pdf"

# Định nghĩa hệ màu chuẩn (Professional Navy / Slate / Accent)
NAVY_DARK = RGBColor(15, 23, 42)      # #0F172A
NAVY_PRIMARY = RGBColor(30, 58, 138)  # #1E3A8A
BLUE_ACCENT = RGBColor(37, 99, 235)   # #2563EB
BLUE_LIGHT = RGBColor(219, 234, 254)  # #DBEAFE
CYAN_ACCENT = RGBColor(14, 165, 233)  # #0EA5E9
GREEN_ACCENT = RGBColor(16, 185, 129) # #10B981
GREEN_LIGHT = RGBColor(209, 250, 229) # #D1FAE5
AMBER_ACCENT = RGBColor(245, 158, 11) # #F59E0B
RED_ACCENT = RGBColor(239, 68, 68)    # #EF4444
RED_LIGHT = RGBColor(254, 226, 226)   # #FEE2E2
BG_LIGHT = RGBColor(248, 250, 252)    # #F8FAFC
CARD_BG = RGBColor(255, 255, 255)     # #FFFFFF
BORDER_COLOR = RGBColor(226, 232, 240)# #E2E8F0
TEXT_DARK = RGBColor(30, 41, 59)      # #1E293B
TEXT_MUTED = RGBColor(100, 116, 139)  # #64748B
TEXT_WHITE = RGBColor(255, 255, 255)  # #FFFFFF

FONT_MAIN = "Arial"

def set_slide_background(slide, color):
    bg_shape = slide.shapes.add_shape(MSO_SHAPE.RECTANGLE, 0, 0, Inches(13.333), Inches(7.5))
    bg_shape.fill.solid()
    bg_shape.fill.fore_color.rgb = color
    bg_shape.line.fill.background()
    # Gửi shape xuống dưới cùng không cần thiết nếu tạo đầu tiên

def add_header(slide, category_text, title_text, subtitle_text=None, is_dark=False):
    # Category Pill / Tag
    pill = slide.shapes.add_shape(MSO_SHAPE.ROUNDED_RECTANGLE, Inches(0.8), Inches(0.45), Inches(3.8), Inches(0.35))
    pill.fill.solid()
    pill.fill.fore_color.rgb = RGBColor(30, 41, 59) if is_dark else BLUE_LIGHT
    pill.line.fill.background()
    p = pill.text_frame.paragraphs[0]
    p.text = category_text.upper()
    p.alignment = PP_ALIGN.CENTER
    p.font.name = FONT_MAIN
    p.font.size = Pt(9.5)
    p.font.bold = True
    p.font.color.rgb = CYAN_ACCENT if is_dark else RGBColor(29, 78, 216)
    
    # Title Box
    title_box = slide.shapes.add_textbox(Inches(0.8), Inches(0.85), Inches(11.7), Inches(0.7))
    tf = title_box.text_frame
    tf.word_wrap = True
    tf.margin_left = tf.margin_top = tf.margin_right = tf.margin_bottom = 0
    p_t = tf.paragraphs[0]
    p_t.text = title_text
    p_t.font.name = FONT_MAIN
    p_t.font.size = Pt(22)
    p_t.font.bold = True
    p_t.font.color.rgb = TEXT_WHITE if is_dark else NAVY_DARK
    
    if subtitle_text:
        p_s = tf.add_paragraph()
        p_s.text = subtitle_text
        p_s.font.name = FONT_MAIN
        p_s.font.size = Pt(12)
        p_s.font.color.rgb = RGBColor(148, 163, 184) if is_dark else TEXT_MUTED

def add_card(slide, left, top, width, height, bg_color=CARD_BG, border_color=BORDER_COLOR):
    card = slide.shapes.add_shape(MSO_SHAPE.ROUNDED_RECTANGLE, left, top, width, height)
    card.fill.solid()
    card.fill.fore_color.rgb = bg_color
    if border_color:
        card.line.color.rgb = border_color
        card.line.width = Pt(1)
    else:
        card.line.fill.background()
    return card

def add_metric_badge(slide, left, top, width, height, value_text, label_text, sub_text=None, accent_color=BLUE_ACCENT):
    card = add_card(slide, left, top, width, height, bg_color=CARD_BG, border_color=BORDER_COLOR)
    tf = card.text_frame
    tf.word_wrap = True
    tf.margin_left = tf.margin_right = Inches(0.15)
    tf.margin_top = Inches(0.15)
    
    p0 = tf.paragraphs[0]
    p0.text = value_text
    p0.alignment = PP_ALIGN.CENTER
    p0.font.name = FONT_MAIN
    p0.font.size = Pt(24)
    p0.font.bold = True
    p0.font.color.rgb = accent_color
    
    p1 = tf.add_paragraph()
    p1.text = label_text
    p1.alignment = PP_ALIGN.CENTER
    p1.font.name = FONT_MAIN
    p1.font.size = Pt(11)
    p1.font.bold = True
    p1.font.color.rgb = NAVY_DARK
    
    if sub_text:
        p2 = tf.add_paragraph()
        p2.text = sub_text
        p2.alignment = PP_ALIGN.CENTER
        p2.font.name = FONT_MAIN
        p2.font.size = Pt(9.5)
        p2.font.color.rgb = TEXT_MUTED

def set_speaker_notes(slide, notes):
    notes_slide = slide.notes_slide
    tf = notes_slide.notes_text_frame
    tf.text = notes.strip()

print("Presentation helpers ready.")
