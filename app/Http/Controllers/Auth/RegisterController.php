<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\verification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'class' => 'required|string',
            'g-recaptcha-response' => 'recaptcha',
        ]);
    }

    protected function registered(Request $request, $user)
    {
        //$this->guard()->logout();
        $request->session()->flash('success', 'Registracija sėkminga. Per ateinančias 10 min. jums turėtų būti atsiųstas el. laiškas adresu: '.$user->email.' skirtas patvirtinti jūsų paskyrą. Patvirtinus galėsite naudotis renginių platforma.');
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //if(!(strpos($data['email'], '@azuolynogimnazija.lt') !== false)){
            //abort(403, 'Netinkamas el. pašto adresas!');
        //}

        /*
            TODO : REDIRECT TO REGISTRATION WITH WARNING/DANGER MESSAGES
        */

        //class check, galima butu padaryti protingiau, kol kas bus gerai
        if(
            $data['class'] != "I A" && $data['class'] != "I B" && $data['class'] != "I C" && $data['class'] != "I D" && $data['class'] != "I E"
            && $data['class'] != "II A" && $data['class'] != "II B" && $data['class'] != "II C" && $data['class'] != "II D" && $data['class'] != "II E"
            && $data['class'] != "III A" && $data['class'] != "III B" && $data['class'] != "III C" && $data['class'] != "III D" && $data['class'] != "III E"
            && $data['class'] != "IV A" && $data['class'] != "IV B" && $data['class'] != "IV C" && $data['class'] != "IV D" && $data['class'] != "IV E"
        ){
            abort(403, "Netinkamas klasės pasirinkimas!");
        }


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'class' => $data['class'],
            'password' => bcrypt($data['password']),
        ]);

        $verify_user = verification::create([
            'id' => $user->id,
            'token' => str_random(80)
        ]);

        app('App\Http\Controllers\Mailcontroller')->sendMail($user->email, "Registracijos patvirtinimas", "Jūs užsiregistravote į Renginių Platformą, kad patvirtinti savo registraciją paspauskite ant šios nuorodos: http://azuolynogimnazija.renginiai.it/verification/".$verify_user->token);

        return $user;

    }

}
