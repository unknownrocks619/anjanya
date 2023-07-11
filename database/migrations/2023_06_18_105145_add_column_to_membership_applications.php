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
        Schema::table('membership_applications', function (Blueprint $table) {
            //
            $table->boolean('user_profile_approved')->nullable()->after('resubmitted_count');
            $table->boolean('user_identity_approved')->nullable()->after('user_profile_approved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('membership_applications', function (Blueprint $table) {
            //
            $table->removeColumn('user_profile_approved');
            $table->removeColumn('user_identity_approved');
        });
    }
};
