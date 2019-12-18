<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class verifyAdminEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $verificationUrl;
    
    public function __construct($verificationUrl)
    {
        $this->verificationUrl = $verificationUrl;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.sendView',[$this->verificationUrl]);
    }
}
