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
        //
        Schema::create('store_products', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('sku')->unique();
            $table->boolean('status')->default(false);
            $table->integer('product_type')->default(1)->comment('1 : Physical Product, 2: Digital Product, 3 : Service');
            $table->bigInteger('stock')->default(500);
            $table->longText('intro_description')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->longText('product_files')->nullable();
            $table->float('base_price')->default(0);
            $table->text('price_range')->nullable();
            $table->text('youtube_link')->nullable();
            $table->text('facebook_link')->nullable();
            $table->text('instagram_link')->nullable();
            $table->text('twitter_link')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

        //
        Schema::create('store_product_additional', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pro');
            $table->string('title')->nullable();
            $table->longText('intro_description')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        //
        Schema::create('product_categories', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pro');
            $table->unsignedBigInteger('id_cat');
            $table->timestamps();
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
