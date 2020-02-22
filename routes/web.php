<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('index');
//});
//
//Route::get('/news/', function () {
//    return view('news');
//});
Route::get('/', 'HomeController@index')->name('home');

Route::group([
    'prefix'=>'admin',
    'namespace'=>'Admin',
    'as'=>'admin.'
], function () {
    Route::get('/', 'IndexController@index')->name('admin');
    Route::match(['post','get'],'/addNews', 'IndexController@addnews')->name('addNews');
    Route::get('/test1', 'IndexController@test1')->name('test1');
    Route::get('/test2', 'IndexController@test2')->name('test2');
});

Route::group([
    'prefix' => 'news',
    'namespace' => 'News',
    'as' => 'news.'
], function (){
    Route::get('/', 'NewsController@allCategories')->name('categories');
    Route::get('/{cat_alias}', 'NewsController@newsOneCategory')->name('oneCategoryNews');
    Route::get('/{cat_alias}/{id}', 'NewsController@oneNews')->name('oneNews');
});



Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
