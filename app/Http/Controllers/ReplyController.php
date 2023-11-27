<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function createReply(Request $request, $postId)
    {
        $user = auth()->user();
        $post = Post::find($postId);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        $reply = new Reply();
        $reply->content = $request->input('content');
        $reply->user()->associate($user);
        $reply->post()->associate($post);
        $reply->save();
        return response()->json(['message' => 'Reply created successfully'], 201);
    }


    public function updateReply(Request $request, $id)
    {
        $user = auth()->user();
        $reply = Reply::where('id', $id)->where('user_id', $user->id)->first();
        if (!$reply) {
            return response()->json(['message' => 'Reply not found or unauthorized'], 404);
        }
        $reply->content = $request->input('content');
        $reply->save();
        return response()->json(['message' => 'Reply updated successfully'], 200);
    }
    public function deleteReply($id)
    {
        $user = auth()->user();
        $reply = Reply::where('id', $id)->where('user_id', $user->id)->first();
        if (!$reply) {
            return response()->json(['message' => 'Reply not found or unauthorized'], 404);
        }
        $reply->delete();
        return response()->json(['message' => 'Reply deleted successfully'], 200);
    }


}
