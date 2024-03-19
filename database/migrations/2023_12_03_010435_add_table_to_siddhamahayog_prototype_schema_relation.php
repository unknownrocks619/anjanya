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
        Schema::connection('portal_connection')->table('member_emergency_metas', function (Blueprint $table) {
            //
            $table->longText('profile')->nullable()->after('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('portal_connection')->table('member_emergency_metas', function (Blueprint $table) {
           $table->dropColumn('profile');
        });

    }
};
