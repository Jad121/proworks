<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ws_user;
class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'ws_user_email' => 'required',
            'ws_user_password' => 'required'
          ]);
          
        // $credentials = $request->only('ws_user_email', 'ws_user_password');



        // if (Auth::attempt(['ws_user_email' => $request->ws_user_email, 'password' => $request->ws_user_password])) {

        //     return redirect('/');
        // }

        $ws_user=ws_user::where('ws_user_email',$request->ws_user_email)->where('ws_user_password',$request->ws_user_password)->first();
        if($ws_user){
            Auth::login($ws_user);
            return redirect('/dashboard');
        }

        return redirect()->back()->withInput()->withErrors([
            'ws_user_email' => 'These credentials do not match our records.',
        ]);
    }
}
