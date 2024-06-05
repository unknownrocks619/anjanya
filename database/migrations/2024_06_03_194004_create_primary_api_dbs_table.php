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
        if ( Schema::connection('defaultConnection')->hasTable('primary_api_dbs') ){
            return;
        }
        
        Schema::connection('defaultConnection')->create('primary_api_dbs', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('domain');
            $table->string('database');
            $table->string('username');
            $table->string('password');
            $table->string('themes')->default('default');
            $table->integer('port')->default(3306);
            $table->boolean('active')->default(true);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('defaultConnection')->dropIfExists('primary_api_dbs');
    }
};
