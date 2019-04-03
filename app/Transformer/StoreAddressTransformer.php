<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 13/02/2018
 * Time: 11:34
 */

namespace App\Transformer;


use App\Models\StoreAddress;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class StoreAddressTransformer extends TransformerAbstract
{
    public function transform(StoreAddress $storeAddress){

        try{
            $createdDate = Carbon::parse($storeAddress->created_at)->format('d M Y');
            $updatedDate = Carbon::parse($storeAddress->updated_at)->format('d M Y');

            if($storeAddress->primary == 1){
                $primary = "Primary";
            }
            else{
                $primary = "Not Primary";
            }

            return[
                'name'              => $storeAddress->name,
                'description'       => $storeAddress->description,
                'updated_at'        => $updatedDate,
                'created_at'        => $createdDate,
                'created_by'        => $storeAddress->createdBy->first_name . ' ' . $storeAddress->createdBy->last_name,
                'updated_by'        => $storeAddress->updatedBy->first_name . ' ' . $storeAddress->updatedBy->last_name,
                'province'          => $storeAddress->province->name,
                'city'              => $storeAddress->city->name,
                'district'          => $storeAddress->disctrict_id,
                'postal_code'       => $storeAddress->postal_code,
                'primary'           => $primary
            ];
        }
        catch (\Exception $exception){
            error_log($exception);
            Log::error("StoreAddressTransformer/transform error: ". $exception);
        }
    }
}