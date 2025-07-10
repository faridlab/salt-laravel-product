<?php

namespace SaltProduct\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Schema;

use SaltFile\Traits\Fileable;
use SaltProduct\Models\WarehouseAddresses;
use SaltCountries\Models\Countries;
use SaltCountries\Models\Provinces;
use SaltCountries\Models\Cities;
use SaltCountries\Models\Districts;
use SaltCountries\Models\Subdistricts;

use SaltLaravel\Models\Resources;
use SaltLaravel\Traits\ObservableModel;
use SaltLaravel\Traits\Uuids;
use SaltProduct\Traits\WarehouseSluggable;
use SaltProduct\Traits\WarehouseAddressable;

class Warehouses extends Resources {

    use Uuids;
    use ObservableModel;
    use WarehouseSluggable;
    use WarehouseAddressable;

    use Fileable;
    protected $fileableFields = ['thumbnail', 'image'];
    protected $fileableCascade = true;
    protected $fileableDirs = [
        'thumbnail' => 'warehouses/thumbnail',
        'image' => 'warehouses/image',
    ];

    protected $filters = [
        'default',
        'search',
        'fields',
        'limit',
        'page',
        'relationship',
        'withtrashed',
        'orderby',
        // Fields table warehouses
        'id',
        'name',
        'slug',
        'short_desc',
        'desc',
        'status',
        'code'
    ];

    protected $rules = array(
        'name' => 'required|string',
        'slug' => 'nullable|string',
        'short_desc' => 'nullable|string',
        'desc' => 'nullable|string',
        'status' => 'nullable|string',
        'code' => 'nullable|string'
    );

    protected $auths = array (
        // 'index',
        'store',
        // 'show',
        'update',
        'patch',
        'destroy',
        'trash',
        'trashed',
        'restore',
        'delete',
        'import',
        'export',
        'report'
    );

    protected $forms = array();
    protected $structures = array();

    protected $searchable = array('name', 'slug', 'short_desc', 'desc', 'status', 'code');
    protected $fillable = array('name', 'slug', 'short_desc', 'desc', 'status', 'code');
    protected $casts = [];

    public function image() {
        return $this->hasOne('SaltFile\Models\Files', 'foreign_id', 'id')
                    ->where('foreign_table', 'warehouses')
                    ->where('directory', 'warehouses/image');
    }

    public function thumbnail() {
        return $this->hasOne('SaltFile\Models\Files', 'foreign_id', 'id')
                    ->where('foreign_table', 'warehouses')
                    ->where('directory', 'warehouses/thumbnail');
    }

    public function address() {
        return $this->belongsTo('SaltProduct\Models\WarehouseAddresses', 'id', 'warehouse_id');
    }

    public function country() {
        return $this->hasOneThrough(Countries::class, WarehouseAddresses::class, 'warehouse_id', 'id', 'id', 'country_id');
    }

    public function province() {
        return $this->hasOneThrough(Provinces::class, WarehouseAddresses::class, 'warehouse_id', 'id', 'id', 'province_id');
    }

    public function city() {
        return $this->hasOneThrough(Cities::class, WarehouseAddresses::class, 'warehouse_id', 'id', 'id', 'city_id');
    }

    public function district() {
        return $this->hasOneThrough(Districts::class, WarehouseAddresses::class, 'warehouse_id', 'id', 'id', 'district_id');
    }

    public function subdistrict() {
        return $this->hasOneThrough(Subdistricts::class, WarehouseAddresses::class, 'warehouse_id', 'id', 'id', 'subdistrict_id');
    }

}
