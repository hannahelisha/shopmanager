<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller {
    // para ma-show Register form
    public function showRegister()
    {
        return view('register');
    }

    // for rf submit
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }

    // para naman kay login form
    public function showLogin()
    {
        return view('login');
    }

    // for  lf
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect('/dashboard');
        }
        return back()->with('error', 'Invalid email or password.');
    }

    // logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

}