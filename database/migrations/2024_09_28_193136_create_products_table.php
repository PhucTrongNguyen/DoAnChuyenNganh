<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->char('proc_id', 5)->primary();
            $table->char('cate_id', 5)->nullable();
            $table->string('name', 100)->nullable();
            $table->text('description')->nullable(); // Mô tả sản phẩm
            $table->integer('quantity')->nullable();
            $table->float('price')->nullable();
            $table->text('picture')->nullable();
            $table->float('rating')->nullable(); // Điểm đánh giá
            $table->integer('sales')->default(0); // Số lượng đã bán
            $table->string('status')->default('active'); // Trạng thái sản phẩm
            $table->float('discount')->nullable(); // Phần trăm giảm giá
            $table->string('sku')->nullable(); // Số SKU
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
