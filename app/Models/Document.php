<?php

namespace App\Models;

use App\Libs\DiskPathTools\DiskPathInfo;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\ModelFilters\DocumentsFilter;
use ElasticScoutDriverPlus\Searchable;

/**
 * App\Models\Document
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $download_link
 * @property string $content_file
 * @property string $content_hash
 * @property int|null $count_page
 * @property string|null $binding
 * @property int|null $code
 * @property int $view
 * @property int $download
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $is_crawl
 * @property string|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $fiveStar
 * @property-read int|null $five_star_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $fourStar
 * @property-read int|null $four_star_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Keyword[] $keywords
 * @property-read int|null $keywords_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $oneStar
 * @property-read int|null $one_star_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $threeStar
 * @property-read int|null $three_star_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $twoStar
 * @property-read int|null $two_star_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Document acceptRequest(?array $request = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Document filter(?array $request = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Document ignoreRequest(?array $request = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|Document setCustomDetection(?array $object_custom_detect = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Document setLoadDefaultDetection($load_default_detection)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereBinding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereContentFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereContentHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereCountPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDownload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDownloadLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereIsCrawl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereView($value)
 * @mixin \Eloquent
 */
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
