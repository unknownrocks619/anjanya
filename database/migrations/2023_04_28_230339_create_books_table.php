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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->index();
            $table->string('book_title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('intro_text')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->string('status')->default('draft');
            $table->string('default_project')->nullable();
            $table->boolean('is_converted')->default(false);
            $table->longText('categories')->nullable();
            $table->longText('canva_link')->nullable();
            $table->longText('book')->nullable();
            $table->longText('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
