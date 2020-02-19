<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class HomeController extends Controller

{

    public function index() {
        $allAboutNews = new News();
        return view('index', ['categories'=>$allAboutNews->getAllCategories()]);
    }
}
