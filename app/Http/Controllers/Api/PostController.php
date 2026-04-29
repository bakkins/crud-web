<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::where('user_id', $request->user()->id)->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = $request->user()->posts()->create($data);
        return response()->json($post, 201);
    }

    public function show(Request $request, Post $post)
    {
        $post=$request->user()->posts()->show();
        return response()->json($post);
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post=$request->user()->posts()->update($data);
        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        $post->$request->user()->posts()->delete();
        return response()->json(['message' => 'Dzēsts']);
    }
}