<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news = DB::table('news')
            ->join('categories', 'news.news_category', '=', 'categories.category_id')
            ->select('news.*', 'categories.category_name', 'categories.category_alias')
            ->where('news.news_important', '=', 1)
            ->orderByDesc('news.news_id')
            ->get();
        return view('home',['news'=>$news]);
    }
}
