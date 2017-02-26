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
Route::resource('show', 'CarController');

// route to show login form
//Route::get('login', array('uses' => 'HomeController@showLogin'));

// route to process login form
//Route::get('login', array('uses' => 'HomeController@doLogin'));

//Route::resource('login', 'HomeController');

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index');
