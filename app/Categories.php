<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'category_name',
        'category_alias',
        'category_description',
        'category_image',
        'category_private'
        ];
    public function oneCategoryNews() {
        return $this->hasMany(News::class, 'news_category');
    }
}
