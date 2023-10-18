<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class SubscriberWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $app_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $app_name)
    {
        $this->user = $user;
        $this->app_name = $app_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(Lang::get('Welcome to '.$this->app_name))->view('emails.subscriber_welcome_email');
    }
}
