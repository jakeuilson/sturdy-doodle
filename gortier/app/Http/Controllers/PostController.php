<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);
        $post = new Post([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => optional(Auth::user())->id,
        ]);
        $post->save();
        return redirect()->route('posts.index')->with('success', 'Post is created and posted!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Show and sorts posts by the number of comments
        $post = Post::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->get();

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }
        $post->update($request->only('title', 'body'));
        return redirect()->route('post.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}
