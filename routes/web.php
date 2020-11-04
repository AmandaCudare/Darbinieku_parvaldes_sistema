<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'StartController@index');
Route::get('/hour', 'HoursController@index');
Route::get('/skills', 'SkillsController@index');
Route::get('/projects', 'ProjectsController@index');
Route::get('/vacation', 'HoursController@vacation');
Route::get('/admin', 'AdminController@index');
//Route::resources('hours')
Auth::routes();



Route::get('/profile', 'HomeController@index')->name('profile')->middleware('auth');
