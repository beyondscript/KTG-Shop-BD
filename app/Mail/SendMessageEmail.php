<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class SendMessageEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $information;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin, $information)
    {
        $this->admin = $admin;
        $this->information = $information;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo($this->information['email'])->subject(Lang::get($this->information['name'].' has sent a message'))->view('emails.send_message_email');
    }
}
