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
        Schema::create('order_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('admin_user_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('order_line')->nullable();
            $table->string('log_type')->default('update')->comment('available options: delete, insert');
            $table->longText('log_message')->nullable();
            $table->longText('old_record')->nullable();
            $table->longText('new_record')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_logs');
    }
};
