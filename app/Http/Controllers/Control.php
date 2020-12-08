<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use App\Auth;


class Control extends Controller
{
    public function index(){
        $events = Events::all();
        return view('index')->with('Events', $events);
    }

    public function recovery(){
        return view('auth/recover');
    }
}
