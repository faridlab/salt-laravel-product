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
        Schema::create('product_showcases', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('product_id')->references('id')->on('products');
            $table->foreignUuid('showcase_id')->references('id')->on('showcases');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
