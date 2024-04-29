<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Like;
use App\Models\User;
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
    $post->body = $request['body'];
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
   
public function postEdit(Request $request){
    $request->validate([
        'body' => 'required|max:1000',
    ]);
    $post=Post::find($request['postId']);
    $post->body=$request['body'];
    $post->update();
    return response()->json(['new_body' => $post->body], 200);
} 
public function likePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }   

    public function userPosts(User $user)
{
    $posts = $user->posts()->orderBy('created_at', 'desc')->get();
    return view('posts.show-user-posts', compact('posts', 'user'));
}
}
