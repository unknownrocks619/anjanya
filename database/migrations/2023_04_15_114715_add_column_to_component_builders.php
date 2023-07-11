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
        Schema::table('component_builders', function (Blueprint $table) {
            //
            $table->string('display_location')->after('values')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('component_builders', function (Blueprint $table) {
            //
            $table->dropColumn('display_location');
        });
    }
};
