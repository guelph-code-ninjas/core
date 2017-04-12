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

/* HomeController Routes */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

/* CourseController Routes */
Route::get('course/register/','CourseController@showRegistration');
Route::get('course/settings', 'CourseController@showSettings');

Route::post('course/register/', 'CourseController@store');
Route::get('course/{course}','CourseController@show')->name('coursePage');

/* AssignmentController Routes */
Route::get('course/{course}/assignment/register', 'AssignmentController@register');
Route::post('course/{course}/assignment/register', 'AssignmentController@store');
Route::get('course/{course}/assignment/{assignment}','AssignmentController@show')->name('courseAssignment');

Auth::routes();
