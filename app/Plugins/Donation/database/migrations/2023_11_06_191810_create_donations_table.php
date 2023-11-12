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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->longText('slug');
            $table->longText('intro_text')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->boolean('active')->default(false);
            $table->string('donation_type')->default('event')->comment('Event: Donation is enabled from start and end date, standalone: donation is enabled until marked as inactive,');
            $table->longText('settings')->nullable('[min donation amount, max donation amount]');
            $table->float('donation_cap_amount')->nullable()->comment('if this field is empty or donation type is standalone user can donate lifetime. otherwise progress bar will be displayed.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
