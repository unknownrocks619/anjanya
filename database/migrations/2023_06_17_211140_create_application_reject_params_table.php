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
        Schema::create('application_reject_params', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->integer('application_id')->index()->nullable();
            $table->longText('remarks')->nullable();
            $table->longText('step_params')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_reject_params');
    }
};
