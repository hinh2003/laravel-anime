<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\Movie ;
use App\Models\Category;
class HomeController extends Controller
{
    public function index(){
        $moviesAnime = Movie::where('country_id',2)->take(10)->get();
        $moviesOr = Movie::where('country_id',3)->take(10)->get();
        $Categorys = Category::all();
        return view('pages.home',compact('moviesAnime','moviesOr','Categorys'));
    }
    public function showlistContry($id)
    {
        $Categorys = Category::all();
        $status = Status::all();
        $country = Country::find($id);

        // Lấy danh sách phim dựa trên id của trạng thái
        $movies = Movie::where('country_id', $id)->get();

        return view('pages.listshow', compact('movies', 'Categorys', 'status','country'));

    }
    public function showlist($id)
    {
        // Lấy tất cả các thể loại
        $Categorys = Category::all();
        $name_category = Category::find($id); // Lấy một đối tượng duy nhất

        // Lấy danh sách phim dựa trên id của thể loại
            $movies = Movie::whereHas('categories', function ($query) use ($id) {
            $query->where('category_id', $id);
        })->get();

        return view('pages.listshow', compact('movies', 'Categorys','name_category'));
    }
    public function showlistByStatus($id)
    {
        $Categorys = Category::all();
        $status = Status::all();
        $name_status = Status::find($id) ;
        // Lấy danh sách phim dựa trên id của trạng thái
        $movies = Movie::where('status_id', $id)->get();

        return view('pages.listshow', compact('movies', 'Categorys', 'status','name_status'));
    }
    public function showlistByCountry($id)
    {
        $name_country = Country::find($id) ;
        // Lấy danh sách phim dựa trên id của trạng thái
        $movies = Movie::where('country_id', $id)->get();

        return view('pages.listshow', compact('movies', 'name_country'));
    }
}
