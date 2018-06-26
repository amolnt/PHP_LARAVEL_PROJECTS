<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Your_Username_Password extends Mailable
{
    use Queueable, SerializesModels;

    public $username="";
    public $password="";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->password=$data['password'];
        $this->username=$data['username'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.password')->with('username',$this->username)->with('password',$this->password);
    }
}
