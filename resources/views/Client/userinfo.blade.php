@include('index')
@include('header')

<div class="menu-conten">
    <div class="container">
        <div class="row">
            <!-- Phim Yêu Thích -->
            <div class="col-md-8">
                <h3 style="color: #c9d427">Phim Yêu Thích</h3>
                <div class="main-container-list">
                    <div class="list">
                        @foreach($movies as $movie)
                            <div class="item">
                                <a href="{{ route('movies.info', $movie->id) }}">
                                    <img src="{{ url('frontend/' . $movie->pic) }}" alt="{{ $movie->name_movie }}">
                                    <h4>{{ $movie->name_movie }}</h4>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <h3 style="color: #c9d427">Thông Tin Người Dùng</h3>
                <div class="user-info">
                    <p>Tên: {{ Auth::user()->name }}</p>
                    <p>Email: {{ Auth::user()->email }}</p>
                    @if(Auth::user()->role-> name_role == 'Admin' )
                    <a href="{{route('main')}}" ><p>Role: {{ Auth::user()->role-> name_role}}</p></a>
                    @else
                        <p>Role: {{ Auth::user()->role-> name_role}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .menu-conten .container {
        display: flex;
        justify-content: space-between;
    }

    .menu-conten .main-container-list {
        display: flex;
        flex-wrap: wrap;
    }

    .menu-conten .item {
        flex: 1 1 200px; /* Đặt kích thước cho mỗi item */
        margin: 10px;
    }

    .user-info {
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

</style>
