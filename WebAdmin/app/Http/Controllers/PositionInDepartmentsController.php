<?php

namespace App\Http\Controllers;

use App\PositionInDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
Use Redirect;

class PositionInDepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $position_in_departments = DB::table('position_in_departments')
                ->get();

        return view('position_in_departments.index', compact('position_in_departments'));
        // return view('position_in_departments.index',compact('position_in_departments'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('position_in_departments.create');
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
        ]);
        
        $position_in_department = new \App\PositionInDepartment;
 
        $position_in_department->nama=$request->get('nama');
        $position_in_department->save();

        return redirect()->route('position_in_departments.index')
                        ->with('success','PositionInDepartment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PositionInDepartment  $position_in_department
     * @return \Illuminate\Http\Response
     */
    public function show(PositionInDepartment $position_in_department)
    {
        return view('position_in_departments.show', compact('position_in_department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PositionInDepartment  $position_in_department
     * @return \Illuminate\Http\Response
     */
    public function edit(PositionInDepartment $position_in_department)
    {
        return view('position_in_departments.edit',compact('position_in_department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PositionInDepartment  $position_in_department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PositionInDepartment $position_in_department)
    {
        $rules=[    
            'nama'=>'required',
        ];
 
        $pesan=[
            'nama.required'=>'Nama tidak boleh kosong!',
        ];
 
        $validator=Validator::make($request->all(),$rules,$pesan);
 
        if ($validator->fails()) {
            return Redirect::to('position_in_departments/'.$position_in_department->id.'/edit')
            ->withErrors($validator);
 
        }else{
            $position_in_department->nama=$request->get('nama');
            $position_in_department->save();
 
            // Session::flash('message','Data Barang Berhasil Diubah');
             
            return redirect()->route('position_in_departments.index')
                        ->with('success','PositionInDepartment created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PositionInDepartment  $position_in_department
     * @return \Illuminate\Http\Response
     */
    public function destroy(PositionInDepartment $position_in_department)
    {
        $position_in_department->delete();
  
        return redirect()->route('position_in_departments.index')
                        ->with('success','PositionInDepartment deleted successfully');
    }

    public function getPositionInDepartmentCount(){
        return $count = DB::table('position_in_departments')->count();
    }
}
