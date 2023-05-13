<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdminAuthController extends Controller
{
    //
    public function getLogin(){
        return view('admin.auth.login');
    }
 
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            
        ]);  
      
            if(auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
               
               
        return redirect()->route('adminDashboard');
        //  return redirect('/admin')->with('user',$user);
        }else {
           return back()->with('error','Whoops! invalid email and password.');
        }
     // return redirect()->route('adminDashboard')->with('success','You are Logged in sucessfully.');
    }
 
    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('adminLogin'));
    }
}
