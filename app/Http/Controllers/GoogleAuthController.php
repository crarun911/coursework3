<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }
    public function callbackGoogle(){
        $google_user=Socialite::driver('google')->user();
        $user=User::where('google_id',$google_user->getid())->first();
        if(!$user){
            $new_user=User::create([
                'name'=> $google_user->getname(),
                'email'=>$google_user->getEmail(),
                'google_id'=>$google_user->getId()
            ]);
            Auth::login($new_user);
            return redirect()->intended('profile');
        }else{
            Auth::login($user);
            return redirect()->intended('profile');

        }
    }

}
