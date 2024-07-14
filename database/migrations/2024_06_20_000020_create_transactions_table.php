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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('trx_id')->nullable(); // INVOICE NUMBER

            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('product_id')->references('id')->on('products');
            $table->foreignUuid('warehouse_id')->references('id')->on('warehouses');
            $table->foreignUuid('promo_id')->nullable()->references('id')->on('promotions');

            $table->dateTime('purchase_date')->useCurrent();
            $table->enum('status', ['settlement', 'unpaid', 'cancel', 'paid'])->default('settlement');

            $table->enum('currency', ['IDR', 'USD', 'EUR'])->default('IDR');
            $table->float('price', 11, 8); // product price
            $table->unsignedInteger('quantity');

            $table->json('address');
            $table->json('expedition')->nullable();

            $table->float('tax', 11, 8)->default(0); // semua pajak
            $table->float('discount', 11, 8)->default(0); // potongan harga dari promo
            $table->float('admin_fee', 11, 8)->default(0); // biaya asuransi
            $table->float('insurance_fee', 11, 8)->default(0); // biaya asuransi
            $table->float('expedition_fee', 11, 8)->default(0); // biaya expedisi
            $table->float('total', 11, 8); // TOTAL

            $table->json('data')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
