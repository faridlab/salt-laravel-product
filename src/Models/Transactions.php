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

class Transactions extends Resources {

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
        // Fields table transactions
        'id',
        'trx_id',
        'user_id',
        'product_id',
        'warehouse_id',
        'promo_id',
        'purchase_date',
        'status',
        'currency',
        'price',
        'quantity',
        'address',
        'expedition',
        'tax',
        'discount',
        'admin_fee',
        'insurance_fee',
        'expedition_fee',
        'total',
        'data',
    ];

    protected $rules = array(
        'trx_id' => 'nullable|string',
        'user_id' => 'required|string',
        'product_id' => 'required|string',
        'warehouse_id' => 'required|string',
        'promo_id' => 'nullable|string',
        'purchase_date' => 'nullable|date_format:Y-m-d H:i:s',
        'status' => 'nullable|in:settlement,unpaid,cancel,paid',
        'currency' => 'nullable|in:IDR,USD,EUR',
        'price' => 'required|double',
        'quantity' => 'required|integer',
        'tax' => 'nullable|integer',
        'address' => 'nullable|json',
        'expedition' => 'nullable|json',
        'admin_fee' => 'nullable|double',
        'insurance_fee' => 'nullable|double',
        'expedition_fee' => 'nullable|double',
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
        'trx_id',
        'user_id',
        'product_id',
        'warehouse_id',
        'promo_id',
        'purchase_date',
        'status',
        'currency',
        'price',
        'quantity',
        'address',
        'expedition',
        'tax',
        'discount',
        'admin_fee',
        'insurance_fee',
        'expedition_fee',
        'total',
        'data',
    );
    protected $fillable = array(
        'trx_id',
        'user_id',
        'product_id',
        'warehouse_id',
        'promo_id',
        'purchase_date',
        'status',
        'currency',
        'price',
        'quantity',
        'address',
        'expedition',
        'tax',
        'discount',
        'admin_fee',
        'insurance_fee',
        'expedition_fee',
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

    public function orders() {
        return $this->hasMany('SaltProduct\Models\Orders', 'transaction_id', 'id')->withTrashed();
    }

}
