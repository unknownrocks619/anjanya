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
        Schema::create('component_builders', function (Blueprint $table) {
            $table->id();
            $table->string('component_name');
            $table->longText('component_type');
            $table->string('relation_model');
            $table->integer('relation_id')->index();
            $table->longText('values')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('component_builders');
    }
};
