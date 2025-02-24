@include('admin.index')
@include('admin.header')
<section class="ftco-section">
    <div class="container">
        <form id="themphim" method="POST" action="{{ route('movies.addchap.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 style="color: white;" class="heading-section">Phim</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Phim</td>
                                <th>
                                    <select id="movie_id" name="movie_id" required onchange="updateChapters()">
                                        <option value="">Chọn phim</option>
                                        @foreach($movies as $movie)
                                            <option value="{{ $movie['id'] }}"
                                                    data-episodes="{{ $movie['episodes'] }}"
                                                    data-existing-chapters="{{ json_encode($movie['existing_chapters']) }}">
                                                {{ $movie['name_movie'] }}
                                            </option>
                                        @endforeach
                                    </select>

                                </th>
                            </tr>
                            <tr>
                                <td>Tập</td>
                                <th>
                                    <select id="chapter" name="chapter" required>
                                    </select>
                                </th>

                            </tr>
                            <tr>
                                <td>Chọn File Phim</td>
                                <th><input type="file" id="video_file" name="video_file" required accept="video/*"></th>
                            </tr>
                            </tbody>
                        </table>
                        <p style="color: red;" id="result1"></p>
                        <input type="submit" id="themphim" name="themphim" value="Thêm Phim">
                    </div>
                </div>
            </div>
        </form>
        <br>
        <br>
        @include('Error.login')
    </div>
</section>
