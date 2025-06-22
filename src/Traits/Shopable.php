<?php

namespace SaltProduct\Traits;

use Illuminate\Support\Str;
use SaltProduct\Models\Categories;
use SaltProduct\Models\Products;

trait Shopable
{
    /**
     * Boot function from Laravel.
     */
    public static function bootShopable() {
        static::creating(function ($model) {
            $user = auth()->user();
            $product = Products::find($model->product_id);
            $price = intval($product->price_discount) > 0 ? intval($product->price_discount): intval($product->price);
            $model->user_id = $user->id;
            $model->price = $price;
            $model->total = $price * intval($model->quantity);
        });

        static::updating(function ($model) {
            $product = Products::find($model->product_id);
            $price = intval($product->price_discount) > 0 ? intval($product->price_discount): intval($product->price);
            $model->price = $price;
            $model->total = $price * intval($model->quantity);
        });
    }
}
