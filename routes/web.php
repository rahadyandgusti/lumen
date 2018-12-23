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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth']], function () {
	Route::get('/draft', 'HomeController@draft')->name('draft');
	Route::resource('page', 'PagesController')->except('show');
	Route::get('/tag/get-data', 'TagsController@getData')->name('tag.get');
});
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/page/{slug}', 'PagesController@show')->name('page.show');
Route::get('/page/getdata/{id}', 'PagesController@getData')->name('page.get-data');
Route::get('/tags/{tag}', 'PagesController@tags')->name('page.tag');


Route::get('/testhome', 'HomeController@testHome');
Route::get('/getdata/{id}', 'HomeController@getData');
Route::get('/testpage/{test}', 'HomeController@testPage');