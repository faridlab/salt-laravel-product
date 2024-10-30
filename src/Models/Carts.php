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
use SaltProduct\Traits\Shopable;

class Carts extends Resources {

    use Uuids;
    use ObservableModel;
    use Shopable;

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
        'status',
        'currency',
        'price',
        'quantity',
        'total',
        'data',
    ];

    protected $rules = array(
        'user_id' => 'nullable|string',
        'product_id' => 'required|string',
        'status' => 'nullable|in:active,checkout,cancel',
        'currency' => 'nullable|in:IDR,USD,EUR',
        'price' => 'nullable|numeric',
        'quantity' => 'nullable|integer',
        'total' => 'nullable|integer',
        'data' => 'nullable|json',
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

    public function user() {
        return $this->belongsTo('SaltLaravel\Models\Users', 'user_id', 'id')->withTrashed();
    }

}
