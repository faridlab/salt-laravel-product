<?php

namespace SaltProduct\Traits;

use Illuminate\Support\Str;
use SaltProduct\Models\Products;
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
                return;
            }
            $model->slug = $model->slug .'-'. $code;

            if(empty($model->preorder) && is_null($model->preorder)) {
                $model->preorder = '{"available":false,"duration":null,"time_unit":"day"}';
            }
        });

        static::updating(function ($model) {
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
        });

    }
}
