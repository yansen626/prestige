<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\libs\Utilities;
use App\Models\Address;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Province;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    public function getBilling()
    {
        // Have to Check to if User already Login
        $flag=0;
        $address = null;
        $user = null;
        $totalWeight = 0;

        if (Auth::check())
        {
            //Read DB
            $user = Auth::user();
            $addressDB = Address::where('user_id', $user->id)->get();
            if(count($addressDB) != 0){
                $address = Address::where('user_id', $user->id)->where('primary', 1)->first();
                $flag=1;
            }
        }
        else if(Session::has('cart')){
            //guest has address
            if(Session::has('user')){
                $user = Session::get('user');
                $addressDB = Address::where('user_id', $user->id)->get();
                if(count($addressDB) != 0){
                    $address = Address::where('user_id', $user->id)->where('primary', 1)->first();
                    $flag = 2;
                }
            }
            else{
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new \App\Cart($oldCart);
                $carts = $cart->items;

                foreach ($carts as $cartData) {
                    $productDB = Product::find($cartData['item']['product_id']);

                    $weight = $productDB->weight *  $cartData['item']['qty'];
                    $totalWeight += $weight;
                }
            }
        }

        if(!empty($user)){
            //get cart total weight for rajaongkir process
            $cartDB = Cart::where('user_id', $user->id)->get();
            foreach ($cartDB as $cart){
                $weight = $cart->product->weight * $cart->qty;
                $totalWeight += $weight;
            }
        }




        $countries = Country::all();
        $provinces = Province::all();
        $cities = City::all();

        $isIndonesian = true;
        $data=([
            'flag' => $flag,
            'address' => $address,
            'countries' => $countries,
            'provinces' => $provinces,
            'cities' => $cities,
            'totalWeight' => $totalWeight,
            'isIndonesian' => $isIndonesian,
        ]);
//        dd($data);
        return view('frontend.billing-shipment')->with($data);
    }

    public function submitBilling(Request $request)
    {
        // Get Data from Session or DB and then Continue
        // Create Transaction
        // Check Delivery Fee from Rajaongkir or DHL
        // Clear Session
        try{
            $user = null;
            $userAddress = null;
            $cityId = $request->input('city');

            if(strpos($cityId, '-') !== false){
                $splitedCity = explode('-', $cityId);
                $cityId = $splitedCity[1];
            }
            // Get Data from Session
            if(!Auth::check()){
                if(Session::has('cart')) {

                    //checking if guest already have account from session
                    //dd(!Session::has('user'));
                    if(!Session::has('user')) {
                        // Validation for Users
                        $validator = Validator::make($request->all(), [
                            'first_name'        => 'required|max:100',
                            'last_name'         => 'required|max:100',
                            'email'             => 'required|regex:/^\S*$/u|unique:users|max:50',
//                        'role_id'           => 'required'
                        ],[
                            'email.unique'      => 'ID Login Akses telah terdaftar!',
                            'email.regex'       => 'ID Login Akses harus tanpa spasi!'
                        ]);
                        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

                        // Create User with Guest Status
                        $user = User::create([
                            'first_name' => $request->input('first_name'),
                            'last_name' => $request->input('last_name'),
                            'email' => $request->input('email'),
                            'phone' => $request->input('phone'),
                            'email_token' => base64_encode($request->input('email')),
                            'status_id' => 3
                        ]);
                    }
                    else{
                        $user = Session::get('user');
                    }

                    //checking if guest already have address
                    $addressDB = Address::where('user_id', $user->id)->get();
                    if(count($addressDB) != 0){
                        $userAddress = Address::where('user_id', $user->id)->where('primary', 1)->first();
                    }
                    else{
                        // Create Address
                        $userAddress = Address::create([
                            'user_id' => $user->id,
                            'primary' => 1,
                            'description' => $request->input('address_detail'),
                            'country_id' => $request->input('country'),
                            'province_id' => $request->input('province'),
                            'city_id' => $cityId,
                            'street' => $request->input('street'),
                            'suburb' => $request->input('suburb'),
                            'state' => $request->input('state'),
                            'postal_code' => $request->input('post_code')
                        ]);
                    }

                    // Save to DB Table Cart
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $cart = new \App\Cart($oldCart);
                    $carts = $cart->items;

                    foreach ($carts as $cartData) {
//                        dd($carts);
                        $newCart = Cart::create([
                            'product_id' => $cartData['item']['product_id'],
                            'user_id' => $user->id,
                            'description' => $cartData['item']['description'],
                            'qty' => $cartData['item']['qty'],
                            'price' => $cartData['item']['product_id'],
                            'total_price' => $cartData['price'],
                            'created_at' => Carbon::now('Asia/Jakarta'),
                            'updated_at' => Carbon::now('Asia/Jakarta')
                        ]);
                    }
                    // Session for Cart deleted
                    // Session for user Created to be used later for payment at Checkout
                    // and Shipment for Rajaongkir or DHLl
                    if(!Session::has('user')) {
                        $request->session()->put('user', $user);
                    }
                }
            }

            // Get Data from DB
            else{
                $user = Auth::user();

                //checking if user already have address
                $addressDB = Address::where('user_id', $user->id)->get();
                if(count($addressDB) != 0){
                    $userAddress = Address::where('user_id', $user->id)->where('primary', 1)->first();
                }
                else{
                    // Create Address
                    $userAddress = Address::create([
                        'user_id' => $user->id,
                        'primary' => 1,
                        'description' => $request->input('address_detail'),
                        'country_id' => $request->input('country'),
                        'province_id' => $request->input('province'),
                        'city_id' => $cityId,
                        'street' => $request->input('street'),
                        'suburb' => $request->input('suburb'),
                        'state' => $request->input('state'),
                        'postal_code' => $request->input('post_code')
                    ]);
                }
            }

            //add new secondary address
            if($request->input('another_shipment') == true){
                $userAddress = Address::create([
                    'user_id' => $user->id,
                    'primary' => 0,
                    'description' => $request->input('address_detail_secondary'),
                    'country_id' => $request->input('country_secondary'),
                    'province_id' => $request->input('province_secondary'),
                    'city_id' => $request->input('city_secondary'),
                    'street' => $request->input('street_secondary'),
                    'suburb' => $request->input('suburb_secondary'),
                    'state' => $request->input('state_secondary'),
                    'postal_code' => $request->input('post_code_secondary')
                ]);
            }
//            dd($userAddress);

            // get rajaongkir Data
            $courier = $request->input('courier');
            $selectedCourier = explode('-',$courier);
            $totalWeight = $request->input('weight');
            $data = array();
            $data = $this->getRajaongkirData($totalWeight, $selectedCourier, $userAddress);

            if(empty($data)){
                return redirect()->back()->withErrors("Internal Server Error");
            }

            //dd($data);
            $results = array();
            $results = $data->rajaongkir->results;
//            dd($results);
            $shippingPrice = 0;
            foreach($results as $result){
                foreach ($result->costs as $cost){
                    if($cost->service == $selectedCourier[1]){
                        $shippingPrice = $cost->cost[0]->value;
                    }
                }
            }
//            dd($shippingPrice);
            if($shippingPrice == 0){
                return redirect()->back()->withErrors("Shipping service not available");
            }

            // create transaction from setTransaction
            $transactionSuccess = $this->setTransaction($user, $userAddress, $courier, $shippingPrice);
            if($transactionSuccess > 0){
                // Redirect to Checkout
                return redirect()->route('checkout', ['order'=>$transactionSuccess]);
            }
            else{
                return back()->withErrors("Something Went Wrong")->withInput($request->all());
            }

        }
        catch (\Exception $exception){
            return redirect()->route('cart')->withErrors($exception);
//            return redirect()->route('cart')->withErrors("Something Went Wrong");
        }
    }

    public function getRajaongkirData($totalWeight, $selectedCourier, $userAddress){
        $result = array();
        try{
            $client = new \GuzzleHttp\Client();
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
                    'destination' => $userAddress->city_id,
                    'destinationType' => 'city',
                    'weight' => $totalWeight,
                    'courier' => $selectedCourier[0]
                ]
            ]);
//            dd($response);
            $response = $response->getBody()->getContents();
            $result = json_decode($response);
//            dd($result);
            return $result;
        }
        catch (\Exception $exception){
            //dd($exception);
            return $result;
        }
    }

    public function setTransaction($user, $userAddress, $courier, $shippingPrice){
        try{
            $carts = Cart::where('user_id', $user->id)->get();
            $totalPrice = $carts->sum('total_price');

            // Order number generator
            $today = Carbon::today();
            $prepend = "INV/". $today->year. $today->month. $today->day;

            $nextNo = Utilities::GetNextOrderNumber($prepend);
            $orderNumber = Utilities::GenerateOrderNumber($prepend, $nextNo);

            //create order
            $newOrder = Order::create([
                'user_id' => $user->id,
                'billing_address_id' => $userAddress->id,
                'shipping_option' => $courier,
                'shipping_address_id' => $userAddress->id,
                'shipping_charge' => $shippingPrice,
                'payment_option' => "",
                'sub_total' => $totalPrice,
                'grand_total' => $totalPrice,
                'currency_code' => "IDR",
                'order_status_id' => 1,
                'order_number' => $orderNumber,
                'created_at' => Carbon::now('Asia/Jakarta'),
                'updated_at' => Carbon::now('Asia/Jakarta')
            ]);

            // Update auto number of Order Number
            Utilities::UpdateOrderNumber($prepend);

            //create order product
            foreach ($carts as $cart){
                $newOrderProduct = OrderProduct::create([
                    'order_id' => $newOrder->id,
                    'product_id' => $cart->product_id,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'grand_total' => $cart->total_price,
                    'product_info' => $cart->description,
                    'created_at' => Carbon::now('Asia/Jakarta'),
                    'updated_at' => Carbon::now('Asia/Jakarta')
                ]);
                $newOrder->voucher_code = $cart->voucher_code;
                $newOrder->save();
                $cart->delete();
            }

            //edit voucher if using voucher
            $voucherDB = Voucher::where('code', $cart->voucher_code)->first();
            if(!empty($voucherDB)){
                $voucherAmount = $voucherDB->voucher_amount;
                if(!empty($voucherAmount)){
                    $newSubTotal = $totalPrice - $voucherAmount;

                    $newOrder->voucher_amount = $voucherAmount;
                    $newOrder->sub_total = $newSubTotal;
                    $newOrder->grand_total = $newSubTotal;
                    $newOrder->save();
                }
                $voucherPercentage = $voucherDB->voucher_percentage;
                if(!empty($voucherPercentage)){
                    $voucherPercentageAmount = ($totalPrice * $voucherPercentage) / 100;
                    $newSubTotal = $totalPrice - $voucherPercentageAmount;

                    $newOrder->voucher_amount = $voucherPercentageAmount;
                    $newOrder->sub_total = $newSubTotal;
                    $newOrder->grand_total = $newSubTotal;
                    $newOrder->save();
                }
            }

            return $newOrder->id;
        }
        catch (\Exception $exception){
//            dd($exception);
            return 0;
        }
    }
}
