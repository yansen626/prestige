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
        $isIndonesian = true;
        $data=([
            'order' => $order,
            'orderProduct' => $orderProduct,
            'isIndonesian' => $isIndonesian
        ]);
        return view('frontend.checkout')->with($data);
    }

    public function submitCheckout(Request $request, Order $order){
        $paymentMethod = $request->input('payment_method');
        $orderProduct = OrderProduct::where('order_id', $order->id)->get();

        //set data to request
        $transactionDataArr = Midtrans::setRequestData($order, $orderProduct, $paymentMethod);
                dd($transactionDataArr);
        //sending to midtrans
        $redirectUrl = Midtrans::sendRequest($transactionDataArr);
//                dd($redirectUrl);

        return redirect($redirectUrl);
    }
}
