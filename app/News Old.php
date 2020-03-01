<?php
//
//namespace App;
//
//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Http\File;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Storage;
//
//
////class News extends Model
//{
//
//    public function getAllNews() {
//        return DB::table('news')->get();
//    }
//
//
//    public static function getAllCategories() {
//        return DB::table('categories')->get();
//    }
//
//    public static function getOneCategoryNews($alias) {
//        return DB::table('categories')
//            ->where('category_alias', '=', $alias)
//            ->join('news', 'categories.category_id', "=", 'news.news_category')
//            ->orderByDesc('news_id')
//            ->get();
//    }
//
//    public static function getOneNews($id) {
//        return DB::table('news')
//            ->where('news_id', '=', $id)
//            ->join('categories', 'news.news_category', '=', 'categories.category_id')
//            ->select('news.*', 'categories.category_name', 'categories.category_alias')
//            ->first();
//    }
//
//    public static function getImportantNews() {
//        return DB::table('news')
//            ->join('categories', 'news.news_category', '=', 'categories.category_id')
//            ->select('news.*', 'categories.category_name', 'categories.category_alias')
//            ->where('news.news_important', '=', 1)
//            ->orderByDesc('news.news_created_at')
//            ->orderByDesc('news.news_views')
//            ->take(15)
//            ->get();
//    }
//
//    public static function addNews($freshNews) {
//        $path = Storage::putFile('public/imgs', $freshNews['image']);
//        $url = Storage::url($path);
//        DB::table('news')->insert([
//            [
//                'news_title' => $freshNews['title'],
//                'news_category' => $freshNews['category'],
//                'news_short' => $freshNews['short'],
//                'news_inform' => $freshNews['inform'],
//                'news_image' => $url,
//                'news_likes' => random_int(0, 365),
//                'news_views' => random_int(432, 3765),
//                'news_private' => $freshNews['private'] ?? 0,
//                'news_important' => $freshNews['important'] ?? 0
//            ]
//        ]);
//    }
//}
