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
        Schema::create('user_metas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->longText('education')->nullable();
            $table->longText('profession')->nullable();
            $table->longText('gaurdian_info')->nullable();
            $table->longText('emergency_contact')->nullable();
            $table->longText('signature')->nullable();
            $table->longText('parent_signature')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_metas');
    }
};
