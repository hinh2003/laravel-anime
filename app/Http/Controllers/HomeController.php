<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\Movie ;
use App\Models\Category;
class HomeController extends Controller
{
    public function index()
    {
        $moviesAnime = Movie::where('movies.country_id', 2)
            ->leftJoin('chap_movies', 'movies.id', '=', 'chap_movies.movie_id')
            ->select(
                'movies.id',
                'movies.name_movie',
                'movies.pic',
                'movies.updated_at',
                \DB::raw('COALESCE(MAX(chap_movies.created_at), movies.updated_at) as latest_update')
            )
            ->groupBy('movies.id', 'movies.name_movie', 'movies.updated_at', 'movies.pic')
            ->orderByDesc('latest_update')
            ->take(10)
            ->get();

        $moviesOr = Movie::where('movies.country_id', 3)
            ->leftJoin('chap_movies', 'movies.id', '=', 'chap_movies.movie_id')
            ->select(
                'movies.id',
                'movies.name_movie',
                'movies.pic',
                'movies.updated_at',
                \DB::raw('COALESCE(MAX(chap_movies.created_at), movies.updated_at) as latest_update')
            )
            ->groupBy('movies.id', 'movies.name_movie', 'movies.updated_at','movies.pic')
            ->orderByDesc('latest_update')
            ->take(10)
            ->get();

        $Categorys = Category::all();

        return view('pages.home', compact('moviesAnime', 'moviesOr', 'Categorys'));
    }



    public function showlistContry($id)
    {
        $Categorys = Category::all();
        $status = Status::all();
        $country = Country::find($id);

        $movies = Movie::where('country_id', $id)
            ->leftJoin('chap_movies', 'movies.id', '=', 'chap_movies.movie_id')
            ->select('movies.*', \DB::raw('COALESCE(MAX(chap_movies.updated_at), movies.updated_at) as latest_update'))
            ->groupBy('movies.id')
            ->orderByDesc('latest_update')
            ->get();
        return view('pages.listshow', compact('movies', 'Categorys', 'status','country'));

    }
    public function showlist($id)
    {
        $Categorys = Category::all();
        $name_category = Category::findOrFail($id);

        $movies = Movie::whereHas('categories', function ($query) use ($id) {
            $query->where('category_id', $id);
        })
            ->leftJoin('chap_movies', 'movies.id', '=', 'chap_movies.movie_id')
            ->select('movies.*', \DB::raw('COALESCE(MAX(chap_movies.created_at), movies.updated_at) as latest_update'))
            ->groupBy('movies.id')
            ->orderByDesc('latest_update')
            ->get();

        return view('pages.listshow', compact('movies', 'Categorys', 'name_category'));
    }

    public function showlistByStatus($id)
    {
        $Categorys = Category::all();
        $status = Status::all();
        $name_status = Status::findOrFail($id);

        $movies = Movie::where('status_id', $id)
            ->leftJoin('chap_movies', 'movies.id', '=', 'chap_movies.movie_id')
            ->select('movies.*', \DB::raw('COALESCE(MAX(chap_movies.updated_at), movies.updated_at) as latest_update'))
            ->groupBy('movies.id')
            ->orderByDesc('latest_update')
            ->get();

        return view('pages.listshow', compact('movies', 'Categorys', 'status', 'name_status'));
    }

    public function showlistByCountry($id)
    {
        $name_country = Country::findOrFail($id);

        $movies = Movie::where('country_id', $id)
            ->leftJoin('chap_movies', 'movies.id', '=', 'chap_movies.movie_id')
            ->select('movies.*', \DB::raw('COALESCE(MAX(chap_movies.updated_at), movies.updated_at) as latest_update'))
            ->groupBy('movies.id')
            ->orderByDesc('latest_update')
            ->get();

        return view('pages.listshow', compact('movies', 'name_country'));
    }

}
