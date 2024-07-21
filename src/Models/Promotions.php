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
        'type',
        'category',
        'product_id',
        'category_id',
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
        'type' => 'nullable|in:standard,minimum,quantity,event',
        'category' => 'nullable|in:all,product,category,bundle',
        'product_id' => 'nullable|string',
        'category_id' => 'nullable|string',
        'start_at' => 'nullable|date_format:Y-m-d H:i:s',
        'expired_at' => 'nullable|date_format:Y-m-d H:i:s',
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
        'type',
        'category',
        'product_id',
        'category_id',
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
        'type',
        'category',
        'product_id',
        'category_id',
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
}
