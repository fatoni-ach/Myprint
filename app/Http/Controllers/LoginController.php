<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if($request->method() == "POST"){
            // dd($request->only('name', 'password'));
            if (Auth::attempt($request->only('name', 'password'))){
                return redirect(route('profil'));
            }
        }
        if(Auth::check()){
            return redirect(route('produk.admin'));
        }
        return view('layouts/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('produk');
    }
}
