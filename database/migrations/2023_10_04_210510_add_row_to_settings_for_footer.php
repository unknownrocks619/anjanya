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
       $settings = new \App\Models\Setting();
       $settings->fill([
           'name' => 'footer',
           'value'  => 'footer/default/footer',
           'additional_text'    => ['name' => 'default']
       ]);
       $settings->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings_for_footer', function (Blueprint $table) {
            //
        });
    }
};
