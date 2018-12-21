<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
//            dd($productDB);
            $cartDB = Cart::where('product_id', $productDB->id)->first();
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
                    'description' => $description,
                    'qty' => 1,
                    'price' => $productDB->price,
                    'total_price' => $productDB->price,
                    'created_at'        => $dateTimeNow->toDateTimeString(),
                    'updated_at'        => $dateTimeNow->toDateTimeString()
                ]);
            }
            return redirect()->route('cart');

        }catch(\Exception $ex){
//            dd($ex);
            error_log($ex);
            return back()->withErrors("Something Went Wrong")->withInput($request->all());
        }
    }

    public function getCart(){
        return view('frontend.cart');
    }
}
