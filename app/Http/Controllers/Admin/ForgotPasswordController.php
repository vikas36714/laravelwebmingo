<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mail;
use Str;
use DB;

class ForgotPasswordController extends Controller
{
    // public function getEmail()
    // {
    //    return view('auth.password.email');
    // }

 //----------------------- Send Email Code ---------------------------//
    public function postEmail(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $request->_token, 'created_at' => Carbon::now()]
        );

        Mail::send('auth.password.verify',['token' => $request->_token], function($message) use ($request) {
                  $message->from($request->email);
                  $message->to('vikas36714@gmail.com');
                  $message->subject('Reset Password Notification');
               });

               return response()->json(['success'=>'A new verification link has been sent to the email address you provided during registration!']);
    }


}
