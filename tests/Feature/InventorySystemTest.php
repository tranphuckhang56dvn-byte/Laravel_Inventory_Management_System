<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventorySystemTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected User $staff;

    protected Category $category;

    protected Supplier $supplier;

    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        // Khởi tạo người dùng phân quyền
        $this->admin = User::create([
            'name' => 'Thái Anh Kiệt (Admin)',
            'email' => 'admin@kho.vn',
            'phone' => '0901234567',
            'role' => 'admin',
            'status' => true,
            'password' => bcrypt('password123'),
        ]);

        $this->staff = User::create([
            'name' => 'Trần Phúc Khang (Thủ kho)',
            'email' => 'staff@kho.vn',
            'phone' => '0907654321',
            'role' => 'staff',
            'status' => true,
            'password' => bcrypt('password123'),
        ]);

        $this->category = Category::create([
            'code' => 'CAT-TEST',
            'name' => 'Linh kiện máy tính',
            'description' => 'Mô tả test',
            'status' => true,
        ]);

        $this->supplier = Supplier::create([
            'code' => 'NCC-TEST',
            'name' => 'Công ty Phân phối Tin học',
            'phone' => '0912345678',
            'email' => 'test@supplier.vn',
            'status' => true,
        ]);

        $this->product = Product::create([
            'sku' => 'SP-TEST-01',
            'barcode' => '8930000001',
            'name' => 'Ổ cứng SSD Kingston NVMe 512GB',
            'category_id' => $this->category->id,
            'supplier_id' => $this->supplier->id,
            'unit' => 'Chiếc',
            'purchase_price' => 800000,
            'selling_price' => 1000000,
            'current_stock' => 10,
            'min_stock' => 5,
            'max_stock' => 100,
            'status' => true,
        ]);
    }

    /**
     * Test đăng nhập API nhận Sanctum Token
     */
    public function test_user_can_login_via_api_and_get_sanctum_token(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'admin@kho.vn',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'access_token',
                'token_type',
                'user' => ['id', 'name', 'email', 'role'],
            ]);

        $token = $response->json('access_token');
        $this->assertNotEmpty($token);

        // Kiểm tra truy cập API bảo vệ bằng Sanctum Token
        $meResponse = $this->withHeader('Authorization', 'Bearer '.$token)
            ->getJson('/api/auth/me');

        $meResponse->assertStatus(200)
            ->assertJsonPath('user.email', 'admin@kho.vn');
    }

    /**
     * Test Web login
     */
    public function test_user_can_login_via_web(): void
    {
        $response = $this->post('/login', [
            'email' => 'staff@kho.vn',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($this->staff);
    }

    /**
     * Test Lập phiếu nhập kho: Tăng tồn kho và tạo Audit Log
     */
    public function test_goods_receipt_increases_stock_and_creates_audit_log(): void
    {
        $initialStock = $this->product->current_stock; // 10

        $receiptData = [
            'supplier_id' => $this->supplier->id,
            'receipt_date' => now()->toDateString(),
            'note' => 'Nhập thêm 15 sản phẩm',
            'items' => [
                [
                    'product_id' => $this->product->id,
                    'quantity' => 15,
                    'unit_price' => 820000,
                    'note' => 'Lô mới',
                ],
            ],
        ];

        $response = $this->actingAs($this->staff)
            ->post('/receipts', $receiptData);

        $response->assertRedirect();

        // Kiểm tra tồn kho sau khi nhập
        $this->product->refresh();
        $this->assertEquals($initialStock + 15, $this->product->current_stock); // 25
        $this->assertEquals(820000, $this->product->purchase_price);

        // Kiểm tra Audit Log được lưu chính xác
        $this->assertDatabaseHas('inventory_logs', [
            'product_id' => $this->product->id,
            'user_id' => $this->staff->id,
            'type' => 'in',
            'reference_type' => 'receipt',
            'quantity_before' => $initialStock,
            'quantity_change' => 15,
            'quantity_after' => 25,
        ]);
    }

    /**
     * Test Lập phiếu xuất kho: Trừ tồn an toàn và tạo Audit Log
     */
    public function test_goods_issue_decreases_stock_and_creates_audit_log(): void
    {
        $initialStock = $this->product->current_stock; // 10

        $issueData = [
            'customer_name' => 'Khách hàng thử nghiệm',
            'issue_date' => now()->toDateString(),
            'reason' => 'Xuất bán',
            'items' => [
                [
                    'product_id' => $this->product->id,
                    'quantity' => 4,
                    'unit_price' => 1000000,
                ],
            ],
        ];

        $response = $this->actingAs($this->staff)
            ->post('/issues', $issueData);

        $response->assertRedirect();

        $this->product->refresh();
        $this->assertEquals($initialStock - 4, $this->product->current_stock); // 6

        $this->assertDatabaseHas('inventory_logs', [
            'product_id' => $this->product->id,
            'user_id' => $this->staff->id,
            'type' => 'out',
            'reference_type' => 'issue',
            'quantity_before' => 10,
            'quantity_change' => -4,
            'quantity_after' => 6,
        ]);
    }

    /**
     * Test Ngăn chặn xuất kho quá số lượng tồn (Ngừa âm kho)
     */
    public function test_goods_issue_fails_when_stock_is_insufficient(): void
    {
        $initialStock = $this->product->current_stock; // 10

        $issueData = [
            'customer_name' => 'Khách mua sỉ',
            'issue_date' => now()->toDateString(),
            'reason' => 'Xuất bán',
            'items' => [
                [
                    'product_id' => $this->product->id,
                    'quantity' => 50, // Yêu cầu 50 trong khi chỉ có 10
                    'unit_price' => 1000000,
                ],
            ],
        ];

        $response = $this->actingAs($this->staff)
            ->post('/issues', $issueData);

        // Phải bị từ chối và báo lỗi
        $response->assertSessionHas('error');

        // Tồn kho không được thay đổi
        $this->product->refresh();
        $this->assertEquals($initialStock, $this->product->current_stock);
    }

    /**
     * Test Cảnh báo tồn kho dưới min_stock
     */
    public function test_low_stock_detection(): void
    {
        // Ban đầu tồn là 10, min_stock là 5 => Chưa cảnh báo
        $this->assertFalse($this->product->isLowStock());

        // Khi tồn kho bằng đúng ngưỡng tối thiểu (5 == 5) => Không cảnh báo
        $this->product->update(['current_stock' => 5]);
        $this->assertFalse($this->product->isLowStock());
        $this->assertEquals(0, Product::lowStock()->count());

        // Cập nhật tồn kho xuống 3 < min_stock (5) => Cảnh báo
        $this->product->update(['current_stock' => 3]);
        $this->assertTrue($this->product->isLowStock());

        // Kiểm tra truy vấn scopeLowStock
        $lowStockCount = Product::lowStock()->count();
        $this->assertEquals(1, $lowStockCount);

        // Kiểm tra API cảnh báo
        $response = $this->actingAs($this->admin, 'sanctum')
            ->getJson('/api/products/low-stock');

        $response->assertStatus(200)
            ->assertJsonPath('count', 1)
            ->assertJsonPath('data.0.sku', 'SP-TEST-01');
    }

    /**
     * Test Phân quyền RBAC: Staff không thể vào trang Quản lý Người dùng của Admin
     */
    public function test_staff_cannot_access_user_management(): void
    {
        $response = $this->actingAs($this->staff)->get('/users');
        $response->assertStatus(403);
    }

    /**
     * Test Admin truy cập thành công trang Quản lý Người dùng
     */
    public function test_admin_can_access_user_management(): void
    {
        $response = $this->actingAs($this->admin)->get('/users');
        $response->assertStatus(200);
    }

    /**
     * Test Kiểm kê điều chỉnh tồn kho
     */
    public function test_admin_can_adjust_stock(): void
    {
        $response = $this->actingAs($this->admin)
            ->post('/products/'.$this->product->id.'/adjust-stock', [
                'new_stock' => 8,
                'reason' => 'Kiểm kê thực tế chênh lệch',
            ]);

        $response->assertRedirect();

        $this->product->refresh();
        $this->assertEquals(8, $this->product->current_stock);

        $this->assertDatabaseHas('inventory_logs', [
            'product_id' => $this->product->id,
            'type' => 'adjust',
            'quantity_before' => 10,
            'quantity_change' => -2,
            'quantity_after' => 8,
        ]);
    }

    /**
     * Test Phân quyền Danh mục dữ liệu: Chỉ Admin có quyền Thêm, Sửa, Xóa; Staff chỉ được tra cứu
     */
    public function test_staff_cannot_create_or_modify_master_data(): void
    {
        // Staff chỉ xem được danh sách
        $this->actingAs($this->staff)->get('/products')->assertStatus(200);
        $this->actingAs($this->staff)->get('/categories')->assertStatus(200);
        $this->actingAs($this->staff)->get('/suppliers')->assertStatus(200);

        // Staff bị chặn khi cố tạo hoặc sửa
        $this->actingAs($this->staff)->get('/products/create')->assertStatus(403);
        $this->actingAs($this->staff)->post('/categories', [
            'code' => 'CAT-STAFF',
            'name' => 'Danh mục của Staff',
        ])->assertStatus(403);
        $this->actingAs($this->staff)->delete('/categories/'.$this->category->id)->assertStatus(403);
    }

    /**
     * Test Admin có quyền cao nhất trên Danh mục dữ liệu
     */
    public function test_admin_has_full_master_data_access(): void
    {
        $this->actingAs($this->admin)->get('/products/create')->assertStatus(200);
        $this->actingAs($this->admin)->get('/products/'.$this->product->id.'/edit')->assertStatus(200);
    }
}
