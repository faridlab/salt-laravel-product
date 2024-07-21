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
use SaltProduct\Traits\Sluggable;
use SaltProduct\Traits\Orderable;

class ProductStocks extends Resources {

    use Uuids;
    use ObservableModel;
    use Sluggable;
    use Orderable;

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
        'status',
        'total',
    ];

    protected $rules = array(
        'product_id' => 'required|string',
        'warehouse_id' => 'required|string',
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
        'status',
        'total',
    );
    protected $fillable = array(
        'product_id',
        'warehouse_id',
        'status',
        'total',
    );
    protected $casts = [];

    public function category() {
        return $this->belongsTo('SaltCategories\Models\Categories', 'category_id', 'id')->withTrashed();
    }

    public function brand() {
        return $this->hasMany('SaltProduct\Models\Brands', 'brand_id', 'id')->withTrashed();
    }

}
