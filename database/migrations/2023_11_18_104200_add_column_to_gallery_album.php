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
        Schema::table('gallery_albums', function (Blueprint $table) {
            //
            $table->string('album_type')->after('active')->default('album_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gallery_albums', function (Blueprint $table) {
            //
            $table->dropColumn('album_type');
        });
    }
};
