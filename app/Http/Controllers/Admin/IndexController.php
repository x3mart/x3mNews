<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function addNews(Request $request) {
        $allAboutNews = new News();
        if ($request->method() == 'POST') {
            $freshNews = $request->except('_token');
            foreach ($freshNews as $item) {
                if (is_null($item)) {
                    $request->flash();
                    return redirect()->route('admin.addNews');
                }
            }
            $allAboutNews->addNews($freshNews);
            return redirect()->route('admin.addNews');
        }
        return view('admin.addNews', ['categories' => $allAboutNews->getAllCategories()]);
    }

    public function test1() {
        return view('admin.test1');
    }

    public function test2() {
        return view('admin.test2');
    }
}
