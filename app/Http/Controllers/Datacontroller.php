<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use App\User;
use App\Http\Controllers\Restricted;
use Mail;
class Datacontroller extends Controller
{
    public function __construct(Restricted $restricted) {
       $this->middleware('auth');
    }

    public function editUser(Request $request){
        if(\Auth::user()->role < PERM_EDIT_USERS){ // jei vartotojas neturi permissiono
            abort(403, 'Jūs neturite teisių šiam veiksmui!');
        }

        $user = User::find($request->userID);
        if(!($user)){
            return redirect()->back()->with('user_error', 'user error');
        }

        if($request->remove == 1){
            $user->delete();
            return redirect()->back()->with('user_removed', 'user removal');
        }

        if(strlen($request->password) > 0){
            if($request->password != $request->password_confirmation){
                return redirect()->back()->with('password_mismatch', 'Slaptažodžiai nesutampa!');
            }
            $user->password = bcrypt($request->password);
        }
        $user->name = $request->name;
        $user->class = $request->class;
        $user->email = $request->email;

        if($request->role != "Rolė"){
            $updateRole = 0;
            if($request->role == "Moderatorius"){
                $updateRole = 1;
            } else if($request->role == "Administratorius"){
                $updateRole = 2;
            } else if($request->role == "Sistemos Administratorius"){
                $updateRole = 3;
            }
            $user->role = $updateRole;
        }

        $user->save();
        return redirect()->back()->with('success_edit', 'Sėkmingai pakeista informacija!');
    }


    public function addRegistration(Request $request){

        $event = Events::find($request->eventID); //isgaunam eventa pagal id
        if($event){
          $reg = $request->reg;
            if($reg == "true"){ //jeigu mes registruojames
              $slots = $event->slots;
              if($slots == 0) { abort(403, 'Nėra laisvų vietų.');}

              if($slots > 0){
                  $currentRegistrationList = $event->registered; //isgaunam prisiregistravusiu sarasa
                  $user = \Auth::user(); //isgaunam dabartini naudotoja
                  if($user->verified == 0){
                      return redirect('/')->with('danger', 'Kad užsiregistuoti į renginį jums reikia patvirtinti savo el. pašto adresą! <a href="confirmation/resend/'.$user->id.'">Spauskite čia, kad persiųsti patvirtinimo laišką</a>');
                  }
                  if(!(strpos($currentRegistrationList, $user->email) !== false)){ //patikriname ar nera prisiregistraves
                    $slots--;
                    $currentRegistrationList .= $user->email.';'; //kabliataskis, kad poto galima butu atskirt uzsiregistravusiuosius;
                    $event->registered = $currentRegistrationList; //pakeiciam data
                    $event->slots = $slots;
                    $saved = $event->save(); //issaugom
                        if(!$saved){
                            abort(403, 'Saugojimo klaida!');
                        }
                        app('App\Http\Controllers\Mailcontroller')->sendMail($user->email, "Prisiregistravimas prie renginio", "Jūs sėkmingai prisiregistravote prie renginio: ".$event->title);
                    }
                    else{
                      abort(403, 'Naudotojas jau yra prisiregistravęs.');
                    }
                }
            }
            else{ //jeigu issiregistruojame
                $slots = $event->slots;
                $currentRegistrationList = $event->registered; //isgaunam prisiregistravusiu sarasa
                $user = \Auth::user(); //isgaunam dabartini naudotoja
                if(strpos($currentRegistrationList, $user->email) !== false){ // patikriname ar tikrai yra prie prisiregistravusiuju
                    $slots++;
                    $currentRegistrationList = str_replace($user->email.";", "", $currentRegistrationList);
                    $event->registered = $currentRegistrationList;
                    $event->slots = $slots;
                    $saved = $event->save();
                    if(!$saved){
                      abort(403, 'Saugojimo klaida!');
                    }
                    app('App\Http\Controllers\Mailcontroller')->sendMail($user->email, "Išsiregistravimas iš renginio", "Jūs sėkmingai išsiregistravote iš renginio: ".$event->title);

                } else{
                  abort(403, 'Naudotojas nėra prisiregistravęs.');
                }
            }
        } else{
          abort(403, 'Tokio renginio nėra.');
        }
        return redirect('/');
    }
}
