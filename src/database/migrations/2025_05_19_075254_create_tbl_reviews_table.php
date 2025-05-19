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
        if (!Schema::hasTable('tbl_reviews')) {
            Schema::create('tbl_reviews', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained('tbl_products')->onDelete('cascade');
                $table->foreignId('customer_id')->constrained('tbl_customers')->onDelete('cascade');
                $table->tinyInteger('rating')->unsigned(); // 1-5
                $table->text('comment')->nullable();
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('tbl_reviews', 'product_id')) {
                Schema::table('tbl_reviews', function (Blueprint $table) {
                    $table->foreignId('product_id')->constrained('tbl_products')->onDelete('cascade')->after('id');
                });
            }
            if (!Schema::hasColumn('tbl_reviews', 'customer_id')) {
                Schema::table('tbl_reviews', function (Blueprint $table) {
                    $table->foreignId('customer_id')->constrained('tbl_customers')->onDelete('cascade')->after('product_id');
                });
            }
            if (!Schema::hasColumn('tbl_reviews', 'rating')) {
                Schema::table('tbl_reviews', function (Blueprint $table) {
                    $table->tinyInteger('rating')->unsigned()->after('customer_id');
                });
            }
            if (!Schema::hasColumn('tbl_reviews', 'comment')) {
                Schema::table('tbl_reviews', function (Blueprint $table) {
                    $table->text('comment')->nullable()->after('rating');
                });
            }
            if (!Schema::hasColumn('tbl_reviews', 'created_at') || !Schema::hasColumn('tbl_reviews', 'updated_at')) {
                Schema::table('tbl_reviews', function (Blueprint $table) {
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
        Schema::dropIfExists('tbl_reviews');
    }
};
