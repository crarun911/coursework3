<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        if($request['gender']=='male'){
            $pic_data='boy.png';
        }
        else
        {
            $pic_data='girl.png';
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create and save the user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender=$request->gender;
        $user->pic=$pic_data;
        $user->password = Hash::make($request->password);
        $user->save();

        $profile=new Profile();
        $profile->user_id=$user->id;
        $profile->about="I am a new user";
        $profile->save();

        // Redirect the user after registration
        return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Check if a user with the provided email exists in the database
    $user = User::where('email', $credentials['email'])->first();

    if (!$user) {
        // If user does not exist, return back with an error message
        return back()->withErrors([
            'email' => 'User not found.',
        ]);
    }

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('/'); // Redirect to the intended destination after login
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}
    public function logout(Request $request)
    {
        Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login');
    }

  

}
