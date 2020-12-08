<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use \Carbon\Carbon;

class Alertcontroller extends Controller
{
    public function tick(){
        $latestLog = \DB::table('alerttimer')->select('lastcall')->where('id', \DB::raw("(select max(`id`) from alerttimer)"))->first();
        if(Carbon::now()->diffInMinutes($latestLog->lastcall) >= 1440){ // if 24 hours have passed after last call
            foreach(Events::all() as $event){ //loop the events
                if(Carbon::now()->format('Y-m-d') == Carbon::createFromFormat('Y-m-d H:i:s', $event->date)->format('Y-m-d')){ //check if event's date is today
                    foreach (explode(';', $event->registered) as $email) { //get users who are registered to event
                        if($email != null){ // check if email is valid
                            app('App\Http\Controllers\Mailcontroller')->sendMail($email, "Renginio priminimas", "Primename, kad jūs užsiregistravote į renginį kuris vyksta šiandien: ".$event->title);
                        }
                    }
                }
            }
            //add new call to database
            \DB::table('alerttimer')->insertGetId(['lastcall' => Carbon::now()]);
        }
    }
}
