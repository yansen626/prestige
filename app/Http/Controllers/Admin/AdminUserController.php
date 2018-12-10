<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Transformer\AdminUserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AdminUserController extends Controller
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
        $users = AdminUser::query();
        return DataTables::of($users)
            ->setTransformer(new AdminUserTransformer)
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
        return view('admin.adminuser.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.adminuser.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        //
        $validator = Validator::make($request->all(), [
            'first_name'        => 'required|max:100',
            'last_name'         => 'required|max:100',
            'email'             => 'required|regex:/^\S*$/u|unique:users|max:50',
            'role'              => 'required',
            'password'          => 'required'
        ],[
            'email.unique'      => 'ID Login Akses telah terdaftar!',
            'email.regex'       => 'ID Login Akses harus tanpa spasi!'
        ]);

        $validator->sometimes('password', 'min:6|confirmed', function ($input) {
            return $input->password;
        });

        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

        //Create Admin
        $adminUser = AdminUser::create([
            'first_name'    => $request->input('first_name'),
            'last_name'     => $request->input('last_name'),
            'email'         => $request->input('email'),
            'role'          => $request->input('role'),
            'password'      => $request->input('password'),
            'status_id'     => $request->input('status'),
            'is_super_admin'=> $request->input('is_super_admin')
        ]);

        Session::flash('message', 'Success Creating new Admin User!');
        return redirect()->route('admin.admin-users');
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
