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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('slug');
            $table->string('sku');
            $table->integer('author_id')->index()->nullable();
            $table->integer('book_id')->index()->nullable();
            $table->integer('option_project_id')->index()->nullable();
            $table->longText('intro_text')->nullabe();
            $table->longText('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->string('status')->default('inactive');
            $table->longText('categories');
            $table->string('stock')->nullable();
            $table->string('product_type')->default('digital');
            $table->float('item_price')->default(0);
            $table->string('tax')->nullable();
            $table->float('total_pricing')->default(0);
            $table->boolean('is_shipping_available')->default(true);
            $table->integer('sort_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
