<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Booking;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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
        foreach($bookings as $booking){
            $booking->r_nama = DB::table('rooms')->select('nama')->where('rooms.id', '=', $booking->r_id)->first()->nama;
            $booking->u_nama = DB::table('users')->select('nama')->where('users.id', '=', $booking->u_id)->first()->nama;
            unset($booking->u_id);
            unset($booking->r_id);
            unset($booking->id);
        }
        
        // return response
        $response = [
            'error' => false,
            'bookings' => $bookings,
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
        
        $validator = Validator::make($request->all(), [
            'r_id'=>'required',
            'username'=>'required',
            'tanggal_pinjam'=>'required',
            'waktu_mulai'=>'required',
            'waktu_selesai'=>'required',
            'keperluan' => 'required',
            'file' => 'required|mimes:jpg,png,jpeg,JPG',
        ]);

        $u_id = DB::table('users')->select('id')->where('users.username', '=', $request->get('username'))->first()->id; 

        if ($validator->fails()) {
            return response()->json(['error' => true, 'msg' => 'Unvalid']);
        }

        $tanggal_pinjam = $request->get('tanggal_pinjam');
        $hari_pinjam = substr($tanggal_pinjam, 0, 2);
        $bulan_pinjam = substr($tanggal_pinjam, 3, 2);
        $tahun_pinjam = substr($tanggal_pinjam, 6, 4);
        
        $booking = new \App\Booking;
        
        if (!$request->file('file')) {
            # code...
            return response()->json(['error' => true, 'msg' => 'File tidak ada']);
        }else{
            $booking->file = $request->file('file')->store('bookings','public');                
        }

        $tanggal_pin = $tahun_pinjam.'-'.$bulan_pinjam.'-'.$hari_pinjam;
        $waktu_mul = $request->get('waktu_mulai').':00';
        $waktu_sel = $request->get('waktu_selesai').':00';

        $booking->r_id=$request->get('r_id');
        $booking->u_id=$u_id;
        $booking->tanggal_pinjam=$tanggal_pin;
        $booking->waktu_mulai=$waktu_mul;
        $booking->waktu_selesai=$waktu_sel;
        $booking->keperluan=$request->get('keperluan');
        $booking->save();
        return response()->json(['error' => false, 'msg' => 'Berhasil melakukan peminjaman ruangan']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($r_id)
    {
        // Method ini berfungsi bukan untuk mencari booking berdasarkan ID Tetapi 
        // berdasarkan ID Ruangan yang diklik oleh user

        $booking_u_id = DB::table('bookings')->select('u_id')->where('bookings.r_id', '=', $r_id)->first();
        $user_nip_nama = $user_department = DB::table('users')->select('nip', 'nama')->where('users.id', '=', $booking_u_id->u_id)->first();
        $booking = DB::table('bookings')->select('tanggal_pinjam','waktu_selesai', 'waktu_mulai', 'keperluan')->where('bookings.r_id', '=', $r_id)->first();;
        $booking->nip = $user_nip_nama->nip;
        $booking->nama = $user_nip_nama->nama;

        if (is_null($booking)) {
            // return response
            $response = [
                'error' => true,
                'message' => 'Booking not found.',
            ];
            return response()->json($response, 404);
        }
        
        // return response
        $response = [
            'error' => false,
            'msg' => 'Booking retrieved successfully.',
            'booking_room' => $booking  
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
            'tanggal_pinjam' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'keperluan' => 'required',
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

    public function deleteUserBooking(Request $request){
        $file = Booking::where('r_id', $request->r_id)->select('file')->first();
        unlink(storage_path().'/app/public/'.$file->file);
        Booking::where('r_id', $request->r_id)->delete();
        return response()->json(['error' => false, 'msg' => 'Berhasil Membatalkan Booking Ruangan']);
    }

    public function getUserBooking($username)
    {
        // Method ini berfungsi untuk mencari semua booking 
        // berdasarkan ID Ruangan yang dibooking user
        $user = Auth::user();
        if($user->username == $username){
            $booking_u_id = DB::table('users')->select('id')->where('users.username', '=', $username)->first()->id;
            $user_booking= DB::table('users')
            ->join('bookings', 'bookings.u_id', '=', 'users.id')
            ->join('rooms', 'bookings.r_id', '=', 'rooms.id')
            ->where('bookings.u_id', '=', $booking_u_id)
            ->select('bookings.r_id', 'rooms.nama', 'tanggal_pinjam','waktu_selesai', 'waktu_mulai', 'keperluan', 'file')
            ->get();

            if (is_null($user_booking)) {
                // return response
                $response = [
                    'error' => true,
                    'msg' => 'Booking not found.',
                ];
                return response()->json($response, 200);
            }
            
            // return response
            $response = [
                'error' => false,
                'msg' => 'Booking retrieved successfully.',
                'user_booking' => $user_booking 
            ];
            return response()->json($response, 200);
        }

    }
     public function getAvailableBooking(){
        $bookings = DB::table('bookings')->select('r_id')->get();

        $rooms = DB::table('rooms')->select('id', 'nama')->get();

        $room_list_d1 = array();
        $room_list_d2 = array();
        $list_d1=0;
        for($i=0; $i<count($rooms);$i++){
            for($j=0; $j<count($bookings);$j++){
                    if($bookings[$j]->r_id == $rooms[$i]->id){
                        break;
                    }else{
                        if($j == count($bookings)-1){
                            $room_list_d2[0] = $rooms[$i]->id;
                            $room_list_d2[1] = $rooms[$i]->nama;
                            $room_list_d1[$list_d1] = $room_list_d2;
                            $list_d1++;
                        } else{
                            continue;
                        }
                   
                    }
                    
            }
        }
        
     $response = [
            'error' => false,
            'available_booking' => $room_list_d1,
        ];

        return response()->json($response, 200);
    }


    public function getFilterBooking(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'r_id' => 'required',
            'tanggal_pinjam' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);
        
        if ($validator->fails()) {
            // return response
            $response = [
                'error' => true,
                'msg' => 'Validation Error.', $validator->errors(),
            ];
            return response()->json($response);
        }

        $tanggal_pinjam = $request->get('tanggal_pinjam');
        $hari_pinjam = substr($tanggal_pinjam, 0, 2);
        $bulan_pinjam = substr($tanggal_pinjam, 3, 2);
        $tahun_pinjam = substr($tanggal_pinjam, 6, 4);
        $tanggal_pin = $tahun_pinjam.'-'.$bulan_pinjam.'-'.$hari_pinjam;
        $waktu_mul = $request->get('waktu_mulai').':00';
        $waktu_sel = $request->get('waktu_selesai').':00';

        $search = DB::table('bookings')
                ->leftJoin('rooms','rooms.id', '=', 'bookings.r_id')
                ->leftJoin('users', 'users.id', '=', 'bookings.u_id')
                ->select('rooms.nama as r_nama', 'users.nama as u_nama', 'tanggal_pinjam', 'waktu_mulai', 'waktu_selesai', 'file')
                ->where('r_id', '=', $request->r_id)
                ->whereDate('tanggal_pinjam', '>', Carbon::now())
                ->whereDate('tanggal_pinjam', '=', $tanggal_pin)
                ->where(function($query) use ($waktu_mul, $waktu_sel){
                    return $query
                    ->where(function($query) use ($waktu_mul){
                        return $query
                        ->whereTime('waktu_mulai', '<=', $waktu_mul)
                        ->whereTime('waktu_selesai', '>=', $waktu_mul);
                    })
                    ->orWhere(function($query) use ($waktu_sel){
                        return $query
                        ->whereTime('waktu_mulai', '<=', $waktu_sel)
                        ->whereTime('waktu_selesai', '>=', $waktu_sel);
                    });
                })
                ->orderBy('tanggal_pinjam', 'asc')
                ->orderBy('waktu_mulai', 'asc')
                ->get();
            
                $response = [
                    'error' => false,
                    'bookings' => $search,
                ];

        return response()->json($response);
    }
}
