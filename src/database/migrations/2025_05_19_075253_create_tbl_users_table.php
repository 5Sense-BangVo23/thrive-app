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
        if (!Schema::hasTable('tbl_users')) {
            Schema::create('tbl_users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('role')->default('user'); // admin, user...
                $table->rememberToken();
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('tbl_users', 'name')) {
                Schema::table('tbl_users', function (Blueprint $table) {
                    $table->string('name')->after('id');
                });
            }

            if (!Schema::hasColumn('tbl_users', 'email')) {
                Schema::table('tbl_users', function (Blueprint $table) {
                    $table->string('email')->unique()->after('name');
                });
            }

            if (!Schema::hasColumn('tbl_users', 'password')) {
                Schema::table('tbl_users', function (Blueprint $table) {
                    $table->string('password')->after('email');
                });
            }

            if (!Schema::hasColumn('tbl_users', 'role')) {
                Schema::table('tbl_users', function (Blueprint $table) {
                    $table->string('role')->default('user')->after('password');
                });
            }

            if (!Schema::hasColumn('tbl_users', 'remember_token')) {
                Schema::table('tbl_users', function (Blueprint $table) {
                    $table->rememberToken()->after('role');
                });
            }

            if (!Schema::hasColumn('tbl_users', 'created_at') || !Schema::hasColumn('tbl_users', 'updated_at')) {
                Schema::table('tbl_users', function (Blueprint $table) {
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
        Schema::dropIfExists('tbl_users');
    }
};
