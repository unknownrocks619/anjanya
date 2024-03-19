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

        Schema::connection('portal_connection')->table('member_infos', function (Blueprint $table) {
            //
            $table->string('total_connected_family')
                    ->after('remarks')
                    ->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('protal_connection')->table('member_infos', function (Blueprint $table) {

            $table->dropColumn(['total_connected_family']);
        });
    }
};
