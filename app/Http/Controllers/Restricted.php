<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
//use App\Auth;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\verification;

class Restricted extends Controller
{
    public function defines(){
        define("ROLE_USER", "0");
        define("ROLE_MODERATOR", "1");
        define("ROLE_ADMIN", "2");
        define("ROLE_SYSTEM_ADMIN", "3");
        define("ROLE_HEATHCLIFF", "1337");
        define("DEFAULT_PAGE", "/dashboard");

        define("PERM_CREATE_EVENT", ROLE_ADMIN);
        define("PERM_EDIT_EVENT", ROLE_ADMIN);
        define("PERM_READ_EVENT", ROLE_MODERATOR);
        define("PERM_EDIT_USERS", ROLE_SYSTEM_ADMIN);
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->defines();
    }

    public function index()
    {
        return view(DEFAULT_PAGE);
    }

    public function hasPermission($permission){
        if(\Auth::user()->role >= $permission){
            return true;
        }
        return false;
    }

    public function dashboard_createEvent(){
        if($this->hasPermission(PERM_CREATE_EVENT)){
            return view('dashboard.create_event');
        } else{
            return redirect(DEFAULT_PAGE);
        }
    }

    public function dashboard_editEvent(){
        if($this->hasPermission(PERM_EDIT_EVENT)){
            $events = Events::all();
            return view('dashboard.edit_events')->with('Events', $events);
        } else{
            return redirect(DEFAULT_PAGE);
        }
    }

    public function dashboard_statistics(){
        if($this->hasPermission(PERM_READ_EVENT)){
            $events = Events::all();
            $users = User::all();
            return view('dashboard.statistics')->with('Events', $events)->with('Users', $users);
        } else{
            return redirect(DEFAULT_PAGE);
        }
    }

    public function dashboard_usermanagement(){
        if($this->hasPermission(PERM_EDIT_USERS)){
            $users = User::all();
            return view('dashboard.user_management')->with('Users', $users);
        }
        else{
            return redirect(DEFAULT_PAGE);
        }
    }

    public function resendVerification($id){
        $user = User::where('id', $id)->first();
        if($user->verified == 0){
            $verifyUser = verification::where('id', $id)->first();
            app('App\Http\Controllers\Mailcontroller')->sendMail($user->email, "Registracijos patvirtinimas", "Jūs užsiregistravote į Renginių Platformą, kad patvirtinti savo registraciją paspauskite ant šios nuorodos: http://azuolynogimnazija.renginiai.it/verification/".$verifyUser->token);
            return redirect('/')->with('success', 'Patvritinimo laiškas buvo išsiųstas į el. paštą: '.$user->email);
        }

        return redirect('/')->with('success', "Jūsų paskyra yra patvirtinta!");
    }

    public function verifyUser($token)
    {
        $verifyUser = verification::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                return redirect('/')->with('success', "Jūsų el. pašto adresas buvo patvirtintas, dabar galite registruotis į renginius!");
            }
        } else {
            return redirect('/')->with('warning', "El. paštas nerastas.");
        }
        return redirect('/')->with('warning', "Jūsų el. pašto adresas jau patvirtintas!");
    }
}
