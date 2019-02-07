<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmation extends Mailable
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
    public function __construct($user, $order, $orderProduct, $productImages)
    {
        //
        $this->user = $user;
        $this->order = $order;
        $this->orderProduct = $orderProduct;
        $this->productImages = $productImages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->user->first_name. " ".$this->user->last_name.", Order Confirmation")
            ->view('mail.order-confirmation')->with([
                'user' => $this->user,
                'order' => $this->order,
                'orderProducts' => $this->orderProduct,
                'productImages' => $this->productImages,
            ]);
    }
}
