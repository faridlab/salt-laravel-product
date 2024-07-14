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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('trx_id')->nullable(); // INVOICE NUMBER

            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('product_id')->references('id')->on('products');
            $table->foreignUuid('warehouse_id')->references('id')->on('warehouses');
            $table->foreignUuid('promo_id')->nullable()->references('id')->on('promotions');

            $table->enum('status', ['settlement', 'unpaid', 'cancel', 'paid'])->default('settlement');

            $table->enum('currency', ['IDR', 'USD', 'EUR'])->default('IDR');
            $table->float('price', 11, 8); // product price
            $table->unsignedInteger('quantity');

            $table->float('tax', 11, 8)->default(0); // semua pajak
            $table->float('discount', 11, 8)->default(0); // potongan harga dari promo
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
        Schema::dropIfExists('orders');
    }
};
