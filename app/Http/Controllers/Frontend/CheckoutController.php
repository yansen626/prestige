<?php

namespace App\Http\Controllers\Frontend;

use App\Libs\Midtrans;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function getCheckout(Order $order)
    {
        if (Auth::check()){
            $user = Auth::user();
        }
        else{
            $user = Session::get('user');
        }
        if($order->user_id == $user->id){
            $orderProduct = OrderProduct::where('order_id', $order->id)->get();

            $isIndonesian = true;
            $data=([
                'order' => $order,
                'orderProduct' => $orderProduct,
                'isIndonesian' => $isIndonesian
            ]);
            return view('frontend.checkout')->with($data);
        }
        return redirect()->route('home');
    }

    public function submitCheckout(Request $request, Order $order){
        // Credit card = credit_card
        // Bank Transfer = bank_transfer, echannel,
        // Internet Banking = bca_klikpay, bca_klikbca, mandiri_clickpay, bri_epay, cimb_clicks, danamon_online,
        // Ewallet = telkomsel_cash, indosat_dompetku, mandiri_ecash,
        // Over the counter = cstore
        // Cardless Credit = akulaku
        try{
            $paymentMethod = $request->input('payment_method');
            $orderProduct = OrderProduct::where('order_id', $order->id)->get();

            //set data to request
            $transactionDataArr = Midtrans::setRequestData($order, $orderProduct, $paymentMethod);
//            dd($transactionDataArr);

            //sending to midtrans
            $redirectUrl = Midtrans::sendRequest($transactionDataArr);
            //dd($exception);
        }
        catch (\Exception $ex){
            dd($ex);
            return 0;
        }
        //                dd($redirectUrl);

        return redirect($redirectUrl);
    }
}
