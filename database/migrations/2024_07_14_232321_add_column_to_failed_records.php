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
        Schema::table('failed_records', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_event')->after('session_info')->nullable();
        });

        Schema::table('success_records', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_event')->after('source')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('failed_records', function (Blueprint $table) {
            //
            $table->dropColumn('id_event');
        });

        Schema::table('success_records', function (Blueprint $table) {
            //
            $table->dropColumn('id_event');
        });

    }
};
