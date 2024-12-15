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
            // $model->slug = $model->slug .'-'. $code;

            if(empty($model->preorder) && is_null($model->preorder)) {
                $preorder = [
                    "available" => false,
                    "duration" => null,
                    "time_unit" => "day"
                ];
                $model->preorder = $preorder;
            }

            $stock = [
                "total" => request()->get('stock_total', 1000),
                "minimum_alert" => request()->get('stock_minimum_alert', 10),
                "wording" => request()->get('stock_wording', "Stock terbatas, buruan dapatkan produk impianmu"),
                "main" => request()->get('stock_total', 1000),
                "available" => request()->get('stock_total', 1000)
            ];
            $model->stock = $stock;

            $dimension = [
                "length" => request()->get('dimension_length', 0),
                "width" => request()->get('dimension_width', 0),
                "height" => request()->get('dimension_height', 0),
            ];
            $model->dimension = $dimension;

            if(!is_null($model->price_discount) && !empty($model->price_discount)) {
                $discount = ((float) $model->price_discount / (float) $model->price) * 100;
                $model->price_discount_percentage = (float) number_format((float) $discount, 1, '.', '');
            }
        });

        static::updating(function ($model) {
            if (request()->isMethod('patch')) {
                $params = request()->all();
                foreach ($params as $key => $value) {
                    $model[$key] = $value;
                }
                return;
            }

            if(!is_null($model->price_discount) && !empty($model->price_discount)) {
                $discount = ((float) $model->price_discount / (float) $model->price) * 100;
                $model->price_discount_percentage = (float) number_format((float) $discount, 1, '.', '');
            }

            $stock = [
                "total" => request()->get('stock_total', $model->stock->total),
                "minimum_alert" => request()->get('stock_minimum_alert', $model->stock->minimum_alert),
                "wording" => request()->get('stock_wording', $model->stock->wording),
                "main" => request()->get('stock_total', $model->stock->main),
                "available" => request()->get('stock_total', $model->stock->available)
            ];
            $model->stock = $stock;

            $dimension = [
                "length" => request()->get('dimension_length', $model->dimension->length),
                "width" => request()->get('dimension_width', $model->dimension->width),
                "height" => request()->get('dimension_height', $model->dimension->height),
            ];
            $model->dimension = $dimension;

            $name = $model->name;
            $old_name = $model->getOriginal('name');
            if($name == $old_name) {
                return;
            }
            // $model->slug = Str::slug($model->name, '-') .'-'. $model->code;
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
