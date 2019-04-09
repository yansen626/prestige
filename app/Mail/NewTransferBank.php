<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewTransferBank extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $order;
    protected $orderProduct;
    protected $productImages;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $order)
    {
        //
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("New Transfer from ".$this->user->first_name. " ".$this->user->last_name)
            ->view('mail.new-transfer-bank')->with([
                'user' => $this->user,
                'order' => $this->order
            ]);
    }
}
