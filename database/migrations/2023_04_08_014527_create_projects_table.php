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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('organisation_id')->index();
            $table->string('title');
            $table->string('slug')->index();
            $table->longText('intro_text')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->string('project_country')->nullable();
            $table->string('project_state')->nullable();
            $table->string('project_street_address')->nullable();
            $table->boolean('donation')->default(true)->nullable();
            $table->boolean('active')->default(false);
            $table->longText('category')->nullable();
            $table->longText('genre')->nullable();
            $table->string('project_type')->default('project')->comment('available options: project, library');
            $table->integer('sort_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
