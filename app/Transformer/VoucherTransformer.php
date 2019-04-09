<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 13/02/2018
 * Time: 11:34
 */

namespace App\Transformer;


use App\Models\Category;
use App\Models\Product;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class VoucherTransformer extends TransformerAbstract
{
    public function transform(Voucher $data){

        try{
            $createdDate = Carbon::parse($data->created_at)->format('d M Y');
            $updatedDate = Carbon::parse($data->updated_at)->format('d M Y');
            $startDate = Carbon::parse($data->start_date)->format('d M Y');
            $finishDate = Carbon::parse($data->finish_date)->format('d M Y');

            if($data->category_id != null || $data->category_id != 0){
                $action = "<a class='btn btn-xs btn-info' href='vouchers/edit/category/".$data->id."' data-toggle='tooltip' data-placement='top'><i class='icon-mode_edit'></i></a>";
            }
            else{
                $action = "<a class='btn btn-xs btn-info' href='vouchers/edit/product/".$data->id."' data-toggle='tooltip' data-placement='top'><i class='icon-mode_edit'></i></a>";
            }
            $action .= "<a class='delete-modal btn btn-xs btn-danger' data-id='". $data->id ."' ><i class='icon-delete'></i></a>";

            if($data->category_id != null || $data->category_id != 0){
                $tmpCategory = Category::find($data->category_id);
                $category = $tmpCategory->name;
            }
            else{
                $category = '-';
            }

            if($data->product_id != null || $data->product_id != 0){
                $tmpProduct = Product::find($data->product_id);
                $product = $tmpProduct->name;
            }
            else{
                $product = '-';
            }

            return[
                'code'              => $data->code,
                'description'       => $data->description,
                'category'          => $category,
                'product'           => $product,
                'created_at'        => $createdDate,
                'created_by'        => $data->createdBy->first_name . ' ' . $data->createdBy->last_name,
                'updated_at'        => $updatedDate,
                'updated_by'        => $data->updatedBy->first_name . ' ' . $data->updatedBy->last_name,
                'start_date'        => $startDate,
                'finish_date'       => $finishDate,
                'status'            => $data->status->description,
                'action'            => $action
            ];
        }
        catch (\Exception $exception){
            error_log($exception);
            Log::error("VoucherTransformer/transform error: ". $exception);
        }
    }
}