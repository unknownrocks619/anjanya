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
        Schema::create('common_component_connectors', function (Blueprint $table) {
            $table->id();
            $table->integer('relation_id')->index();
            $table->string('relation_model')->index();
            $table->integer('web_component_id')->index();
            $table->boolean('active')->default(true);
            $table->boolean('sort_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_component_connectors');
    }
};
