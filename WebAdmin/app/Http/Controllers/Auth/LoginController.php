<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        return 'username';
    }

    // public function logout() {
    //     Auth::logout();
    //     return redirect('/login');
    // }
    
    public function getLogin()
    {
      return view('auth.login');
    }

    public function login(Request $request)
    {
  
        // Validate the form data
      $this->validate($request, [
        'username' => 'required',
        'password' => 'required'
      ]);
  
        // Attempt to log the user in
        // Passwordnya pake bcrypt
        //pasword sebelum di kirim langsung, dienkripsi dulu 
        //jadi pas kalo ada attacker di db ga bisa liat password. karna passwd ush di
        //enkripsi.  tapi username ga ikut. 

        //cara abcrypt, contohnya ada di Http/controllers/auth/registercrontroller.php 
        //(Auth::guard ('') )--- > maksudnya, ke kelas Auth (dir: config/auth.php )

        //!important!
        //satu section ini untuk pengaturan agar di web, user tidak bisa
        //langsung ngetik url/Admin
      if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
          // if successful, then redirect to their intended location
        return redirect()->intended('/admin');
      } else if (Auth::guard('user')->attempt(['username' => $request->username, 'password' => $request->password])) {
        return redirect()->intended('/notadmin');
      } else{
        return redirect()->intended('/');
      }
  
    }
  
    public function logout()
    {
      if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
      } elseif (Auth::guard('user')->check()) {
        Auth::guard('user')->logout();
      }

      return redirect('/login');
    }
}
