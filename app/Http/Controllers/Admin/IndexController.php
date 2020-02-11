<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $homeRoute = route('home');
        $test2Route = route('admin.test2');
        $test1Route = route('admin.test1');
        return <<<php
        <h1>Привет admin</h1>
        бла бла бла всякая фигня<br>
        <a href="{$homeRoute}"> to homepage</a> <br>
        <a href="{$test1Route}"> to test1</a> <br>
        <a href="{$test2Route}"> to test2</a>
php;
    }

    public function test1() {
        $adminRoute = route('admin.admin');
        return <<<php
        <h1>Test1</h1>
        <a href="{$adminRoute}"> to admin</a>
php;
    }

    public function test2() {
        $adminRoute = route('admin.admin');
        return <<<php
        <h1>Test2</h1>
        <a href="{$adminRoute}"> to admin</a>
php;
    }
}
