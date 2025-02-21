<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Chap_movies;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function show(Movie $movie)
    {
        // Lấy danh sách các tập của phim
        $chapters = Chap_movies::where('movie_id', $movie->id)->get();

        // Kiểm tra xem có tập phim nào hay không
        if ($chapters->isEmpty()) {
            // Nếu không có tập phim nào, bạn có thể xử lý như sau
            $default_chapter = null; // Hoặc bạn có thể đưa ra một giá trị mặc định khác phù hợp
            return view('pages.videoMovies', compact('movie', 'chapters', 'default_chapter'))->with('message', 'Bộ phim chưa có tập nào.');
        }

        // Mặc định hiển thị tập đầu tiên
        $default_chapter = $chapters->first();

        return view('pages.videoMovies', compact('movie', 'chapters', 'default_chapter'));
    }

    public function showChapter(Movie $movie, $chapter)
    {
        // Lấy danh sách các tập của phim
        $chapters = Chap_movies::where('movie_id', $movie->id)->orderBy('name_chap', 'asc')->get();

        // Lấy thông tin của tập được chọn
        $selected_chapter = Chap_movies::findOrFail($chapter);

        return view('pages.videoMovies', compact('movie', 'chapters', 'selected_chapter'));
    }
}
