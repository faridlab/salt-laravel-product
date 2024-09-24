<?php

namespace SaltProduct\Traits;

use Illuminate\Support\Str;
use SaltProduct\Models\Categories;
use SaltProduct\Models\Products;

trait Wishable
{
    /**
     * Boot function from Laravel.
     */
    public static function bootWishable() {
        static::creating(function ($model) {
            $user = auth()->user();
            $model->user_id = $user->id;
        });
    }
}
