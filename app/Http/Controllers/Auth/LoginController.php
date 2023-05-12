<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
   //protected $redirectTo = RouteServiceProvider::HOME;
   
   public function logins(Request $request)
    {
        $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if(auth()->guard('user')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
        $user = auth()->guard('user')->user();
        if($user->is_admin == 1){
            return view('home');
        }
    }else {
        return back()->with('error','Whoops! invalid email and password.');
    }
        
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
