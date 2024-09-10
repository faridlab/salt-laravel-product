<?php

namespace SaltProduct\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Schema;

use SaltFile\Traits\Fileable;
use SaltLaravel\Models\Resources;
use SaltLaravel\Traits\ObservableModel;
use SaltLaravel\Traits\Uuids;

class WarehouseAddresses extends Resources {

    use Uuids;
    use ObservableModel;

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
        'warehouse_id',
        'country_id',
        'province_id',
        'city_id',
        'district_id',
        'subdistrict_id',
        'address',
        'address2',
        'rtrw',
        'postalcode',
        'latitude',
        'longitude',
    ];

    protected $rules = array(
        'warehouse_id' => 'required|string',
        'country_id' => 'required|string',
        'province_id' => 'required|string',
        'city_id' => 'required|string',
        'district_id' => 'required|string',
        'subdistrict_id' => 'nullable|string',
        'address' => 'required|string',
        'address2' => 'nullable|string',
        'rtrw' => 'nullable|string',
        'postalcode' => 'nullable|string',
        'latitude' => 'nullable|double',
        'longitude' => 'nullable|double',
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

    protected $searchable = array(
        'warehouse_id',
        'country_id',
        'province_id',
        'city_id',
        'district_id',
        'subdistrict_id',
        'address',
        'address2',
        'rtrw',
        'postalcode',
        'latitude',
        'longitude'
    );
    protected $fillable = array(
        'warehouse_id',
        'country_id',
        'province_id',
        'city_id',
        'district_id',
        'subdistrict_id',
        'address',
        'address2',
        'rtrw',
        'postalcode',
        'latitude',
        'longitude'
    );
    protected $casts = [];

    public function warehouse() {
        return $this->belongsTo('SaltProduct\Models\Warehouses', 'warehouse_id', 'id')->withTrashed();
    }

    public function country() {
        return $this->belongsTo('SaltCountries\Models\Countries', 'country_id', 'id')->withTrashed();
    }

    public function province() {
        return $this->belongsTo('SaltCountries\Models\Provinces', 'province_id', 'id')->withTrashed();
    }

    public function city() {
        return $this->belongsTo('SaltCountries\Models\Cities', 'city_id', 'id')->withTrashed();
    }

    public function District() {
        return $this->belongsTo('SaltCountries\Models\Districts', 'district_id', 'id')->withTrashed();
    }

    public function Subdistrict() {
        return $this->belongsTo('SaltCountries\Models\Subdistricts', 'subdistrict_id', 'id')->withTrashed();
    }

}
