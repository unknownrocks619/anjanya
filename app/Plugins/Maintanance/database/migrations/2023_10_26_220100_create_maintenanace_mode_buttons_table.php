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
        Schema::create('maintenanace_mode_buttons', function (Blueprint $table) {
            $table->id();
            $table->integer('maintenance_mode')->index();
            $table->string('button_label');
            $table->string('response_type')->default('image')->comment('available options: link, image, pdf, video');
            $table->longText('button_response');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenanace_mode_buttons');
    }
};
