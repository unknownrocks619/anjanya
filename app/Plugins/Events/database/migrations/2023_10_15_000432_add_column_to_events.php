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
            $table->string('event_contact_person')->nullable()->after('event_end_time');
            $table->string('event_contact_number')->nullable()->after('event_contact_person');
            $table->string('event_location')->nullable()->after('event_contact_number');
            $table->longText('event_location_iframe')->nullable()->after('event_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['event_contact_person','event_contact_number','event_location','event_location_iframe']);
        });
    }
};
