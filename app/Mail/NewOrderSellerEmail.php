<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class NewOrderSellerEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderdetail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderdetail)
    {
        $this->orderdetail = $orderdetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(Lang::get('You have received a new order'))->view('emails.new_order_seller_email');
    }
}
