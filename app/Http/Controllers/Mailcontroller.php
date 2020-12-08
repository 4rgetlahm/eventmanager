<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EmailQueueing;
use Mail;

class Mailcontroller extends Controller
{
    public function mail_defines(){
        if(!defined("EMAIL")){
            define("EMAIL", "Email.renginiuplatforma@gmail.com");
        }
    }

    public function __construct()
    {
        $this->mail_defines();
    }

    public function sendMail($email, $title, $message){
        /*$details['email'] = $email;
        $details['title'] = $title;
        $details['message'] = $message;
        dispatch(new \App\Jobs\SendEmail($details));*/
        dispatch(new \App\Jobs\SendEmail($email, $title, $message));
        //Mail::send(new EmailQueueing($email, $title, $message));
        /*Mail::to($message, function($message) use ($email, $title){
            $message->to($email)->subject($title);
            $message->from(EMAIL, 'Renginių Platforma');
        })->queue(new EmailQueueing($));*/
    }
}
