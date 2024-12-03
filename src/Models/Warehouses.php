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
        'status'
    ];

    protected $rules = array(
        'name' => 'required|string',
        'slug' => 'nullable|string',
        'short_desc' => 'nullable|string',
        'desc' => 'nullable|string',
        'status' => 'nullable|string'
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

    protected $searchable = array('name', 'slug', 'short_desc', 'desc', 'status');
    protected $fillable = array('name', 'slug', 'short_desc', 'desc', 'status');
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
        return $this->hasOne('SaltProduct\Models\WarehouseAddresses', 'warehouse_id', 'id');
    }

}
