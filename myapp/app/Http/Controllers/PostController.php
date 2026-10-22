<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(string $slug)
    {
        return view('post', [
            'post' => Post::where('slug', $slug)->firstOrFail(),
        ]);
    }

    public function store(Request $request)
    {
        $post = new Post;

        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = $request->slug;

        $post->save();

        return response()->json(['result' => 'ok'], 201);
    }

    public function destroy(string $postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();

        return response()->json(['result' => 'ok'], 200);
    }

    public function update(Request $request, string $postId)
    {
        $post = Post::findOrFail($postId);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = $request->slug;
        $post->save();

        return response()->json(['result' => 'ok'], 200);
    }
}
