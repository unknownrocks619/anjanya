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
        Schema::create('project_donation_breaks', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->index()->nullable();
            $table->integer('organisation_id')->index()->nullable();
            $table->string('amount');
            $table->longText('milestone_text')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_donation_breaks');
    }
};
