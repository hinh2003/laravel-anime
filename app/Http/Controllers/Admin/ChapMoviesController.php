<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chap_movies;
use App\Models\Movie;
use App\Services\UploadVideo;
use Illuminate\Http\Request;

class ChapMoviesController extends Controller
{
    public function addChap()
    {
        $movies = Movie::all();
        $chapters = Chap_movies::select('movie_id', 'name_chap')->get()->groupBy('movie_id');

        $movies = $movies->map(function ($movie) use ($chapters) {
            return [
                'id' => $movie->id,
                'name_movie' => $movie->name_movie,
                'episodes' => $movie->episodes,
                'existing_chapters' => isset($chapters[$movie->id])
                    ? $chapters[$movie->id]->pluck('name_chap')->map(fn($chap) => (int) $chap)->toArray()
                    : []
            ];
        });

        return view('admin.fages.movies_add_chap', compact('movies'));
    }

    public function handAddChap(Request $request)
    {
        $request->validate([
            'chapter' => 'required|integer',
            'video_file' => 'required|mimes:mp4,mkv,avi,mov',
            'movie_id' => 'required|integer|exists:movies,id'
        ]);
        $videoFile = $request->file('video_file');
        $filePath = $videoFile->getPathname();

        $uploadServer = new UploadVideo();
        $response = $uploadServer->upload($filePath);
        $response_aws = $uploadServer->uploadVideoAWS($videoFile);
        if (isset($response['urlIframe'])) {
            Chap_movies::create([
                'movie_id' => $request->movie_id,
                'link_chap' => $response['urlIframe'],
                'aws_link' => $response_aws['url'],
                'name_chap' => request()->chapter,
            ]);

            return back()->with('success', 'Phim đã được tải lên !');
        }
        return back()->with('error', 'Lỗi khi tải lên Hydrax.');
    }
    public function updateChapMovie($id){
        $chap_movie = Chap_movies::where('movie_id', $id)->with('movie')->orderBy('name_chap', 'asc')->get();
        return view('admin.fages.update_chapter' ,compact('chap_movie'));
    }
    public function handupdateChapMovie(Request $request, $id)
    {
        $request->validate([
            'name_chap_' . $id => 'required|string',
            'link_chap_' . $id => 'required|string',
        ]);

        $chap_movie = Chap_movies::findOrFail($id);

        $chap_movie->name_chap = $request->input('name_chap_' . $id);
        $chap_movie->link_chap = $request->input('link_chap_' . $id);
        $chap_movie->save();

        return redirect()->back()->with('success', 'Cập nhật tập phim thành công');
    }

    public function deleteChapMovie($id)
    {
        $chap_movie = Chap_movies::findOrFail($id);
        $chap_movie->delete();

        return redirect()->back()->with('success', 'Xóa tập phim thành công');
    }

}
