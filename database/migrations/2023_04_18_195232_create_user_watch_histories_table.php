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
        Schema::create('user_watch_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_course_enrollment_id')->index()->nullable();
            $table->integer('course_id')->index()->nullable();
            $table->integer('user_id')->index();
            $table->integer('chapter_id')->index()->nullable();
            $table->integer('lession_id')->index();
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_watch_histories');
    }
};
