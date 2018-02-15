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

Route::get('/', function () {
    //return view('welcome');
    return view('mywelcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('myhome');

Route::middleware(['auth'])->group(function () {
	Route::get('/manage-expenses','HETController@index')->name('manageexpenses');
	Route::post('/manage-expenses','HETController@store')->name('addexpensesubmit');
});