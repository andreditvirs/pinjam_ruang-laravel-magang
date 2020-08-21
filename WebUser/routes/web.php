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

Route::post('login', 'GuzzleController@login')->name('login');
Route::post('register', 'GuzzleController@register')->name('register');

Route::group(['middleware' => 'homeauth'], function(){
            Route::get('home', function () {
                // $profile = Session::get('profile');
                //->with('profile', $profile)
                return view('akun.beranda');
            });
        
            Route::get('profile/edit', function () {
                return view('akun.editprofile');
            });
            
            Route::get('profile/password/edit', function () {
                return view('akun.changepass');
            });
            
            Route::get('bookings/status', function () {
                if(Cache::has('booking_r_id'.Cookie::get('access_token'))){
                    Cache::forget('booking_r_id'.Cookie::get('access_token'));
                    Cache::forget('booking_tanggal_pinjam'.Cookie::get('access_token'));
                    Cache::forget('booking_waktu_mulai'.Cookie::get('access_token'));
                    Cache::forget('booking_waktu_selesai'.Cookie::get('access_token'));
                    if(Cache::has('booking_keperluan'.Cookie::get('access_token'))){
                        Cache::forget('booking_keperluan'.Cookie::get('access_token'));
                    }
                }
                return view('akun.usersbooking');
            });
            
            Route::get('bookings/step/1', function () {
                return view('akun.formbooking');
            });
        
            Route::get('bookings/step/2', function () {
                if(Cache::has('booking_r_id'.Cookie::get('access_token'))){
                    return view('akun.formbooking2');
                }else{
                    return redirect()->back();
                }
            });
        
            Route::get('bookings/step/3', function () {
                if(Cache::has('booking_r_id'.Cookie::get('access_token')) && Cache::has('booking_keperluan'.Cookie::get('access_token'))){
                    return view('akun.formbooking3');
                }else{
                    return redirect()->back();
                }
            });
        
            Route::post('logout', 'GuzzleController@logout')->name('logout');
            Route::post('profile/edit', 'GuzzleController@editprofile')->name('editprofile');
            Route::post('profile/password/edit', 'GuzzleController@changepass')->name('changepass');
            Route::post('bookings/filter', 'GuzzleController@getFilterBooking')->name('filter_bookings');
            Route::post('bookings/step/1', 'GuzzleController@booking1')->name('bookings1');
            Route::post('bookings/step/2', 'GuzzleController@booking2')->name('bookings2');
            Route::post('bookings/step/3', 'GuzzleController@booking3')->name('bookings3');
            Route::post('bookings/delete', 'GuzzleController@deleteUserBooking')->name('delete_user_booking');
    });