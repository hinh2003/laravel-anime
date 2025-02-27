<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie ;

class MovieControlleer extends Controller
{
    public function index($identifier)
    {
        $movie = Movie::with(['country', 'status', 'categories'])
            ->where('slug', $identifier)
            ->orWhere('id', $identifier)
            ->firstOrFail();

        return view('Client.Movies.index', compact('movie'));
    }


}
