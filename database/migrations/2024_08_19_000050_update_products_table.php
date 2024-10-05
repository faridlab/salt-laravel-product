<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->after('wholesale', function ($table) {
                $preorder = [
                    'available' => false,
                    'duration' => null,
                    'time_unit' => 'day',
                ];
                $table->json('preorder')->nullable()->default(json_encode($preorder));
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
