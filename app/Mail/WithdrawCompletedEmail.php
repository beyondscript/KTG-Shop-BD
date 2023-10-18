<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class WithdrawCompletedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $withdraw;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($withdraw)
    {
        $this->withdraw = $withdraw;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(Lang::get('Your withdrawal request for BDT '.$this->withdraw->amount.' has been completed'))->view('emails.withdraw_completed_email');
    }
}
