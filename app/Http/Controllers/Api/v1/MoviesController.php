<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::with(['categories'])
            ->leftJoin('chap_movies', 'movies.id', '=', 'chap_movies.movie_id')
            ->select('movies.*', \DB::raw('COALESCE(MAX(chap_movies.created_at), movies.updated_at) as latest_update'))
            ->groupBy('movies.id')
            ->orderByDesc('latest_update')
            ->take(10)
            ->get();
        return response()->json(['movies' => $movies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($identifier)
    {

        $movie = Movie::with(['country', 'status', 'categories'])
            ->where('slug', $identifier)
            ->orWhere('id', $identifier)
            ->firstOrFail();

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        return response()->json($movie);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
