<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\EmailQueueing as EmailQueueing;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     public $content;
     protected $mailSubject, $mailTo;
    public function __construct($to, $subject, $content)
    {
        $this->content = $content;
        $this->mailSubject = $subject;
        $this->mailTo = $to;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new EmailQueueing($this->mailTo, $this->mailSubject, $this->content);
        Mail::to($this->mailTo)->send($email);
        /*$this->subject($this->mailSubject)
             ->to($this->mailTo)
             ->from("Email.renginiuplatforma@gmail.com", 'Renginių Platforma');*/
    }
}
