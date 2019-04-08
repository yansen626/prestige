<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\libs\ExportExcel;
use App\Models\Subscribe;
use App\Models\WaitingList;
use App\Transformer\SubscribeTransformer;
use App\Transformer\WaitingListTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Yajra\DataTables\DataTables;

class WaitingListController extends Controller
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
        $users = WaitingList::query();
        return DataTables::of($users)
            ->setTransformer(new WaitingListTransformer())
            ->addIndexColumn()
            ->make(true);
    }

    public function downloadList(){
        $createdDate = Carbon::now('Asia/Jakarta')->format('d M Y');

//        return Excel::download(new ExcelExport, 'Waiting List - '.$createdDate.'.xlsx');

        return (new ExportExcel())->download('Waiting List - '.$createdDate.'.xlsx');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.waitinglist.index');
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
    public function store(Request $request)
    {
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
