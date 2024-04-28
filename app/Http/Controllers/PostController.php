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
    // $request->validate([
    //     'content' => 'required',
    //     'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
    // ]);

    $post = new Post();
    $post->content = $request['body'];

    $post->user_id = 6;

    // if ($request->hasFile('image')) {
    //     $image = $request->file('image');
    //     $imageName = time().'.'.$image->extension();
    //     $image->move(public_path('images'), $imageName);
    //     $post->image = $imageName;
    // }

    $post->save();

    return redirect()->route('posts.create')->with('success', 'Post created successfully');
}
public function showPosts(){

}
}
