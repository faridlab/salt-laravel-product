<?php

namespace SaltProduct\Traits;

use Illuminate\Support\Str;
use SaltProduct\Models\Brands;

trait Sluggable
{
    /**
     * Boot function from Laravel.
     */
    public static function bootSluggable() {
        static::creating(function ($model) {
            if(empty($model->slug) && is_null($model->slug)) {
                $model->slug = Str::slug($model->name, '-');
            }

            $count = Brands::where('slug', $model->slug)->count();
            if($count === 0) return;

            $model->slug = $model->slug .'-'. ($count + 1);
        });

        static::updating(function ($model) {
            $count = Brands::where('slug', $model->slug)->count();
            if($count === 0) return;

            $model->slug = $model->slug .'-'. ($count + 1);
        });
    }
}
