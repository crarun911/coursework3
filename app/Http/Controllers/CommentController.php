<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        
        $comment = new Comment();
        $comment->content = $request->body; 
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $post->id;
        $comment->save();

        return response()->json(['comment' => $comment]);
    }

    
}
