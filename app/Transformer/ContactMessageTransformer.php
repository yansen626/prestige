<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 13/02/2018
 * Time: 11:34
 */

namespace App\Transformer;


use App\Models\ContactMessage;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class ContactMessageTransformer extends TransformerAbstract
{
    public function transform(ContactMessage $data){

        try{
            $createdDate = Carbon::parse($data->created_at)->format('d M Y');

            $action = "<a class='delete-modal btn btn-xs btn-danger' data-id='". $data->id ."' ><i class='icon-delete'></i></a>";

            return[
                'name'              => $data->name,
                'email'             => $data->email,
                'message'           => $data->message,
                'created_at'        => $createdDate,
                'action'            => $action
            ];
        }
        catch (\Exception $exception){
            error_log($exception);
        }
    }
}