<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\News;


class NewsController extends Controller
{
    public function allCategories() {
        $allAboutNews = new News ();
        $categories = $allAboutNews->getAllCategories();
        return view('news.allCategories', ['categories'=>$categories]);
    }

    public function newsOneCategory ($cat_alias) {
        $allAboutNews = new News ();
        $category = $allAboutNews->getOneCategory($cat_alias);
        $news = $allAboutNews->getOneCategoryNews($category['cat_id']);
        $categories = $allAboutNews->getAllCategories();
        return view('news.oneCategoryNews', ['category' => $category,
            'news'=> $news, 'categories' => $categories]);
    }

    public function oneNews ($cat_alias, $id) {
        $allAboutNews = new News ();
        $category = $allAboutNews->getOneCategory($cat_alias);
        $news = $allAboutNews->getOneNews($id);
        $categories = $allAboutNews->getAllCategories();
        return view('news.oneNews', ['category' => $category,
            'news'=> $news, 'categories' => $categories]);
    }
}
