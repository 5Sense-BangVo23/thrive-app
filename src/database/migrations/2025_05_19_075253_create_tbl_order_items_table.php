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
        if (!Schema::hasTable('tbl_order_items')) {
            // Nếu bảng chưa có thì tạo mới
            Schema::create('tbl_order_items', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('order_id');
                $table->unsignedBigInteger('product_id');
                $table->unsignedInteger('quantity');
                $table->decimal('price', 10, 2);
                $table->timestamps();

                // Tạo foreign key constraints
                $table->foreign('order_id')->references('id')->on('tbl_orders')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('tbl_products')->onDelete('cascade');
            });
        } else {
            // Nếu bảng đã tồn tại thì kiểm tra từng cột
            if (!Schema::hasColumn('tbl_order_items', 'order_id')) {
                Schema::table('tbl_order_items', function (Blueprint $table) {
                    $table->unsignedBigInteger('order_id')->after('id');
                    $table->foreign('order_id')->references('id')->on('tbl_orders')->onDelete('cascade');
                });
            }

            if (!Schema::hasColumn('tbl_order_items', 'product_id')) {
                Schema::table('tbl_order_items', function (Blueprint $table) {
                    $table->unsignedBigInteger('product_id')->after('order_id');
                    $table->foreign('product_id')->references('id')->on('tbl_products')->onDelete('cascade');
                });
            }

            if (!Schema::hasColumn('tbl_order_items', 'quantity')) {
                Schema::table('tbl_order_items', function (Blueprint $table) {
                    $table->unsignedInteger('quantity')->after('product_id');
                });
            }

            if (!Schema::hasColumn('tbl_order_items', 'price')) {
                Schema::table('tbl_order_items', function (Blueprint $table) {
                    $table->decimal('price', 10, 2)->after('quantity');
                });
            }

            if (!Schema::hasColumn('tbl_order_items', 'created_at') || !Schema::hasColumn('tbl_order_items', 'updated_at')) {
                Schema::table('tbl_order_items', function (Blueprint $table) {
                    $table->timestamps();
                });
            }
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_order_items');
    }
};
