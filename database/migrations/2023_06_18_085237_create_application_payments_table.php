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
        Schema::create('application_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->integer('application_id')->index();
            $table->float('amount')->default(0.00);
            $table->string('bank_account')->nullable();
            $table->string('currency')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('start_date');
            $table->string('expire_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_payments');
    }
};
