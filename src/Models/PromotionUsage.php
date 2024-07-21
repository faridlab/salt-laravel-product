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

class PromotionUsage extends Resources {

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
        'promo_id',
        'product_id',
        'quantity',
        'discount',
    ];

    protected $rules = array(
        'user_id' => 'required|string',
        'product_id' => 'required|string',
        'promor_id' => 'required|string',
        'quantity' => 'required|integer',
        'discount' => 'required|integer',
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
        'promo_id',
        'product_id',
        'quantity',
        'discount',
    );
    protected $fillable = array(
        'user_id',
        'promo_id',
        'product_id',
        'quantity',
        'discount',
    );
    protected $casts = [];

    public function user() {
        return $this->belongsTo('SaltLaravel\Models\Users', 'user_id', 'id')->withTrashed();
    }

    public function product() {
        return $this->belongsTo('SaltProduct\Models\Products', 'product_id', 'id')->withTrashed();
    }

    public function promo() {
        return $this->belongsTo('SaltProduct\Models\Promotions', 'promo_id', 'id')->withTrashed();
    }

}
