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
use App\Models\OrderBankTransfer;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class OrderBankTransferTransformer extends TransformerAbstract
{
    public function transform(OrderBankTransfer $order){

        try{
            $createdDate = Carbon::parse($order->created_at)->format('d M Y');

            $action = "<a class='btn btn-xs btn-info' href='orders/detail/".$order->id."' data-toggle='tooltip' data-placement='top'><i class='icon-info'></i></a>";

            if($order->order->order_status_id == 8){
                $action .= " <a class='accept-modal btn btn-xs btn-success' data-id='". $order->id ."' ><i class='icon-save'></i></a>";
            }

            return[
                'order_number'      => $order->order->order_number ?? '',
                'customer'          => $order->user->first_name . ' ' . $order->user->last_name,
                'bank_acc_no'       => $order->bank_acc_no,
                'bank_acc_name'     => $order->bank_acc_name,
                'bank_name'         => $order->bank_name,
                'amount'            => $order->amount,
                'created_at'        => $createdDate,
                'action'            => $action
            ];
        }
        catch (\Exception $exception){
            error_log($exception);
        }
    }
}