<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $movies = Movie::where('name_movie', 'LIKE', "%{$query}%")->get();

        return response()->json($movies);
    }
}
