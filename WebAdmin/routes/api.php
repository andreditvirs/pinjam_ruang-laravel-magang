<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/login', 'Api\UserAuthController@login');
Route::post('/auth/register', 'Api\UserAuthController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/bookings/filter', 'Api\BookingsController@getFilterBooking');
    Route::resource('/bookings' , 'Api\BookingsController');
    Route::resource('/rooms' , 'Api\RoomsController');
    Route::post('/auth/details', 'Api\UserAuthController@details');
    Route::post('/auth/change_password', 'Api\UserAuthController@changePassword');
    Route::post('/auth/logout', 'Api\UserAuthController@logout');
    Route::get('/bookings/get_user_booking/{username?}', 'Api\BookingsController@getUserBooking');
    Route::post('/bookings/delete', 'Api\BookingsController@deleteUserBooking');
    Route::post('/auth/editprofile', 'Api\UserAuthController@editprofile');
    Route::get('/get_available_booking','Api\BookingsController@getAvailableBooking');
});

// Route::get('/auth', 'Api\UserAuthController@index');
// Route::post('/auth/store', 'Api\UserAuthController@store');
// Route::get('/auth/{id?}', 'Api\UserAuthController@show');
// Route::patch('/auth/{id?}', 'Api\UserAuthController@update');
// Route::delete('/auth/{id?}', 'Api\UserAuthController@destroy');