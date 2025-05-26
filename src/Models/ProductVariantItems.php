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

class ProductVariantItems extends Resources {

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
        'variant',
        'price',
        'stock',
        'sku',
        'weight',
        'status',
        'is_primary',
    ];

    protected $rules = array(
        'product_id' => 'nullable|string',
        'variant' => 'required|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'sku' => 'nullable|string',
        'weight' => 'required|numeric',
        'status' => 'required|in:active,inactive',
        'is_primary' => 'required|boolean',
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
        'variant',
        'price',
        'stock',
        'sku',
        'weight',
        'status',
        'is_primary',
    );
    protected $fillable = array(
        'product_id',
        'variant',
        'price',
        'stock',
        'sku',
        'weight',
        'status',
        'is_primary',
    );
    protected $casts = [];

    public function product() {
        return $this->belongsTo('SaltProduct\Models\Products', 'product_id', 'id')->withTrashed();
    }
}
