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
        Schema::create('lessions', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->index();
            $table->integer('chapter_id')->index();
            $table->string('lession_name');
            $table->string('slug');
            $table->string('total_duration')->nullable();
            $table->longText('intro_text')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->longText('youtube')->nullable();
            $table->longText('vimeo')->nullable();
            $table->longText('intro_video')->nullable();
            $table->boolean('enable_youtube')->default(false);
            $table->boolean('enable_vimeo')->default(true);
            $table->boolean('enable_preview');
            $table->boolean('active')->default(true);
            $table->integer('sort_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessions');
    }
};
