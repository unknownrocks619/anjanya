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
        Schema::create('project_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('source')->default('stripe');
            $table->string('transaction_amount')->default(0);
            $table->longText('source_detail')->nullable();
            $table->longText('remarks')->nullable();
            $table->integer('project_id')->index();
            $table->integer('organisation_id')->index()->nullable();
            $table->longText('additional_text')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_transactions');
    }
};
