<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class BillingController extends Controller
{
    public function getBilling()
    {
        $countries = Country::all();
        $provinces = Province::all();
        $cities = City::all();

        return view('frontend.billing-shipment', compact('countries', 'provinces', 'cities'));
    }



}
