<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function updateUserPost(Request $request, $postId)
    {
        $user = Auth::user();

        $post = Post::where('id', $postId)
            ->where('user_id', $user->id)
            ->first();

        if (!$post) {
            return response()->json(['error' => 'Post not found or you are not authorized to update'], 404);
        }

        $post->content = $request->input('content');
        $post->save();

        return response()->json(['message' => 'Post updated successfully']);
    }

    public function deleteUserPost($postId)
    {
        $user = Auth::user();

        $post = Post::where('id', $postId)
            ->where('user_id', $user->id)
            ->first();

        if (!$post) {
            return response()->json(['error' => 'Post not found or you are not authorized to delete'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
