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

            $model->user_id = $user->id;
            $model->price = $product->price;
            $model->quantity = 1;
            $model->total = $product->price;
        });
    }
}
