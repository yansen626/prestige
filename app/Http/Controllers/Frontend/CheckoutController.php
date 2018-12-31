<?php

namespace App\Http\Controllers\Frontend;

use App\Libs\Midtrans;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function getCheckout(Order $order)
    {
        $orderProduct = OrderProduct::where('order_id', $order->id)->get();

        $data=([
            'order' => $order,
            'orderProduct' => $orderProduct
        ]);
        return view('frontend.checkout')->with($data);
    }

    public function submitCheckout(){
//        //set data to request
//        $transactionDataArr = Midtrans::setRequestData($userId, Input::get('checkout-payment-method-input'), $orderId, $cartCreate);
////                dd($transactionDataArr);
//        //sending to midtrans
//        $redirectUrl = Midtrans::sendRequest($transactionDataArr);
////                dd($redirectUrl);
//
//        return redirect($redirectUrl);
    }
}
