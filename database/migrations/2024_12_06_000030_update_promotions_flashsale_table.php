<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->after('code', function ($table) {
                $table->boolean('is_flashsale')->default(false);
            });
            $table->after('category_id', function ($table) {
                $table->foreignUuid('showcase_id')->nullable()->references('id')->on('showcases');
            });
            // $table->enum('category', ['all', 'product', 'category', 'showcase', 'bundle'])->default('all')->change();
            // DB::statement("ALTER TABLE 'promotions' CHANGE COLUMN 'category' 'category' ENUM('all', 'product', 'category', 'showcase', 'bundle') NOT NULL DEFAULT 'all'");
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
