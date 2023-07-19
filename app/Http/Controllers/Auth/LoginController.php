<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }
            return back()->withErrors([
                'error' => 'Email Atau Password Anda Salah'
            ]);
    }
}
