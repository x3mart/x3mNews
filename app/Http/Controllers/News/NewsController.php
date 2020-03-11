<?php

namespace App\Http\Controllers\News;

use App\Categories;
use App\Http\Controllers\Controller;
use App\News;


class NewsController extends Controller
{
    public function allCategories() {
        return view('news.allCategories', ['categories'=>Categories::query()->orderBy('id', 'desc')->get()]);
    }

    public function newsOneCategory ($cat_alias) {
        $category = Categories::query()
            ->select(['id', 'category_name', 'category_alias'])
            ->where('category_alias', $cat_alias)
            ->first();

        return view('news.oneCategoryNews', [
            'news'=> Categories::query()
                ->find($category->id)
                ->oneCategoryNews()
                ->get(),
            'category' => $category,
            'categories' => Categories::all()
        ]);
    }

    public function oneNews ($cat_alias, $id) {
        return view('news.oneNews', [
            'news' => News::with('category')
                ->find($id),
            'categories' => Categories::all()
        ]);
    }
}
