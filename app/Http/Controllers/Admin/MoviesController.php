<?php

namespace App\Http\Controllers\Admin;
use App\Models\Country ;
use App\Models\Category ;
use App\Models\Status ;
use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Services\UploadVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Chap_movies;

class MoviesController extends Controller
{
    public function index(){
        $countries = Country::all();
        $statuses = Status::all();
        $categories = Category::all();

        return view('admin.fages.add', compact('countries', 'statuses', 'categories'));
    }
    public function addMovie()
    {
        return view('admin.fages.add');

    }
    public function handAddMoive(Request $request)
    {

        $request->validate([
            'name_movie' => 'required|string|max:255',
            'episodes' => 'required|integer',
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'country_id' => 'required|exists:countries,id',
            'status_id' => 'required|exists:statuses,id',
            'name_category' => 'required|array',
            'name_category.*' => 'exists:categories,id',
            'description' => 'required|string',
            'slug_movie'=>'required|unique:movies,slug',
        ]);

        if ($request->hasFile('pic')) {
            $originalName = $request->file('pic')->getClientOriginalName();
            $path = $request->file('pic')->move(public_path('frontend/images'), $originalName);
            $path = 'images/' . $originalName;
        }

        $movie = new Movie();
        $movie->name_movie = $request->name_movie;
        $movie->episodes = $request->episodes;
        $movie->slug = $request->slug_movie;
        $movie->pic = $path;
        $movie->country_id = $request->country_id;
        $movie->status_id = $request->status_id;
        $movie->description = $request->description;
        $movie->save();


        $nameCategoryIds = explode(',', $request->name_category[0]);
        $nameCategoryIds = array_map('trim', $nameCategoryIds);
        $nameCategoryIds = array_map('intval', $nameCategoryIds);

        $movie->categories()->attach($nameCategoryIds);

        return redirect()->route('movies.add')->with('success', 'Phim đã được thêm thành công');


    }

    public function addCategory(Request $request){
        return view('admin.fages.category');
    }
    public function handCategory(Request $request){
        $request->validate([
            'name_category' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        Category::create([
            'name_category' => request()->name_category,
            'description' => request()->description,
            'created_atcreated_at'=>request()->now,
        ]);
        return redirect()->route('movies.category')->with('success', 'Thể loại đã được thêm thành công');


    }

    public function updateMovie($id)
    {
        $movie = Movie::findOrFail($id);
        $countries = Country::all();
        $statuses = Status::all();
        $categories = Category::all();
        return view('admin.fages.update', compact('movie', 'countries', 'statuses', 'categories'));
    }
    public function handUpdateMovie(Request $request, $id){
        $request->validate([
            'name_movie' => 'required|string|max:255',
            'episodes' => 'required|integer',
            'country_id' => 'required|exists:countries,id',
            'status_id' => 'required|exists:statuses,id',
            'name_category' => 'required|array',
            'name_category.*' => 'exists:categories,id',
            'description' => 'required|string',
            'slug_movie' => 'required|unique:movies,slug,' . $id,
        ]);

        $movie = Movie::findOrFail($id);
        $path = $movie->pic;

        if ($request->hasFile('pic')) {
            if (File::exists(public_path('storage/' . $path))) {
                File::delete(public_path('storage/' . $path));
            }
            $originalName = $request->file('pic')->getClientOriginalName();
            $path = $request->file('pic')->move(public_path('frontend/images'), $originalName);
            $path = 'images/' . $originalName;
        }
        $movie->update([
            'name_movie' => $request->name_movie,
            'episodes' => $request->episodes,
            'pic' => $path,
            'country_id' => $request->country_id,
            'status_id' => $request->status_id,
            'description' => $request->description,
            'slug' => $request->input('slug_movie'),
        ]);

        $nameCategoryIds = explode(',', $request->name_category[0]);
        $nameCategoryIds = array_map('trim', $nameCategoryIds);
        $nameCategoryIds = array_map('intval', $nameCategoryIds);
        $movie->categories()->sync($nameCategoryIds);

        return redirect()->route('main')->with('success', 'Phim đã được cập nhật thành công');
    }

    public function handDelete($id)
    {
        $movie = Movie::find($id);
        $movie->delete();

        return redirect()->route('main')->with('success', 'Phim đã được xóa thành công');

    }

    public function search(Request $request) {
        if ($request->ajax()) {
            $query = Movie::query();

            if ($request->search) {
                $query->where('name_movie', 'like', '%' . $request->search . '%');
            }

            $movies = $query->paginate(5);

            return response()->json([
                'html' => view('admin.layout.movies_table', compact('movies'))->render()
            ]);
        }
    }
}
