<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Notifications\UserLikeNotification;


class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(2); 
        return view('home',['posts'=>$posts]);
    }
    public function notify(){
        if (auth()->check()) {
            $user = User::find(1); // Change to a valid user ID or use a different method to retrieve the user
            if ($user) {
                auth()->user()->notify(new UserLikeNotification($user));
                dd('Notification sent successfully.'); // Debugging message
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
