<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function auth(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'email.required' => 'Masukkan Email!!',
            'email.email' => 'Harus berupa Email!!',
            'password.required' => 'Masukkan Passoword!!',
        ]);
        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($infoLogin)) {
            return redirect('/');
        }else {
            return redirect('/login')->with('error','Email atau Password anda salah');
        }
    }

    public function index(){
        return view('index');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
