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
        if (!Schema::hasTable('tbl_customers')) {
            Schema::create('tbl_customers', function (Blueprint $table) {
                $table->id();

                if (!Schema::hasColumn('tbl_customers', 'name')) {
                    $table->string('name');
                }

                if (!Schema::hasColumn('tbl_customers', 'email')) {
                    $table->string('email')->unique();
                }

                if (!Schema::hasColumn('tbl_customers', 'phone')) {
                    $table->string('phone')->nullable();
                }

                if (!Schema::hasColumn('tbl_customers', 'address')) {
                    $table->text('address')->nullable();
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
        Schema::dropIfExists('tbl_customers');
    }
};
