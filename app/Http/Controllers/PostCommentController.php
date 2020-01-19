<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Comment;
use App\Http\Requests\StoreComment;
use App\Http\Requests;

class PostCommentController extends Controller
{
    public function __constractor()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        // Comment::create()
        $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        return redirect()->back()->with('success', 'Comment has been created');
    }
}
