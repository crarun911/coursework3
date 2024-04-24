<?php

namespace App\Http\Controllers;
use App\Models\User;
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
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create and save the user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

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

    // Attempt to authenticate the user using email and password
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('/'); // Redirect to the intended destination after login
    }

    // If authentication fails, return back with an error message
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
