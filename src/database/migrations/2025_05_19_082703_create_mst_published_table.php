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
        if (!Schema::hasTable('mst_published')) {
            Schema::create('mst_published', function (Blueprint $table) {
                $table->id();

                if (!Schema::hasColumn('mst_published', 'status')) {
                    $table->string('status');
                }

                if (!Schema::hasColumn('mst_published', 'publishable_type') &&
                    !Schema::hasColumn('mst_published', 'publishable_id')) {
                    $table->morphs('publishable');
                }

                $table->timestamps();

                $table->unique(['publishable_type', 'publishable_id']);
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_published');
    }
};
