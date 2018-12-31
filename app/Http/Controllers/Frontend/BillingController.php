<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Province;
use App\Models\User;
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
        }

        $countries = Country::all();
        $provinces = Province::all();
        $cities = City::all();

        $data=([
            'flag' => $flag,
            'address' => $address,
            'countries' => $countries,
            'provinces' => $provinces,
            'cities' => $cities,
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
            //dd($request);

            $user = null;
            $userAddress = null;
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
                            'city_id' => $request->input('city'),
                            'street' => $request->input('street'),
                            'suburb' => $request->input('suburb'),
                            'state' => $request->input('state'),
                            'postal_code' => $request->input('post_code')
                        ]);
                    }
                    //dd($userAddress->city_id);

                    // Save to DB Table Cart
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $cart = new \App\Cart($oldCart);
                    $carts = $cart->items;

                    foreach ($carts as $cartData) {
                        $newCart = Cart::create([
                            'product_id' => $cartData['item']['product_id'],
                            'user_id' => $user->id,
                            'description' => $cartData['item']['description'],
                            'qty' => 1,
                            'price' => $cartData['item']['product_id'],
                            'total_price' => $cartData['price'],
                            'created_at' => Carbon::now('Asia/Jakarta'),
                            'updated_at' => Carbon::now('Asia/Jakarta')
                        ]);
                    }
                    // Session for Cart deleted
                    // Session for user Created to be used later for payment at Checkout
                    // and Shipment for Rajaongkir or DHL
                    Session::forget('cart');
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
                        'city_id' => $request->input('city'),
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
//            $client = new \GuzzleHttp\Client();
//            $response = $client->request('POST', 'https://api.rajaongkir.com/starter/cost', [
//                'headers' => [
//                    'key' => '49c2d8cab7d32fa5222c6355a07834d4'
//                ],
//                'form_params' => [
//                    'origin' => 152,
//                    'destination' => $userAddress->city,
//                    'weight' => 1000,
//                    'courier' => 'jne'
//                ]
//            ]);
//            $response = $response->getBody()->getContents();
//            $data = (array)json_decode($response);
//            dd($data);
            $data = null;

            // create transaction from setTransaction
            $transactionSuccess = $this->setTransaction($user, $userAddress, $data);
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

    public function setTransaction($user, $userAddress, $rajaongkirData){
        try{
            $carts = Cart::where('user_id', $user->id)->get();
            $totalPrice = $carts->sum('total_price');
            $newOrder = Order::create([
                'user_id' => $user->id,
                'billing_address_id' => $userAddress->id,
                'shipping_option' => "jne-REG",
                'shipping_address_id' => $userAddress->id,
                'shipping_charge' => 0,
                'payment_option' => "",
                'grand_total' => $totalPrice,
                'order_status_id' => 1,
                'created_at' => Carbon::now('Asia/Jakarta'),
                'updated_at' => Carbon::now('Asia/Jakarta')
            ]);

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
                $cart->delete();
            }

            return $newOrder->id;
        }
        catch (\Exception $exception){
            dd($exception);
            return 0;
        }
    }
}
