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
        Schema::table('courses', function (Blueprint $table) {
            //
            $table->string('course_type')->nullable()->after('sort_by');
            $table->string('total_lecture')->nullable()->after('course_type');
            $table->string('language')->nullable()->default('Nepali')->after('total_lecture');
            $table->string('certification')->nullable()->default('Yes')->after('language');
            $table->string('duration')->nullable()->default('Yes')->after('certification');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            //
        });
    }
};
