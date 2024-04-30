<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Notifications\UserLikeNotification;
class ViewController extends Controller
{
    public function createUser(){
        return view('welcome');
    }
    public function viewNotification(){
        return view('posts.notification');
    }
    public function notify($id){
        if (auth()->check()) {
            $user = User::find($id); // Change to a valid user ID or use a different method to retrieve the user
            if ($user) {
                auth()->user()->notify(new UserLikeNotification($user));
                dd('Notification sent successfully.'); // Debugging message
                return redirect()->route('/');

            } else {
                dd('User not found.'); // Debugging message
            }
        } else {
            dd('User not authenticated.'); // Debugging message
        }
    } 

    public function markasread($id){
        if($id){
            auth()->user()->notifications->where('id',$id)->markAsRead();

        }
        return back();

    }
}
