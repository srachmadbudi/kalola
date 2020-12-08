<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        
    }

    public function register(Request $request)
    {
        $email = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', '=', $email)->first();
        if ($user === null) {
            
        }else {
            return view('login');
        }
    }
}
