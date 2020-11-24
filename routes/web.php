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
Route::resource('hour', 'HoursController');
Route::resource('skills', 'SkillsController');

Route::resource('absence', 'AbsenceController');
Route::get('/admin', 'AdminController@index');
Route::get('/admin/absence', 'AdminController@showAbsence');
Route::put('/admin/absence/{absence_id}', 'AdminController@updateAbsence');
Route::put('/admin/absence/{absence_id}/decline', 'AdminController@declineAbsence');
Route::get('/admin/users', 'AdminController@showUsers');
//Route::resources('hours')
Auth::routes();

Route::resource('projects', 'ProjectsController');
Route::post('/userposition/store', 'PositionController@store_userposition')->name('user_position.add');
Route::post('/project/{project_id}/position', 'PositionController@store')->name('position.add');
Route::get('/profile', 'HomeController@index')->name('profile')->middleware('auth');
