<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 14-Sep-17
 * Time: 2:38 PM
 */

namespace App\libs;

use Carbon\Carbon;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;


class Utilities
{
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
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        }catch(\Exception $ex){
//            dd($ex);
            error_log($ex);
        }
    }
}