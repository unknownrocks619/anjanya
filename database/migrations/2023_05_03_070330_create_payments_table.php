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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_type')->default('stripe');
            $table->integer('order_id')->index();
            $table->string('status')->nullable();
            $table->string('transaction_key')->nullable();
            $table->string('amount');
            $table->string('tax')->nullable();
            $table->string('donation')->nullable();
            $table->longText('payment_response_object')->nullable();
            $table->longText('remarks');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
