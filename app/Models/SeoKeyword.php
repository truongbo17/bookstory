<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use ElasticScoutDriverPlus\Searchable;

class SeoKeyword extends Model
{
    use CrudTrait;
    use Searchable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'seo_keywords';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    protected $mapping = [
        'properties' => [
            'seo_keyword_id' => [
                'type' => 'int'
            ],
            'title' => [
                'type' => 'text'
            ],
            'slug' => [
                'type' => 'text'
            ],
            'status' => [
                'type' => 'int'
            ],
        ]
    ];

    public function toSearchableArray()
    {
        $array = [
            'seo_keyword_id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'status' => $this->status,
        ];

        return $array;
    }
}
