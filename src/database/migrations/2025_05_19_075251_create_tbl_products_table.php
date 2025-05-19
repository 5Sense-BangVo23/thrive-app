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
        if (!Schema::hasTable('tbl_products')) {
            Schema::create('tbl_products', function (Blueprint $table) {
                $table->id();

                // category_id (foreign key)
                if (!Schema::hasColumn('tbl_products', 'category_id')) {
                    $table->foreignId('category_id')
                        ->constrained('tbl_categories')
                        ->onDelete('cascade');
                }

                if (!Schema::hasColumn('tbl_products', 'name')) {
                    $table->string('name');
                }

                if (!Schema::hasColumn('tbl_products', 'description')) {
                    $table->text('description')->nullable();
                }

                if (!Schema::hasColumn('tbl_products', 'price')) {
                    $table->decimal('price', 10, 2);
                }

                if (!Schema::hasColumn('tbl_products', 'stock_quantity')) {
                    $table->unsignedInteger('stock_quantity')->default(0);
                }

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_products');
    }
};
