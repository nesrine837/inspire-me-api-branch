<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewProject extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $name;
    public $email;
    public $message;
    public $cell;
    public function __construct($info)
    {
        $this->name = $info['name'];
        $this->email = $info['email'];
        $this->message = wordwrap($info['message'], 75, "<br/>");
        $this->cell = isset($info['cell']) ? $info['cell'] : '';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new');
    }
}
