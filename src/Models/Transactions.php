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
        'purchase_expired_time',
        'payment_link',
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
        'delivery_type',
    ];

    protected $rules = array(
        'trx_id' => 'nullable|string',
        'user_id' => 'nullable|string',
        'promo_id' => 'nullable|string',
        'purchase_date' => 'nullable|date_format:Y-m-d H:i:s',
        'purchase_expired_time' => 'nullable|date_format:Y-m-d H:i:s',
        'payment_link' => 'nullable|string',
        'status' => 'nullable|in:settlement,unpaid,cancel,paid',
        'currency' => 'nullable|in:IDR,USD,EUR',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'tax' => 'nullable|integer',
        'address' => 'nullable|array',
        'expedition' => 'nullable|json',
        'admin_fee' => 'nullable|numeric',
        'insurance_fee' => 'nullable|numeric',
        'expedition_fee' => 'nullable|numeric',
        'discount' => 'nullable|integer',
        'total' => 'required|integer',
        'data' => 'nullable|json',
        'delivery_type' => 'nullable|in:expedition,onstore',
    );

    protected $auths = array (
        'index',
        'store',
        'show',
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
        'promo_id',
        'purchase_date',
        'purchase_expired_time',
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
        'delivery_type',
    );
    protected $fillable = array(
        'trx_id',
        'user_id',
        'promo_id',
        'purchase_date',
        'purchase_expired_time',
        'payment_link',
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
        'delivery_type',
    );

    protected $casts = [
        'address' => 'array',
        'expedition' => 'array',
    ];

    public function user() {
        return $this->belongsTo('SaltLaravel\Models\Users', 'user_id', 'id')->withTrashed();
    }

    public function promo() {
        return $this->belongsTo('SaltProduct\Models\Promotions', 'promo_id', 'id')->withTrashed();
    }

    public function orders() {
        return $this->hasMany('SaltProduct\Models\Orders', 'transaction_id', 'id')->withTrashed();
    }

    public function statuses() {
        return $this->hasMany('SaltProduct\Models\TrackingOrders', 'transaction_id', 'id')->withTrashed();
    }

    public function products() {
        return $this->belongsToMany('SaltProduct\Models\Products', 'orders', 'transaction_id', 'product_id');
    }
}
