<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class News extends Model
{

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->news = $this->getAllNews();
        $this->categories = $this->getAllCategories();
    }

    public function getAllNews() {
        return DB::table('news')->get();
    }


    public static function getAllCategories() {
        return DB::table('categories')->get();
    }

    public function getOneCategory($alias) {
        foreach ($this->categories as $category) {
            if ($category->category_alias == $alias) {
                return $category;
            }
        }
    }

    public static function getOneCategoryNews($alias) {
        return DB::table('categories')
            ->where('category_alias', '=', $alias)
            ->join('news', 'categories.category_id', "=", 'news.news_category')
            ->orderByDesc('news_id')
            ->get();
    }

    public static function getOneNews($id) {
        $news = DB::table('news')
            ->where('news_id', '=', $id)
            ->join('categories', 'news.news_category', '=', 'categories.category_id')
            ->select('news.*', 'categories.category_name', 'categories.category_alias')
            ->get();
                return $news[0];
    }


    public function addNews($freshNews) {
        $id = count($this->news) + 1;
        $freshNews['id'] = $id;
        $path = Storage::putFile('public/imgs', $freshNews['image']);
        $url = Storage::url($path);
        $freshNews['image'] = $url;
        $news = $this->news;
        array_push($news, $freshNews);
        $json = json_encode($news, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        Storage::put('news/news.json', $json);
    }
}
