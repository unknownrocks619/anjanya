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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->string('slug')->index();
            $table->longText('short_description')->nullable();
            $table->longText('intro_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->string('type')->default('blog')->comment('available option: video, gallery,blog,text');
            $table->string('status')->default('draft')->comment('available options: draft, pending, active');
            $table->string('categories')->default('[]');
            $table->string('sort_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
