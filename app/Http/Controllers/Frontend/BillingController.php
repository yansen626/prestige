<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
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
        $countries = Country::all();
        $provinces = Province::all();
        $cities = City::all();

        return view('frontend.billing-shipment', compact('countries', 'provinces', 'cities'));
    }

    public function submitBilling(Request $request)
    {
        try{
            // Get Data from Session or DB and then Continue
            // Create Transaction
            // Check Delivery Fee from Rajaongkir or DHL
            // Clear Session
            if(!Auth::check()){
                if(!Session::has('cart')) {
                    // Validation for Users
                    $validator = Validator::make($request->all(), [
                        'first_name'        => 'required|max:100',
                        'last_name'         => 'required|max:100',
                        'email'             => 'required|regex:/^\S*$/u|unique:users|max:50',
                        'role_id'           => 'required'
                    ],[
                        'email.unique'      => 'ID Login Akses telah terdaftar!',
                        'email.regex'       => 'ID Login Akses harus tanpa spasi!'
                    ]);

                    if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

                    // Create User with Guest Status
                    $user = User::create([
                        'first_name' => $request->input('first_name'),
                        'last_name' => $request->input('first_name'),
                        'email' => $request->input('first_name'),
                        'phone' => $request->input('first_name'),
                        'email_token' => base64_encode($request->input('email')),
                        'status_id' => 3
                    ]);

                    // Create Address
                    $userAddress = Address::create([
                        'user_id' => $user->id,
                        'primary' => 1,
                        'province' => $request->input('province'),
                        'city' => $request->input('city'),
                        'postal_code' => $request->input('post_code')
                    ]);

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

                    // Add Transaction
                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('POST', 'https://api.rajaongkir.com/starter/cost', [
                        'headers' => [
                            'key' => '49c2d8cab7d32fa5222c6355a07834d4'
                        ],
                        'form_params' => [
                            'origin' => 152,
                            'destination' => $userAddress->city,
                            'weight' => 1000,
                            'courier' => 'jne'
                        ]
                    ]);
                    $response = $response->getBody()->getContents();
                    $data = (array)json_decode($response);
                    dd($data);
                    // Session for Cart deleted
                    // Session for user Created to be used later for payment at Checkout
                    // and Shipment for Rajaongkir or DHL
                    Session::forget('cart');
                    $request->session()->put('user', $user);
                }
            }
            // Redirect to Checkout
            return redirect()->route('checkout');
        }
        catch (\Exception $exception){
            dd($exception);
        }
    }
}
