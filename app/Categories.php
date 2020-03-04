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

    public static function rules()
    {
        $table = (new Categories)->getTable();
        return
        [
            'category_name' => 'required|min:3|max:20|unique:categories,category_name',
            'category_alias' => 'required|min:3|max:20|alpha|regex:/^[a-z]+$/i|unique:categories,category_alias',
            'category_description' => 'required|min:20|max:150',
            'category_image' => 'image|max:1024'
        ];
    }

    public static function fieldsAttributes ()
    {
        return
        [
            'category_name' => 'Название категории',
            'category_alias' => 'Псевдоним',
            'category_description' => 'Описание',
            'category_image' => 'Изображение'
        ];
    }
}
