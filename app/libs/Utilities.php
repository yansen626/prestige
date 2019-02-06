<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 14-Sep-17
 * Time: 2:38 PM
 */

namespace App\libs;

use App\Models\OrderNumber;
use App\Models\Product;
use Carbon\Carbon;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;


class Utilities
{
    public static function GetProductMainImage($id){
        $product = Product::find($id);
        $productImage = $product->product_images->where('is_main_image', 1)->first();
//        dd($productImage);
        return $product->product_images->where('is_main_image', 1)->first();
    }

    public static function ExceptionLog($ex){
        $logContent = ['id' => 1,
            'description' => $ex];

        $log = new Logger('exception');
        $log->pushHandler(new StreamHandler(storage_path('logs/error.log')), Logger::ALERT);
        $log->info('exception', $logContent);
    }

    public static function CreateProductSlug($string){
        try{
            $string = strtolower($string);
            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
            $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $string); // Removes special chars.

            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        }catch(\Exception $ex){
//            dd($ex);
            error_log($ex);
        }
    }

    //  Get next incremental number of Order Number
    public static function GetNextOrderNumber($prepend){
        try{
            $nextNo = 1;
            $orderNumber = OrderNumber::find($prepend);
            if(empty($orderNumber)){
                OrderNumber::create([
                    'id'        => $prepend,
                    'next_no'   => 1
                ]);
            }
            else{
                $nextNo = $orderNumber->next_no;
            }

            return $nextNo;
        }
        catch (\Exception $ex){
            throw $ex;
        }
    }

    // Update incremental number of Order Number
    public static function UpdateOrderNumber($prepend){
        try{
            $orderNumber = OrderNumber::find($prepend);
            $orderNumber->next_no++;
            $orderNumber->save();
        }
        catch (\Exception $ex){
            throw $ex;
        }
    }

    // Generate full order number
    public static function GenerateOrderNumber($prepend, $nextNumber){
        try{
            $modulus = "";
            $nxt = $nextNumber. '';

            switch (strlen($nxt))
            {
                case 1:
                    $modulus = "000000";
                    break;
                case 2:
                    $modulus = "00000";
                    break;
                case 3:
                    $modulus = "0000";
                    break;
                case 4:
                    $modulus = "000";
                    break;
                case 5:
                    $modulus = "00";
                    break;
                case 6:
                    $modulus = "0";
                    break;
            }

            return $prepend. "/". $modulus. $nextNumber;
        }
        catch (\Exception $ex){
            throw $ex;
        }
    }
}