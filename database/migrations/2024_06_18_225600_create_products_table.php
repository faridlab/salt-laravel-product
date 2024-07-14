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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // FIELDS:
            $table->string('product_id', 10); // NOTE: AUTO GENERATE CODE
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description');

            $table->foreignUuid('category_id')->references('id')->on('categories');

            $table->enum('currency', ['IDR', 'USD', 'EUR'])->default('IDR');
            $table->float('price', 11, 8);

            $table->enum('status', ['banned', 'pending', 'deleted', 'active', 'featured', 'inactive'])->default('pending');

            $table->enum('condition', ['new', 'used'])->default('new');

            $table->integer('min_order')->default(1);

            $table->enum('weight_unit', ['gram', 'kg'])->default('gram');
            $table->float('weight', 11, 8)->nullable();

            $table->enum('dimension_unit', ['m', 'cm', 'mm'])->default('cm');
            $table->json('dimension')->nullable();
            // dimension->length
            // dimension->width
            // dimension->height

            // GARANSI
            $table->enum('guarantee', [
                'distributor', // Garansi Distributor
                'brand', // Garansi Merek (Resmi)
                'store', // Garansi Toko
                'indonesia', // Indonesia
                'international', // International
                'noguarantee'
            ])->default('distributor');

            // NOTE: should be at shopping cart or order
            // LAYANAN PENGIRIMAN
            // $table->enum('logistic_type', ['standard', 'custom'])->default('standard');
            // $table->json('logistic')->nullable(); // JNE, JNT

            $table->boolean('is_must_insurance')->default(true);

            // annotations
            // etalase

            $table->json('stock');
            // stock->total
            // stock->minimum_alert
            // stock->wording
            // stock->main
            // stock->available

            $table->string('sku')->nullable();
            $table->string('sni')->nullable();

            $table->json('wholesale')->nullable();
            // $wholesale = [
            //     [
            //         "min_qty" => 2,
            //         "price" => 9500
            //     ],
            // ];

            $preorder = [
                'available' => false,
                'duration' => null,
                'time_unit' => 'day',
            ];
            $table->json('preorder')->default($preorder);

            $table->json('variant')->nullable();
            // variants: color|size|tool|custom

            // COLORS: putih, hitam, biru, biru muda, merah, merah muda, orange, kuning, cokelat, hijau, ungu, abu-abu, cream
            // {
            //     "identifier": "colour",
            //     "name": "Warna",
            //     "units": [
            //         {
            //             "primary": true,
            //             "status": 'active',
            //             "value": "Putih",
            //             "english_value": "White",
            //             "hex": "#ffffff",
            //             "icon": "",
            //             "data": {
            //                 "price": null,
            //                 "stock": 0,
            //                 "sku": null,
            //                 "weight": 0, // gram
            //             }
            //         },
            //     ]
            // }

            // SIZE: 0,2,4,6,8,10,12,14,16,XS,S,M,L,XL,XXL,ALL SIZE
            // {
            //     "identifier": "size",
            //     "name": "Ukuran",
            //     "units": [
            //         {
            //             "primary": true,
            //             "status": 'active',
            //             "value": "0",
            //             "english_value": "0",
            //             "hex": null,
            //             "icon": "",
            //             "data": {
            //                 "price": null,
            //                 "stock": 0,
            //                 "sku": null,
            //                 "weight": 0, // gram
            //             }
            //         },
            //     ]
            // }

            // TOOL: Berat, Diameter, Dimensi, Volume
            // Berat: 1g, 2g, 4g, 5g, 10g, 25g, 50g, 70g, 100g, 200g, 400g, 500g, 600g, 700g, 800g, 900g, 1kg, 2kg, 3kg, 4kg, 5kg, 2.5kg
            // Diameter: 16cm, 18cm, 20cm, 22cm, 24cm, 26cm, 28cm, 30cm
            // Dimensi: 90x60 cm, 70x45 cm, 40x65 cm, 30x40 cm
            // Volume: 10ml, 25ml, 50ml, 100ml, 250ml, 500ml, 600ml, 800ml, 1l,2l,3l,4l,5l,16l,17l,18l,19l,20l,26l,27l,28l,29l,30l,36l,37l,38l,39l,40l
            // {
            //     "identifier": "tool",
            //     "name": "Ukuran Perkakas Tukang",
            //     "units": [
            //         {
            //             "primary": true,
            //             "status": 'active',
            //             "value": "0",
            //             "english_value": "0",
            //             "hex": null,
            //             "icon": "",
            //             "data": {
            //                 "price": null,
            //                 "stock": 0,
            //                 "sku": null,
            //                 "weight": 0, // gram
            //             }
            //         },
            //     ]
            // }

            // CUSTOM
            // {
            //     "identifier": "custom",
            //     "name": "Custom name",
            //     "units": [
            //         {
            //             "primary": true,
            //             "status": 'active',
            //             "value": "0",
            //             "english_value": "0",
            //             "hex": null,
            //             "icon": "",
            //             "data": {
            //                 "price": null,
            //                 "stock": 0,
            //                 "sku": null,
            //                 "weight": 0, // gram
            //             }
            //         },
            //     ]
            // }

            $table->foreignUuid('brand_id')->nullable()->references('id')->on('brands');

            $table->json('data')->nullable();
            // $table->string('video_url')->nullable();
            // $table->string('web_url')->nullable();
            // $table->string('mobile_url')->nullable();

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
