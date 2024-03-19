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
        Schema::table('gallery_items', function (Blueprint $table) {
            //
            $table->boolean('featured_background')->default(false)->after('sort_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            //
            $table->dropColumn('featured_background');
        });
    }
};
