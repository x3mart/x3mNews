<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;

class IndexController extends Controller
{

    public function index()
    {
        return view('admin.index', [
            'news' => News::query()->orderByDesc('created_at')->paginate(7)
        ]);
    }



    public function test1() {
        $test = News::with('category')
            ->where('news_important', '=', '1')
            ->orderByDesc('news_views')
            ->get();

        return view('admin.test1', ['test' => $test]);
    }

    public function test2() {
        return view('admin.test2');
    }

}
