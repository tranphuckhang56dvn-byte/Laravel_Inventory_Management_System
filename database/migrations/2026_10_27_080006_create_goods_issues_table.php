<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goods_issues', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('customer_name')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('issue_date');
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->string('status')->default('completed'); // draft, completed, cancelled
            $table->string('reason')->default('Xuất bán'); // Xuất bán, Xuất hủy, Xuất chuyển kho, Xuất trả nhà cung cấp, Khác
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goods_issues');
    }
};
