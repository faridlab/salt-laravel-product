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
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('product_id')->references('id')->on('products');
            $table->foreignUuid('warehouse_id')->references('id')->on('warehouses');

            // initial  +
            // restock  +
            // cancel   +
            // outstock -
            $table->enum('status', ['intial', 'restock', 'cancel', 'out'])->default('intial');
            $table->integer('total')->default(1);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stocks');
    }
};
