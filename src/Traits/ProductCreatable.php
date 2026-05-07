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
                $price_discount = abs($model->price - $model->price_discount);
                $discount = ((float) $price_discount / (float) $model->price) * 100;
                $model->price_discount_percentage = (float) number_format((float) $discount, 1, '.', '');
            }
        });

        static::updating(function ($model) {
            if (request()->isMethod('patch')) {
                $params = request()->all();
                $stockKeys = ['stock_total', 'stock_available', 'stock_minimum_alert', 'stock_wording'];
                foreach ($params as $key => $value) {
                    if (in_array($key, $stockKeys, true)) continue;
                    $model[$key] = $value;
                }

                if (array_intersect(['price', 'price_discount'], array_keys($params))) {
                    if (!is_null($model->price_discount) && !empty($model->price_discount) && (float) $model->price > 0) {
                        $price_discount = abs($model->price - $model->price_discount);
                        $discount = ((float) $price_discount / (float) $model->price) * 100;
                        $model->price_discount_percentage = (float) number_format((float) $discount, 1, '.', '');
                    } else {
                        $model->price_discount_percentage = 0;
                    }
                }

                if (array_intersect($stockKeys, array_keys($params))) {
                    $current = is_array($model->stock) ? $model->stock : [];
                    $stock = [
                        "total" => request()->has('stock_total') ? (int) request()->get('stock_total') : ($current['total'] ?? 0),
                        "minimum_alert" => request()->has('stock_minimum_alert') ? (int) request()->get('stock_minimum_alert') : ($current['minimum_alert'] ?? 0),
                        "wording" => request()->get('stock_wording', $current['wording'] ?? ''),
                        "main" => request()->has('stock_total') ? (int) request()->get('stock_total') : ($current['main'] ?? 0),
                        "available" => request()->has('stock_available')
                            ? (int) request()->get('stock_available')
                            : (request()->has('stock_total') ? (int) request()->get('stock_total') : ($current['available'] ?? 0))
                    ];
                    $model->stock = $stock;
                }
                return;
            }

            if(!is_null($model->price_discount) && !empty($model->price_discount)) {
                $price_discount = abs($model->price - $model->price_discount);
                $discount = ((float) $price_discount / (float) $model->price) * 100;
                $model->price_discount_percentage = (float) number_format((float) $discount, 1, '.', '');
            }

            $stock = [
                "total" => request()->get('stock_total', $model->stock['total']),
                "minimum_alert" => request()->get('stock_minimum_alert', $model->stock['minimum_alert']),
                "wording" => request()->get('stock_wording', $model->stock['wording']),
                "main" => request()->get('stock_total', $model->stock['main']),
                "available" => request()->get('stock_total', $model->stock['available'])
            ];
            $model->stock = $stock;

            $dimension = [
                "length" => request()->get('dimension_length', $model->dimension['length']),
                "width" => request()->get('dimension_width', $model->dimension['width']),
                "height" => request()->get('dimension_height', $model->dimension['height']),
            ];
            $model->dimension = $dimension;
        });

        static::updated(function ($model) {
            if (request()->isMethod('patch')) {
                return;
            }

            $showcases = request()->get('showcases');
            ProductShowcases::where('product_id', $model->id)->delete();
            foreach ($showcases as $value) {
                $productShowcases[] = [
                    'id' => Str::uuid()->toString(),
                    'product_id' => $model->id,
                    'showcase_id' => $value,
                    'created_at' => date("Y-m-d H:i:s", time()),
                    'updated_at' => date("Y-m-d H:i:s", time()),
                ];
            }
            ProductShowcases::insert($productShowcases);
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
