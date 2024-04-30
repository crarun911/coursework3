<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Str;
use Mail;

class ForgetPasswordManager extends Controller
{
    public function forgetPassword(){
        return view("auth.forget-password");
    }
    public function forgetPasswordPost(Request $request){
        $user=User::where('email',"=",$request->email)->first();
        if(!empty($user)){
            $user->remember_token=Str::random(40);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return  redirect()->back()->with('success','reset email has been sent to the registered mail');

        }else
        {
            return  redirect()->back()->with('error','Email not found');
        }
    }
}
