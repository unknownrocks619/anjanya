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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->string('slug');
            $table->longText('course_intro_text')->nullable();
            $table->longText('course_short_description')->nullable();
            $table->longText('course_full_description')->nullable();
            $table->longText('intro_video')->nullable();
            $table->longText('permission')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('enable_intro_video')->default(true);
            $table->integer('sort_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
