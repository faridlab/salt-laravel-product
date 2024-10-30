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

class Orders extends Resources {

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
        'transaction_id',
        'user_id',
        'product_id',
        'warehouse_id',
        'promo_id',
        'status',
        'currency',
        'price',
        'quantity',
        'tax',
        'discount',
        'total',
        'data',
    ];

    protected $rules = array(
        'transaction_id' => 'nullable|string',
        'user_id' => 'required|string',
        'product_id' => 'required|string',
        'warehouse_id' => 'required|string',
        'promo_id' => 'nullable|string',
        'status' => 'nullable|in:settlement,unpaid,cancel,paid',
        'currency' => 'nullable|in:IDR,USD,EUR',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'tax' => 'nullable|integer',
        'discount' => 'nullable|integer',
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
        'promo_id',
        'status',
        'currency',
        'price',
        'quantity',
        'tax',
        'discount',
        'total',
        'data',
    );
    protected $fillable = array(
        'user_id',
        'product_id',
        'warehouse_id',
        'promo_id',
        'status',
        'currency',
        'price',
        'quantity',
        'tax',
        'discount',
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

    public function promo() {
        return $this->belongsTo('SaltProduct\Models\Promotions', 'promo_id', 'id')->withTrashed();
    }

    public function transaction() {
        return $this->belongsTo('SaltProduct\Models\Transactions', 'transaction_id', 'id')->withTrashed();
    }
}
