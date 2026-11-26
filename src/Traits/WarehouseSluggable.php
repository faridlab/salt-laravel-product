<?php

namespace SaltProduct\Traits;

use Illuminate\Support\Str;

/**
 * A warehouse's slug is a stable key: shipping integrations name a warehouse by it. It is derived from the name when
 * the warehouse is created, follows the name only when the name changes, and is otherwise never touched. A slug that
 * another warehouse already uses gets "-2", "-3", ... appended; the warehouse itself never counts as a clash.
 */
trait WarehouseSluggable
{
    /**
     * Boot function from Laravel.
     */
    public static function bootWarehouseSluggable() {
        static::creating(function ($model) {
            $base = filled($model->slug) ? $model->slug : Str::slug($model->name, '-');
            $model->slug = $model->uniqueWarehouseSlug($base);
        });

        static::updating(function ($model) {
            if ($model->isDirty('slug') && filled($model->slug)) {
                // A slug set on purpose is kept, made unique against the other warehouses.
                $model->slug = $model->uniqueWarehouseSlug($model->slug);
            } elseif ($model->isDirty('name')) {
                // Its source changed: derive it again from the new name.
                $model->slug = $model->uniqueWarehouseSlug(Str::slug($model->name, '-'));
            } else {
                // Nothing that owns the slug changed (an emptied slug included): keep the stored one.
                $model->slug = $model->getOriginal('slug');
            }
        });
    }

    /** `$base`, or `$base-2`, `$base-3`, ... for the first one no other warehouse uses. */
    protected function uniqueWarehouseSlug(string $base): string
    {
        $slug = $base;
        $suffix = 2;
        while ($this->warehouseSlugTaken($slug)) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }

    protected function warehouseSlugTaken(string $slug): bool
    {
        $query = static::query()->where('slug', $slug);
        if ($this->exists) {
            $query->whereKeyNot($this->getKey());
        }

        return $query->exists();
    }
}
