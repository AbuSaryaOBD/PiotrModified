<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\User;

class UserCommentController extends Controller
{
    public function __constractor()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(User $user, StoreComment $request)
    {
        // Comment::create()
        $user->commentsOn()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        return redirect()->back()->with('success', 'Comment has been created');
    }
}
