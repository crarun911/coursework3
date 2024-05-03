<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    protected $socialite;

    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
    }

    public function redirect() {
        return $this->socialite::driver('google')->redirect();
    }

    public function callbackGoogle(){
        $google_user = $this->socialite::driver('google')->user();
        $user = User::where('google_id', $google_user->getId())->first();
        
        if(!$user){
            $new_user = User::create([
                'name' => $google_user->getName(),
                'email' => $google_user->getEmail(),
                'pic' => 'boy.png',
                'google_id' => $google_user->getId()
            ]);
            
            Auth::login($new_user);
        }else{
            Auth::login($user);
        }

        return redirect()->intended('profile');
    }
}
