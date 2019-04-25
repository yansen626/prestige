<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 15/09/2017
 * Time: 9:59
 */

namespace App\libs;


use App\Models\City;
use App\Models\StoreAddress;
use App\Models\Transaction;
use GuzzleHttp\Client;

class RajaOngkir
{
    public static function getCity($provinceId){
        $client = new Client([
            'base_uri' => 'https://pro.rajaongkir.com/api/city?province='. $provinceId,
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY')
            ],
        ]);

        $request = $client->request('GET', 'https://pro.rajaongkir.com/api/city?province='. $provinceId);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            return $collect;
        }
    }

    public static function getSubdistrict($cityId){
        $client = new Client([
            'base_uri' => 'https://pro.rajaongkir.com/api/subdistrict?city='. $cityId,
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY')
            ],
        ]);

        $request = $client->request('GET', 'https://pro.rajaongkir.com/api/subdistrict?city='. $cityId);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            return $collect;
        }
    }


    public static function getCost($origin, $originType, $destination, $destinationType, $weight, $courier){
        $client = new Client([
            'base_uri' => 'https://pro.rajaongkir.com/api/cost',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
                'key' => env('RAJAONGKIR_API_KEY')
            ],
        ]);

        $request = $client->request('POST', 'https://pro.rajaongkir.com/api/cost', [
            'form_params' => [
                'origin' => $origin,
                'originType' => $originType,
                'destination' => $destination,
                'destinationType' => $destinationType,
                'weight' => $weight,
                'courier' => $courier,
            ]
        ]);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            return $collect;
        }
    }

    public static function getWaybill($trxId){
        $trx = Transaction::find($trxId);

        $client = new Client([
            'base_uri' => 'https://pro.rajaongkir.com/api/waybill',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'key' => env('RAJAONGKIR_API_KEY')
            ],
        ]);

        $request = $client->request('POST', 'https://pro.rajaongkir.com/api/waybill', [
            'form_params' => [
                'waybill' => $trx->tracking_code,
                'courier' => $trx->courier_code,
            ]
        ]);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            return $collect;
        }
        else{
            return null;
        }
    }

    /**
     * Function to get all the Infomration Data and Synch to Local Database.
     * (Optional)
     *
     * 151 - 155 (Jakarta)
     * 22-24 (Bandung)
     * 444 (Surabaya)
     * 455-457 (Tangerang)
    */
    public static function getAllInformation()
    {
        try{
            $baseAddress = StoreAddress::where('primary', 1)->first();
            $cities = [
                151, 152, 153, 154, 155, 22, 23, 24, 444, 455, 456, 457
            ];

            $tmpCityA = City::whereIn('id', $cities)->get();;

            foreach ($tmpCityA as $cityA){
                $client = new Client([
                    'base_uri' => 'https://pro.rajaongkir.com/api/cost',
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/x-www-form-urlencoded',
                        'key' => env('RAJAONGKIR_API_KEY')
                    ],
                ]);

                $request = $client->request('POST', 'https://pro.rajaongkir.com/api/cost', [
                    'form_params' => [
                        'origin' => $baseAddress->city_id,
                        'originType' => 'city',
                        'destination' => $cityA->id,
                        'destinationType' => 'city',
                        'weight' => 900,
                        'courier' => 'jne',
                    ]
                ]);

                //Do for TIKI too
                //Save to DB
            }
        }
        catch (\Exception $ex){
            error_log($ex);
        }
    }
}