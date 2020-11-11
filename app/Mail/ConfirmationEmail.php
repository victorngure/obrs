<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $msg;
    public $subject; 
    public $name;

    public function __construct($data)
    {
        $this->email = $data["email"];
        $this->msg = $data["msg"];
        $this->subject = $data["subject"];      
        $this->name = $data["name"];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmation')
                ->subject($this->subject)
                ->from($this->email, $this->name);
    }
}
