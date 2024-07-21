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

class ProductVariants extends Resources {

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
        'name',
        'type',
    ];

    protected $rules = array(
        'product_id' => 'required|string',
        'name' => 'required|string',
        'type' => 'nullable|in:color,size,tool,custom',
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
        'name',
        'type',
    );
    protected $fillable = array(
        'product_id',
        'name',
        'type',
    );
    protected $casts = [];

    public function porduct() {
        return $this->hasMany('SaltProduct\Models\Products', 'product_id', 'id')->withTrashed();
    }
}
