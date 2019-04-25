<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\libs\Midtrans;
use App\libs\Zoho;
use App\Mail\NewTransaction;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

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

            $isDevelopment = env('MIDTRANS_IS_DEVELOPMENT');

            if($isDevelopment == "true"){
                $snapURL = env('MIDTRANS_SNAP_SANDBOX');
                $clientKey = env('MIDTRANS_CLIENT_KEY_SANDBOX');
            }
            else{
                $snapURL = env('MIDTRANS_SNAP_PRODUCTION');
                $clientKey = env('MIDTRANS_CLIENT_KEY');
            }
            $data=([
                'order' => $order,
                'orderProduct' => $orderProduct,
                'isIndonesian' => $isIndonesian,
                'snapURL' => $snapURL,
                'clientKey' => $clientKey
            ]);

            //change order status to pending payment
            $orderDB = Order::find($order->id);
            $orderDB->order_status_id = 2;
            $orderDB->save();

            return view('frontend.transactions.checkout')->with($data);
        }
        return redirect()->route('home');
    }

    public function submitCheckout(Request $request){
        // Credit card = credit_card
        // Bank Transfer = bank_transfer, echannel,
        // Internet Banking = bca_klikpay, bca_klikbca, mandiri_clickpay, bri_epay, cimb_clicks, danamon_online,
        // Ewallet = telkomsel_cash, indosat_dompetku, mandiri_ecash,
        // Over the counter = cstore
        // Cardless Credit = akulaku
        try{
            $paymentMethod = $request->input('payment_method');
            $order = Order::find($request->input('order'));
            $orderProduct = OrderProduct::where('order_id', $order->id)->get();

            if($request->input('voucher') != ''){
                //Apply Voucher
                $voucherAmount = (float)$request->input('voucher_amount');
                $order->voucher_code = $request->input('voucher');
                $order->voucher_amount = $voucherAmount;
                $total = $order->grand_total;
                $order->grand_total = $total - $voucherAmount;
                $order->save();
            }

            if($paymentMethod == "credit_card"){
                $order->payment_option = "Credit Card";
                $order->save();

                //set data to request
                $transactionDataArr = Midtrans::setRequestData($order, $orderProduct, $paymentMethod);
//            dd($transactionDataArr);
//            error_log($transactionDataArr);

                //sending to midtrans
                $redirectUrl = Midtrans::sendRequest($transactionDataArr);

                //send email for notification new transaction
//                $user = User::find($order->user_id);
//                $newTransaction = new NewTransaction($user, $order, "Credit Card");
//                Mail::to(env('MAIL_SALES'))
//                    ->send($newTransaction);

                return Response::json(array('success' => $redirectUrl));
            }
            else{
                $order->payment_option = "Transfer Bank";
                $order->save();

                $redirectUrl = route('checkout-transfer-information', ['order'=>$order]);
                //dd($exception);

                //Pending bank transfer payment
                //change status
                $order->order_status_id = 7;
                $order->save();

                //send email for notification new transaction
//                $user = User::find($order->user_id);
//                $newTransaction = new NewTransaction($user, $order, "Transfer Bank");
//                Mail::to(env('MAIL_SALES'))
//                    ->send($newTransaction);

                return Response::json(array('success' => $redirectUrl));
            }
        }
        catch (\Exception $ex){
//            dd($ex);
            Log::error("CheckoutController.php > submitCheckout ".$ex);
            return Response::json(array('errors' => 'INVALID'));
        }
    }
//    public function submitCheckout(Request $request, Order $order){
//        // Credit card = credit_card
//        // Bank Transfer = bank_transfer, echannel,
//        // Internet Banking = bca_klikpay, bca_klikbca, mandiri_clickpay, bri_epay, cimb_clicks, danamon_online,
//        // Ewallet = telkomsel_cash, indosat_dompetku, mandiri_ecash,
//        // Over the counter = cstore
//        // Cardless Credit = akulaku
//        try{
//            $paymentMethod = $request->input('payment_method');
//            $orderProduct = OrderProduct::where('order_id', $order->id)->get();
//
//            //set data to request
//            $transactionDataArr = Midtrans::setRequestData($order, $orderProduct, $paymentMethod);
////            dd($transactionDataArr);
//
//            //sending to midtrans
//            $redirectUrl = Midtrans::sendRequest($transactionDataArr);
//            //dd($exception);
//        }
//        catch (\Exception $ex){
////            dd($ex);
//            return 0;
//        }
//        //                dd($redirectUrl);
//
//        return redirect($redirectUrl);
//    }

    public function checkoutSuccess($order){
        try{
//            dd("asdf");
            //change order status to pending payment
            $order = str_replace('_', '/', $order);
            $orderDB = Order::where('order_number', $order)->first();
            $orderDB->order_status_id = 3;
            $orderDB->save();

            $orderProducts = OrderProduct::where('order_id', $orderDB->id)->get();

            // Create ZOHO Invoice
            Zoho::createInvoice($orderDB->zoho_sales_order_id);

            //send email confirmation
            $user = User::find($orderDB->user_id);

            $productIdArr = [];
            foreach ($orderProducts as $orderProduct){
                array_push($productIdArr, $orderProduct->product_id);

                //minus item quantity
                $product = $orderProduct->product;
                $qty = $product->qty;
                $product->qty = $qty-1;
                $product->save();
            }

            $productImages = ProductImage::whereIn('product_id',$productIdArr)->where('is_main_image', 1)->get();
            $productImageArr = [];
            foreach ($productImages as $productImage){
                $productImageArr[$productImage->product_id] = $productImage->path;
            }
            $orderConfirmation = new OrderConfirmation($user, $orderDB, $orderProducts, $productImageArr);
            Mail::to($user->email)
                ->bcc(env('MAIL_SALES'))
                ->send($orderConfirmation);
//            dd($resultMail);

            $data=([
                'order' => $orderDB,
                'orderProduct' => $orderProducts,
            ]);
//            dd($data);
            return view('frontend.transactions.checkout-success')->with($data);
        }
        catch(\Exception $ex){
//            dd($ex);
            error_log($ex);
            Log::error("CheckoutController > checkoutSuccess Error: ". $ex->getMessage());
        }
    }
    public function TransferInformation(Order $order){
        $orderProducts = OrderProduct::where('order_id', $order->id)->get();

        //send email confirmation
        $user = User::find($order->user_id);

        $productIdArr = [];
        foreach ($orderProducts as $orderProduct){
            array_push($productIdArr, $orderProduct->product_id);

            //minus item quantity
            $product = $orderProduct->product;
            $qty = $product->qty;
            $product->qty = $qty-1;
            $product->save();
        }

        $productImages = ProductImage::whereIn('product_id',$productIdArr)->where('is_main_image', 1)->get();
        $productImageArr = [];
        foreach ($productImages as $productImage){
            $productImageArr[$productImage->product_id] = $productImage->path;
        }
        $orderConfirmation = new OrderConfirmation($user, $order, $orderProducts, $productImageArr);
        Mail::to($user->email)
            ->bcc(env('MAIL_SALES'))
            ->send($orderConfirmation);

        $data=([
            'order' => $order,
            'orderProduct' => $orderProducts,
        ]);
        return view('frontend.transactions.transfer_information')->with($data);
    }
    public function checkoutFailed(Order $order){

    }
}
