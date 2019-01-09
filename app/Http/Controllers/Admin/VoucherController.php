<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Product;
use App\Models\Voucher;
use App\Transformer\VoucherTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class VoucherController extends Controller
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
        $users = Voucher::query();
        return DataTables::of($users)
            ->setTransformer(new VoucherTransformer)
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
        return view('admin.voucher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Get Data from View
        $validator = Validator::make($request->all(), [
            'code'          => 'required|max:100|unique:vouchers',
            'description'   => 'required|max:100',
            'start_date'    => 'required',
            'finish_date'   => 'required'
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

        if(empty($request->input('voucher_amount')) && empty($request->input('voucher_percentage'))){
            return redirect()->back()->withErrors("Voucher Percentage or Voucher Amount is required!")->withInput($request->all());
        }
        //Sort out Data
        $startDate = Carbon::parse($request->input('start_date'));
        $finishDate = Carbon::parse($request->input('finish_date'));

        //Check DateTime
        if(!$finishDate->greaterThan($startDate)){
//            Session::flash('error', 'Finish Date cannot be less than Start Date!');
            return redirect()->back()->withErrors("Finish Date cannot be less than Start Date!")->withInput($request->all());
        }

        $user = Auth::guard('admin')->user();
        $voucher = Voucher::create([
            'code'  => $request->input('code'),
            'description'   => $request->input('description'),
            'voucher_amount'   => $request->input('voucher_amount'),
            'voucher_percentage'   => $request->input('voucher_percentage'),
            'start_date'    => $startDate,
            'finish_date'   => $finishDate,
            'category_id'   => $request->input('category'),
            'product_id'    => $request->input('product'),
            'created_at'    => Carbon::now('Asia/Jakarta'),
            'created_by'    => $user->id,
            'updated_at'    => Carbon::now('Asia/Jakarta'),
            'updated_by'    => $user->id,
            'status_id'     => $request->input('status')
        ]);

        Session::flash('success', 'Success Creating new Voucher!');
        return redirect()->route('admin.vouchers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voucher = Voucher::find($id);

        //More Data to Show
        if($voucher->category_id != null || $voucher->category_id != 0){
            $category = Category::find($voucher->category_id);
        }
        else{
            $category = null;
        }

        if($voucher->product_id != null || $voucher->product_id != 0){
            $product = Product::find($voucher->product_id);
        }
        else{
            $product = null;
        }

        return view('admin.voucher.edit', compact('voucher', 'category', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Get Data from View
        $validator = Validator::make($request->all(), [
            'code'          => 'required|max:100',
            'description'   => 'required|max:100',
            'start_date'    => 'required',
            'finish_date'   => 'required'
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

        //Sort out Data
        $startDate = Carbon::parse($request->input('start_date'));
        $finishDate = Carbon::parse($request->input('finish_date'));

        //Check DateTime
        if(!$finishDate->greaterThan($startDate)){
            Session::flash('error', 'Finish Date cannot be less than Start Date!');
            return redirect()->back();
        }

        $user = Auth::guard('admin')->user();
        $voucher = Voucher::find($request->input('id'));

        $voucher->code = $request->input('code');
        $voucher->voucher_amount   = $request->input('voucher_amount');
        $voucher->voucher_percentage   = $request->input('voucher_percentage');
        $voucher->description = $request->input('description');
        $voucher->start_date = $startDate;
        $voucher->finish_date = $finishDate;
        $voucher->status_id = $request->input('status');
        $voucher->category_id = $request->input('category');
        $voucher->product_id = $request->input('product');
        $voucher->updated_at = Carbon::now('Asia/Jakarta');
        $voucher->updated_by = $user->id;
        $voucher->save();

        Session::flash('success', 'Success Updating Voucher ' . $voucher->code . '!');
        return redirect()->route('admin.vouchers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        try {
            //Belum melakukan pengecekan hubungan antar Table
            $voucherId = $request->input('id');
            $voucher = Voucher::find($voucherId);
            $voucher->delete();

            Session::flash('success', 'Success Deleting Voucher ' . $voucher->code);
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            return Response::json(array('errors' => 'INVALID'));
        }
    }
}
