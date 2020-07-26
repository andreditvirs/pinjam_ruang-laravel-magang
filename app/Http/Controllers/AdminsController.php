<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function index()
    {
        $booking_count =  \App::call('App\Http\Controllers\BookingsController@getBookingCount');
        $department_count =  \App::call('App\Http\Controllers\DepartmentsController@getDepartmentCount');
        $room_count =  \App::call('App\Http\Controllers\RoomsController@getRoomCount');
        $position_in_department_count =  \App::call('App\Http\Controllers\PositionInDepartmentsController@getPositionInDepartmentCount');
        $user_count =  \App::call('App\Http\Controllers\UsersController@getUserCount');
        return view('admins.index', compact('booking_count', 'department_count', 'room_count', 'position_in_department_count','user_count'));
    }
}
