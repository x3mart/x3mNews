<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PHPUnit\Util\Xml;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserController extends Controller
{
   public function index (Request $request)
   {
    $this->makeNews('https://www.gastronom.ru/RSS');
    $this->makeNews('http%3A%2F%2Fwww.kommersant.ru%2FRSS%2Fmoney.xml');
    $request->session()->flash('success', 'Новости успешно добавленны');
    return redirect()->route('news.categories');
   }

   private function makeNews($url)
   {
    $xml = XmlParser::load($url);
    $data = $xml->parse([
        'title' => ['uses' =>'channel.title'],
        'description' => ['uses' =>'channel.description'],
        'link' => ['uses' =>'channel.link'],
        'news' => ['uses' => 'channel.item[title,description,link,enclosure::url]']
    ]);

    $data['title'] = mb_substr($data['title'],0,10);

    $category = $this->existCategory($data['title']);
     if(!$category)
     {
        $category = $this->makeNewCategory($data);
     }

    foreach ($data['news'] as $item)
    {
        $news [] =
        [
            'news_title' => $item['title'],
            'news_category' => $category->id,
            'news_short' => mb_substr($item['description'], 0, 30),
            'news_inform' => $item['description'],
            'news_image' => $item['enclosure::url'],
            'news_important' => random_int(0,1)
        ];
    }
    DB::table('news')->insert($news);
   }

   private function existCategory($category_name)
   {
       return Categories::query()->where('category_name', '=', $category_name)->first();

   }

   private function makeNewCategory($data)
   {
    $category = [
        'category_name' => $data['title'],
        'category_alias' => mb_substr($data['link'], 12, 5),
        'category_description' => $data['description'],
        'category_image' => $data['news'][0]['enclosure::url']
    ];
    DB::table('categories')->insert($category);

    return Categories::query()->where('category_name', '=', $category['category_name'])->first();
   }
}
