<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
Use Redirect;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();
  
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
        $request->validate([
            'nama'=>'required',
            'lantai'=>'required',
            'kapasitas'=>'required|integer',
            'fasilitas'=>'required',
            'foto'=>'required|mimes:jpg,png,jpeg,JPG'
        ]);
  
        $foto=$request->file('foto')->store('bookings','public');

        $booking = new \App\Booking;
 
        $booking->nama=$request->get('nama');
        $booking->lantai=$request->get('lantai');
        $booking->kapasitas=$request->get('kapasitas');
        $booking->fasilitas=$request->get('fasilitas');
        $booking->foto=$foto;
        $booking->save();

        return redirect()->route('bookings.index')
                        ->with('success','Booking created successfully.');
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
        $rules=[    
            'nama'=>'required',
            'lantai'=>'required',
            'kapasitas'=>'required|integer',
            'fasilitas'=>'required',
            'foto'=>'required|mimes:jpg,png,jpeg,JPG'
        ];
 
        $pesan=[
            'nama.required'=>'Nama tidak boleh kosong!',
            'lantai.required'=>'Lantai tidak boleh kosong!',
            'kapasitas.required'=>'Kapasitas tidak boleh kosong!',
            'fasilitas.required'=>'Fasilitas tidak boleh kosong!',
            'foto.required'=>'Foto tidak boleh kosong!'
        ];
 
        $validator=Validator::make($request->all(),$rules,$pesan);
 
        if ($validator->fails()) {
            return Redirect::to('bookings/'.$booking->id.'/edit')
            ->withErrors($validator);
 
        }else{
 
            $foto="";
 
            if (!$request->file('foto')) {
                # code...
                $foto=$request->get('foto');
            }else{
                if(Storage::disk('public')->has($booking->foto)){
                    Storage::disk('public')->delete($booking->foto);
                }
                $foto=$request->file('foto')->store('bookings','public');                
            }

            $booking->nama=$request->get('nama');
            $booking->lantai=$request->get('lantai');
            $booking->kapasitas=$request->get('kapasitas');
            $booking->fasilitas=$request->get('fasilitas');
            $booking->foto=$foto;
            $booking->save();
 
            // Session::flash('message','Data Barang Berhasil Diubah');
             
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
}
