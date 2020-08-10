<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    return view('landingpage');
});

Route::get('login', function () {
    return view('akun.login');
})->middleware('userauth');

Route::get('register', function () {
    return view('akun.register');
});

// Route::get('bookings', function () {
//     return view('booking');
// });

Route::get('home', function () {
    // $profile = Session::get('profile');
    //->with('profile', $profile)
    return view('akun.beranda');
})->middleware('homeauth');

Route::get('profile/edit', function () {
    return view('akun.editprofile');
});

Route::get('profile/password/edit', function () {
    return view('akun.changepass');
});

Route::get('bookings/status', function () {
    return view('akun.usersbooking');
});

Route::get('bookings/create', function () {
    return view('akun.formbooking');
});

Route::post('login', 'GuzzleController@login')->name('login');
Route::post('register', 'GuzzleController@register')->name('register');
Route::post('logout', 'GuzzleController@logout')->name('logout');
Route::post('profile/edit', 'GuzzleController@editprofile')->name('editprofile');
Route::post('profile/password/edit', 'GuzzleController@changepass')->name('changepass');

Route::post('bookings', 'GuzzleController@booking')->name('bookings');
Route::post('bookings/delete', 'GuzzleController@deleteUserBooking')->name('delete_user_booking');