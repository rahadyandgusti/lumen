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


// Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->middleware('underconstruction');
Route::post('/upload', 'HomeController@upload')->name('upload')->middleware('underconstruction');

Route::group(['middleware'=>['auth']], function () {
	Route::get('/draft', 'HomeController@draft')->name('draft')->middleware('underconstruction');
	Route::resource('page', 'PagesController')->except('show')->middleware('underconstruction');
	Route::get('/tag/get-data', 'TagsController@getData')->name('tag.get')->middleware('underconstruction');
});
Route::get('/search', 'PagesController@search')->name('search')->middleware('underconstruction');
Route::get('/page/{slug}', 'PagesController@show')->name('page.show')->middleware('underconstruction');