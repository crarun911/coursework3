<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // Validation
        $this->validate($request, [
            'body' => 'required|max:255',
        ]);

        // Create the comment
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->post_id = $post->id;
        $comment->user_id = auth()->user()->id; // Assuming you're using authentication
        $comment->save();

        // Return the newly created comment
        return response()->json(['comment' => $comment]);
    }
}
