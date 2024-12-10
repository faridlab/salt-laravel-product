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

class Promotions extends Resources {

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
        'name',
        'code',
        'is_flashsale',
        'status',
        'type',
        'category',
        'product_id',
        'category_id',
        'showcase_id',
        'start_at',
        'expired_at',
        'quota',
        'discount_unit',
        'discount',
        'discount_upto',
    ];

    protected $rules = array(
        'name' => 'required|string',
        'code' => 'required|string',
        'is_flashsale' => 'nullable|boolean',
        'status' => 'nullable|in:inactive,active,expired,invalid',
        'type' => 'nullable|in:standard,minimum,quantity,event',
        'category' => 'nullable|in:all,product,category,showcase,bundle',
        'product_id' => 'nullable|string',
        'category_id' => 'nullable|string',
        'showcase_id' => 'nullable|string',
        'start_at' => 'nullable|date_format:Y-m-d',
        'expired_at' => 'nullable|date_format:Y-m-d',
        'quota' => 'required|integer',
        'discount_unit' => 'nullable|in:price,percentage',
        'discount' => 'nullable|integer',
        'discount_upto' => 'nullable|integer',
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
        'name',
        'code',
        'is_flashsale',
        'status',
        'type',
        'category',
        'product_id',
        'category_id',
        'showcase_id',
        'start_at',
        'expired_at',
        'quota',
        'discount_unit',
        'discount',
        'discount_upto',
    );
    protected $fillable = array(
        'name',
        'code',
        'is_flashsale',
        'status',
        'type',
        'category',
        'product_id',
        'category_id',
        'showcase_id',
        'start_at',
        'expired_at',
        'quota',
        'discount_unit',
        'discount',
        'discount_upto',
    );
    protected $casts = [];

    public function product() {
        return $this->belongsTo('SaltProduct\Models\Products', 'product_id', 'id')->withTrashed();
    }

    public function category() {
        return $this->belongsTo('SaltCategories\Models\Categories', 'category_id', 'id')->withTrashed();
    }

    public function bundle() {
        return $this->hasMany('SaltProduct\Models\PromotionBundle', 'promo_id', 'id')->withTrashed();
    }

    public function showcase() {
        return $this->belongsTo('SaltProduct\Models\Showcases', 'showcase_id', 'id')->withTrashed();
    }

    public function showcase_products() {
        return $this->hasMany('SaltProduct\Models\ProductShowcases', 'showcase_id', 'id')->withTrashed();
    }

}
