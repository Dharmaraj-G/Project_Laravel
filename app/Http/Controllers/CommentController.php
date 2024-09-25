<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store a newly created comment in storage
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string',
            'blog_post_id' => 'required|exists:blog_posts,id',
        ]);

        Comment::create([
            'body' => $request->body,
            'blog_post_id' => $request->blog_post_id,
            'user_id' => Auth::id(), // Link comment to authenticated user
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
