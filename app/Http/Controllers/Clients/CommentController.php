<?php

namespace App\Http\Controllers\Clients;

use App\Events\NewCommentEvent;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request, Movie $movie)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::id();
        $comment->movie_id = $movie->id;
        $comment->save();
        broadcast(new NewCommentEvent($comment))->toOthers();

        return response()->json([
            'success' => true,
            'comment' => [
                'user' => Auth::user()->name,
                'content' => $comment->content,
                'created_at' => $comment->created_at->diffForHumans(),
            ]
        ]);
    }
    public function list(Movie $movie)
    {
        $comments = $movie->comments()->with('user')->latest()->get();

        return response()->json([
            'success' => true,
            'comments' => $comments->map(function ($comment) {
                return [
                    'user' => $comment->user->name,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->diffForHumans(),
                ];
            })
        ]);
    }


}
