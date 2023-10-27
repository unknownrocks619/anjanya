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
        Schema::table('maintenanace_mode_buttons', function (Blueprint $table) {
            //
            $table->longText('title')->nullable()->after('maintenance_mode');
            $table->longText('description')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maintenanace_mode_buttons', function (Blueprint $table) {
            //
            $table->dropColumn(['title','description']);
        });
    }
};
