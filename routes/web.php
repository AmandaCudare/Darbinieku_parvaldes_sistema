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
//Sākuma lapa
Route::get('/', 'StartController@index');
//Dienas izdarītais
Route::resource('hour', 'HoursController')->except(['show']);
Route::get('/schedule', 'HoursController@showSchedule');
//Prasmes
Route::resource('skills', 'SkillsController')->except(['create','show']);
//Prombūtne
Route::resource('absence', 'AbsenceController')->except(['show']);
// Administratora panelis
Route::get('/admin', 'AdminController@index');
Route::get('/admin/absence', 'AdminController@showAbsence');
Route::put('/admin/absence/{absence_id}', 'AdminController@updateAbsence');
Route::put('/admin/absence/{absence_id}/decline', 'AdminController@declineAbsence');
Route::get('/admin/users', 'AdminController@showUsers');
Route::get('/admin/users/{user_id}/edit', 'AdminController@editUser');
Route::get('/admin/users/{user_id}/role', 'AdminController@editRole');
Route::put('/admin/users/{user_id}', 'AdminController@updateUser');
Route::put('/admin/users/{user_id}/deactivate', 'AdminController@deactivateUser');

//Autenfifikacija
Auth::routes();
//Projeti un amati
Route::resource('projects', 'ProjectsController');
Route::post('/userposition/store', 'PositionController@store_userposition')->name('user_position.add');
Route::post('/project/{project_id}/position', 'PositionController@store')->name('position.add');
Route::get('/projects/{project_id}/assign', 'PositionController@show');
Route::get('/projects/{project_id}/accepted', 'PositionController@accept_userposition');
Route::get('/projects/{project_id}/decline', 'PositionController@decline_userposition');
Route::get('/userposition/delete/{position_id}', 'PositionController@destroy_UserPosition');
Route::get('/user/{user_id}', 'PositionController@user');
Route::get('projects/positions/{position_id}/delete', 'PositionController@destroyPosition');
Route::resource('projects/positions', 'PositionController')->except([
    'show', 'store', 'index', 'create', 'destroy'
]);
Route::get('/projects/{project_id}/position/delete', 'PositionController@delete');
//Profila lapa
Route::get('/profile', 'HomeController@index')->name('profile')->middleware('auth');
//Paroles maiņa
Route::get('/password', 'HomeController@PasswordChange')->middleware('auth');
Route::post('/password/store', 'HomeController@PasswordUpdate')->middleware('auth');
