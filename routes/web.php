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

Auth::routes();

Route::get('/', function(){
    return view('welcome');
});

Route::get('/admin', 'AdminController@index');

Route::resource('/rooms', 'RoomsController');
Route::resource('/users', 'UsersController');
Route::resource('/departments', 'DepartmentsController');
Route::resource('/position_in_departments', 'PositionInDepartmentsController');
