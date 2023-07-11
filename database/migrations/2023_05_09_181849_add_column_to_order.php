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
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->longText('order_note')->nullable()->after('order_status');
            $table->longText('reject_message')->nullable();
            $table->longText('delivery_address')->nullable()->after('phone_number');
            $table->longText('billing_address')->nullable()->after('delivery_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order', function (Blueprint $table) {
            //
            $table->dropColumn(['order_note', 'reject_message', 'delivery_address', 'billing_address']);
        });
    }
};
