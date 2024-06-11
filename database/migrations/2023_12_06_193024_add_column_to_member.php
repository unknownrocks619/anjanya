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
        if( Schema::connection('portal_connection')->hasColumn('members','id_card')) {
            return;
        }
        Schema::connection('portal_connection')->table('members', function (Blueprint $table) {
            //
            $table->longText('id_card')->after('role_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('portal_connection')->table('members', function (Blueprint $table) {
            //
            $table->dropColumn('id_card');
        });
    }
};
