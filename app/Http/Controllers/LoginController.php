<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{
    //----- Login View -----//
    public function index()
    {
        if (View::exists('login.index')) {
            return view('login.index ');
        } else {
            return abort(404);
        }

        return view('login.index ');
    }
    //----- Logout -----//
    public function logOut()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
    //----- Login -----//
    public function login(Request $request)
    {
        $request->validate([
            'username'      => 'required',
            'password'      => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
  
            $user = Auth::user();
            $username        = $user->username;
            $full_name       = $user->full_name;
            $access_rights   = $user->access_rights;
            $active          = $user->active;

            if ($active == 'Y') {
                //SET Session
                Session::put('user_name', $username);
                Session::put('full_name', $full_name);
                Session::put('user_rights', $access_rights);

                return redirect()->intended('home');
            } else {
                return redirect()->intended('login')->with('message', 'Your account is already inactive!');
            }
        }

        return redirect('/login')->with('message', 'Invalid Username or Passowrd!');
    }
}
