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
        Schema::create('domain_plugins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_api');
            $table->unsignedBigInteger('id_plu');
            $table->boolean('active')->default(false);
            $table->string('start_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_plugins');
    }
};
