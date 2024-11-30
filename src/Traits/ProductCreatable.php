<?php

namespace SaltProduct\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use SaltProduct\Models\Products;
use SaltProduct\Models\ProductShowcases;
use SaltFile\Models\Files;

trait ProductCreatable
{
    /**
     * Boot function from Laravel.
     */
    public static function bootProductCreatable() {
        static::creating(function ($model) {
            $code = Str::random(10);
            if(empty($model->code) && is_null($model->code)) {
                $model->code = $code;
            }

            if(empty($model->slug) && is_null($model->slug)) {
                $model->slug = Str::slug($model->name, '-') .'-'. $code;
            }
            $model->slug = $model->slug .'-'. $code;

            if(empty($model->preorder) && is_null($model->preorder)) {
                $model->preorder = '{"available":false,"duration":null,"time_unit":"day"}';
            }

            if(!is_null($model->price_discount) && !empty($model->price_discount)) {
                $model->price_discount_percentage = ((float) $model->price_discount / (float) $model->price) * 100;
            }
        });

        static::updating(function ($model) {

            if(!is_null($model->price_discount) && !empty($model->price_discount)) {
                $model->price_discount_percentage = ((float) $model->price_discount / (float) $model->price) * 100;
            }

            $name = $model->name;
            $old_name = $model->getOriginal('name');
            if($name == $old_name) {
                return;
            }
            $model->slug = Str::slug($model->name, '-') .'-'. $model->code;
        });

        static::created(function ($model) {
            Files::where('foreign_id', $model->code)
            ->update(['foreign_id' => $model->id]);

            $showcases = request()->get('showcases');
            $productShowcases = [];
            foreach ($showcases as $value) {
                $productShowcases[] = [
                    'id' => Str::uuid()->toString(),
                    'product_id' => $model->id,
                    'showcase_id' => $value,
                    'created_at' => date("Y-m-d H:i:s", time()),
                    'updated_at' => date("Y-m-d H:i:s", time()),
                ];
            }
            DB::table('product_showcases')->insert($productShowcases);
        });

    }
}
