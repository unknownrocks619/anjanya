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
        Schema::create('slider_albums', function (Blueprint $table) {
            $table->id();
            $table->string('album_name');
            $table->boolean('status')->default(false)->comment('1 active,0 inactive');
            $table->string('slider_type')->default('bootstrap')->comment('available: bootstrap(default) or theme');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider_albums');
    }
};
