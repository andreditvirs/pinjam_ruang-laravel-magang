<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
Use Redirect;
Use Storage;
use Illuminate\Support\Carbon;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = DB::table('bookings')->orderBy('id', 'desc')->paginate(10);
  
        return view('bookings.index', compact('bookings'));
        // return view('bookings.index',compact('bookings'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $this->validasi_input($request);
  
        if ($valid->fails()) {
            return Redirect::to('bookings/create')
            ->withErrors($valid);
 
        }else{
            $file=$request->file('file')->store('bookings','public');

            $booking = new \App\Booking;
            $tanggal_pinjam = $request->get('tanggal_pinjam');
            $hari_pinjam = substr($tanggal_pinjam, 0, 2);
            $bulan_pinjam = substr($tanggal_pinjam, 3, 2);
            $tahun_pinjam = substr($tanggal_pinjam, 6, 4);
    
            $tanggal_pin = $tahun_pinjam.'-'.$bulan_pinjam.'-'.$hari_pinjam;
            $waktu_mul = $request->get('waktu_mulai').':00';
            $waktu_sel = $request->get('waktu_selesai').':00';
            $booking->r_id=$request->get('r_id');
            $booking->u_id=$request->get('u_id');
            $booking->tanggal_pinjam=$tanggal_pin;
            $booking->waktu_mulai=$waktu_mul;
            $booking->waktu_selesai=$waktu_sel;
            $booking->keperluan=$request->get('keperluan');
            $booking->file=$file;
            
            $cek_id_user = DB::table('users')->select('id')->where('users.id', '=', $request->u_id)->first();
            $cek_id_ruangan = DB::table('rooms')->select('id')->where('rooms.id', '=', $request->r_id)->first();
            if(is_null($cek_id_ruangan) && is_null($cek_id_user)){
                return redirect()->route('bookings.create')
                    ->with('error','Gagal booking. ID ruangan dan ID Peminjam salah.');
            } 
            elseif(is_null($cek_id_ruangan)){
                return redirect()->route('bookings.create')
                    ->with('error','Gagal booking. ID ruangan salah.');
            }elseif(is_null($cek_id_user)){
                return redirect()->route('bookings.create')
                    ->with('error','Gagal booking. ID Peminjam salah.');
            }else {
                $booking->save();
                return redirect()->route('bookings.index')
                        ->with('success','Booking created successfully.');
            }
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return view('bookings.show',compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        return view('bookings.edit',compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $valid = $this->validasi_input($request);
        if ($valid->fails()) {
            return Redirect::to('bookings/'.$booking->id.'/edit')
            ->withErrors($valid);
 
        }else{
             $file=$request->file('file')->store('bookings','public');
 
            if (!$request->file('file')) {
                # code...
                $file=$request->get('file');
            }else{
                if(Storage::disk('public')->has($booking->file)){
                    Storage::disk('public')->delete($booking->file);
                }
                $foto=$request->file('file')->store('bookings','public');                
            }
            $file=$request->file('file')->store('bookings','public');
           

            //$booking = new \App\Booking;
            $tanggal_pinjam = $request->get('tanggal_pinjam');
            $hari_pinjam = substr($tanggal_pinjam, 0, 2);
            $bulan_pinjam = substr($tanggal_pinjam, 3, 2);
            $tahun_pinjam = substr($tanggal_pinjam, 6, 4);
    
            $tanggal_pin = $tahun_pinjam.'-'.$bulan_pinjam.'-'.$hari_pinjam;
            $waktu_mul = $request->get('waktu_mulai').':00';
            $waktu_sel = $request->get('waktu_selesai').':00';
            $booking->r_id=$request->get('r_id');
            $booking->u_id=$request->get('u_id');
            $booking->tanggal_pinjam=$tanggal_pin;
            $booking->waktu_mulai=$waktu_mul;
            $booking->waktu_selesai=$waktu_sel;
            $booking->keperluan=$request->get('keperluan');
            $booking->file=$file;
            $booking->save();
            return redirect()->route('bookings.index')
                        ->with('success','Booking created successfully.');
        }
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        if(Storage::disk('public')->has($booking->foto)){
            Storage::disk('public')->delete($booking->foto);
        }

        $booking->delete();
  
        return redirect()->route('bookings.index')
                        ->with('success','Booking deleted successfully');
    }

    public function getBookingCount(){
        return $count = DB::table('bookings')->count();
    }

    public function validasi_input(Request $request)
    {
        $rules=[    
            'r_id'=>'required|integer',
            'u_id'=>'required|integer',
            'tanggal_pinjam' => 'required',
            'waktu_mulai'=>'required',
            'waktu_selesai'=>'required',
            'keperluan'=>'required',
            'file'=>'required|mimes:jpg,png,jpeg,JPG'
        ];
 
        $pesan=[
            'r_id.required'=>'ID Ruangan tidak boleh kosong!',
            'u_id.required'=>'ID Peminjam tidak boleh kosong!',
            'tanggal_pinjam'=> 'Tanggal pinjam tidak boleh kosong!',
            'waktu_mulai.required'=>'Waktu mulai tidak boleh kosong!',
            'waktu_selesai.required'=>'Waktu selesai tidak boleh kosong!',
            'keperluan.required'=>'Keperluan tidak boleh kosong!',
            'file.required'=>'Foto surat izin tidak boleh kosong!'
        ];
 
        $validator=Validator::make($request->all(),$rules,$pesan);
        return $validator;
    }
}
