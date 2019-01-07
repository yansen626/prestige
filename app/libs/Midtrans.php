<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 18-Sep-17
 * Time: 10:30 AM
 */

namespace App\libs;

use App\Models\Cart;
use GuzzleHttp\Client;

class Midtrans
{
    public static function setRequestData($order, $orderProducts, $paymentMethod){
        try{
            //item_details
            $item_details = [];
            foreach($orderProducts as $orderProduct){
                //set item detail
                $item_detail = array(
                    'id' => $orderProduct->id,
                    'price' => $orderProduct->price,
                    'quantity' => $orderProduct->qty,
                    'name' => $orderProduct->Product->name
                );
                array_push($item_details, $item_detail);
            }

            //add shipping as item for midtrans
            $item_shipping = array(
                'id' => $order->id,
                'price' => $order->shipping_charge,
                'quantity' => 1,
                'name' => "Shipping ".$order->shipping_option
            );
            array_push($item_details, $item_shipping);

            //add other service as item for midtrans
            $item_service = array(
                'id' => $order->id,
                'price' => $order->payment_charge,
                'quantity' => 1,
                'name' => "Service"
            );
            array_push($item_details, $item_service);

            //add tax as item for midtrans
            $item_tax = array(
                'id' => $order->id,
                'price' => $order->tax_amount,
                'quantity' => 1,
                'name' => "Tax"
            );
            array_push($item_details, $item_tax);


            //vtweb

            // credit card = credit_card
            // bank transfer = bank_transfer
            // e-wallet =
            // direct debit = mandiri_clickpay, cimb_clicks, bri_epay, bca_klikpay

            $hostUrl = env('SERVER_HOST_URL');
            if($paymentMethod == 'bank_transfer'){
                $finish_redirect_url = $hostUrl. '/checkout/success/bank_transfer';
                $unfinish_redirect_url = $hostUrl. '/checkout-4';
            }
            else{
                $finish_redirect_url = $hostUrl. '/checkout-success/'.$order->user_id;
                $unfinish_redirect_url = $hostUrl. '/checkout-failed';
            }
            $vt_web = array(
                'credit_card_3d_secure' => true,
                'enabled_payments' => $paymentMethod,
                'finish_redirect_url' => $finish_redirect_url,
                'unfinish_redirect_url' => $unfinish_redirect_url,
                'error_redirect_url' => $hostUrl. '/payment/error'
            );
            
            $transaction_details = array(
                'order_id' => rand(),
                'gross_amount' => $order->grand_total, // no decimal allowed
            );

            $customer_details = array(
                'email'         => $order->user->email,
                'phone'         => $order->user->phone
            );
            $transaction = array(
                'payment_type' => "vtweb",
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details,
                'item_details' => $item_details,
                'vtweb' => $vt_web,
            );

            return $transaction;
        }
        catch (\Exception $ex){
            error_log($ex);
            dd($ex);
            Utilities::ExceptionLog('midtransSetRequestData EX = '. $ex);
        }
    }

    public static function sendRequest($transactionDataArr){
        $isDevelopment = env('MIDTRANS_IS_DEVELOPMENT');

        if($isDevelopment == "true"){
            $serverKey = env('MIDTRANS_API_KEY_SANDBOX');
            $serverURL = env('MIDTRANS_API_URL_SANDBOX');
        }
        else{
            $serverKey = env('MIDTRANS_API_KEY_PRODUCTION');
            $serverURL = env('MIDTRANS_URL_PRODUCTION');
        }
        json_encode($transactionDataArr);
        $base64ServerKey = base64_encode($serverKey);

        $client = new Client([
            'base_uri' => $serverURL,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.$base64ServerKey
            ],
        ]);
        $request = $client->request('POST', $serverURL, [
            'json' => $transactionDataArr
        ]);

        Utilities::ExceptionLog($request->getBody());

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());
            $redirectUrl = $collect->redirect_url;

            return $redirectUrl;
        }

    }
}