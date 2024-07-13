<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LivemoviesController extends Controller
{
    //
    public function likeMovie(Request $request, $movieId)
    {
        $user = Auth::user();
        $movie = Movie::findOrFail($movieId);

        if (!$user->movies()->where('movie_id', $movieId)->exists()) {
            $user->movies()->attach($movie);
        }

        return redirect()->back()->with('success', 'Bạn đã thích bộ phim này!');
    }

    public function unlikeMovie(Request $request, $movieId)
    {
        $user = Auth::user();
        $movie = Movie::findOrFail($movieId);

        if ($user->movies()->where('movie_id', $movieId)->exists()) {
            $user->movies()->detach($movie);
        }

        return redirect()->back()->with('success', 'Bạn đã bỏ thích bộ phim này!');
    }
}
