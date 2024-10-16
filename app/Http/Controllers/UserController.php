<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm()
    {
        return view('producted.user.login');
    }

    public function registerForm()
    {
        return view('producted.user.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('product.index');
        }

        return redirect()->back()->withErrors('Invalid login details');
    }




    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('product.index');
        }

        return redirect()->back()->withErrors('Error occurred during registration');
    }



    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
