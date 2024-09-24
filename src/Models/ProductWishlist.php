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
use SaltProduct\Traits\Wishable;

class ProductWishlist extends Resources {

    protected $table = 'product_wishlist';

    use Uuids;
    use ObservableModel;
    use Wishable;

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
        'user_id'
    ];

    protected $rules = array(
        'product_id' => 'required|string',
        'user_id' => 'nullable|string'
    );

    protected $auths = array (
        'index',
        'store',
        'show',
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
        'user_id',
    );
    protected $fillable = array(
        'product_id',
        'user_id',
    );
    protected $casts = [];

    public function product() {
        return $this->belongsTo('SaltProduct\Models\Products', 'product_id', 'id')->withTrashed();
    }

    public function user() {
        return $this->belongsTo('SaltLaravel\Models\Users', 'user_id', 'id')->withTrashed();
    }
}
