<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\GoodsIssue;
use App\Models\GoodsIssueItem;
use App\Models\GoodsReceipt;
use App\Models\GoodsReceiptItem;
use App\Models\InventoryLog;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Tạo Users phân quyền RBAC
        $admin = User::create([
            'name' => 'Thái Anh Kiệt (Admin)',
            'email' => 'admin@kho.vn',
            'phone' => '0901234567',
            'role' => 'admin',
            'status' => true,
            'password' => Hash::make('admin123'),
        ]);

        $staff1 = User::create([
            'name' => 'Trần Phúc Khang (Thủ kho)',
            'email' => 'staff@kho.vn',
            'phone' => '0907654321',
            'role' => 'staff',
            'status' => true,
            'password' => Hash::make('staff123'),
        ]);

        $staff2 = User::create([
            'name' => 'Nguyễn Văn An (Thủ kho phụ)',
            'email' => 'nhanvien@kho.vn',
            'phone' => '0918889999',
            'role' => 'staff',
            'status' => true,
            'password' => Hash::make('password'),
        ]);

        // 2. Tạo Danh mục (Categories)
        $catElectronics = Category::create([
            'code' => 'CAT-DT',
            'name' => 'Thiết bị Điện tử & Viễn thông',
            'description' => 'Điện thoại, máy tính bảng, router wifi, switch mạng...',
            'status' => true,
        ]);

        $catComponents = Category::create([
            'code' => 'CAT-LK',
            'name' => 'Linh kiện & Phụ kiện PC',
            'description' => 'RAM, ổ cứng SSD, chuột, bàn phím, màn hình...',
            'status' => true,
        ]);

        $catOffice = Category::create([
            'code' => 'CAT-VP',
            'name' => 'Thiết bị & Văn phòng phẩm',
            'description' => 'Máy in, giấy in, máy chấm công, mực in...',
            'status' => true,
        ]);

        $catPacking = Category::create([
            'code' => 'CAT-DG',
            'name' => 'Vật tư & Đóng gói',
            'description' => 'Thùng carton, màng PE, băng dính đóng hàng...',
            'status' => true,
        ]);

        // 3. Tạo Nhà cung cấp (Suppliers)
        $supFPT = Supplier::create([
            'code' => 'NCC-FPT',
            'name' => 'Công ty TNHH Phân phối Synnex FPT',
            'phone' => '028 7300 6666',
            'email' => 'fpt.synnex@fpt.com.vn',
            'address' => 'Tòa nhà FPT, Khu CNC, TP. Thủ Đức, TP.HCM',
            'status' => true,
        ]);

        $supDGW = Supplier::create([
            'code' => 'NCC-DGW',
            'name' => 'Tập đoàn Thế Giới Số Digiworld',
            'phone' => '028 3929 0059',
            'email' => 'contact@digiworld.com.vn',
            'address' => '195 Hai Bà Trưng, Phường Võ Thị Sáu, Quận 3, TP.HCM',
            'status' => true,
        ]);

        $supMaiHoang = Supplier::create([
            'code' => 'NCC-MH',
            'name' => 'Công ty Tin học & Công nghệ Mai Hoàng',
            'phone' => '024 3537 7109',
            'email' => 'sales@maihoang.com.vn',
            'address' => '241 Phố Vọng, Hai Bà Trưng, Hà Nội',
            'status' => true,
        ]);

        $supTanPhat = Supplier::create([
            'code' => 'NCC-TP',
            'name' => 'Công ty Sản xuất Bao bì Tân Phát Đạt',
            'phone' => '0912 345 678',
            'email' => 'info@tanphatdat.vn',
            'address' => 'Lô C2 KCN Tân Bình, Tân Phú, TP.HCM',
            'status' => true,
        ]);

        // 4. Tạo Sản phẩm (Products)
        $productsData = [
            [
                'sku' => 'SP-SSD-512',
                'barcode' => '893850123001',
                'name' => 'Ổ cứng SSD Kingston NV2 512GB PCIe 4.0 NVMe',
                'category_id' => $catComponents->id,
                'supplier_id' => $supMaiHoang->id,
                'unit' => 'Chiếc',
                'purchase_price' => 850000,
                'selling_price' => 1100000,
                'current_stock' => 45,
                'min_stock' => 10,
                'max_stock' => 200,
                'description' => 'Tốc độ đọc 3500MB/s, ghi 2100MB/s. Bảo hành 36 tháng.',
                'status' => true,
            ],
            [
                'sku' => 'SP-RAM-16G',
                'barcode' => '893850123002',
                'name' => 'RAM Corsair Vengeance LPX 16GB (1x16GB) DDR4 3200MHz',
                'category_id' => $catComponents->id,
                'supplier_id' => $supMaiHoang->id,
                'unit' => 'Thanh',
                'purchase_price' => 780000,
                'selling_price' => 990000,
                'current_stock' => 30,
                'min_stock' => 8,
                'max_stock' => 150,
                'description' => 'Tản nhiệt nhôm đen nguyên khối, độ trễ CL16 tối ưu cho chơi game và đồ họa.',
                'status' => true,
            ],
            [
                'sku' => 'SP-CHUOT-G102',
                'barcode' => '893850123003',
                'name' => 'Chuột Gaming Logitech G102 Lightsync RGB',
                'category_id' => $catComponents->id,
                'supplier_id' => $supDGW->id,
                'unit' => 'Con',
                'purchase_price' => 310000,
                'selling_price' => 420000,
                'current_stock' => 3, // DƯỚI NGƯỠNG MIN_STOCK (Cảnh báo!)
                'min_stock' => 10,
                'max_stock' => 100,
                'description' => 'Cảm biến 8000 DPI, LED RGB 16.8 triệu màu, 6 nút bấm lập trình.',
                'status' => true,
            ],
            [
                'sku' => 'SP-PHIM-K68',
                'barcode' => '893850123004',
                'name' => 'Bàn phím cơ DareU EK87 Red Switch',
                'category_id' => $catComponents->id,
                'supplier_id' => $supMaiHoang->id,
                'unit' => 'Chiếc',
                'purchase_price' => 450000,
                'selling_price' => 590000,
                'current_stock' => 2, // DƯỚI NGƯỠNG MIN_STOCK (Cảnh báo!)
                'min_stock' => 8,
                'max_stock' => 80,
                'description' => 'Thiết kế tenkeyless gọn gàng, Red Switch êm ái, LED rainbow.',
                'status' => true,
            ],
            [
                'sku' => 'SP-ROUTER-AX1800',
                'barcode' => '893850123005',
                'name' => 'Bộ phát Wifi 6 TP-Link Archer AX23 Chuẩn AX1800',
                'category_id' => $catElectronics->id,
                'supplier_id' => $supFPT->id,
                'unit' => 'Bộ',
                'purchase_price' => 920000,
                'selling_price' => 1250000,
                'current_stock' => 18,
                'min_stock' => 5,
                'max_stock' => 60,
                'description' => 'Băng tần kép Gigabit Wi-Fi 6 thế hệ mới, hỗ trợ OneMesh phủ sóng rộng.',
                'status' => true,
            ],
            [
                'sku' => 'SP-SWITCH-24P',
                'barcode' => '893850123006',
                'name' => 'Switch mạng Cisco CBS110-24T Unmanaged 24 cổng Gigabit',
                'category_id' => $catElectronics->id,
                'supplier_id' => $supFPT->id,
                'unit' => 'Cái',
                'purchase_price' => 2400000,
                'selling_price' => 2950000,
                'current_stock' => 1, // DƯỚI NGƯỠNG MIN_STOCK (Cảnh báo!)
                'min_stock' => 4,
                'max_stock' => 30,
                'description' => '24 Port 10/100/1000Mbps, cắm là chạy, khung kim loại chuẩn rack 1U.',
                'status' => true,
            ],
            [
                'sku' => 'SP-MAYIN-CANON',
                'barcode' => '893850123007',
                'name' => 'Máy in Laser đơn năng Canon LBP2900',
                'category_id' => $catOffice->id,
                'supplier_id' => $supDGW->id,
                'unit' => 'Máy',
                'purchase_price' => 3800000,
                'selling_price' => 4450000,
                'current_stock' => 8,
                'min_stock' => 3,
                'max_stock' => 25,
                'description' => 'Huyền thoại in đen trắng khổ A4, hộp mực Cartridge 303 bền bỉ dễ thay thế.',
                'status' => true,
            ],
            [
                'sku' => 'SP-GIAY-A4-70',
                'barcode' => '893850123008',
                'name' => 'Thùng Giấy in Double A Khổ A4 Định lượng 70gsm (5 Ram)',
                'category_id' => $catOffice->id,
                'supplier_id' => $supTanPhat->id,
                'unit' => 'Thùng',
                'purchase_price' => 320000,
                'selling_price' => 385000,
                'current_stock' => 60,
                'min_stock' => 15,
                'max_stock' => 300,
                'description' => 'Độ trắng sáng cao, không kẹt giấy, phù hợp tất cả các dòng máy photocopy và in laser.',
                'status' => true,
            ],
            [
                'sku' => 'SP-THUNG-CARTON-M',
                'barcode' => '893850123009',
                'name' => 'Thùng Carton 3 lớp 30x20x15cm (Đóng hàng TMĐT)',
                'category_id' => $catPacking->id,
                'supplier_id' => $supTanPhat->id,
                'unit' => 'Cái',
                'purchase_price' => 3500,
                'selling_price' => 5000,
                'current_stock' => 450,
                'min_stock' => 100,
                'max_stock' => 2000,
                'description' => 'Sóng B cứng cáp chịu va đập tốt khi vận chuyển bưu điện, Shopee, Lazada.',
                'status' => true,
            ],
            [
                'sku' => 'SP-BANGDINH-1KG',
                'barcode' => '893850123010',
                'name' => 'Cuộn Băng dính OPP trong suốt 1kg (Cây 6 cuộn)',
                'category_id' => $catPacking->id,
                'supplier_id' => $supTanPhat->id,
                'unit' => 'Cây',
                'purchase_price' => 120000,
                'selling_price' => 155000,
                'current_stock' => 4, // DƯỚI NGƯỠNG MIN_STOCK (Cảnh báo!)
                'min_stock' => 10,
                'max_stock' => 100,
                'description' => 'Keo dính chắc dai không đứt giữa chừng, chuyên dụng cho xưởng đóng gói.',
                'status' => true,
            ],
        ];

        $createdProducts = [];
        foreach ($productsData as $pData) {
            $createdProducts[] = Product::create($pData);
        }

        // 5. Tạo dữ liệu Phiếu nhập và Phiếu xuất mẫu (Lịch sử giao dịch 3 tháng gần nhất)
        $today = Carbon::now();

        // Giao dịch tháng trước
        $pn1 = GoodsReceipt::create([
            'code' => 'PN-20260910-0001',
            'supplier_id' => $supMaiHoang->id,
            'user_id' => $staff1->id,
            'receipt_date' => $today->copy()->subMonths(1)->day(10)->toDateString(),
            'total_amount' => 42500000,
            'status' => 'completed',
            'note' => 'Nhập lô SSD Kingston 512GB và RAM Corsair phục vụ dự án đối tác',
        ]);

        GoodsReceiptItem::create([
            'goods_receipt_id' => $pn1->id,
            'product_id' => $createdProducts[0]->id, // SSD
            'quantity' => 30,
            'unit_price' => 850000,
            'total_price' => 25500000,
            'note' => 'Lô hàng chuẩn tem bảo hành',
        ]);

        GoodsReceiptItem::create([
            'goods_receipt_id' => $pn1->id,
            'product_id' => $createdProducts[1]->id, // RAM
            'quantity' => 20,
            'unit_price' => 850000,
            'total_price' => 17000000,
            'note' => 'Hàng nguyên seal',
        ]);

        InventoryLog::create([
            'product_id' => $createdProducts[0]->id,
            'user_id' => $staff1->id,
            'type' => 'in',
            'reference_type' => 'receipt',
            'reference_id' => $pn1->id,
            'reference_code' => $pn1->code,
            'quantity_before' => 15,
            'quantity_change' => 30,
            'quantity_after' => 45,
            'unit_price' => 850000,
            'note' => 'Nhập kho theo phiếu '.$pn1->code,
            'created_at' => $today->copy()->subMonths(1)->day(10),
        ]);

        InventoryLog::create([
            'product_id' => $createdProducts[1]->id,
            'user_id' => $staff1->id,
            'type' => 'in',
            'reference_type' => 'receipt',
            'reference_id' => $pn1->id,
            'reference_code' => $pn1->code,
            'quantity_before' => 10,
            'quantity_change' => 20,
            'quantity_after' => 30,
            'unit_price' => 850000,
            'note' => 'Nhập kho theo phiếu '.$pn1->code,
            'created_at' => $today->copy()->subMonths(1)->day(10),
        ]);

        // Phiếu nhập tháng này
        $pn2 = GoodsReceipt::create([
            'code' => 'PN-20261015-0002',
            'supplier_id' => $supFPT->id,
            'user_id' => $admin->id,
            'receipt_date' => $today->copy()->day(15)->toDateString(),
            'total_amount' => 18400000,
            'status' => 'completed',
            'note' => 'Nhập bổ sung Router Wifi 6 TP-Link AX23',
        ]);

        GoodsReceiptItem::create([
            'goods_receipt_id' => $pn2->id,
            'product_id' => $createdProducts[4]->id, // Router
            'quantity' => 20,
            'unit_price' => 920000,
            'total_price' => 18400000,
            'note' => 'Hàng phân phối FPT chính hãng',
        ]);

        InventoryLog::create([
            'product_id' => $createdProducts[4]->id,
            'user_id' => $admin->id,
            'type' => 'in',
            'reference_type' => 'receipt',
            'reference_id' => $pn2->id,
            'reference_code' => $pn2->code,
            'quantity_before' => 2,
            'quantity_change' => 20,
            'quantity_after' => 22,
            'unit_price' => 920000,
            'note' => 'Nhập kho theo phiếu '.$pn2->code,
            'created_at' => $today->copy()->day(15),
        ]);

        // Phiếu xuất tháng này
        $px1 = GoodsIssue::create([
            'code' => 'PX-20261020-0001',
            'customer_name' => 'Công ty Cổ phần Giải pháp Phần mềm ABC',
            'user_id' => $staff1->id,
            'issue_date' => $today->copy()->day(20)->toDateString(),
            'total_amount' => 15700000,
            'status' => 'completed',
            'reason' => 'Xuất bán',
            'note' => 'Giao hàng đợt 1 nâng cấp phòng IT',
        ]);

        GoodsIssueItem::create([
            'goods_issue_id' => $px1->id,
            'product_id' => $createdProducts[0]->id, // SSD
            'quantity' => 10,
            'unit_price' => 1100000,
            'total_price' => 11000000,
            'note' => 'Kèm hóa đơn GTGT',
        ]);

        GoodsIssueItem::create([
            'goods_issue_id' => $px1->id,
            'product_id' => $createdProducts[4]->id, // Router
            'quantity' => 4,
            'unit_price' => 1175000,
            'total_price' => 4700000,
            'note' => 'Đã cấu hình trước',
        ]);

        InventoryLog::create([
            'product_id' => $createdProducts[0]->id,
            'user_id' => $staff1->id,
            'type' => 'out',
            'reference_type' => 'issue',
            'reference_id' => $px1->id,
            'reference_code' => $px1->code,
            'quantity_before' => 55,
            'quantity_change' => -10,
            'quantity_after' => 45,
            'unit_price' => 1100000,
            'note' => 'Xuất kho theo phiếu '.$px1->code,
            'created_at' => $today->copy()->day(20),
        ]);

        InventoryLog::create([
            'product_id' => $createdProducts[4]->id,
            'user_id' => $staff1->id,
            'type' => 'out',
            'reference_type' => 'issue',
            'reference_id' => $px1->id,
            'reference_code' => $px1->code,
            'quantity_before' => 22,
            'quantity_change' => -4,
            'quantity_after' => 18,
            'unit_price' => 1175000,
            'note' => 'Xuất kho theo phiếu '.$px1->code,
            'created_at' => $today->copy()->day(20),
        ]);

        // Tạo log kiểm kê điều chỉnh kho
        InventoryLog::create([
            'product_id' => $createdProducts[2]->id, // Chuột G102
            'user_id' => $admin->id,
            'type' => 'adjust',
            'reference_type' => 'adjustment',
            'reference_id' => null,
            'reference_code' => 'ADJ-20261025-001',
            'quantity_before' => 5,
            'quantity_change' => -2,
            'quantity_after' => 3,
            'unit_price' => 310000,
            'note' => 'Kiểm kê định kỳ: Trừ 2 con chuột lỗi bao bì gửi bảo hành',
            'created_at' => $today->copy()->day(25),
        ]);
    }
}
