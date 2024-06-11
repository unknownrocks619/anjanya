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
        if( Schema::connection('portal_connection')->hasTable('event_jap_information')) {
            return;
        }

        Schema::connection('portal_connection')->create('event_jap_information', function (Blueprint $table) {
            //
            $table->id();
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('event_id')->nullable();
            $table->unsignedInteger('total_jap_count');
            $table->string('jap_start_date');
            $table->string('total_expected_jap_count')->nullable();
            $table->string('average_jap_count')->nullable();
            $table->boolean('is_family')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('portal_connection')->table('event_jap_information', function (Blueprint $table) {
            $table->drop('event_jap_information');
        });

    }
};
