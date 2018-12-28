<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addCart(Request $request){
//        $validator = Validator::make($request->all(),[
//            'start_date'        => 'required',
//            'end_date'          => 'required',
//            'description'       => 'required|max:300'
//        ]);
//
//        if ($validator->fails()) {
//            return redirect()
//                ->back()
//                ->withErrors($validator)
//                ->withInput($request->all());
//        }
        try{
            $productDB = Product::where('slug', $request->input('slug'))->first();
            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $color = $request->input('custom-color');
            $color = explode("-", $color);
            $size = $request->input('custom-size');
            $size = explode("-", $size);
            $description = "Text: ".strtoupper($request->input('custom-text'))."<br>".
                "Font: ".$request->input('custom-font')."<br>".
                "Color: ".$color[0]."<br>".
                "Size: ".$size[0]."<br>";

            //add cart to database
            if (Auth::check())
            {
                $cartDB = Cart::where('product_id', $productDB->id)->where('user_id', Auth::user()->id)->first();
                if(!empty($cartDB)){
                    $qty = $cartDB->qty + 1;
                    $cartDB->qty = $qty;
                    $cartDB->updated_at = $dateTimeNow->toDateTimeString();
                    $cartDB->total_price = $qty * $productDB->price;
                    $cartDB->save();
                }
                else{
                    $newCart = Cart::create([
                        'product_id' => $productDB->id,
                        'user_id' => Auth::user()->id,
                        'description' => $description,
                        'qty' => 1,
                        'price' => $productDB->price,
                        'total_price' => $productDB->price,
                        'created_at'        => $dateTimeNow->toDateTimeString(),
                        'updated_at'        => $dateTimeNow->toDateTimeString()
                    ]);
                }
            }
            //add cart to cookies
            else
            {
                //Add to cookie
                if(Cookie::get('guest-cart') != null){
                    $value = Cookie::get('guest-cart');

                    if(strpos($value, '#') !== false) {
                        $valueArr2 = explode("#", $value);
                        $flag=true;
                        for($i=0;$i<count($valueArr2);$i++){
                            $cartDB = Cart::find($valueArr2[$i]);
                            if(!empty($cartDB)){
                                if($cartDB->product_id == $productDB->id){;
                                    $qty = $cartDB->qty + 1;
                                    $price = $cartDB->price;
                                    $total_price = $qty * $price;

                                    $cartDB->qty = $qty;
                                    $cartDB->total_price = $total_price;
                                    $cartDB->save();
                                    $flag=false;
                                }
                            }
                        }
                        if($flag){
                            $newCart = Cart::create([
                                'product_id' => $productDB->id,
                                'description' => $description,
                                'qty' => 1,
                                'price' => $productDB->price,
                                'total_price' => $productDB->price,
                                'created_at'        => $dateTimeNow->toDateTimeString(),
                                'updated_at'        => $dateTimeNow->toDateTimeString()
                            ]);

                            $value .= '#' . $newCart->id;
                            $minutes = 1440;
                            $name = 'guest-cart';
                            Cookie::queue($name, $value, $minutes);
                        }
                    }
                }
                else{
                    $newCart = Cart::create([
                        'product_id' => $productDB->id,
                        'description' => $description,
                        'qty' => 1,
                        'price' => $productDB->price,
                        'total_price' => $productDB->price,
                        'created_at'        => $dateTimeNow->toDateTimeString(),
                        'updated_at'        => $dateTimeNow->toDateTimeString()
                    ]);

                    $minutes = 1440;
                    $name = 'guest-cart';
                    Cookie::queue($name, $newCart->id, $minutes);
                }

//
//                $cookieValue = Cookie::get('guest-cart');
//                $user_id = "";
//                $minutes = 1440;
//
//                //if cookie contains cart data
//                if(!empty($cookieValue)){
//                    $newValue = "";
//
//                    //if cookie already consist a product
//                    if(strpos($cookieValue, $productDB->slug) !== false){
//                        $valueArr = explode(";", $cookieValue);
//                        for($i=0;$i<count($valueArr);$i++){
//                            if(strpos($valueArr[$i], '|') !== false){
//                                $valueArr2 = explode("|", $valueArr[$i]);
//
//                                //if product slug = current product
//                                if($valueArr2[0] == $productDB->slug){
//                                    $qty = (double)$valueArr2[2] + 1;
//                                    $price = (double)$valueArr2[3];
//                                    $total_price = $qty * $price;
//                                    $newValue = $newValue.$valueArr2[0]."|".$valueArr2[1]."|".$qty."|".
//                                        $price."|".$total_price."|".$valueArr2[5].";";
//                                }
//                                //else rewrite current data from cookie to new cookie
//                                else{
//                                    $newValue = $newValue.$valueArr2[0]."|".$valueArr2[1]."|".$valueArr2[2]."|".
//                                        $valueArr2[3]."|".$valueArr2[4]."|".$valueArr2[5].";";
//                                }
//                            }
//                            else{
//                                break;
//                            }
//                        }
//                    }
//                    else{
//                        $newValue = $cookieValue;
//                        $description = "asdfdsaf";
//                        //cookie value = product_id|user_id|qty|price|total_price|description
//                        $newValue = $newValue.$productDB->slug."|".$user_id."|1|".$productDB->price."|".$productDB->price."|".$description.";";
//
//                    }
//                    Cookie::queue(Cookie::make('guest-cart', $newValue, $minutes));
//                }
//                //create new cookie store cart datas
//                else{
//                    //cookie value = product_id|user_id|qty|price|total_price|description
//                    $value = $productDB->slug."|".$user_id."|1|".$productDB->price."|".$productDB->price."|".$description.";";
//
//                    Cookie::queue(Cookie::make('guest-cart', $value, $minutes));
//                }
            }

            return redirect()->route('cart');

        }catch(\Exception $ex){
//            dd($ex);
            error_log($ex);
            return back()->withErrors("Something Went Wrong")->withInput($request->all());
        }
    }

    public function getCart(){
        if (Auth::check())
        {
            //Read DB
            $user = Auth::user();
            $carts = Cart::where('user_id', $user->id)->get();
            $flag = 1;
        }
        else if(Cookie::get('guest-cart') != null){
//            dd(Cookie::get('guest-cart'));
            //Get from Cookie
            $carts = [];
            $temporary = Cookie::get('guest-cart');
            $valArr1 = explode(';', $temporary);
            for($i=0;$i<count($valArr1);$i++){
                $valArr2 = explode("#", $valArr1[$i]);

                for($i=0;$i<count($valArr2);$i++){
                    $cartDB = Cart::find($valArr2[$i]);
                    array_push($carts, $cartDB);
                }
            }
            $flag = 2;
            //dd($carts);
        }
        else{
            $carts = null;
            $flag = 0;
        }
        return view('frontend.cart', compact('carts', 'flag'));
    }
}
