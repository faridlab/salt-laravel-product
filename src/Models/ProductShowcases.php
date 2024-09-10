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

class ProductShowcases extends Resources {

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
        'showcase_id',
    ];

    protected $rules = array(
        'product_id' => 'required|string',
        'showcase_id' => 'required|string',
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
    );
    protected $fillable = array(
        'product_id',
        'warehouse_id',
    );
    protected $casts = [];

    public function porduct() {
        return $this->hasMany('SaltProduct\Models\Products', 'product_id', 'id')->withTrashed();
    }

    public function showcase() {
        return $this->hasMany('SaltProduct\Models\Showcases', 'showcase_id', 'id')->withTrashed();
    }

}
