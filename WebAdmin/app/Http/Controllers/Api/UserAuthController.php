<?php

namespace App\Http\Controllers\Api;

use App\UserAuth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public $successStatus = 200;
    
    public function index()
    {
        $users = UserAuth::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua UserAuths',
            'data' => $users
        ], 200);
    }

    public function login(){
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['error' => false, 'success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>true, 'msg' => 'Unauthorized']);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|integer',
            'username' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'department_id' => 'required',
            'foto'=>'required|mimes:jpg,png,jpeg,JPG',
            'jabatan_id' => 'required'
        ]);

        $input = $request->all();

        if ($validator->fails()) {
            return response()->json(['error'=>true, 'msg'=>$validator->errors()]);            
        } 

        $checkusername=$this->availableUsername($input['username']);
        if(!$checkusername){
            return response()->json(['error' => true, 'msg'=>'Username']);
        }

        $checknip=$this->availableNip($input['nip']);
        if (!$checknip) {
            return response()->json(['error' => true, 'msg'=>'Nip']);
            # code...
        }
        
        $foto="";
 
        if (!$request->file('foto')) {
            # code...
            $input['foto']=$request->get('foto');
        }else{
            $input['foto']=$request->file('foto')->store('users','public');                
        }

        $input['password'] = bcrypt($input['password']);
        $user = UserAuth::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['nama'] =  $user->nama;

        return response()->json(['error'=>false], $this->successStatus);
    }
    public function availableUsername($username){
        $checkusername = DB::table('users')->select('nama')->where('username', '=', $username)->first();
        if(is_null($checkusername)){
            return true;
        }else{
           return false;
        }
       }

    public function availableNip($nip){
        $checknip = DB::table('users')->select('nip')->where('nip', '=', $nip)->first();
        if (is_null($checknip)) {
            return true;
        }else{
            return false;
        }
    }
    public function details()
    {
        $user = Auth::user();
        $user_department = DB::table('departments')->select('nama')->where('departments.id', '=', $user->department_id)->first();
        $user_position_in_department = DB::table('position_in_departments')->select('nama')->where('position_in_departments.id', '=', $user->jabatan_id)->first();
        $user->department_name = $user_department->nama;
        $user->position_in_department_name = $user_position_in_department->nama;
        return response()->json(['error' => false, 'profile' => $user], $this->successStatus);
    }

    public function logout(){   
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(['error'=>false,'msg' =>'logout_success'],200); 
        }else{
            return response()->json(['error'=>true, 'msg' =>'api.something_went_wrong'], 500);
        }
    }

    public function changePassword(Request $request)
    {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            // 'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                    $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
                } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                    $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                    UserAuth::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }
        }
        return \Response::json($arr);
    }

    public function editprofile(Request $request)
    {
        $userauth = Auth::user();
        $id = $userauth->id;

        $validator = Validator::make($request->all(), [
            'nip' => 'required|integer',
            'username' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'department_id' => 'required',
            'foto'=>'required|mimes:jpg,png,jpeg,JPG',
            'jabatan_id' => 'required'
        ]);

        $user = UserAuth::findOrFail($id);
        $user->nip = $request->get('nip');
        $user->nama = $request->get('nama');
        $user->username = $request->get('username');
        $user->jenis_kelamin = $request->get('jenis_kelamin');
        $user->department_id = $request->get('department_id');
        $user->jabatan_id = $request->get('jabatan_id');

        // $input = $request->all();
        if ($validator->fails()) {
            return response()->json(['error'=>true]);            
        }

        $foto="";
 
        if (!$request->file('foto')) {
            return response()->json(['error'=>true]);
        }else{
            unlink(storage_path().'/app/public/'.$user->foto);
            $user->foto = $request->file('foto')->store('users','public');                
        }

        $user->save();
        
        return response()->json(['error'=>false], $this->successStatus);
    }

}
