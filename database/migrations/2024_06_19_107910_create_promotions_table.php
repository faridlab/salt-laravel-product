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
        Schema::create('promotions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('code', 50);

            $table->enum('type', ['standard', 'minimum', 'quantity', 'event'])->default('standard');
            // STANDARD: potongan beli produk tertentu
            // MINIMUM: minimum beli 10 dapat potongan 10%
            // QUANTITY: beli 2 gratis 1
            // EVENT: potongan harga satuan dalam rentang waktu

            $table->enum('category', ['all', 'product', 'category', 'bundle'])->default('all');
            // ALL: apply to all product and category
            // PRODUCT: berlaku spesifik produk tertentu
            // CATEGORY: berlaku untuk katergori produk dan turunannya
            // SHOWCASE: berlaku untuk showcase tertentu
            // BUNDLE: apply to some products selected

            $table->foreignUuid('product_id')->nullable()->references('id')->on('products');
            $table->foreignUuid('category_id')->nullable()->references('id')->on('categories');

            $table->dateTime('start_at')->nullable();
            $table->dateTime('expired_at')->nullable();

            $table->unsignedInteger('quota')->nullable();

            $table->enum('discount_unit', ['price', 'percentage'])->default('price');
            $table->unsignedInteger('discount'); // value of price or percentage
            $table->unsignedInteger('discount_upto')->nullable(); // value of price or percentage

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
