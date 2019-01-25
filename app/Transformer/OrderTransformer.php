<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 13/02/2018
 * Time: 11:34
 */

namespace App\Transformer;


use App\Models\AdminUser;
use App\Models\Order;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    public function transform(Order $order){

        try{
            $createdDate = Carbon::parse($order->created_at)->format('d M Y');

            $action = "<a class='btn btn-xs btn-info' href='orders/detail/".$order->id."' data-toggle='tooltip' data-placement='top'><i class='icon-info'></i></a>";

            $tax = 0;
            if($order->tax_amount != null){
                $tax = $order->tax_amount;
            }

            return[
                'created_at'        => $createdDate,
                'customer'          => $order->user->first_name . ' ' . $order->user->last_name,
                'email'             => $order->user->email,
                'shipping'          => $order->shipping_option,
                'sub_total'         => 'Rp'.$order->sub_total,
                'tax_amount'        => 'Rp'.$tax,
                'grand_total'       => 'Rp'.$order->grand_total,
                'status'            => $order->order_status->name,
                'action'            => $action
            ];
        }
        catch (\Exception $exception){
            error_log($exception);
        }
    }
}