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

Route::get('/', function(){
  return view('welcome');
});
//ada 2 cara untuk memunculkan tombol2 login regis di welcome page
//1. 
// Authentication Routes...
//maksudnya selain yg dikoding, gamuncul
//cuma muncul yg dibawah
Route::get('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@getLogin'
  ]);
Route::post('login', [
    'as' => '',
    'uses' => 'Auth\LoginController@login'
  ]);
Route::post('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
  ]);

  Route::get('/notadmin', function() {
    return view('notadmin');
  })->middleware('auth:user');


  //2.
// Auth::routes(['register' => false, 'reset' => false]);
//untuk memprevent yg dikoding saja. jadi selain itu, dimunculin semua



Route::group(['middleware' => 'auth:admin'], function(){
    Route::get('/admin', 'AdminsController@index');
    Route::resource('rooms', 'RoomsController');
    Route::resource('users', 'UsersController');
    Route::resource('bookings', 'BookingsController');
    Route::resource('departments', 'DepartmentsController');
    Route::resource('position_in_departments', 'PositionInDepartmentsController');
});

// Route::get('/searchajax',array('as'=>'searchajax','uses'=>'UsersController@autoComplete'));
