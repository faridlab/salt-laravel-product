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
        Schema::create('warehouse_addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('warehouse_id')->references('id')->on('warehouses');

            $table->foreignUuid('country_id')->references('id')->on('countries');
            $table->foreignUuid('province_id')->references('id')->on('provinces');
            $table->foreignUuid('city_id')->references('id')->on('cities');
            $table->foreignUuid('district_id')->references('id')->on('districts');
            $table->foreignUuid('subdistrict_id')->nullable()->references('id')->on('subdistricts');

            $table->string('address', 512);
            $table->string('address2', 512)->nullable();
            $table->string('rtrw')->nullable();
            $table->string('postalcode', 5)->nullable();
            $table->float('latitude', 11, 8)->nullable();
            $table->float('longitude', 11, 8)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_addresses');
    }
};
