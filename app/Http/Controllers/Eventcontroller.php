<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use App\User;
use App\Http\Controllers\Restricted;
use \Carbon\Carbon;

class Eventcontroller extends Controller
{
    public function __construct(Restricted $restricted) {
       $this->middleware('auth');
    }


    public function createEvent(Request $request){
        if(\Auth::user()->role < PERM_CREATE_EVENT){ // jei vartotojas neturi permissiono kurti eventui, ismetam klaida.
            abort(403, 'Jūs neturite teisių šiam veiksmui!');
        }
        if($request->date == null){ return back()->with('danger', 'Nenustatyta renginio data!'); }
        if(!is_numeric($request->slots)){ return back()->with('danger', 'Vartotojų kiekis turi būti skaičius!'); }
        $event = new Events();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->slots = $request->slots;
        $event->registered = "";

        $datetime = Carbon::parse($request->date)->format('Y/m/d');
        $event->date = $datetime;

        $event->save();
        return redirect()->intended('/')->with('success', 'Sėkmingai sukūrėte renginį!');
    }

    public function editEvent(Request $request){
        if(\Auth::user()->role < PERM_EDIT_EVENT){ // jei vartotojas neturi permissiono kurti eventui, ismetam klaida.
            abort(403, 'Jūs neturite teisių šiam veiksmui!');
        }

        $event = Events::find($request->eventID);

        if($request->remove == '1'){
            $event->delete();
            return redirect()->intended('/')->with('warning', "Sėkmingai panaikinote renginį!");
        }
        else{
            $event->title = $request->title;
            $event->description = $request->description;
            $event->slots = $request->slots;

            $datetime = Carbon::parse($request->date)->format('Y/m/d');
            $event->date = $datetime;

            $event->save();
            return redirect()->intended('/')->with('success', 'Sėkmingai pakeitėte renginio duomenis!');
        }

    }

}
