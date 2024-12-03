<?php

namespace SaltProduct\Traits;

use Illuminate\Support\Str;
use SaltProduct\Models\WarehouseAddresses;

trait WarehouseAddressable
{
    /**
     * Boot function from Laravel.
     */
    public static function bootWarehouseAddressable() {
        static::created(function ($model) {
            WarehouseAddresses::create([
                'warehouse_id' => $model->id,
                'country_id' => request()->get('country_id'),
                'province_id' => request()->get('province_id'),
                'city_id' => request()->get('city_id'),
                'district_id' => request()->get('district_id'),
                'subdistrict_id' => request()->get('subdistrict_id'),
                'address' => request()->get('address'),
                // 'address2' => request()->get('address2'),
                // 'rtrw' => request()->get('rtrw'),
                'postalcode' => request()->get('postalcode'),
                'latitude' => request()->get('latitude'),
                'longitude' => request()->get('longitude'),
            ]);
        });

        static::updated(function ($model) {
            $address = WarehouseAddresses::where('warehouse_id', $model->id)->first();
            $address->country_id = request()->get('country_id');
            $address->province_id = request()->get('province_id');
            $address->city_id = request()->get('city_id');
            $address->district_id = request()->get('district_id');
            $address->subdistrict_id = request()->get('subdistrict_id');
            $address->address = request()->get('address');
            // $address->address2 = request()->get('address2');
            // $address->rtrw = request()->get('rtrw');
            $address->postalcode = request()->get('postalcode');
            $address->latitude = request()->get('latitude');
            $address->longitude = request()->get('longitude');
            $address->save();
        });
    }
}
