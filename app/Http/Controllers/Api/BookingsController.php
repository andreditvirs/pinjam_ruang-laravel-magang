<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Booking;
use Validator;

class BookingsController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();

        // return response
        $response = [
            'success' => true,
            'message' => 'Bookings retrieved successfully.',
            'status' => $bookings,
        ];
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'r_id' => 'required',
            'u_id' => 'required',
            'keperluan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            // return response
            $response = [
                'success' => false,
                'message' => 'Validation Error.', $validator->errors(),
            ];
            return response()->json($response, 404);
        }

        $book = Booking::create($input);

        // return response
        $response = [
            'success' => true,
            'message' => 'Booking created successfully.',
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
        $booking = Booking::find($id);

        if (is_null($booking)) {
            // return response
            $response = [
                'success' => false,
                'message' => 'Booking not found.',
            ];
            return response()->json($response, 404);
        }

        // return response
        $response = [
            'success' => true,
            'message' => 'Booking retrieved successfully.',
        ];
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'r_id' => 'required',
            'u_id' => 'required',
            'keperluan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            // return response
            $response = [
                'success' => false,
                'message' => 'Validation Error.', $validator->errors(),
            ];
            return response()->json($response, 404);
        }

        $booking->name = $input['name'];
        $booking->author = $input['author'];
        $booking->save();

        // return response
        $response = [
            'success' => true,
            'message' => 'Booking updated successfully.',
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $book)
    {
        $book->delete();

        // return response
        $response = [
            'success' => true,
            'message' => 'Booking deleted successfully.',
        ];
        return response()->json($response, 200);
    }
}
