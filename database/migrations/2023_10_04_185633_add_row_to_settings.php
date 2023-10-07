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
        $setting = new \App\Models\Setting();
        $setting->fill([
            'name'  => 'header',
            'value' => 'header/header-center/header',
            'additional_text' => ['name'=>'header-center']
        ]);
        $setting->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
};
