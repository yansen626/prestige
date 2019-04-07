<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class RajaOngkirController extends Controller
{
    public function getCost(Request $request){
        try{
            $cityId = intval($request->input('destination_city_id'));
            $weight = intval($request->input('weight'));
            $courierArr = $request->input('courier');

            $client = new \GuzzleHttp\Client(['http_errors' => false]);
            $url = "https://api.rajaongkir.com/starter/cost";
//            $url = env('RAJAONGKIR_URL').'/cost';
            $key = env('RAJAONGKIR_KEY');

            $response = $client->request('POST', $url, [
                'headers' => [
                    'key' => $key
                ],
                'form_params' => [
                    'origin' => 152,
                    'originType' => 'city',
                    'destination' => $cityId,
                    'destinationType' => 'city',
                    'weight' => $weight,
                    'courier' => $courierArr[0]
                ]
            ]);

            $shippingPrice = 0;
            if($response->getStatusCode() === 200){
                $responseBody = $response->getBody()->getContents();
                $responseArr = json_decode($responseBody);
                $results = $responseArr->rajaongkir->results;

                $shippingPrice = 0;
                foreach($results as $result){
                    foreach ($result->costs as $cost){
                        if($cost->service == $courierArr[1]){
                            $shippingPrice = $cost->cost[0]->value;
                        }
                    }
                }
            }

            return Response::json(
                array(
                    'code'      => $response->getStatusCode(),
                    'fee'       => $shippingPrice
                )
            );
        }
        catch (\Exception $exception){
            return Response::json(
                array(
                    'errors'    => 'EXCEPTION',
                    'ex'        => $exception->getTraceAsString()
                )
            );
        }
    }
}