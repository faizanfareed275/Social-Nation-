<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        $suggestedUsers = User::where('id', '!=', auth()->id())
                                ->inRandomOrder()
                                ->take(5)
                                ->get();

        return view('posts.index', compact('posts', 'suggestedUsers'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:4096',
            'caption' => 'nullable|string|max:1000',
        ]);

        $imagePath = $request->file('image')->store('posts', 'public');

        Post::create([
            'user_id' => Auth::id(),
            'image' => $imagePath,
            'caption' => $request->caption,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'caption' => 'nullable|string|max:1000',
            'image' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->caption = $request->caption;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
