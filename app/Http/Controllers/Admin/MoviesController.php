<?php

namespace App\Http\Controllers\Admin;
use App\Models\Country ;
use App\Models\Category ;
use App\Models\Status ;
use App\Http\Controllers\Controller;
use App\Models\Movie;
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

        // Validate dữ liệu đầu vào
        $request->validate([
            'name_movie' => 'required|string|max:255',
            'years' => 'required|integer',
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'country_id' => 'required|exists:countries,id',
            'status_id' => 'required|exists:statuses,id',
            'name_category' => 'required|array',
            'name_category.*' => 'exists:categories,id',
            'description' => 'required|string',
        ]);

        // Xử lý upload hình ảnh
        if ($request->hasFile('pic')) {
            $originalName = $request->file('pic')->getClientOriginalName();
            $path = $request->file('pic')->move(public_path('images'), $originalName);
            $path = 'images/' . $originalName;
        }

        // Tạo mới bộ phim
        $movie = new Movie();
        $movie->name_movie = $request->name_movie;
        $movie->years = $request->years;
        $movie->pic = $path;
        $movie->country_id = $request->country_id;
        $movie->status_id = $request->status_id;
        $movie->description = $request->description;
        $movie->save();

// Lấy các ID của thể loại từ request
        $nameCategoryIds = explode(',', $request->name_category[0]);
        $nameCategoryIds = array_map('trim', $nameCategoryIds);
        $nameCategoryIds = array_map('intval', $nameCategoryIds);

// Gắn từng thể loại vào phim bằng phương thức attach()
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
            'years' => 'required|integer',
            'country_id' => 'required|exists:countries,id',
            'status_id' => 'required|exists:statuses,id',
            'name_category' => 'required|array',
            'name_category.*' => 'exists:categories,id',
            'description' => 'required|string',
        ]);

        $movie = Movie::findOrFail($id);
        $path = $movie->pic; // Giữ lại đường dẫn ảnh cũ

        if ($request->hasFile('pic')) {
            // Xóa ảnh cũ nếu có ảnh mới
            if (File::exists(public_path('storage/' . $path))) {
                File::delete(public_path('storage/' . $path));
            }
            // Lấy tên gốc của file
            $originalName = $request->file('pic')->getClientOriginalName();
            // Di chuyển file tới thư mục 'public/images' với tên gốc
            $path = $request->file('pic')->move(public_path('images'), $originalName);
            // Lưu đường dẫn tương đối vào cơ sở dữ liệu
            $path = 'images/' . $originalName;
        }

        $movie->update([
            'name_movie' => $request->name_movie,
            'years' => $request->years,
            'pic' => $path,
            'country_id' => $request->country_id,
            'status_id' => $request->status_id,
            'description' => $request->description,
        ]);

        // Lấy danh sách các ID của các thể loại từ request
        $nameCategoryIds = explode(',', $request->name_category[0]);
        $nameCategoryIds = array_map('trim', $nameCategoryIds);
        $nameCategoryIds = array_map('intval', $nameCategoryIds);
        // Đồng bộ hóa các thể loại của phim
        $movie->categories()->sync($nameCategoryIds);

        return redirect()->route('main')->with('success', 'Phim đã được cập nhật thành công');
    }

    public function handDelete($id)
    {
        $movie = Movie::find($id);
        // Xóa bản ghi phim
        $movie->delete();

        return redirect()->route('main')->with('success', 'Phim đã được xóa thành công');

    }
    public function addChap()
    {
        $movies =  Movie::all() ;
        $chapter = Chap_movies::all() ;
        return view('admin.fages.movies_add_chap' ,compact('movies','chapter'));

    }
    public function handAddChap(Request $request)
    {
        $request->validate([
            'chapter' => 'required|integer',
            'link_movis' => 'required|string',
            'movie_id' => 'required|integer|exists:movies,id'
        ]);

        $chap_movies = new Chap_movies();
        $chap_movies->name_chap = $request->chapter;
        $chap_movies->movie_id = $request->movie_id;
        $chap_movies->link_chap = $request->link_movis;
        $chap_movies->save();

        return redirect()->route('movies.addchap')->with('success', 'Phim đã được thêm thành công');
    }
    public function updateChapMovie($id){
        $chap_movie = Chap_movies::where('movie_id', $id)->with('movie')->orderBy('name_chap', 'asc')->get();
        return view('admin.fages.update_chapter' ,compact('chap_movie'));
    }
    public function handupdateChapMovie(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'name_chap_' . $id => 'required|string',
            'link_chap_' . $id => 'required|string',
        ]);

        // Find the specific Chap_movie to update
        $chap_movie = Chap_movies::findOrFail($id);

        // Update the fields
        $chap_movie->name_chap = $request->input('name_chap_' . $id);
        $chap_movie->link_chap = $request->input('link_chap_' . $id);
        $chap_movie->save();

        // Redirect back or wherever appropriate after update
        return redirect()->back()->with('success', 'Cập nhật tập phim thành công');
    }


// Ví dụ về xóa tập phim
    public function deleteChapMovie($id)
    {
        $chap_movie = Chap_movies::findOrFail($id);
        $chap_movie->delete();

        return redirect()->back()->with('success', 'Xóa tập phim thành công');
    }



}
