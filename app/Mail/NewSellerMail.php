<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class NewSellerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin, $user)
    {
        $this->admin = $admin;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(Lang::get('A new seller has registered'))->view('emails.new_seller_email');
    }
}
