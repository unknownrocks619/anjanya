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
        Schema::create('order_lines', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('project_id')->index()->nullable();
            $table->string('product_id')->nullable()->index();
            $table->string('item_price')->default(0);
            $table->string('quantity')->default(1);
            $table->string('tip_amount')->default(0);
            $table->string('processing_charge')->default(0);
            $table->string('final_amount')->default(0);
            $table->string('donation_amount')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_lines');
    }
};
