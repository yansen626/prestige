<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 15/09/2017
 * Time: 9:59
 */

namespace App\libs;


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
}