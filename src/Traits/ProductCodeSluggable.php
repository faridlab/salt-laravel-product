<?php

namespace SaltProduct\Traits;

use Illuminate\Support\Str;
use SaltProduct\Models\Products;

trait ProductCodeSluggable
{
    /**
     * Boot function from Laravel.
     */
    public static function bootProductCodeSluggable() {
        static::creating(function ($model) {
            $code = Str::random(10);
            if(empty($model->code) && is_null($model->code)) {
                $model->code = $code;
            }

            if(empty($model->slug) && is_null($model->slug)) {
                $model->slug = Str::slug($model->name, '-') .'-'. $code;
                return;
            }
            $model->slug = $model->slug .'-'. $code;
        });

        static::updating(function ($model) {
            $name = $model->name;
            $old_name = $model->getOriginal('name');
            if($name == $old_name) {
                return;
            }
            $model->slug = Str::slug($model->name, '-') .'-'. $model->code;
        });
    }
}
