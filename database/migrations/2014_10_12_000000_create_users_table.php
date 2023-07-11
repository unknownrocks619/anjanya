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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('street_address')->nullable();
            $table->string("date_of_birth")->nullable();
            $table->string("gender")->nullable();
            $table->string("phone_number")->nullable()->index();
            $table->string("source")->default("signup")->comment("Available Options: Sing up, Import, Campagain, Pre-Registration, Social Login");
            $table->string("source_id")->nullable();
            $table->longText('source_records')->nullable();
            $table->string("username")->nullable()->index();
            $table->string("status")->default('hold')->comment("Available Options: Hold: for unverified account, suspend: To disable user login for shorten period of time, review: Account waiting for review by authorized party, reject: Reject this account");
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
