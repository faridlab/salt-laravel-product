<?php

namespace SaltProduct\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Schema;

use SaltLaravel\Models\Resources;
use SaltFile\Traits\Fileable;
use SaltLaravel\Traits\ObservableModel;
use SaltLaravel\Traits\Uuids;
use SaltProduct\Traits\ProductCreatable;

class Products extends Resources {

    use Uuids;
    use ObservableModel;
    use ProductCreatable;

    use Fileable;
    protected $fileableFields = ['thumbnail', 'image'];
    protected $fileableCascade = true;
    protected $fileableDirs = [
        'thumbnail' => 'products/thumbnail',
        'image' => 'products/image',
    ];

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
        'price_discount',
        'price_discount_percentage',
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
        'video_url' => 'nullable|string',
        'price' => 'required|numeric',
        'price_discount' => 'nullable|numeric',
        'price_discount_percentage' => 'nullable|numeric',
        'status' => 'nullable|in:banned,pending,deleted,active,featured,inactive',
        'condition' => 'nullable|in:new,used',
        'min_order' => 'nullable|integer',
        'weight_unit' => 'nullable|in:gram,kg',
        'weight' => 'nullable|numeric',
        'dimension_unit' => 'nullable|in:m,cm,mm',
        'dimension' => 'nullable|array',
        'dimension_length' => 'nullable|numeric',
        'dimension_width' => 'nullable|numeric',
        'dimension_height' => 'nullable|numeric',
        'guarantee' => 'nullable|in:distributor,brand,store,indonesia,international,noguarantee',
        'is_must_insurance' => 'nullable|boolean',
        'stock' => 'nullable|array',
        'stock_total' => 'nullable|numeric',
        'stock_minimum_alert' => 'nullable|numeric',
        'stock_wording' => 'nullable|string',
        'sku' => 'nullable|string',
        'sni' => 'nullable|string',
        'wholesale' => 'nullable|array',
        'preorder' => 'nullable|array',
        'variant' => 'nullable|array',
        'brand_id' => 'nullable|string',
        'data' => 'nullable|array',
        'video_url' => 'nullable|string',
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
        'price_discount',
        'price_discount_percentage',
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
        'video_url',
    );
    protected $fillable = array(
        'code',
        'name',
        'slug',
        'description',
        'category_id',
        'currency',
        'price',
        'price_discount',
        'price_discount_percentage',
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
        'video_url',
    );

    protected $casts = [
        'stock' => 'array',
        'dimension' => 'array',
        'stock' => 'array',
        'wholesale' => 'array',
        'preorder' => 'array',
        'variant' => 'array',
        'data' => 'array',
    ];

    public function category() {
        return $this->belongsTo('SaltCategories\Models\Categories', 'category_id', 'id')->withTrashed();
    }

    public function brand() {
        return $this->belongsTo('SaltProduct\Models\Brands', 'brand_id', 'id')->withTrashed();
    }

    public function variants() {
        return $this->hasMany('SaltProduct\Models\ProductVariants', 'product_id', 'id')->withTrashed();
    }

    public function images() {
        return $this->hasMany('SaltFile\Models\Files', 'foreign_id', 'id')->orderBy('order', 'asc')->withTrashed();
    }

    public function showcases() {
        return $this->hasMany('SaltProduct\Models\ProductShowcases', 'product_id', 'id')->withTrashed();
    }

}
