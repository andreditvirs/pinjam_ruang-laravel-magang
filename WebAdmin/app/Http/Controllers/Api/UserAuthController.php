<?php

namespace App\Http\Controllers\Api;

use App\UserAuth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function index()
    {
        $users = UserAuth::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua UserAuths',
            'data' => $users
        ], 200);
    }

    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ],
            [
                'title.required' => 'Masukkan Title UserAuth !',
                'content.required' => 'Masukkan Content UserAuth !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $user = UserAuth::create([
                'title'     => $request->input('title'),
                'content'   => $request->input('content')
            ]);


            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'UserAuth Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'UserAuth Gagal Disimpan!',
                ], 400);
            }
        }
    }


    public function show($id)
    {
        $user = UserAuth::whereId($id)->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Detail UserAuth!',
                'data'    => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'UserAuth Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }

    public function update(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ],
            [
                'title.required' => 'Masukkan Title UserAuth !',
                'content.required' => 'Masukkan Content UserAuth !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $user = UserAuth::whereId($request->input('id'))->update([
                'title'     => $request->input('title'),
                'content'   => $request->input('content'),
            ]);


            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'UserAuth Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'UserAuth Gagal Diupdate!',
                ], 500);
            }

        }

    }

    public function destroy($id)
    {
        $user = UserAuth::findOrFail($id);
        $user->delete();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'UserAuth Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'UserAuth Gagal Dihapus!',
            ], 500);
        }

    }

    public $successStatus = 200;

    public function login(){
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['error' => false, 'success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>true, 'error_msg' => 'Unauthorized'], 401);
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
            'foto'=>'required|mimes:jpg,png,jpeg,JPG'
        ]);

        $input = $request->all();

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
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

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function logout(){   
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(['success' =>'logout_success'],200); 
        }else{
            return response()->json(['error' =>'api.something_went_wrong'], 500);
        }
    }

    public function changePassword(Request $request)
    {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
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

}
