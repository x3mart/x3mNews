<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\News;


class NewsController extends Controller
{
    public function allCategories() {
        return view('news.allCategories', ['categories'=>News::getAllCategories()]);
    }

    public function newsOneCategory ($cat_alias) {
        return view('news.oneCategoryNews', ['news'=> News::getOneCategoryNews($cat_alias),
            'categories' => News::getAllCategories()]);
    }

    public function oneNews ($cat_alias, $id) {
        return view('news.oneNews', ['news'=> News::getOneNews($id), 'categories' => News::getAllCategories()]);
    }
}
