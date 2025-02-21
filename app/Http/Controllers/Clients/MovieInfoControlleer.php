<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie ;

class MovieInfoControlleer extends Controller
{
    public function index($id){
        $movie = Movie::with(['country', 'status', 'categories'])->findOrFail($id);
        return view('pages.movieInfo', compact('movie'));
    }
}
