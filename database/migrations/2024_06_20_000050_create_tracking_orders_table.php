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
        // [001-999] NEW - PESANAN BARU
        // [1000-1999] READY - SIAP DIKIRIM
        // [2000-2999] DELIVERING - DALAM PENGIRIMAN
        // [3000-3999] COMPLAINT - DIKOMPLAIN
        // [4000-4999] FINISH - PESANAN SELESAI
        // [5000-5999] CANCELED - DIBATALKAN
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
