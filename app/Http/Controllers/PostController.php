<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewPostMailJob;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
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
        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:10'],
            'thumbnail' => ['required', 'image'],
        ]);

        $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails');

        auth()->user()->posts()->create($validated);

        dispatch(new SendNewPostMailJob(['email' => auth()->user()->email, 'name' => auth()->user()->name, 'title' => $validated['title']]));
        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);
        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:10'],
            'thumbnail' => ['sometimes', 'image'],
        ]);

        if ($request->hasFile('thumbnail')) {
            File::delete(storage_path('app/public/' . $post->thumbnail));
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }
        $post->update($validated);
        return to_route('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        File::delete(storage_path('app/public/' . $post->thumbnail));
        $post->delete();
        return to_route('posts.index');
    }
}
