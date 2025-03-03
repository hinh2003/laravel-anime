<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Chap_movies;
use Illuminate\Http\Request;

class ChapMoviesController extends Controller
{
    public function index($id)
    {
        $chap_movies = Chap_movies::where('movie_id',$id)->get();

        if (!$chap_movies) {
            return response()->json([
                'message' => 'Chapter movie not found'
            ], 404);
        }

        return response()->json([
            'chap_movies' => $chap_movies
        ]);
    }

}
