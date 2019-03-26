<?php

namespace App\Http\Controllers;

use App\libs\Zoho;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function test(){
        try{
            Zoho::createInvoice("1783013000000075027");

            dd("SUCCESS!");
        }
        catch(\Exception $ex){
            dd($ex);
        }
    }
}
