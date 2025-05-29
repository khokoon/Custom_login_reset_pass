<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordController extends Controller
{
    //
    public function forgotPasswordForm()
    {
        return view('auth.forgotPasswordForm');
    }

    public function forgotPasswordFormPost(Request $request)
    {
        $request->validate([
            'email'=> 'required|email|exists:users'
        ]);

        $token = Str::random(64);

        DB::table('password_forgot')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        

        Mail::send('emails.forgotPassword', ['token' => $token], function($message) use($request)
        {
            $message->to($request->email);
            $message->subject('Forgot Password');
        });

       // dd('done');

       return redirect()->route('login')->with('success', " We have sent email for reset password");

    }

    public function showLinkForm($token)
    {
        return view('auth.forgotPasswordLinkForm', compact('token'));
    }


    public function resetPassword(Request $request){
        $request-> validate([
            'token' => 'required',
            'email'=> 'required|email|exists:users',
            'password'=> 'required|confirmed'
        ]);

        $first = DB::table('password_forgot')
             ->where('email', $request->email)
             ->where('token', $request->token)->first();

        // $last = DB::table('password_forgot')
        //          ->where('email', $request->email)
        //          ->where('token', $request->token)
        //          ->orderBy('id', 'desc')  // assuming 'id' reflects order of insertion
        //          ->first();

        if(is_null($first)){
            return back()->with('error', 'Something is wrong.');
        }

        $user = User::where('email', $request->email)->first();

        //password update
        $user->password = Hash::make($request->password);
        $user->save();

        //select and delete reset token
        DB::table('password_forgot')->where('email', $request->email)
                    ->where('token', $request->token)
                    ->delete();

        return redirect()->route("login")->with('success', 'Reset password successfully.');

        // dd($first);
    }
}
