@include('admin.index')

@include('admin.header')
@include('Error.login')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 style="color: white;" class="heading-section">Phim</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr>

                            <th>Hình Ảnh</th>
                            <th>Tên Phim</th>
                            <th>Số Tập</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($movies as $movie)
                            <tr>
                                <td><img src="{{ asset('frontend/' . $movie->pic) }}" alt="Ảnh" style="width: 150px; height: 150px;"></td>
                                <td>{{ $movie->name_movie }}</td>
                                <td>{{ $movie->years }}</td>
                                <td>
                                    <a href="{{ route('movies.update', $movie->id) }}">Cập nhật</a> |
                                    <a href="{{route('chapmovies.edit',$movie->id)}}">Tập Phim</a>
                                    <form action="{{ route('movies.delete', $movie->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: red; text-decoration: underline; cursor: pointer;">Xóa</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @csrf
                </div>
            </div>
        </div>
    </div>
</section>


