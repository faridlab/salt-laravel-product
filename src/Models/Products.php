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

class Products extends Resources {

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
        'code',
        'name',
        'slug',
        'description',
        'category_id',
        'currency',
        'price',
        'status',
        'condition',
        'min_order',
        'weight_unit',
        'weight',
        'dimension_unit',
        'dimension',
        'guarantee',
        'is_must_insurance',
        'stock',
        'sku',
        'sni',
        'wholesale',
        'preorder',
        'variant',
        'brand_id',
        'data',
    ];

    protected $rules = array(
        'code' => 'nullable|string',
        'name' => 'required|string',
        'slug' => 'nullable|string',
        'description' => 'required|string',
        'category_id' => 'required|string',
        'currency' => 'nullable|string',
        'price' => 'required|double',
        'status' => 'nullable|in:banned,pending,deleted,active,featured,inactive',
        'condition' => 'nullable|in:new,used',
        'min_order' => 'nullable|integer',
        'weight_unit' => 'nullable|in:gram,kg',
        'weight' => 'nullable|double',
        'dimension_unit' => 'nullable|in:m,cm,mm',
        'dimension' => 'nullable|json',
        'guarantee' => 'nullable|in:distributor,brand,store,indonesia,international,noguarantee',
        'is_must_insurance' => 'nullable|boolean',
        'stock' => 'nullable|json',
        'sku' => 'nullable|string',
        'sni' => 'nullable|string',
        'wholesale' => 'nullable|json',
        'preorder' => 'nullable|json',
        'variant' => 'nullable|json',
        'brand_id' => 'nullable|string',
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
        'code',
        'name',
        'slug',
        'description',
        'category_id',
        'currency',
        'price',
        'status',
        'condition',
        'min_order',
        'weight_unit',
        'weight',
        'dimension_unit',
        'dimension',
        'guarantee',
        'is_must_insurance',
        'stock',
        'sku',
        'sni',
        'wholesale',
        'preorder',
        'variant',
        'brand_id',
        'data',
    );
    protected $fillable = array(
        'code',
        'name',
        'slug',
        'description',
        'category_id',
        'currency',
        'price',
        'status',
        'condition',
        'min_order',
        'weight_unit',
        'weight',
        'dimension_unit',
        'dimension',
        'guarantee',
        'is_must_insurance',
        'stock',
        'sku',
        'sni',
        'wholesale',
        'preorder',
        'variant',
        'brand_id',
        'data',
    );
    protected $casts = [];

    public function category() {
        return $this->belongsTo('SaltCategories\Models\Categories', 'category_id', 'id')->withTrashed();
    }

    public function brand() {
        return $this->hasMany('SaltProduct\Models\Brands', 'brand_id', 'id')->withTrashed();
    }

}
