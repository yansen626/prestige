<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 13/02/2018
 * Time: 11:34
 */

namespace App\Transformer;


use App\Models\Subscribe;
use App\Models\WaitingList;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class WaitingListTransformer extends TransformerAbstract
{
    public function transform(WaitingList $data){

        try{
            $createdDate = Carbon::parse($data->created_at)->format('d M Y');

            $action = "<a class='delete-modal btn btn-xs btn-danger' data-id='". $data->id ."' ><i class='icon-delete'></i></a>";

            return[
                'name'              => $data->name,
                'email'             => $data->email,
                'product_sku'           => $data->product->sku,
                'product_name'           => $data->product->name,
                'product_color'     => $data->product->colour,
                'created_at'        => $createdDate,
                'action'            => $action
            ];
        }
        catch (\Exception $exception){
            error_log($exception);
        }
    }
}