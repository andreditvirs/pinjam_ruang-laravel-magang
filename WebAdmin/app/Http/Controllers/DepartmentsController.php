<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
Use Redirect;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = DB::table('departments')
                ->leftJoin('users', 'departments.kepala_id', '=', 'users.id')
                ->select('departments.*', 'users.nama as user_nama')
                ->get();

        return view('departments.index', compact('departments'));
        // return view('departments.index',compact('departments'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
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
            'kepala_id'=>'required',
        ]);
        
        $department = new \App\Department;
 
        $department->nama=$request->get('nama');
        $department->kepala_id=$request->get('kepala_id');
        $department->save();

        return redirect()->route('departments.index')
                        ->with('success','Department created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('departments.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $rules=[    
            'nama'=>'required',
            'kepala_id'=>'required',
        ];
 
        $pesan=[
            'nama.required'=>'Nama tidak boleh kosong!',
            'kepala_id.required'=>'Kepala_id tidak boleh kosong!',
        ];
 
        $validator=Validator::make($request->all(),$rules,$pesan);
 
        if ($validator->fails()) {
            return Redirect::to('departments/'.$department->id.'/edit')
            ->withErrors($validator);
 
        }else{
 

            $department->nama=$request->get('nama');
            $department->kepala_id=$request->get('kepala_id');
            $department->save();
 
            // Session::flash('message','Data Barang Berhasil Diubah');
             
            return redirect()->route('departments.index')
                        ->with('success','Department created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
  
        return redirect()->route('departments.index')
                        ->with('success','Department deleted successfully');
    }

    public function getDepartmentCount(){
        return $count = DB::table('departments')->count();
    }
}
