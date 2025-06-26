<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $comments = $user->comments()->with('post')->latest()->paginate(10);
        return view('user.comments', compact('user', 'comments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $comment = $post->comments()->create([
            'comment' => $request->comment,
            'user_id' => auth()->id(),
        ]);

        if ($post->user_id !== auth()->id()) {
            $post->user->notify(new CommentNotification($comment));
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        if (auth()->user()->id !== $comment->user_id &&
            !auth()->user()->hasRole('admin') &&
            !auth()->user()->hasRole('moderator')) 
        {
            abort(403, 'Unauthorized action.');
        }

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        if (auth()->user()->id !== $comment->user_id &&
            !auth()->user()->hasRole('admin') &&
            !auth()->user()->hasRole('moderator')) 
        {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $comment->update($request->only('comment'));

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if (auth()->user()->id !== $comment->user_id && !auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->route('dashboard');
    }
}
