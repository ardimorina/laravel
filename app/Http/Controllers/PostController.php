<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $user = auth()->user();
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $user->posts()->save($post);
        return response()->json(['message' => 'Post created successfully'], 201);
    }
    public function updatePost(Request $request, $id)
    {
        $user = auth()->user();
        $post = Post::where('id', $id)->where('user_id', $user->id)->first();
        if (!$post) {
            return response()->json(['message' => 'Post not found or unauthorized'], 404);
        }
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return response()->json(['message' => 'Post updated successfully'], 200);
    }
    public function deletePost($id)
    {
        $user = auth()->user();
        $post = Post::where('id', $id)->where('user_id', $user->id)->first();
        if (!$post) {
            return response()->json(['message' => 'Post not found or unauthorized'], 404);
        }
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }



}
