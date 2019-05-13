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
use Illuminate\Support\Facades\Log;

class OrderBankTransferTransformer extends TransformerAbstract
{
    public function transform(OrderBankTransfer $order){

        try{
            $createdDate = Carbon::parse($order->created_at)->format('d M Y');

            $action = "<a class='btn btn-xs btn-info' href='detail/".$order->order_id."' data-toggle='tooltip' data-placement='top'><i class='icon-info'></i></a>";

            if($order->order->order_status_id == 8){
                $action .= " <a class='accept-modal btn btn-xs btn-success' data-id='". $order->order_id ."' ><i class='icon-save'></i></a>";
            }
            if($order->status == 0){
                $statusDesc = "Need Confimation";
            }
            else{
                $statusDesc = "Confirmed";
            }

            return[
                'order_number'      => $order->order->order_number ?? '',
                'customer'          => $order->user->first_name . ' ' . $order->user->last_name,
                'bank_acc_no'       => $order->bank_acc_no,
                'bank_acc_name'     => $order->bank_acc_name,
                'bank_name'         => $order->bank_name,
                'amount'            => $order->amount_string,
                'status'            => $statusDesc,
                'created_at'        => $createdDate,
                'action'            => $action
            ];
        }
        catch (\Exception $exception){
            error_log($exception);
            Log::error("OrderBankTransferTransformer.php > transform ".$exception);
        }
    }
}