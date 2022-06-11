<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use ElasticScoutDriverPlus\Searchable;

/**
 * App\Models\SeoKeyword
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $title_hash
 * @property int $length
 * @property int $documents_matched
 * @property int $view
 * @property int $status
 * @property string|null $hits
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword query()
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword whereDocumentsMatched($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword whereHits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword whereTitleHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoKeyword whereView($value)
 * @mixin \Eloquent
 */
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
