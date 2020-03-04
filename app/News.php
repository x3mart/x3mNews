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

    public static function rules()
    {
        $table = (new Categories)->getTable();
        return
        [
            'news_title' => 'required|min:5|max:50',
            'news_category' => "required|exists:{$table},id",
            'news_short' => 'required|min:50|max:151',
            'news_inform' => 'required|min: 50| max:3000',
            'news_image' => 'image|max:1024'
        ];
    }

    public static function fieldsAttributes ()
    {
        return
        [
            'news_title' => 'Название новости',
            'news_category' => 'Категория новостей',
            'news_short' => 'Краткое описание',
            'news_inform' => 'Текст новости',
            'news_image' => 'Изображение'
        ];
    }

}
