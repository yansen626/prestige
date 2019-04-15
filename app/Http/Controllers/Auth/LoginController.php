<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'logoutUser']);
    }

    public function login(){

        return View("auth.login");
    }

    public function authenticate(Request $request)
    {
        $rules = array(
            'email'                 => 'required|email',
            'password'              => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return View("auth.login")->withErrors(['msg' => ['Wrong Username or Password']]);
        }

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back()->withErrors('Wrong Email or Password', 'default')->withInput($request->only('email'));
        }

        $credentials = $this->credentials($request);
        $userData = User::where('email', $request->email)->first();

        if($userData->status_id == 4){
            $email = $userData->email;
            return View('auth.send-email', compact('email'));
        }

        Session::forget('cart');
        Session::forget('cartQty');

        if(Session::get('cartQty') == null) {
            $cartQty = 0;
            $cartsDb = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($cartsDb as $cart) {
                $cartQty += $cart->qty;
            }

            Session::put('cartQty', $cartQty);
        }

        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            return $this->sendLoginResponse($request);
        }

        return Redirect::route('home');
    }

    public function logoutUser(){
        Auth::guard('web')->logout();
        Session::forget('cart');
        Session::forget('cartQty');
        return redirect()->guest(route('home'));
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $shopping = Session::get('shopping');

        if($shopping != null){
            return Redirect::route('billing');
        }
//
//        return $this->authenticated($request, $this->guard()->user())
//            ?: redirect()->intended($this->redirectPath());

        return Redirect::route('home');
    }
}
