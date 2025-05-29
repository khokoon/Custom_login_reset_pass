<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthControllerSecond extends Controller
{
    //

    public function registerPost(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
    ]);

    if ($validator->fails()) {
        // Flash all input including password
        return redirect()->back()
            ->withErrors($validator)
            ->withInput($request->all()); // Flash all input manually
    }

    dd($request->all()); // Or continue registration logic
}
}
