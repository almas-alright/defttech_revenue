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
Route::get('/revenue/{type}/status', 'RevenueController@status')->name('revenue.status');
Route::get('/date-b2in/{start}/{end}', 'RevenueController@showRange')->name('revenue.week');
Route::get('/revenue-dttbl/showall', 'RevenueController@showall')->name('revenue-dttbl.showall');

Route::resource('revenue', 'RevenueController');

Route::get('/test', 'TestController@index');
Route::post('/check', 'TestController@checkPost')->name('check.post');
Route::get('/test/fact', 'TestController@fact')->name('test.json');

Auth::routes();

Route::get('/home', 'HomeController@index');
