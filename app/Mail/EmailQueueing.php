<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailQueueing extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    protected $mailSubject, $mailTo;

    /**
     * Create a new message instance.
     *
     * @param LayoutMailRawRequest $request
     */
     public function __construct($to, $subject, $content)
     {
         $this->content = $content;
         $this->mailSubject = $subject;
         $this->mailTo = $to;
     }

    /**
     * Build the message.
     *
     * @throws \Exception
     */
    public function build()
    {
         $this->subject($this->mailSubject)
              ->to($this->mailTo)
              ->from("Email.renginiuplatforma@gmail.com", 'Renginių Platforma');
        return $this->view('emails.raw');
    }
}
