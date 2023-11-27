<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function deleteAnyPost($postId)
    {
        // Ensure the authenticated user is an admin
        $user = Auth::user();
        if (!$user->isAdmin()) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        $post = Post::find($postId);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
