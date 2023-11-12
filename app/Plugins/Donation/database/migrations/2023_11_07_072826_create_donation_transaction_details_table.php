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
        Schema::create('donation_transaction_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id')->index();
            $table->string('full_name')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('user_initial')->nullable();
            $table->string('email')->nullable();
            $table->float('amount')->default(0.0);
            $table->longText('payment_source')->nullable();
            $table->longText('transaction_id')->nullable();
            $table->longText('payment_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_transaction_details');
    }
};
