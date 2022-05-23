<?php

namespace App\Models;

use App\Libs\DiskPathTools\DiskPathInfo;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\ModelFilters\DocumentsFilter;
use ElasticScoutDriverPlus\Searchable;

class Document extends Model
{
    use CrudTrait;
    use Filterable;
    use DocumentsFilter;
    use Searchable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'documents';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    public function toSearchableArray()
    {
        $array = [
            'document_id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content_file ? DiskPathInfo::parse($this->content_file)->read() : $this->title,
            'image' => $this->image,
            'status' => $this->status,
        ];

        return $array;
    }


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'document_keyword', 'document_id', 'keyword_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'document_id');
    }

    //Star rating
    public function oneStar()
    {
        return $this->hasMany(Review::class, 'document_id')->where('rating', 1);
    }

    public function twoStar()
    {
        return $this->hasMany(Review::class, 'document_id')->where('rating', 2);
    }

    public function threeStar()
    {
        return $this->hasMany(Review::class, 'document_id')->where('rating', 3);
    }

    public function fourStar()
    {
        return $this->hasMany(Review::class, 'document_id')->where('rating', 4);
    }

    public function fiveStar()
    {
        return $this->hasMany(Review::class, 'document_id')->where('rating', 5);
    }

    //End star rating

    public function users()
    {
        return $this->belongsToMany(User::class, 'document_user', 'document_id', 'user_id');
    }

    private static $whiteListFilter = ['*'];
}
