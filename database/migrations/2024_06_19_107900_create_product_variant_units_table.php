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
        Schema::create('product_variant_units', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('variant_id')->references('id')->on('product_variants');
            $table->enum('type', ['color', 'size', 'tool', 'custom'])->default('custom');

            $table->string('name');

            $table->boolean('is_primary')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('label');
            $table->string('label_english');
            $table->string('hex', 10)->nullable();
            $table->string('icon')->nullable();

            $table->float('price', 11, 8);
            $table->integer('stock');
            $table->string('sku')->nullable();
            $table->float('weight', 11, 8);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_units');
    }
};
