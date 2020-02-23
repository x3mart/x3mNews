<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class News extends Model
{
    private $categories = [
        ['cat_id' => 1,
            'cat_name' => 'HOBOSTI',
            'cat_alias' => 'hobosti',
            'cat_description' => 'Свежие и не очень,  мудрые и не слишком. Все о том чего небыло и не будет!'],
        ['cat_id' => 2,
            'cat_name' => 'Политика',
            'cat_alias' => 'politic',
            'cat_description' => 'Новости политики. О политиках, обществе и прочем бреде'],
        ['cat_id' => 3,
            'cat_name' => 'Экономика',
            'cat_alias' => 'economic',
            'cat_description' => 'Новости Экономики. О финансах, финансистах и прочем бреде'],
        ['cat_id' => 4,
            'cat_name' => 'Культура',
            'cat_alias' => 'culture',
            'cat_description' => 'Новости Культуры. О певцах, танцорах и прочем сброде'],
        ['cat_id' => 5,
            'cat_name' => 'Спорт',
            'cat_alias' => 'sport',
            'cat_description' => 'Новости спорта. О спортсменах, соревнованиях и прочем допинге'],
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->news = $this->getAllNews();
    }

    public function getAllNews() {
        return json_decode(Storage::get('public/news.json'), TRUE);
;
    }

    public function getAllCategories() {
        return $this->categories;
    }

    public function getOneCategory($cat_alias) {
        foreach ($this->categories as $category) {
            if ($category['cat_alias'] == $cat_alias) {
                return $category;
            }
        }
    }

    public function getOneCategoryNews($cat_id) {
        $oneCategoryNews = [];
        foreach ($this->news as $news) {
            if ($news['category'] == $cat_id) {
                array_push($oneCategoryNews, $news);
            }
        }
        return $oneCategoryNews;
    }

    public function getOneNews($id) {
        foreach ($this->news as $news) {
            if ($news['id'] == $id) {
                return $news;
            }
        }
    }

    public function addNews($freshNews) {
        $id = count($this->news) + 1;
        $freshNews['id'] = $id;
        $news = $this->news;
        array_push($news, $freshNews);
        $json = json_encode($news, JSON_UNESCAPED_UNICODE);
        Storage::put('public/news.json', $json);
    }
}
