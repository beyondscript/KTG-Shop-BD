<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class WithdrawRequestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $user;
    public $withdraw;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin, $user, $withdraw)
    {
        $this->admin = $admin;
        $this->user = $user;
        $this->withdraw = $withdraw;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(Lang::get('You have a new withdrawal request of BDT '.$this->withdraw->amount))->view('emails.withdraw_request_email');
    }
}
