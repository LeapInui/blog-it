<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['user', 'comments' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->latest()->paginate(5);
        
        return view('dashboard', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post_images', 'public');
            $post->image = $imagePath;
        }

        $post->save();
    
        return redirect()->back()->with('success', 'Post added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (auth()->user()->id !== $post->user_id && !auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }
    
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (auth()->user()->id !== $post->user_id &&
            !auth()->user()->hasRole('admin') &&
            !auth()->user()->hasRole('moderator')) 
        {
            abort(403, 'Unauthorized action.');
        }
    
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:500',
        ]);
    
        $post->update($request->only(['title', 'body']));
    
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (auth()->user()->id !== $post->user_id &&
            !auth()->user()->hasRole('admin') &&
            !auth()->user()->hasRole('moderator')) 
        {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('dashboard');
    }
}
