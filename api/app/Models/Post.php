<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Post
 * @package App\Models
 * @version January 14, 2021, 2:37 am UTC
 *
 */
class Post extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'posts';


    protected $dates = ['deleted_at'];


    public $fillable = [
        "author_id", "title", "body", "active", "slug", "image"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function getImageAttribute($value)
    {

        if ($value) return env('AWS_S3_URL', true) . $value;
        return '';
    }

}
