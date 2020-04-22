<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;


   protected $fillable = [

        'category_id',
        'user_id',
        'title',
        'slug',
        'content_raw',
        'content_html',
        'is_published',
        'published_at',
        'excerpt',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
