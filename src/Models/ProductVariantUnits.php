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

class ProductVariantUnits extends Resources {

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
        'variant_id',
        'type',
        'name',
        'is_primary',
        'status',
        'label',
        'label_english',
        'hex',
        'icon',
        'price',
        'stock',
        'sku',
        'weight',
    ];

    protected $rules = array(
        'variant_id' => 'required|string',
        'type' => 'nullable|in:color,size,tool,custom',
        'name' => 'required|string',
        'is_primary' => 'nullable|boolean',
        'status' => 'nullable|in:active,inactive',
        'label' => 'required|string',
        'label_english' => 'required|string',
        'hex' => 'nullable|string',
        'icon' => 'nullable|string',
        'price' => 'required|double',
        'stock' => 'required|integer',
        'sku' => 'nullable|string',
        'weight' => 'required|double',
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
        'variant_id',
        'type',
        'name',
        'is_primary',
        'status',
        'label',
        'label_english',
        'hex',
        'icon',
        'price',
        'stock',
        'sku',
        'weight',
    );
    protected $fillable = array(
        'variant_id',
        'type',
        'name',
        'is_primary',
        'status',
        'label',
        'label_english',
        'hex',
        'icon',
        'price',
        'stock',
        'sku',
        'weight',
    );
    protected $casts = [];

    public function variant() {
        return $this->belongsTo('SaltProduct\Models\ProductVariants', 'variant_id', 'id')->withTrashed();
    }
}
