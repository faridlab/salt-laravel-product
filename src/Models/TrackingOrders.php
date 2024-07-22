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

class TrackingOrders extends Resources {

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
        // Fields table brands
        'id',
        'transaction_id',
        'status_id',
        'order',
        'note',
    ];

    protected $rules = array(
        'transaction_id' => 'required|string',
        'status_id' => 'required|string',
        'order' => 'required|integer',
        'note' => 'nullable|string',
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
        'transaction_id',
        'status_id',
        'order',
        'note',
    );
    protected $fillable = array(
        'transaction_id',
        'status_id',
        'order',
        'note',
    );
    protected $casts = [];

    public function transaction() {
        return $this->belongsTo('SaltProduct\Models\Transactions', 'transaction_id', 'id')->withTrashed();
    }

    public function status() {
        return $this->belongsTo('SaltProduct\Models\TrackingStatuses', 'status_id', 'id')->withTrashed();
    }
}
