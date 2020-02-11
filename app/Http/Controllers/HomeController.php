<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller

{

    public function index() {
        $adminRoute = route('admin.admin');
        $categoriesRoute = route('news.categories');

        return <<<php
        <h1>Приветствуем на сайте НОВОСТЕЙ</h1>
        бла бла бла всякая фигня<br>
        <a href="{$categoriesRoute}"><h2>Категории новостей</h2></a>
        <hr>
        <a href="{$adminRoute}"> <h4>to admin</h4></a>
php;
    }
}
