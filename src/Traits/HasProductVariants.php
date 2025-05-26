<?php

namespace SaltProduct\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use SaltProduct\Models\Products;
use SaltProduct\Models\ProductVariantItems;
use SaltFile\Models\Files;

trait HasProductVariants
{
    /**
     * Boot function from Laravel.
     */
    public static function bootHasProductVariants() {

        static::updated(function ($model) {
            if (request()->isMethod('patch')) {
                return;
            }

            $variants = request()->get('variant');

            $ids = collect($variants)->pluck('id');

            ProductVariantItems::where('product_id', $model->id)
                ->whereNotIn('id', $ids)
                ->delete();

            $variantInserts = [];
            $variantUpdates = [];

            foreach ($variants as $value) {
                $id = isset($value['id']) ? $value['id'] : Str::uuid()->toString();
                $data = [
                    'id' => $id,
                    'product_id' => $model->id,
                    'variant' => $value['variant'],
                    'price' => $value['price'],
                    'stock' => $value['stock'],
                    'sku' => $value['sku'],
                    'weight' => $value['weight'],
                    'status' => $value['status'],
                    'is_primary' => $value['is_primary'],
                    'created_at' => $value['created_at'] ?? date("Y-m-d H:i:s", time()),
                    'updated_at' => date("Y-m-d H:i:s", time()),
                ];

                if(!isset($value['id'])) {
                    $variantInserts[] = $data;
                    continue;
                }
                $variantUpdates[] = $data;
            }

            if(!empty($variantInserts)) {
                ProductVariantItems::insert($variantInserts);
            }

            if(!empty($variantUpdates)) {
                foreach($variantUpdates as $value) {
                    ProductVariantItems::where('id', $value['id'])->update($value);
                }
            }
        });

        static::created(function ($model) {
            $variants = request()->get('variant');
            $productVariants = [];
            foreach ($variants as $value) {
                $productVariants[] = [
                    'id' => Str::uuid()->toString(),
                    'product_id' => $model->id,
                    'variant' => $value['variant'],
                    'price' => $value['price'],
                    'stock' => $value['stock'],
                    'sku' => $value['sku'],
                    'weight' => $value['weight'],
                    'status' => $value['status'],
                    'is_primary' => $value['is_primary'],
                    'created_at' => date("Y-m-d H:i:s", time()),
                    'updated_at' => date("Y-m-d H:i:s", time()),
                ];
            }
            DB::table('product_variant_items')->insert($productVariants);
        });

    }
}
