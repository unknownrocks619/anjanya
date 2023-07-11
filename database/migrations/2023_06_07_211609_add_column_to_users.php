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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->boolean('perma_same_as_temp')->default(true)->after('street_address');
            $table->string('temp_country')->nullable()->after('perma_same_as_temp');
            $table->string('temp_state')->nullable()->after('temp_country');
            $table->longText('temp_street_address')->nullable()->after('temp_state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['perma_same_as_temp', 'temp_country', 'temp_state', 'temp_street_address']);
        });
    }
};
