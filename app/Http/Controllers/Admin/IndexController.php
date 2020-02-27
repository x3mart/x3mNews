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

    public function addNews(Request $request, News $allAboutNews) {
        $freshNews = $request->except('_token');
        if ($request->method() == 'POST') {
            if (($this->checkRequiredFields($freshNews) && $request->file())) {
                News::addNews($freshNews);
                return redirect()->route('admin.addNews')->with('success', 'Новость успешно добавленна');
            } else {
                $request->flash();
                return redirect()->route('admin.addNews')->with('error', 'Забыли заполнить поля или добавить изображение');
            }
        }
        return view('admin.addNews', ['categories' => News::getAllCategories()]);
    }

    public function test1() {
        return view('admin.test1');
    }

    public function test2() {
        return view('admin.test2');
    }

    public function checkRequiredFields($freshNews) {
        foreach ($freshNews as $item) {
            if (is_null($item)) {
                return false;
            }
        }
        return true;
    }
}
