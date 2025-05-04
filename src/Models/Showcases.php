<?php

namespace SaltProduct\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Schema;

use SaltFile\Traits\Fileable;
use SaltLaravel\Models\Resources;
use SaltLaravel\Traits\ObservableModel;
use SaltLaravel\Traits\Uuids;
use SaltProduct\Traits\ShowcaseSluggable;

class Showcases extends Resources {

    use Uuids;
    use ObservableModel;
    use ShowcaseSluggable;

    use Fileable;
    protected $fileableFields = ['thumbnail', 'image'];
    protected $fileableCascade = true;
    protected $fileableDirs = [
        'thumbnail' => 'showcases/thumbnail',
        'image' => 'showcases/image',
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
        // Fields table showcases
        'id',
        'name',
        'slug',
        'short_desc',
        'desc',
        'status',
        'order'
    ];

    protected $rules = array(
        'name' => 'required|string',
        'slug' => 'nullable|string',
        'short_desc' => 'nullable|string',
        'desc' => 'nullable|string',
        'status' => 'nullable|string',
        'order' => 'nullable|integer'
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

    protected $searchable = array('name', 'slug', 'short_desc', 'desc', 'status', 'order');
    protected $fillable = array('name', 'slug', 'short_desc', 'desc', 'status', 'order');
    protected $casts = [];

    public function image() {
        return $this->hasOne('SaltFile\Models\Files', 'foreign_id', 'id')
                    ->where('foreign_table', 'showcases')
                    ->where('directory', 'showcases/image');
    }

    public function thumbnail() {
        return $this->hasOne('SaltFile\Models\Files', 'foreign_id', 'id')
                    ->where('foreign_table', 'showcases')
                    ->where('directory', 'showcases/thumbnail');
    }

    public function products() {
        return $this->hasMany('SaltProduct\Models\ProductShowcases', 'showcase_id', 'id')->withTrashed();
    }

}
