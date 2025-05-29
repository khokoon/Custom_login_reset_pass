<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    //

    public function register()
    {
        //view registration form page 
        return view('auth.register');
    }

    //after submit register form data this validation works

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'

        ]);

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=>Hash::make($request->password)
        ]);

        //stay login to this auth session
        auth()->login($user);

        return redirect()->route('dashboard')->with("success", "User register successfully!");

        //dd($user);
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    //logout
    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('login');
    }

    //login
    public function login(Request $request)
    {
        return view('auth.login');
    }

    //after submit login form data this validation works
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'

        ]);

        if(auth()->attempt(['email'=> $request->email, 'password'=> $request->password]))
        {
            return redirect()->route('dashboard')->with('success', 'User login successfully');
        }
        return back()->with("error", "Username or password are wrong.");
    }

}
