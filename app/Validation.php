<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Validation extends Model
{
    public static function rules($request)
    {
        $table = (new Categories)->getTable();

        if ($request->routeIs('*News*')) {
            return
            [
            //Новости
            'news_title' => 'required|min:5|max:50',
            'news_category' => "required|exists:{$table},id",
            'news_short' => 'required|min:50|max:151',
            'news_inform' => 'required|min: 50| max:3000',
            'news_image' => 'image|max:1024',
            'news_private' => 'integer|boolean',
            'news_important' => 'integer|boolean'
            ];
        }
        if ($request->routeIs('*Categor*')){
            return
        [
            //Категории новостей
            'category_name' => 'required|min:3|max:20|unique:categories,category_name,'.$request->id,
            'category_alias' => 'required|min:3|max:20|alpha|regex:/^[a-z]+$/i|unique:categories,category_alias,'.$request->id,
            'category_description' => 'required|min:20|max:150',
            'category_image' => 'image|max:1024',
            'category_private' => 'integer|boolean'
        ];
        }
        return [];
        if ($request->routeIs('*Profile*')){
        //     //Users Profiles
        return
        [
            'name' => 'required|string|max:10',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
            'curent_password' => 'required|string',
            'password' => $request->password ? 'string|min:3' : '',
            'password_confirm' =>  'required_with:password|same:password'
        ];
        }
        return [];
    }

    public static function fieldsAttributes($request)
    {
        if ($request->routeIs('*News*')) {
            return
            [
        //     //Новости
            'news_title' => 'Название новости',
            'news_category' => 'Категория новостей',
            'news_short' => 'Краткое описание',
            'news_inform' => 'Текст новости',
            'news_image' => 'Изображение'
            ];
        }
        if ($request->routeIs('*Categor*')){
            return
        [
        //     //Категории новостей
            'category_name' => 'Название категории',
            'category_alias' => 'Псевдоним',
            'category_description' => 'Описание',
            'category_image' => 'Изображение'
        ];
        }
        if ($request->routeIs('*Profile*')){
            return
            [
            //Users Profiles
            'curent_password' => 'Пароль',
            'password' => 'Новый пароль',
            'password_confirm' =>'Пароль еще разок'
            ];
        }
        return[];
    }
}
