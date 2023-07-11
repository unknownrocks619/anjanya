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
        Schema::table('book_bundles', function (Blueprint $table) {
            //
            $table->longText('intro_text')->nullable()->after('categories');
            $table->longText('short_description')->nullable()->after('intro_text');
            $table->longText('full_description')->nullable()->after('short_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_bundles', function (Blueprint $table) {
            //
            $table->dropColumn('intro_text');
            $table->dropColumn('short_description');
            $table->dropColumn('full_description');
        });
    }
};
