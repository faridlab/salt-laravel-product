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
        Schema::create('promotion_usage', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('promo_id')->references('id')->on('promotions');
            $table->foreignUuid('product_id')->nullable()->references('id')->on('products');

            $table->unsignedInteger('quantity');
            $table->unsignedInteger('discount'); // value of price

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_usage');
    }
};
