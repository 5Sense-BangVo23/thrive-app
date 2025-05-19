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
        if (!Schema::hasTable('tbl_orders')) {
            Schema::create('tbl_orders', function (Blueprint $table) {
                $table->id();

                // Khóa ngoại customer_id tham chiếu đến tbl_customers(id)
                $table->foreignId('customer_id')->constrained('tbl_customers')->onDelete('cascade');

                $table->dateTime('order_date');

                $table->decimal('total_amount', 12, 2);

                $table->string('status')->default('pending'); // pending, completed, canceled...

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_orders');
    }
};
