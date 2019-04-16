<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewTransaction extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $order;
    protected $orderProduct;
    protected $paymentMethod;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $order, $paymentMethod)
    {
        //
        $this->user = $user;
        $this->order = $order;
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("New Transaction from ".$this->user->first_name. " ".$this->user->last_name)
            ->view('mail.new-transaction')->with([
                'user' => $this->user,
                'order' => $this->order,
                'paymentMethod' => $this->paymentMethod
            ]);
    }
}
