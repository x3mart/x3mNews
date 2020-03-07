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
   public function __construct()
   {
    //    $this->middleware('auth');
   }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'news' => News::with('category')
                ->where('news_important', '=', 1)
                ->orderByDesc('news.created_at')
                ->orderByDesc('news.news_views')
                ->paginate(6)
        ]);
    }
}
