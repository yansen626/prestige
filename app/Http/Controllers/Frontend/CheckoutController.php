<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function getCheckout(Order $order)
    {
        $data=([
            'order' => $order
        ]);
        return view('frontend.checkout')->with($data);
    }
}
