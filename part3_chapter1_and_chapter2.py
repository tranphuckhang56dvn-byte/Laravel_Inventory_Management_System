# -*- coding: utf-8 -*-
"""
Phần 3: Chương 1 (Tổng quan bài toán) và Chương 2 (Cơ sở lý thuyết & Công nghệ)
"""
import docx
from docx.shared import Inches, Pt, RGBColor
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.enum.table import WD_TABLE_ALIGNMENT
from report_builder_utils import set_cell_background, set_cell_margins, set_table_borders, add_callout, add_code_snippet

def build_chapter1_and_chapter2(doc, md):
    # ========================== CHƯƠNG 1 ==========================
    p_c1 = doc.add_paragraph()
    p_c1.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_c1.add_run("CHƯƠNG 1. TỔNG QUAN VỀ BÀI TOÁN QUẢN LÝ NHẬP - XUẤT - TỒN KHO\n")
    r.font.size = Pt(16)
    r.font.bold = True
    r.font.color.rgb = RGBColor(15, 23, 42)
    
    # 1.1
    p = doc.add_paragraph()
    r = p.add_run("1.1. Thực trạng và quy trình quản lý kho hàng trong doanh nghiệp\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Hoạt động quản lý kho hàng (Warehouse Management) là trung tâm điều phối của mọi chuỗi cung ứng hàng hóa vật chất trong doanh nghiệp. Một quy trình quản lý kho tiêu chuẩn bao gồm bốn phân hệ nghiệp vụ cơ bản: quản lý danh mục, tiếp nhận nhập kho, xử lý xuất kho và kiểm kê điều chỉnh số dư tồn kho định kỳ.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("1.1.1. Quy trình quản lý danh mục và nhà cung cấp\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Danh mục hàng hóa và hồ sơ nhà cung cấp là dữ liệu gốc (Master Data) của hệ thống. Mỗi sản phẩm được định danh bằng một mã lưu kho duy nhất (SKU - Stock Keeping Unit) và mã vạch (Barcode). Bên cạnh các thuộc tính định danh cơ bản (tên hàng, quy cách, đơn vị tính, danh mục phân loại), hai thông số kinh tế then chốt là giá vốn nhập dự kiến (purchase price) và giá xuất bán (selling price). Đặc biệt, hệ thống quy định ngưỡng tồn kho an toàn tối thiểu (min_stock) và ngưỡng tồn kho tối đa (max_stock) nhằm hỗ trợ doanh nghiệp tối ưu hóa lượng hàng lưu trữ, tránh lãng phí vốn lưu động hoặc thiếu hụt nguyên vật liệu đột ngột.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("1.1.2. Quy trình lập và xử lý phiếu nhập kho\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Nghiệp vụ nhập kho phát sinh khi doanh nghiệp mua thêm hàng hóa từ nhà cung cấp hoặc tiếp nhận hàng chuyển từ các chi nhánh khác về. Quy trình chuẩn đòi hỏi:\n"
        "1. Lập chứng từ phiếu nhập kho với mã số định danh chuẩn (ví dụ: PN-YYYYMMDD-XXXX), ghi nhận rõ thông tin đối tác cung cấp, ngày nhập hàng, diễn giải lý do và người lập phiếu.\n"
        "2. Kiểm đếm số lượng thực tế của từng mặt hàng nhập vào, xác nhận đơn giá vốn và thành tiền tương ứng.\n"
        "3. Tự động tính toán tổng giá trị phiếu nhập và cập nhật tăng số lượng tồn kho (current_stock) của các sản phẩm tương ứng trong cơ sở dữ liệu ngay khi hoàn tất xác nhận.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("1.1.3. Quy trình lập và xử lý phiếu xuất kho\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Nghiệp vụ xuất kho phát sinh nhằm phục vụ bán hàng thương mại cho khách hàng, xuất chuyển kho nội bộ hoặc xuất thanh lý/hủy hàng hóa hư hỏng. Khác với nghiệp vụ nhập, xuất kho đòi hỏi tính kiểm soát vô cùng khắt khe:\n"
        "1. Lập phiếu xuất kho với mã số chuẩn (PX-YYYYMMDD-XXXX), ghi nhận rõ tên đơn vị/khách hàng tiếp nhận, ngày xuất, lý do xuất (Xuất bán, Xuất chuyển kho, Xuất hủy, Xuất trả nhà cung cấp) và thủ kho giao hàng.\n"
        "2. Kiểm tra tính khả dụng của hàng hóa: Số lượng yêu cầu xuất phải nhỏ hơn hoặc bằng số lượng tồn kho thực tế hiện hành trong hệ thống.\n"
        "3. Cập nhật trừ số lượng tồn kho tương ứng và tạo lập biên bản giao nhận có đầy đủ chữ ký của người nhận hàng, thủ kho giao và kế toán phê duyệt.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("1.1.4. Quy trình kiểm kê định kỳ và điều chỉnh tồn kho\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Trong quá trình vận hành, số liệu ghi nhận trên phần mềm có thể phát sinh chênh lệch so với số lượng kiểm đếm thực tế tại kệ hàng do các nguyên nhân: hàng hóa bị thất thoát, hư hỏng trong quá trình bốc xếp, sai sót trong khâu giao nhận hoặc hao hụt tự nhiên. Do đó, định kỳ hàng tuần hoặc cuối tháng, thủ kho và ban quản lý phải tiến hành kiểm kê thực tế. Khi phát hiện chênh lệch, hệ thống phải cho phép Quản trị viên (Admin) lập biên bản kiểm kê và điều chỉnh số dư tồn kho (Stock Adjustment), đồng thời bắt buộc ghi chú rõ lý do sai lệch để phục vụ kiểm toán nội bộ.\n\n"
    )
    
    # 1.2
    p = doc.add_paragraph()
    r = p.add_run("1.2. Các hạn chế và thách thức của phương pháp thủ công\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Phương pháp quản lý kho truyền thống bằng sổ ghi chép tay hoặc sử dụng các file bảng tính Excel chia sẻ trên mạng nội bộ đã và đang bộc lộ những rủi ro cực kỳ lớn đối với sự an toàn hoạt động của doanh nghiệp:\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("1.2.1. Sai lệch số liệu và thiếu tính tức thời (Real-time)\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Khi nhập liệu thủ công qua sổ sách hoặc bảng tính, độ trễ về dữ liệu giữa thời điểm hàng thực xuất/nhập với thời điểm số liệu được ghi nhận vào báo cáo thường kéo dài từ vài giờ đến vài ngày. Điều này khiến cho người quản lý không thể nắm bắt chính xác số lượng tồn kho thực tế ở từng thời điểm, dẫn đến việc nhận đơn hàng vượt quá khả năng cung ứng hoặc từ chối các cơ hội kinh doanh vì lầm tưởng đã hết hàng.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("1.2.2. Xung đột đồng thời (Race Condition) và rủi ro âm kho\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Khi doanh nghiệp mở rộng quy mô với nhiều thủ kho cùng làm việc hoặc kết nối nhiều kênh bán hàng trực tuyến, tình huống xung đột giao dịch đồng thời xảy ra thường xuyên (Kumar & Sharma, 2022). Giả sử một mặt hàng trong kho chỉ còn lại đúng 5 sản phẩm. Tại cùng một giây, Thủ kho A lập phiếu xuất 5 sản phẩm cho Khách hàng 1 và Thủ kho B cũng lập phiếu xuất 5 sản phẩm cho Khách hàng 2. Nếu phần mềm không có cơ chế khóa độc quyền (Exclusive Lock), cả hai tiến trình sẽ cùng đọc được số tồn hiện tại là 5 (hợp lệ), sau đó cùng tiến hành trừ kho. Kết quả là 10 sản phẩm được xuất đi, tồn kho bị ghi đè thành 0 hoặc âm 5, gây thất thoát nghiêm trọng và tranh chấp kinh tế.\n\n"
    )
    
    add_callout(doc, "Hiện tượng Lost Update và Race Condition là nguyên nhân cốt lõi dẫn đến tình trạng kho bị âm. Để giải quyết triệt để vấn đề này, hệ thống bắt buộc phải áp dụng kỹ thuật Pessimistic Locking trong quá trình thực thi Database Transaction.", "Cảnh báo kỹ thuật")
    
    p = doc.add_paragraph()
    r = p.add_run("1.2.3. Khó khăn trong truy vết sai phạm (Audit Trail)\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Các bảng tính Excel truyền thống không thể cung cấp cơ chế lưu vết lịch sử đáng tin cậy. Bất kỳ ai có quyền truy cập file đều có thể chỉnh sửa số liệu tồn kho mà không để lại bất kỳ dấu vết nào. Khi xảy ra mất mát hàng hóa, ban giám đốc hoàn toàn không có cơ sở xác định ai đã thực hiện thay đổi, lúc mấy giờ, dựa trên chứng từ nào và vì lý do gì. Thiếu vắng nhật ký kiểm toán (Inventory Audit Log) là lỗ hổng nghiêm trọng trong quản trị rủi ro doanh nghiệp.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("1.2.4. Cảnh báo tồn kho dưới ngưỡng an toàn bị chậm trễ\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Trong phương pháp thủ công, nhân viên kho phải tự rà soát từng dòng dữ liệu bằng mắt thường để phát hiện các sản phẩm sắp hết hàng. Do khối lượng mặt hàng quản lý lên đến hàng trăm, hàng nghìn chủng loại, việc bỏ sót là không thể tránh khỏi. Hậu quả là doanh nghiệp chỉ phát hiện hết hàng khi đơn hàng xuất đi bị đình trệ, làm suy giảm uy tín với đối tác và khách hàng.\n\n"
    )
    
    # 1.3
    p = doc.add_paragraph()
    r = p.add_run("1.3. Đề xuất giải pháp xây dựng hệ thống trên nền tảng Web & RESTful API\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Nhằm khắc phục triệt để các tồn tại trên, nhóm nghiên cứu đề xuất xây dựng hệ thống phần mềm quản lý kho tập trung dựa trên kiến trúc Web Application và RESTful API hiện đại, vận hành trên nền tảng Laravel Framework và hệ quản trị cơ sở dữ liệu MySQL.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("1.3.1. Mô hình kiến trúc giải pháp\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Hệ thống được thiết kế theo kiến trúc phân tầng chuyên nghiệp (Multi-tier Architecture):\n"
        "- Tầng trình diễn (Presentation Layer): Giao diện Web được thiết kế theo phong cách hiện đại với HTML5, CSS3, JavaScript và Bootstrap 5, mang lại trải nghiệm mượt mà, trực quan trên mọi kích thước màn hình thiết bị.\n"
        "- Tầng nghiệp vụ (Business / Service Layer): Tách biệt toàn bộ logic xử lý giao dịch kho phức tạp vào một lớp dịch vụ độc lập (InventoryService), áp dụng chặt chẽ cơ chế Database Transaction và Pessimistic Locking.\n"
        "- Tầng dữ liệu (Data Access Layer): Sử dụng ORM Eloquent mạnh mẽ của Laravel kết hợp hệ quản trị cơ sở dữ liệu quan hệ MySQL, tối ưu hóa các chỉ mục (Indexes) để bảo đảm tốc độ truy vấn cao.\n"
        "- Tầng dịch vụ API (RESTful API Layer): Cung cấp bộ API chuẩn Stateless bảo mật bằng Laravel Sanctum Token, sẵn sàng phục vụ cho việc tích hợp hệ thống trong tương lai.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("1.3.2. Phạm vi và giới hạn của đề tài\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Phạm vi thực hiện của đề tài tập trung giải quyết trọn vẹn bài toán cốt lõi trong nội bộ kho hàng:\n"
        "- Quản lý tài khoản người dùng và phân quyền theo 2 vai trò chuẩn: Quản trị viên (Admin) và Nhân viên thủ kho (Staff).\n"
        "- Quản lý thông tin danh mục, nhà cung cấp, thông tin sản phẩm và ngưỡng min_stock.\n"
        "- Quy trình lập phiếu nhập kho, phiếu xuất kho, cập nhật số dư tồn kho thời gian thực với khóa bản ghi an toàn.\n"
        "- Hệ thống nhật ký kiểm toán biến động kho tự động (Inventory Audit Log).\n"
        "- Dashboard tổng quan, cảnh báo tự động sản phẩm dưới ngưỡng an toàn và biểu đồ thống kê Chart.js.\n"
        "- Giới hạn đề tài: Không bao gồm ứng dụng di động riêng biệt, không tích hợp cổng thanh toán trực tuyến hoặc các phân hệ kế toán tài chính phức tạp bên ngoài.\n\n"
    )
    
    doc.add_page_break()

    # ========================== CHƯƠNG 2 ==========================
    p_c2 = doc.add_paragraph()
    p_c2.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_c2.add_run("CHƯƠNG 2. CƠ SỞ LÝ THUYẾT VÀ CÔNG NGHỆ ỨNG DỤNG\n")
    r.font.size = Pt(16)
    r.font.bold = True
    r.font.color.rgb = RGBColor(15, 23, 42)
    
    # 2.1
    p = doc.add_paragraph()
    r = p.add_run("2.1. Framework Laravel và kiến trúc phần mềm\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Trong kỹ nghệ phần mềm hiện đại, việc lựa chọn một nền tảng framework vững chắc quyết định trực tiếp đến độ tin cậy, khả năng bảo trì và tốc độ phát triển dự án (Bass, Clements, & Kazman, 2021).\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("2.1.1. Tổng quan về Laravel Framework và PHP 8.3\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Laravel là framework phát triển ứng dụng Web mã nguồn mở phổ biến hàng đầu thế giới dành cho ngôn ngữ PHP, được sáng lập bởi Taylor Otwell (Otwell, 2024). Hệ thống của đề tài được xây dựng trên phiên bản Laravel hiện đại chạy trên môi trường PHP 8.3. Sự kết hợp này mang lại những ưu thế vượt trội:\n"
        "- Công cụ dòng lệnh Artisan Command Line Interface giúp tự động hóa các tác vụ tạo cấu trúc mã nguồn, thực thi Migration và quản lý Seeder.\n"
        "- Hệ thống ORM Eloquent hiện đại, chuyển hóa các bảng dữ liệu quan hệ thành các lớp đối tượng trực quan, hỗ trợ thiết lập quan hệ (Relationships) như one-to-many, belongs-to và query scopes.\n"
        "- Cơ chế Dependency Injection và Service Container quản lý vòng đời đối tượng linh hoạt, hỗ trợ tối đa cho việc kiểm thử tự động.\n"
        "- Động cơ Blade Template Engine mạnh mẽ, tái sử dụng các layout giao diện và bảo vệ chống tấn công Cross-Site Scripting (XSS).\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("2.1.2. Mô hình MVC (Model - View - Controller)\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Kiến trúc Model - View - Controller phân chia ứng dụng thành 3 thành phần có trách nhiệm hoàn toàn độc lập:\n"
        "- Model: Đại diện cho cấu trúc dữ liệu và các quy tắc nghiệp vụ gắn liền với bảng CSDL (ví dụ: Product, GoodsReceipt, InventoryLog).\n"
        "- View: Chịu trách nhiệm hiển thị giao diện đồ họa đến người dùng cuối thông qua các template Blade HTML.\n"
        "- Controller: Đóng vai trò điều phối luồng, tiếp nhận các yêu cầu HTTP từ Router, gọi xử lý nghiệp vụ và trả về kết quả tương ứng (View hoặc JSON Response).\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("2.1.3. Mẫu thiết kế Service Layer Pattern trong xử lý kho\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Nếu toàn bộ nghiệp vụ kiểm tra số lượng tồn, mở Transaction, khóa bản ghi và ghi Audit Log được đặt trực tiếp trong Controller, mã nguồn sẽ trở nên cồng kềnh, vi phạm nguyên lý Single Responsibility (SRP) và không thể tái sử dụng cho cả giao diện Web lẫn RESTful API. Do đó, hệ thống áp dụng mẫu thiết kế Service Layer Pattern với lớp trung tâm "
    )
    p.add_run("App\\Services\\InventoryService").font.bold = True
    p.add_run(
        ". Cả Web Controller và API Controller đều gọi chung đến InventoryService, đảm bảo tính nhất quán nghiệp vụ 100% trong toàn bộ ứng dụng.\n\n"
    )
    
    p_fig1 = doc.add_paragraph()
    p_fig1.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_fig1.add_run("Hình 1: Mô hình kiến trúc phân tầng MVC kết hợp Service Layer Pattern trong hệ thống WMS\n")
    r.font.italic = True
    r.font.size = Pt(11)
    
    # 2.2
    p = doc.add_paragraph()
    r = p.add_run("2.2. Kiểm soát giao dịch đồng thời (Concurrency Control)\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Trong môi trường mạng có nhiều người dùng thao tác song song, kiểm soát giao dịch đồng thời là bài toán phức tạp và quan trọng bậc nhất trong khoa học cơ sở dữ liệu (Silberschatz, Korth, & Sudarshan, 2020).\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("2.2.1. Khái niệm Giao dịch (Transaction) và thuộc tính ACID\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Một giao dịch (Database Transaction) là một chuỗi các thao tác cơ sở dữ liệu được đối xử như một đơn vị xử lý không thể chia cắt. Một hệ thống giao dịch chuẩn mực phải đáp ứng đầy đủ bốn tiêu chuẩn ACID (Silberschatz et al., 2020):\n"
        "- Atomicity (Tính nguyên tử): Toàn bộ các thao tác (lập phiếu, trừ tồn, ghi log) phải thành công trọn vẹn cùng nhau. Nếu một thao tác thất bại, toàn bộ quá trình phải được Rollback về trạng thái ban đầu như chưa từng xảy ra.\n"
        "- Consistency (Tính nhất quán): Dữ liệu trước và sau giao dịch luôn luôn phải thỏa mãn toàn bộ các ràng buộc toàn vẹn (tồn kho không được âm, mã chứng từ là duy nhất).\n"
        "- Isolation (Tính cô lập): Các giao dịch thực thi đồng thời không được nhìn thấy dữ liệu trung gian chưa commit của nhau.\n"
        "- Durability (Tính bền vững): Khi giao dịch đã hoàn tất thành công (Commit), kết quả sẽ được lưu trữ vĩnh viễn trên ổ đĩa vật lý ngay cả khi hệ thống gặp sự cố mất điện đột ngột.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("2.2.2. Hiện tượng Race Condition và Lost Update trong ứng dụng kho vận\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Xét bài toán kinh điển trong quản lý kho (Jagadeesan & Parthasarathy, 2021):\n"
        "Sản phẩm A có số lượng tồn kho hiện tại là 10 đơn vị. Hai giao dịch T1 và T2 cùng lúc yêu cầu xuất hàng:\n"
        "- Tại thời điểm t1: Giao dịch T1 đọc số tồn kho của A: S1 = 10. Yêu cầu xuất 6.\n"
        "- Tại thời điểm t2: Giao dịch T2 đọc số tồn kho của A: S2 = 10. Yêu cầu xuất 7.\n"
        "- Tại thời điểm t3: T1 kiểm tra S1 >= 6 (thỏa mãn), tính toán tồn mới = 10 - 6 = 4 và cập nhật S = 4.\n"
        "- Tại thời điểm t4: T2 kiểm tra S2 >= 7 (thỏa mãn trên dữ liệu cũ), tính toán tồn mới = 10 - 7 = 3 và cập nhật đè S = 3.\n"
        "Hậu quả: Doanh nghiệp đã xuất đi 13 sản phẩm trong khi kho chỉ có 10. Thao tác của T1 hoàn toàn bị ghi đè (Lost Update) và dẫn đến thất thoát hàng thực tế.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("2.2.3. Phân tích so sánh Optimistic Locking và Pessimistic Locking\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Để giải quyết xung đột tương tranh, hai trường phái kỹ thuật chính được áp dụng rộng rãi:\n"
        "- Khóa lạc quan (Optimistic Locking): Giả định xung đột hiếm khi xảy ra. Hệ thống sử dụng một cột phiên bản (version/timestamp). Khi cập nhật, hệ thống kiểm tra xem số phiên bản có bị thay đổi hay không; nếu đã bị giao dịch khác sửa trước, giao dịch hiện tại sẽ thất bại và yêu cầu người dùng thử lại từ đầu.\n"
        "- Khóa bi quan (Pessimistic Locking): Giả định xung đột có nguy cơ xảy ra rất cao. Ngay khi giao dịch đọc bản ghi để chuẩn bị thao tác, hệ thống sẽ đặt ngay một khóa độc quyền (Exclusive Lock) lên hàng dữ liệu đó ở mức động cơ CSDL. Mọi giao dịch khác cố gắng truy cập vào bản ghi này sẽ bị cưỡng chế chờ (Blocked) cho đến khi giao dịch trước Commit hoặc Rollback xong (Kumar & Sharma, 2022).\n\n"
    )
    
    # Bảng 1: So sánh Locking
    tbl_comp = doc.add_table(rows=6, cols=3)
    tbl_comp.alignment = WD_TABLE_ALIGNMENT.CENTER
    set_table_borders(tbl_comp)
    
    headers = ["Tiêu chí đánh giá", "Optimistic Locking (Khóa lạc quan)", "Pessimistic Locking (Khóa bi quan)"]
    for i, h in enumerate(headers):
        c = tbl_comp.cell(0, i)
        set_cell_background(c, "E2E8F0")
        set_cell_margins(c, 100, 100, 140, 140)
        p = c.paragraphs[0]
        p.alignment = WD_ALIGN_PARAGRAPH.CENTER
        p.add_run(h).font.bold = True
        
    comp_rows = [
        ("Cơ chế hoạt động", "Kiểm tra phiên bản dữ liệu (version) tại bước Commit", "Khóa hàng trực tiếp trong CSDL (SELECT ... FOR UPDATE)"),
        ("Mức độ can thiệp CSDL", "Không giữ khóa vật lý trên hàng", "Giữ Exclusive Lock trên bản ghi trong suốt Transaction"),
        ("Khả năng chống âm kho", "Thấp hơn khi giao dịch dồn dập (dễ gây lỗi exception)", "Tuyệt đối an toàn 100%, tuần tự hóa giao dịch trên bản ghi"),
        ("Trải nghiệm người dùng", "Người dùng đến sau thường bị báo lỗi và phải gõ lại", "Hệ thống tự động xếp hàng chờ và xử lý mượt mà"),
        ("Ứng dụng phù hợp", "Hệ thống đọc nhiều, ít ghi (Blog, CMS)", "Hệ thống tài chính, ngân hàng, quản lý kho hàng (WMS)"),
    ]
    
    for r_idx, (c0, c1, c2) in enumerate(comp_rows):
        row = tbl_comp.rows[r_idx + 1]
        for c_idx, val in enumerate([c0, c1, c2]):
            cell = row.cells[c_idx]
            set_cell_margins(cell, 80, 80, 120, 120)
            p = cell.paragraphs[0]
            if c_idx == 0:
                p.add_run(val).font.bold = True
            else:
                p.add_run(val)
                
    p_tbl1 = doc.add_paragraph()
    p_tbl1.alignment = WD_ALIGN_PARAGRAPH.CENTER
    r = p_tbl1.add_run("\nBảng 1: So sánh đặc tính giữa Optimistic Locking và Pessimistic Locking\n")
    r.font.italic = True
    r.font.size = Pt(11)
    
    p = doc.add_paragraph()
    r = p.add_run("2.2.4. Ứng dụng Pessimistic Locking (lockForUpdate) trong Laravel\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Nhận thấy tính chất đặc thù của kho hàng đòi hỏi sự chính xác tuyệt đối, đề tài đã quyết định lựa chọn giải pháp Pessimistic Locking. Trong Laravel Eloquent, phương thức "
    )
    p.add_run("Product::where('id', $id)->lockForUpdate()->firstOrFail()").font.bold = True
    p.add_run(
        " được gọi bên trong khối "
    )
    p.add_run("DB::transaction()").font.bold = True
    p.add_run(
        ". Cú pháp này được biên dịch thành câu truy vấn SQL: "
    )
    p.add_run("SELECT * FROM products WHERE id = ? FOR UPDATE;").font.bold = True
    p.add_run(
        ". Khi một giao dịch đang thực thi, bất kỳ luồng nào khác muốn xuất hoặc nhập hàng cùng sản phẩm này đều phải chờ giao dịch hiện tại hoàn tất, từ đó loại trừ hoàn toàn khả năng hàng hóa bị âm kho.\n\n"
    )
    
    # 2.3
    p = doc.add_paragraph()
    r = p.add_run("2.3. Xác thực và bảo mật RESTful API với Laravel Sanctum\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Trong xu hướng phát triển ứng dụng phân tán hiện đại, các dịch vụ web backend được thiết kế tách biệt khỏi giao diện người dùng, cung cấp các chuẩn giao tiếp qua mạng dựa trên giao thức REST (Fielding, 2000; Richardson & Ruby, 2007).\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("2.3.1. Tổng quan về kiến trúc RESTful API\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Kiến trúc REST (Representational State Transfer) định nghĩa việc tương tác với các tài nguyên (Resources) thông qua các URI chuẩn và các động từ HTTP tương ứng:\n"
        "- GET: Truy vấn lấy thông tin tài nguyên (idempotent, an toàn).\n"
        "- POST: Tạo mới một tài nguyên.\n"
        "- PUT / PATCH: Cập nhật toàn bộ hoặc từng phần thông tin tài nguyên.\n"
        "- DELETE: Xóa bỏ tài nguyên khỏi hệ thống.\n"
        "Tính chất phi trạng thái (Statelessness) của REST quy định rằng mỗi yêu cầu từ máy khách (Client) phải chứa đầy đủ mọi thông tin cần thiết để máy chủ (Server) nhận diện và xử lý độc lập mà không dựa vào Session lưu tạm trên bộ nhớ máy chủ.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("2.3.2. Cơ chế xác thực Bearer Token của Laravel Sanctum\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Laravel Sanctum cung cấp hệ thống xác thực Stateless Token cực kỳ nhẹ nhàng nhưng bảo mật tuyệt đối. Khi người dùng gửi yêu cầu xác thực tại "
    )
    p.add_run("POST /api/auth/login").font.bold = True
    p.add_run(
        ", hệ thống kiểm tra mật khẩu qua Hash::check(). Nếu hợp lệ, Sanctum sinh ra một chuỗi Access Token ngẫu nhiên (dạng: {id}|{plainTextToken}), sau đó lưu mã băm SHA-256 vào bảng "
    )
    p.add_run("personal_access_tokens").font.bold = True
    p.add_run(
        " và trả về chuỗi Token gốc cho người dùng. Trong các yêu cầu kế tiếp, Client chỉ cần truyền header HTTP: "
    )
    p.add_run("Authorization: Bearer <access_token>").font.bold = True
    p.add_run(
        ". Khi người dùng đăng xuất, Token tương ứng sẽ bị xóa vĩnh viễn khỏi CSDL, đảm bảo thu hồi quyền truy cập an toàn.\n\n"
    )
    
    # 2.4
    p = doc.add_paragraph()
    r = p.add_run("2.4. Mô hình phân quyền truy cập theo vai trò (RBAC)\n")
    r.font.size = Pt(14)
    r.font.bold = True
    p.add_run(
        "Kiểm soát truy cập là yêu cầu an toàn thông tin bắt buộc trong mọi hệ thống phần mềm doanh nghiệp (Nguyen & Le, 2023).\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("2.4.1. Lý thuyết kiểm soát truy cập theo vai trò (Role-Based Access Control)\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Mô hình RBAC gán các quyền hạn cụ thể cho từng vai trò nghiệp vụ (Role), sau đó gán vai trò đó cho người dùng. Cách tiếp cận này giúp việc quản trị phân quyền trở nên minh bạch và dễ bảo trì. Trong hệ thống WMS của đề tài, hai vai trò chính được thiết lập:\n"
        "1. Quản trị viên (Admin): Có quyền tối cao trên toàn hệ thống. Quản lý người dùng, đổi mật khẩu, phân chia vai trò, xóa bỏ sản phẩm/danh mục/nhà cung cấp và là người duy nhất có quyền thực hiện chức năng Kiểm kê & Điều chỉnh số lượng tồn kho (Stock Adjustment).\n"
        "2. Nhân viên thủ kho (Staff): Có quyền xem bảng điều khiển Dashboard, quản lý danh sách sản phẩm, lập phiếu nhập kho, lập phiếu xuất kho và tra cứu nhật ký biến động kho. Nhân viên kho bị ngăn chặn truy cập vào phân hệ quản lý tài khoản người dùng và không được phép xóa bỏ dữ liệu lịch sử.\n\n"
    )
    
    p = doc.add_paragraph()
    r = p.add_run("2.4.2. Hiện thực Middleware phân quyền trong hệ thống\n")
    r.font.size = Pt(13)
    r.font.bold = True
    r.font.italic = True
    p.add_run(
        "Hệ thống hiện thực một Middleware tùy biến "
    )
    p.add_run("App\\Http\\Middleware\\CheckRole").font.bold = True
    p.add_run(
        ". Khi một yêu cầu được gửi tới, Middleware sẽ kiểm tra trạng thái kích hoạt tài khoản ($user->status) và so khớp vai trò ($user->role) với danh sách vai trò được phép truy cập của Route. Nếu không hợp lệ, hệ thống sẽ chặn đứng và trả về mã lỗi 403 Forbidden (dưới dạng trang báo lỗi trên Web hoặc JSON Response trên API).\n\n"
    )
    
    # 2.5
    p = doc.add_paragraph()
    r = p.add_run("2.5. Hệ quản trị CSDL MySQL trên môi trường XAMPP và công cụ Chart.js\n")
    r.font.size = Pt(14)
    r.font.bold = True
    
    p2 = doc.add_paragraph()
    r1 = p2.add_run("2.5.1. Môi trường XAMPP và hệ quản trị MariaDB / MySQL:\n")
    r1.font.bold = True
    r1.font.italic = True
    p2.add_run(
        "XAMPP là bộ phần mềm môi trường máy chủ phổ biến bậc nhất, tích hợp hoàn hảo giữa máy chủ web Apache, hệ quản trị cơ sở dữ liệu quan hệ MariaDB/MySQL và trình biên dịch PHP. Dự án sử dụng hệ quản trị MySQL trên cổng chuẩn 3306, cơ sở dữ liệu do_an_kho được cấu hình bảng mã utf8mb4_unicode_ci hỗ trợ đầy đủ ký tự tiếng Việt có dấu. Động cơ lưu trữ InnoDB hỗ trợ triệt để chuẩn giao dịch ACID và khóa bản ghi cấp độ hàng (Row-level Locking).\n\n"
    )
    
    p3 = doc.add_paragraph()
    r2 = p3.add_run("2.5.2. Thư viện biểu đồ Chart.js:\n")
    r2.font.bold = True
    r2.font.italic = True
    p3.add_run(
        "Chart.js là thư viện đồ họa mã nguồn mở dựa trên phần tử HTML5 Canvas. Thư viện cung cấp khả năng dựng hình biểu đồ tương tác cao, mượt mà và co giãn tự động theo kích thước màn hình thiết bị (Responsive). Hệ thống tích hợp Chart.js để hiển thị trực quan biểu đồ cột ghép thể hiện xu hướng giá trị Nhập kho và Xuất kho qua 6 tháng gần nhất, cùng với biểu đồ tròn Doughnut thể hiện cơ cấu tỷ trọng sản phẩm theo từng danh mục hàng hóa.\n\n"
    )
    
    doc.add_page_break()

print("Part 3 module loaded.")
