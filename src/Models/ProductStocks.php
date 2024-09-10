<?php

namespace SaltProduct\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Schema;

use SaltLaravel\Models\Resources;
use SaltLaravel\Traits\ObservableModel;
use SaltLaravel\Traits\Uuids;

class ProductStocks extends Resources {

    use Uuids;
    use ObservableModel;

    protected $filters = [
        'default',
        'search',
        'fields',
        'limit',
        'page',
        'relationship',
        'withtrashed',
        'orderby',
        // Fields table categories
        'id',
        'product_id',
        'warehouse_id',
        'variant_id',
        'status',
        'total',
    ];

    protected $rules = array(
        'product_id' => 'required|string',
        'warehouse_id' => 'required|string',
        'variant_id' => 'nullable|string',
        'status' => 'nullable|in:intial,restock,cancel,out',
        'price' => 'required|integer',
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
        'product_id',
        'warehouse_id',
        'variant_id',
        'status',
        'total',
    );
    protected $fillable = array(
        'product_id',
        'warehouse_id',
        'variant_id',
        'status',
        'total',
    );
    protected $casts = [];

    public function product() {
        return $this->belongsTo('SaltProduct\Models\Products', 'product_id', 'id')->withTrashed();
    }

    public function warehouse() {
        return $this->belongsTo('SaltProduct\Models\Warehouses', 'warehouse_id', 'id')->withTrashed();
    }

    public function variant() {
        return $this->belongsTo('SaltProduct\Models\ProductVariantUnits', 'variant_id', 'id')->withTrashed();
    }

}
