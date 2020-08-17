<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Room;
use Validator;

class RoomsController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();

        // return response
        $response = [
            'error' => false,
            'rooms' => $rooms,
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);

        if (is_null($room)) {
            // return response
            $response = [
                'error' => true,
                'message' => 'Room not found.',
            ];
            return response()->json($response, 404);
        }

        // return response
        $response = [
            'error' => false,
            'message' => 'Room retrieved successfully.',
            'room' => $room
        ];
        return response()->json($response, 200);
    }
}
