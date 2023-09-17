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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_name');
            $table->string('slug');
            $table->string('status')->default('draft');
            $table->longText('intro_text')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->string('price')->default(0);;
            $table->string('currency')->default('$');
            $table->boolean('discount')->default(false);
            $table->boolean('discount_percentage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
