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

Route::get('/', 'RevenueController@index');
Route::get('/revenue-dttbl/showall', 'RevenueController@showall')->name('revenue-dttbl.showall');

Route::resource('revenue', 'RevenueController');

Route::get('/test', 'TestController@index');
Route::post('/check', 'TestController@checkPost')->name('check.post');

Auth::routes();

Route::get('/home', 'HomeController@index');
