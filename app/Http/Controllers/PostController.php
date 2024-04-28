<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
{
    return view('posts.create');
}

public function store(Request $request)
{
    $request->validate([
        'body' => 'required|max:1000',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);

    $post = new Post();
    $post->content = $request['body'];
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);
        $post->image = $imageName;
    }
    $message="There was an error";
    if($request->user()->posts()->save($post)){
        $message="Post successfully created !";
    }

    return redirect()->route('home')->with(['message'=>$message]);
}

public function getDeletePost($post_id){
    $post=Post::where('id',$post_id)->first();
    if(Auth::user()!=$post->user){
        return redirect()->back();
    }
    $post->delete();
    return redirect()->route('home')->with(['message'=>'Successfully deleted!']);

}
}
