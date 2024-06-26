<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Hash;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function getPassword($token) {

        return view('auth.passwords.forgetPasswordLink', ['token' => $token]);
     }

     public function updatePassword(Request $request)
     {

     $request->validate([
         'email' => 'required|email|exists:utilisateurs',
         'password' => 'required|string|min:6|confirmed',
         'password_confirmation' => 'required',

     ]);

     $updatePassword = DB::table('password_resets')
                         ->where(['email' => $request->email, 'token' => $request->token])
                         ->first();

     if(!$updatePassword)
         return back()->withInput()->with('error', 'Invalid token!');

       $user = User::where('email', $request->email)
                   ->update(['password' => Hash::make($request->password)]);

       DB::table('password_resets')->where(['email'=> $request->email])->delete();

       return redirect('/login')->with('message', 'Your password has been changed!');

     }
}
