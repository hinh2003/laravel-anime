<table class="table table-bordered table-hover shadow-sm">
    <thead class="table-dark">
    <tr>
        <th class="text-center">Hình Ảnh</th>
        <th class="text-center">Tên Phim</th>
        <th class="text-center">Số Tập</th>
        <th class="text-center">Thao Tác</th>
    </tr>
    </thead>
    <tbody>
    @foreach($movies as $movie)
        <tr>
            <td class="text-center">
                <img src="{{ asset('frontend/' . $movie->pic) }}" alt="Ảnh" class="img-thumbnail" style="width: 120px; height: 120px;">
            </td>
            <td class="text-center fw-bold text-dark">{{ $movie->name_movie }}</td>
            <td class="text-center text-dark">{{ $movie->episodes }}</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                    <form action="{{ route('movies.update', $movie->id) }}" method="GET">
                        <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                    </form>

                    <form action="{{ route('chapmovies.edit', $movie->id) }}" method="GET">
                        <button type="submit" class="btn btn-success btn-sm">Tập phim</button>
                    </form>

                    <form action="{{ route('movies.delete', $movie->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {{ $movies->links('pagination::bootstrap-4') }}
</div>
