<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class BillingController extends Controller
{
    public function getBilling()
    {
        //Read Cookie

        $countries = Country::all();
        $provinces = Province::all();
        $cities = City::all();

        return view('frontend.billing-shipment', compact('countries', 'provinces', 'cities'));
    }

    public function submitBilling(Request $request)
    {
        try{
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
            Address::create([
                'user_id'   => $user->id,
                'primary'   => 1,
                'province'  => $request->input('province'),
                'city'      => $request->input('city'),
                'postal_code'   => $request->input('post_code')
            ]);

            // Get Data from Cookie or DB and then Continue
            // Create Transaction
            // Check Delivery Fee from Rajaongkir or DHL

            // Redirect to Checkout
            return redirect();
        }
        catch (\Exception $exception){

        }
    }
}
