<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\libs\Zoho;
use App\Models\User;
use App\Transformer\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
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
        $users = User::all();
        return DataTables::of($users)
            ->setTransformer(new UserTransformer)
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
        //
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.create');
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
        $rules = array(
            'email'                 => 'required|email|max:100|unique:users',
            'first_name'            => 'required|max:100',
            'last_name'             => 'required|max:100',
            'phone'                 => 'required|unique:users',
            'password'              => 'required|min:6|max:20|same:password',
            'password_confirmation' => 'required|same:password'
        );

        $messages = array(
            'not_contains'  => 'Email cannot contain these characters +',
            'phone.unique'  => 'Your phone number already registered!',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'zoho_id' => "",
            'zoho_primary_contact_id' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'email_token' => base64_encode($request->input('email')),
            'status_id' => 1
        ]);

//        Zoho::createUser($user);

//        $emailVerify = new EmailVerification($user);
//        Mail::to($user->email)->send($emailVerify);

        //return View('auth.send-email', compact('user'));

        return redirect()->route('admin.users.index');
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
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
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
        //
//        $validator = Validator::make($request->all(), [
//            'first_name'        => 'required|max:100',
//            'last_name'         => 'required|max:100',
//            'email'             => 'required|regex:/^\S*$/u|unique:users|max:50',
//            'phone'             => 'required',
//            'password'          => 'required'
//        ],[
//            'email.unique'      => 'ID Login Akses telah terdaftar!',
//            'email.regex'       => 'ID Login Akses harus tanpa spasi!'
//        ]);
        $validator = Validator::make($request->all(), [
            'first_name'        => 'required|max:100',
            'last_name'         => 'required|max:100',
            'phone'             => 'required'
        ]);

//        $validator->sometimes('password', 'min:6|confirmed', function ($input) {
//            return $input->password;
//        });

        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

        $id = $request->input('id');
        $user = User::find($id);
        $user->email = $request->input('email');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->save();

        Session::flash('success', 'Success Updating User!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        //
        try {
            //Belum melakukan pengecekan hubungan antar Table
            $userId = $request->input('id');
            $user = User::find($userId);
            $user->status_id = 2;
            $user->save();
//            $user->delete();

            Session::flash('success', 'Success Deleting User ' . $user->email . ' - ' . $user->name);
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            return Response::json(array('errors' => 'INVALID'));
        }
    }
}
