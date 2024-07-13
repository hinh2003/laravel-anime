@include('admin.index')
@include('admin.header')

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 style="color: white;" class="heading-section">Tập Phim</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr>
                            <th>Tập</th>
                            <th>Tên Phim</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($chap_movie as $chap_movies)
                            <tr>
                                <form action="{{ route('chapmovies.update', $chap_movies->id) }}" method="POST" style="display: inline;">

                                <td>

                                    <input id="name_chap_{{ $chap_movies->id }}" name="name_chap_{{ $chap_movies->id }}" value="{{ $chap_movies->name_chap }}" style="border: none; width: 50px;">
                                </td>
                                <td>
                                    <input id="link_chap_{{ $chap_movies->id }}" name="link_chap_{{ $chap_movies->id }}" type="text" value="{{ $chap_movies->link_chap }}" style="border: none; width: 300px;">
                                </td>
                                <td>
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"  style="background: none; border: none; color: blue; text-decoration: none; cursor: pointer;">Cập Nhật</button>
                                    </form>|
                                    <form action="{{ route('chapmovies.delete', $chap_movies->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: red; text-decoration: none; cursor: pointer;">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                @include('Error.login') <!-- Bao gồm thông báo lỗi login nếu có -->
            </div>
        </div>
    </div>
</section>
