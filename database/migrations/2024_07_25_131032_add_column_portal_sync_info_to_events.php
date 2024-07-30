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
        Schema::table('events', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('portal_program_id')->nullable()->after('id');
            $table->unsignedBigInteger('portal_program_batch_id')->nullable()->after('portal_program_id');
            $table->unsignedBigInteger('portal_program_section_id')->nullable()->after('portal_program_batch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //
            $table->dropColumn(['portal_program_id', 'portal_program_batch_id', 'portal_program_section_id']);
        });
    }
};
