<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
Use Redirect;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
  
        return view('rooms.index', compact('rooms'));
        // return view('rooms.index',compact('rooms'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
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
  
        $foto=$request->file('foto')->store('rooms','public');

        $room = new \App\Room;
 
        $room->nama=$request->get('nama');
        $room->lantai=$request->get('lantai');
        $room->kapasitas=$request->get('kapasitas');
        $room->fasilitas=$request->get('fasilitas');
        $room->foto=$foto;
        $room->save();

        return redirect()->route('rooms.index')
                        ->with('success','Room created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('rooms.show',compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('rooms.edit',compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
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
            return Redirect::to('rooms/'.$room->id.'/edit')
            ->withErrors($validator);
 
        }else{
 
            $foto="";
 
            if (!$request->file('foto')) {
                # code...
                $foto=$request->get('foto');
            }else{
                if(Storage::disk('public')->has($room->foto)){
                    Storage::disk('public')->delete($room->foto);
                }
                $foto=$request->file('foto')->store('rooms','public');                
            }

            $room->nama=$request->get('nama');
            $room->lantai=$request->get('lantai');
            $room->kapasitas=$request->get('kapasitas');
            $room->fasilitas=$request->get('fasilitas');
            $room->foto=$foto;
            $room->save();
 
            // Session::flash('message','Data Barang Berhasil Diubah');
             
            return redirect()->route('rooms.index')
                        ->with('success','Room created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        if(Storage::disk('public')->has($room->foto)){
            Storage::disk('public')->delete($room->foto);
        }

        $room->delete();
  
        return redirect()->route('rooms.index')
                        ->with('success','Room deleted successfully');
    }

    public function getRoomCount(){
        return $count = DB::table('rooms')->count();
    }
}
