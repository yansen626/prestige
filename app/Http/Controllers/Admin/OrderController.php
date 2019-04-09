<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderBankTransfer;
use App\Transformer\OrderBankTransferTransformer;
use App\Transformer\OrderTransformer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getIndex(Request $request){
        $users = Order::query();
        return DataTables::of($users)
            ->setTransformer(new OrderTransformer())
            ->addIndexColumn()
            ->make(true);
    }

    public function getIndexBankTransfer(Request $request){
        $users = OrderBankTransfer::query()->orderBy('status', 'asc');
        return DataTables::of($users)
            ->setTransformer(new OrderBankTransferTransformer())
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.order.index');
    }

    /**
     * Display a listing of the resource bank Transfer.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBankTransfer()
    {
        return view('admin.order.index-transfer');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTracking(Request $request)
    {
        $orderid = $request->input('order-id');
        $orderDB = Order::find($orderid);
        $orderDB->track_code = $request->input('track_code');
        $orderDB->order_status_id = 4;
        $orderDB->save();

        return redirect()->route('admin.orders.detail', ['id'=>$orderid]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function acceptBankTransfer(Request $request)
    {

        $orderid = $request->input('accept-id');
        $orderDB = Order::find($orderid);
        $orderDB->order_status_id = 3;
        $orderDB->save();

        $orderBankDB = OrderBankTransfer::where('order_id', $orderid)->first();
        $orderBankDB->status = 1;
        $orderBankDB->save();

        return redirect()->route('admin.orders.detail', ['id'=>$orderid]);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
