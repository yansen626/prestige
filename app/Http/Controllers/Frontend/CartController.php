<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addCart(Request $request){
        try{
            $productDB = Product::where('slug', $request->input('slug'))->first();
            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $color = $request->input('custom-color');
            $color = explode("-", $color);
            $size = $request->input('custom-size');
            $size = explode("-", $size);
            if($request->input('customize-toggle') == 'true'){
                if($request->input('custom-text') == ""){
                    $description = "";
                }
                else{
                    $description = "Text: ".strtoupper($request->input('custom-text'))."<br>".
                        "Font: ".$request->input('custom-font')."<br>".
                        "Color: ".$color[0]."<br>".
                        "Size: ".$size[0]."<br>";
                }
            }
            else{
                $description = "";
            }

            //add cart to database
            if (Auth::check())
            {
                $cartDB = Cart::where('product_id', $productDB->id)
                    ->where('user_id', Auth::user()->id)
                    ->where('description', $description)
                    ->first();
                $cartQty = 0;
                if(!empty($cartDB)){
                    $qty = $cartDB->qty + 1;
                    $cartDB->qty = $qty;
                    $cartDB->updated_at = $dateTimeNow->toDateTimeString();
                    $cartDB->total_price = $qty * $productDB->price;
                    $cartDB->save();

                    $cartQty = $qty;
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

                $cartsDb = Cart::where('product_id', '!=', $productDB->id)->where('user_id', Auth::user()->id)->get();
                foreach ($cartsDb as $cart){
                    $cartQty += $cart->qty;
                }

                $request->session()->put('cartQty', $cartQty);
            }
            //add cart to Session
            else
            {
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new \App\Cart($oldCart);
                $tmpCart = new Cart([
                    'product_id' => $productDB->id,
                    'description' => $description,
                    'qty' => 1,
                    'price' => $productDB->price,
                    'total_price' => $productDB->price,
                    'created_at'        => $dateTimeNow->toDateTimeString(),
                    'updated_at'        => $dateTimeNow->toDateTimeString()
                ]);

                $cart->add($tmpCart, $productDB->id);

                $request->session()->put('cart', $cart);
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
            if(!empty($carts)){
                $totalPrice = $carts->sum('total_price');
            }
            else{
                $totalPrice = 0;
            }

            if(Session::get('cartQty') == null) {
                $cartQty = 0;
                $cartsDb = Cart::where('user_id', Auth::user()->id)->get();
                foreach ($cartsDb as $cart) {
                    $cartQty += $cart->qty;
                }

                Session::put('cartQty', $cartQty);
            }
        }
        else if(Session::has('cart')){
            $oldCart = Session::get('cart');
            $cart = new \App\Cart($oldCart);
            $carts = $cart->items;
            $totalPrice = 0;
            //dd($carts);
            foreach ($carts as $item){
                $totalPrice += ($item['price'] * $item['qty']);
            }
            $flag = 2;
            //dd($carts);
        }
        else{
            $carts = null;
            $flag = 0;
            $totalPrice = 0;
        }
        //dd($carts);
        return view('frontend.cart', compact('carts', 'flag', 'totalPrice'));
    }

    public function submitCart(Request $request)
    {
        try{
            if (Auth::check()){
                // Update Qty in DB
                $items = $request->input('id');
                $qtys = $request->input('qty');
                $voucher = $request->input('voucher');
                foreach ($items as $item){
                    $cart = Cart::find($item);
                    $cart->qty = $qtys[$item];
                    $cart->total_price = $cart->price * $qtys[$item];
                    $cart->voucher_code = $voucher;
                    $cart->save();
                }

                return redirect()->route('billing');
            }
            else{
                // Update Session
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new \App\Cart($oldCart);
                $items = $request->input('id');
                $qtys = $request->input('qty');
                $voucher = $request->input('voucher');
                foreach ($items as $item){
                    $cart->update($item, $qtys[$item], $voucher);
                }
                $request->session()->put('cart', $cart);
                Session::put('shopping', 'yes');

                return redirect()->route('login.register');
            }
        }
        catch (\Exception $exception){
//            dd($exception);
        }
    }

    public function deleteCart(Request $request){
        //dd($request->input('cartId'));

        try{
            //Delete Cart from DB and Cookie
            //from DB
            if (Auth::check()){
                $cart = Cart::find($request->input('cartId'));
                $cart->delete();
                $cartQty=0;
                $cartsDb = Cart::where('user_id', Auth::user()->id)->get();
                foreach ($cartsDb as $cart){
                    $cartQty += $cart->qty;
                }

                $request->session()->put('cartQty', $cartQty);
            }
            else{
                // delete from Session
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new \App\Cart($oldCart);
                $cart->remove($request->input('cartId'));
//                dd($cart);
                $request->session()->put('cart', $cart);
            }

            return redirect()->route('cart');
        }
        catch (\Exception $exception){

        }
    }

    public function voucherValidation(Request $request){
        try{
            $voucher = $request->input('voucher-code');
            $voucherDB = Voucher::where('code', $voucher)->first();
            if(!empty($voucherDB)){
                $voucherAmount = $voucherDB->voucher_amount == null ? 0 : $voucherDB->voucher_amount;
                $voucherPercentage = $voucherDB->voucher_percentage == null ? 0 : $voucherDB->voucher_percentage;
                return Response::json(array('success' => $voucherAmount.'#'.$voucherPercentage));
            }
            else{
                return Response::json(array('errors' => 'INVALID'));
            }
        }
        catch (\Exception $exception){
            Log::error("CartController/voucherValidation error: ". $exception);
            return Response::json(array('errors' => 'INVALID' . $request->input('id')));
        }
    }
}
