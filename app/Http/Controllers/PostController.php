<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Store a newly created post or reply.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
            'parent_id' => 'nullable|exists:posts,id',
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id,
        ]);

        // Return the post with user relationship for AJAX response
        $post->load('user');

        return response()->json([
            'success' => true,
            'post' => [
                'id' => $post->id,
                'content' => $post->content,
                'user_name' => $post->user->name,
                'user_role' => $post->user->role,
                'created_at' => $post->created_at->diffForHumans(),
                'parent_id' => $post->parent_id,
            ]
        ]);
    }

    /**
     * Get all posts for display (only top-level posts with their replies).
     */
    public function index()
    {
        // Get only top-level posts (posts without a parent_id)
        $posts = Post::with(['user', 'replies.user'])
            ->whereNull('parent_id')
            ->latest()
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'content' => $post->content,
                    'user_name' => $post->user->name,
                    'user_role' => $post->user->role,
                    'created_at' => $post->created_at->diffForHumans(),
                    'replies' => $post->replies->map(function ($reply) {
                        return [
                            'id' => $reply->id,
                            'content' => $reply->content,
                            'user_name' => $reply->user->name,
                            'user_role' => $reply->user->role,
                            'created_at' => $reply->created_at->diffForHumans(),
                            'parent_id' => $reply->parent_id,
                        ];
                    }),
                ];
            });

        return response()->json($posts);
    }
}
