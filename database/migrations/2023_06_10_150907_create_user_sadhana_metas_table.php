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
        Schema::create('user_sadhana_metas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->string('sadhana_level')->nullable();
            $table->string('sadhana_type')->nullable()->comment('Available options: shaktipath,mantra,sarangati,tarak');
            $table->string('sadhana_date')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sadhana_metas');
    }
};
