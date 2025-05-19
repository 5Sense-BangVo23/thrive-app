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
        if (!Schema::hasTable('tbl_payments')) {
            Schema::create('tbl_payments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained('tbl_orders')->onDelete('cascade');
                $table->decimal('amount', 12, 2);
                $table->string('payment_method');
                $table->string('status')->default('pending'); 
                $table->dateTime('payment_date')->nullable();
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('tbl_payments', 'order_id')) {
                Schema::table('tbl_payments', function (Blueprint $table) {
                    $table->foreignId('order_id')->constrained('tbl_orders')->onDelete('cascade')->after('id');
                });
            }
            if (!Schema::hasColumn('tbl_payments', 'amount')) {
                Schema::table('tbl_payments', function (Blueprint $table) {
                    $table->decimal('amount', 12, 2)->after('order_id');
                });
            }
            if (!Schema::hasColumn('tbl_payments', 'payment_method')) {
                Schema::table('tbl_payments', function (Blueprint $table) {
                    $table->string('payment_method')->after('amount');
                });
            }
            if (!Schema::hasColumn('tbl_payments', 'status')) {
                Schema::table('tbl_payments', function (Blueprint $table) {
                    $table->string('status')->default('pending')->after('payment_method');
                });
            }
            if (!Schema::hasColumn('tbl_payments', 'payment_date')) {
                Schema::table('tbl_payments', function (Blueprint $table) {
                    $table->dateTime('payment_date')->nullable()->after('status');
                });
            }
            if (!Schema::hasColumn('tbl_payments', 'created_at') || !Schema::hasColumn('tbl_payments', 'updated_at')) {
                Schema::table('tbl_payments', function (Blueprint $table) {
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
        Schema::dropIfExists('tbl_payments');
    }
};
