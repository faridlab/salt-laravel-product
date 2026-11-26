<?php

namespace SaltProduct\Traits;

use SaltProduct\Models\WarehouseAddresses;

/**
 * The warehouse form sends the warehouse's address with the warehouse. Only the address fields the request actually
 * carries are written: a request without any (a status toggle, a description edit, a warehouse created without an
 * address) leaves the address as it is, instead of overwriting it with nulls, which failed on the NOT NULL columns.
 */
trait WarehouseAddressable
{
    /** The address fields a warehouse request may carry. */
    public static function warehouseAddressFields(): array
    {
        return [
            'country_id',
            'province_id',
            'city_id',
            'district_id',
            'subdistrict_id',
            'address',
            // 'address2',
            // 'rtrw',
            'postalcode',
            'latitude',
            'longitude',
        ];
    }

    /**
     * Boot function from Laravel.
     */
    public static function bootWarehouseAddressable() {
        // `saved`, not `created`/`updated`: a request that changes only the address leaves the warehouse row clean,
        // and Eloquent fires `updated` only when the row itself changed.
        static::saved(function ($model) {
            $request = request();
            $fields = array_values(array_filter(
                static::warehouseAddressFields(),
                fn (string $field) => $request->has($field)
            ));
            if ($fields === []) {
                return;
            }

            $address = WarehouseAddresses::where('warehouse_id', $model->id)->first()
                ?? new WarehouseAddresses();
            $address->warehouse_id = $model->id;
            foreach ($fields as $field) {
                $address->{$field} = $request->get($field);
            }
            $address->save();
        });
    }
}
