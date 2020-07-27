<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
Use Redirect;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
                ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
                ->leftJoin('position_in_departments', 'users.jabatan_id', '=', 'position_in_departments.id')
                ->select('users.*', 'departments.nama as department_nama', 'position_in_departments.nama as jabatan')
                ->paginate(5);

        return view('users.index', compact('users'));
        // return view('users.index',compact('users'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'nip' =>'required',
            'nama'=>'required',
            'username' => 'required',
            'password'=>'required|confirmed|min:6',
            'jenis_kelamin' => 'required',
            'department_id' => 'required',
            'jabatan_id' => 'required',
            'foto'=>'required|mimes:jpg,png,jpeg,JPG'
        ]);
  
        $foto=$request->file('foto')->store('users','public');

        $user = new \App\User;
 
        $user->nip=$request->get('nip');
        $user->nama=$request->get('nama');
        $user->jenis_kelamin=$request->get('jenis_kelamin');
        $user->department_id=$request->get('department_id');
        $user->jabatan_id=$request->get('jabatan_id');
        $user->foto=$foto;
        $user->save();

        return redirect()->route('users.index')
                        ->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules=[    
            'nip' =>'required',
            'nama'=>'required',
            'username' => 'required',
            'password'=>'required|confirmed|min:6',
            'jenis_kelamin' => 'required',
            'department_id' => 'required',
            'jabatan_id' => 'required',
            'foto'=>'required|mimes:jpg,png,jpeg,JPG'
        ];
 
        $pesan=[
            'nip.required'=>'NIP tidak boleh kosong!',
            'nama.required'=>'Nama tidak boleh kosong!',
            'username.required'=>'Username tidak boleh kosong!',
            'password.required'=>'Password tidak boleh kosong/tidak sama!',
            'jenis_kelamin.required'=>'Pilih jenis kelamin!',
            'department_id.required'=>'ID Department tidak boleh kosong!',
            'jabatan_id.required'=>'ID Jabatan tidak boleh kosong!',
            'foto.required'=>'Foto tidak boleh kosong!'
        ];
 
        $validator=Validator::make($request->all(),$rules,$pesan);
 
        if ($validator->fails()) {
            return Redirect::to('users/'.$user->id.'/edit')
            ->withErrors($validator);
 
        }else{
 
            $foto="";
 
            if (!$request->file('foto')) {
                # code...
                $foto=$request->get('foto');
            }else{
                if(Storage::disk('public')->has($user->foto)){
                    Storage::disk('public')->delete($user->foto);
                }
                $foto=$request->file('foto')->store('users','public');                
            }

            $user->nip=$request->get('nip');
            $user->nama=$request->get('nama');
            $user->jenis_kelamin=$request->get('jenis_kelamin');
            $user->department_id=$request->get('department_id');
            $user->jabatan_id=$request->get('jabatan_id');
            $user->foto=$foto;
            $user->save();
 
            // Session::flash('message','Data Barang Berhasil Diubah');
             
            return redirect()->route('users.index')
                        ->with('success','User created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Storage::disk('public')->has($user->foto)){
            Storage::disk('public')->delete($user->foto);
        }

        $user->delete();
  
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function getUserCount(){
        return $count = DB::table('users')->count();
    }
}
