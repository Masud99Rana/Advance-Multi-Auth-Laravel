<?php

namespace App\Mail;

use App\Model\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class verifyUserEmail extends Mailable
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
