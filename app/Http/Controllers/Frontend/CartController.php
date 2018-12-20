<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addCart(Request $request){

    }
    public function getCart(){
        return view('frontend.cart');
    }
}
