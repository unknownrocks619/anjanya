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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('title')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('images')->nullable();
            $table->string('profession')->nullable();
            $table->string('source')->defaut('visit')->nullable();
            $table->longText('comment');
            $table->integer('sort_by');
            $table->string('rating')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
