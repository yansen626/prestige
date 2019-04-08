<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function Index(){
        if (Auth::check())
        {
            //Read DB
            $user = Auth::user();
            $orders = Order::where('user_id', $user->id)->get();

            return view('frontend.transactions.orders', compact('orders'));
        }
        return Redirect::route('home');
        //dd($carts);
    }

    public function Show(Order $order){
        if (Auth::check())
        {
            $orderProduct = OrderProduct::where('order_id', $order->id)->get();

            return view('frontend.transactions.order', compact('order', 'orderProduct'));
        }
        return Redirect::route('home');
        //dd($carts);
    }

    public function ConfirmBankTransfer(Order $order){
        if (Auth::check())
        {
            $orderProduct = OrderProduct::where('order_id', $order->id)->get();

            return view('frontend.transactions.order', compact('order', 'orderProduct'));
        }
        return Redirect::route('home');
        //dd($carts);
    }

}
