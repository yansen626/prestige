<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 13/02/2018
 * Time: 11:34
 */

namespace App\Transformer;

use App\Models\Faq;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class FaqTransformer extends TransformerAbstract
{
    public function transform(Faq $faq){
        try{
            $createdDate = Carbon::parse($faq->created_at)->format('d M Y');

            $action = "<a class='btn btn-xs btn-info' href='faqs/edit/".$faq->id."' data-toggle='tooltip' data-placement='top'><i class='icon-mode_edit'></i></a>";
            $action .= "<a class='delete-modal btn btn-xs btn-danger' data-id='". $faq->id ."' ><i class='icon-delete'></i></a>";

            return[
                'header'            => $faq->header,
                'description'       => $faq->description,
                'created_by'        => $faq->createdBy->first_name . ' ' . $faq->createdBy->last_name,
                'created_at'        => $createdDate,
                'action'            => $action
            ];
        }
        catch (\Exception $exception){
            error_log($exception);
        }
    }
}