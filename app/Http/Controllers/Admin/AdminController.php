<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function loginForm()
    {
        return view('producted.admin.login');
    }

    public function registerForm()
    {
        return view('producted.admin.register');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.product');
        }

        return redirect()->route('admin.login')->withErrors('Login details are not valid.');
    }


    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:admin_users,name',
            'email' => 'required|email|unique:admin_users,email',
            'password' => 'required|confirmed',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.product');
        }

        return redirect()->route('admin.register')->withErrors('Error occurred during registration');
    }





    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
