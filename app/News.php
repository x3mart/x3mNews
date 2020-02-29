<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class News extends Model
{
    protected $fillable = [
        'news_title',
        'news_short',
        'news_inform',
        'news_private',
        'news_image',
        'news_important',
        'news_likes',
        'news_views',
        'news_comments_count'
    ];
    public  function category() {
        return $this->belongsTo(Categories::class, 'news_category');
    }

}
