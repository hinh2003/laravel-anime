<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoveMoviesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user){
            return response()->json(['message' => 'User chưa đăng nhập'], 401);
        }
        $favoriteMovies = Auth::user()->favoriteMovies()
            ->getQuery()
            ->leftJoin('chap_movies', 'movies.id', '=', 'chap_movies.movie_id')
            ->select('movies.*', \DB::raw('COALESCE(MAX(chap_movies.created_at), movies.updated_at) as latest_update'))
            ->groupBy('movies.id')
            ->orderByDesc('latest_update')
            ->get();

        return response()->json(['movies' => $favoriteMovies]);
    }
}
