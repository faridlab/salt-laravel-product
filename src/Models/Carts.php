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

class Carts extends Resources {

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
        'user_id',
        'product_id',
        'warehouse_id',
        'status',
        'currency',
        'price',
        'quantity',
        'total',
        'data',
    ];

    protected $rules = array(
        'user_id' => 'required|string',
        'product_id' => 'required|string',
        'warehouse_id' => 'required|string',
        'status' => 'nullable|in:active,checkout,cancel',
        'currency' => 'nullable|in:IDR,USD,EUR',
        'price' => 'required|double',
        'quantity' => 'required|integer',
        'total' => 'required|integer',
        'data' => 'nullable|json',
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
        'user_id',
        'product_id',
        'warehouse_id',
        'status',
        'currency',
        'price',
        'quantity',
        'total',
        'data',
    );
    protected $fillable = array(
        'user_id',
        'product_id',
        'warehouse_id',
        'status',
        'currency',
        'price',
        'quantity',
        'total',
        'data',
    );
    protected $casts = [];

    public function product() {
        return $this->belongsTo('SaltProduct\Models\Products', 'product_id', 'id')->withTrashed();
    }

    public function warehouse() {
        return $this->belongsTo('SaltProduct\Models\Warehuses', 'warehouse_id', 'id')->withTrashed();
    }

    public function user() {
        return $this->belongsTo('SaltLaravel\Models\Users', 'user_id', 'id')->withTrashed();
    }

}
