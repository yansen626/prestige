<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status', 1)->get();
        $data=([
           'products' => $products,
        ]);
        return view('frontend.home')->with($data);
    }

    public function contact(Request $request)
    {
        $dateTimeNow = Carbon::now('Asia/Jakarta');
        $newContact = ContactMessage::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
            'created_at'        => $dateTimeNow->toDateTimeString(),
        ]);
        return redirect()->route('home');
    }

    public function newsletter(Request $request)
    {
        try{
            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $newSubscriber = Subscribe::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'created_at'        => $dateTimeNow->toDateTimeString(),
            ]);
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            return Response::json(array('errors' => 'INVALID' . $request->input('id')));
        }
    }

    public function aboutUs(){
        $products = Product::where('status', 1)->get();
        $data=([
            'products' => $products,
        ]);
        return view('frontend.about-us')->with($data);
    }

    public function Others($type){
        //faq
        if($type == 'FAQ'){
            return view('frontend.FAQ');
        }
        //term and condition
        else if($type == 'Term-Condition'){
            return view('frontend.term-condition');
        }
        //privacy policy
        else{
            return view('frontend.privacy-policy');
        }
    }

    public function getLocation(){
        dd(\Request::ip());
        $asdf = geoip($ip = \Request::ip());
        dd($asdf);
    }

    public function getProvince(){
        $uri = 'https://api.rajaongkir.com/starter/province';
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/province',[
            'query' => ['key' => '49c2d8cab7d32fa5222c6355a07834d4']
        ]);
        $response = $response->getBody()->getContents();
        $currency = (array)json_decode($response);

        return $currency;
    }
    public function TestingPurpose(){

    }
    public function setCookie(){

        Cookie::queue(Cookie::make('guest-cart', "3#4", 1440));
//        $productDB = Product::find(5);
//        $description = "asdfdsaf";
//        $user_id = "";
//
//        $cookieValue = Cookie::get('guest-cart');
//        $minutes = 1440;
//
//        //if cookie contains cart data
//        if(!empty($cookieValue)){
//            $newValue = "";
//
//            //if cookie already consist a product
//            if(strpos($cookieValue, $productDB->slug) !== false){
//                $valueArr = explode(";", $cookieValue);
//                for($i=0;$i<count($valueArr);$i++){
//                    if(strpos($valueArr[$i], '|') !== false){
//                        $valueArr2 = explode("|", $valueArr[$i]);
//
//                        //if product slug = current product
//                        if($valueArr2[0] == $productDB->slug){
//                            $qty = (double)$valueArr2[2] + 1;
//                            $price = (double)$valueArr2[3];
//                            $total_price = $qty * $price;
//                            $newValue = $newValue.$valueArr2[0]."|".$valueArr2[1]."|".$qty."|".
//                                $price."|".$total_price."|".$valueArr2[5].";";
//                        }
//                        //else rewrite current data from cookie to new cookie
//                        else{
//                            $newValue = $newValue.$valueArr2[0]."|".$valueArr2[1]."|".$valueArr2[2]."|".
//                                $valueArr2[3]."|".$valueArr2[4]."|".$valueArr2[5].";";
//                        }
//                    }
//                    else{
//                        break;
//                    }
//                }
//            }
//            else{
//                $newValue = $cookieValue;
//                $description = "asdfdsaf";
//                //cookie value = product_id|user_id|qty|price|total_price|description
//                $newValue = $newValue.$productDB->slug."|".$user_id."|1|".$productDB->price."|".$productDB->price."|".$description.";";
//
//            }
//            Cookie::queue(Cookie::make('guest-cart', $newValue, $minutes));
//        }
//        //create new cookie store cart datas
//        else{
//            //cookie value = product_id|user_id|qty|price|total_price|description
//            $value = $productDB->slug."|".$user_id."|1|".$productDB->price."|".$productDB->price."|".$description.";";
//
//            Cookie::queue(Cookie::make('guest-cart', $value, $minutes));
//        }
        return redirect()->route('getCookie');
    }
    public function getCookie(){
        $cookieValue = Cookie::get('guest-cart');
        return $cookieValue;
    }
}
