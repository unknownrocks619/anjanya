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
        Schema::create('slider_items', function (Blueprint $table) {
            $table->id();
            $table->integer('slider_album_id')->index();
            $table->string('slider_type')->default('image')->comment('options can be: image, video, paralex,');
            $table->boolean('active')->default(false);
            $table->string('heading_one')->nullable();
            $table->string('heading_two')->nullable();
            $table->string('subtitle')->nullable();
            $table->longText('description')->nullable();
            $table->integer('sort_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider_items');
    }
};
