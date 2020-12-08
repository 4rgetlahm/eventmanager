<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     /*public function authenticated(Request $request, $user)
     {
         if (!$user->verified) {
             auth()->logout();
             return back()->with('warning', 'Jums reikia patvirtinti savo el. pašto adresą, kad naudotis svetaine!');
         }
         return redirect('/');
     }*/

     public function login(Request $request)
     {
         if (Auth::attempt(['email' => request('email'), 'password' => request('password'), 'verified' => 1])) {
             return redirect()->intended('/')->with('success', 'Sėkmingai prisijungėte!');
         } else if(Auth::attempt(['email' => request('email'), 'password' => request('password'), 'verified' => 0])){
	           //auth()->logout();
             return redirect('/')->with('warning', 'Jums reikia patvirtinti savo el. pašto adresą, kad galėtumėte registruotis prie renginių.');
         } else{
             return redirect()->intended('/')->with('danger', 'Neteisingi prisijungimo duomenys!');
         }
     }



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
