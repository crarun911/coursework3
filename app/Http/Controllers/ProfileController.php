<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    // public function showProfile(){
    //     return view('profile.home');
    // }
    public function showProfile(){
        return view('auth.profile-edit');
    }

    public function editProfile(){
        return view('test');
    }

    public function updateProfile(request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Fetch authenticated user instance
        $user = Auth::user();
    
        // Update user data
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->password = Hash::make($request->password);
    
        // Upload and update profile image if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $user->pic = $imageName;
        }
    
        // Save updated user data
        $user->save();
    
        // Redirect back with success message
        return redirect()->route('home')->with('success', 'Profile updated successfully');
    

    }
}
