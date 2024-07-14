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
        // TRACKING STATUS
        // [001-099] NEW - PESANAN BARU
        // [100-199] READY - SIAP DIKIRIM
        // [200-299] DELIVERING - DALAM PENGIRIMAN
        // [300-399] COMPLAINT - DIKOMPLAIN
        // [400-499] FINISH - PESANAN SELESAI
        // [500-599] CANCELED - DIBATALKAN
        Schema::create('tracking_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('transaction_id')->references('id')->on('transactions');
            $table->foreignUuid('status_id')->references('id')->on('tracking_statuses');
            $table->integer('order');
            $table->string('note')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_orders');
    }
};
