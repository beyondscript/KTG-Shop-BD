<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class SendHotDealExpireEmails extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $hotdeal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin, $hotdeal)
    {
        $this->admin = $admin;
        $this->hotdeal = $hotdeal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(Lang::get('Your assigned hot deal has expired'))->view('emails.send_hot_deal_expire_email');
    }
}
