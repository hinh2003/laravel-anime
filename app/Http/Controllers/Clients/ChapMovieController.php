<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Chap_movies;
use App\Models\Movie;
use Illuminate\Http\Request;

class ChapMovieController extends Controller
{
    public function show(Movie $movie)
    {
        $chapters = Chap_movies::where('movie_id', $movie->id)->get();

        if ($chapters->isEmpty()) {
            $default_chapter = null;
            return view('Client.Chap_moive.index', compact('movie', 'chapters', 'default_chapter'))->with('message', 'Bộ phim chưa có tập nào.');
        }

        $default_chapter = $chapters->first();

        return view('Client.Chap_moive.index', compact('movie', 'chapters', 'default_chapter'));
    }

    public function showChapter(Movie $movie, $chapter)
    {
        $chapters = Chap_movies::where('movie_id', $movie->id)->orderBy('name_chap', 'asc')->get();

        $selected_chapter = Chap_movies::findOrFail($chapter);

        return view('Client.Chap_moive.videoMovies', compact('movie', 'chapters', 'selected_chapter'));
    }
}
