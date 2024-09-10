<?php

namespace SaltProduct\Traits;

use Illuminate\Support\Str;
use SaltProduct\Models\Warehouses;

trait WarehouseSluggable
{
    /**
     * Boot function from Laravel.
     */
    public static function bootWarehouseSluggable() {
        static::creating(function ($model) {
            if(empty($model->slug) && is_null($model->slug)) {
                $model->slug = Str::slug($model->name, '-');
            }

            $count = Warehouses::where('slug', $model->slug)->count();
            if($count === 0) return;

            $model->slug = $model->slug .'-'. ($count + 1);
        });

        static::updating(function ($model) {
            $count = Warehouses::where('slug', $model->slug)->count();
            if($count === 0) return;

            $model->slug = $model->slug .'-'. ($count + 1);
        });
    }
}
