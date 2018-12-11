<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 13/02/2018
 * Time: 11:34
 */

namespace App\Transformer;


use App\Models\Currency;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class CurrencyTransformer extends TransformerAbstract
{
    public function transform(Currency $currency){

        try{
            $updatedDate = Carbon::parse($currency->updated_at)->format('d M Y');

            return[
                'name'              => $currency->name,
                'rate'              => $currency->rate_string,
                'updated_at'        => $updatedDate,
            ];
        }
        catch (\Exception $exception){
            error_log($exception);
        }
    }
}