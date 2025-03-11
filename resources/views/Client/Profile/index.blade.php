@include('index')
@include('header')

<div class="menu-conten">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 style="color: #c9d427">Phim Yêu Thích</h3>
                <div class="main-container-list">
                    <div class="row">
                        @foreach($movies as $movie)
                            <div class="col-md-4 col-sm-6">
                                <div class="item">
                                    <a href="{{ route('movies.info', !empty($movie->slug) ? $movie->slug : $movie->id) }}">
                                        <img class="card-img-top" src="{{ url('frontend/' . $movie->pic) }}" alt="{{ $movie->name_movie }}">
                                        <h4>{{ $movie->name_movie }}</h4>
                                    </a>
                                </div>
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
                    @if(Auth::user()->role->name_role == 'Admin')
                        <a href="{{route('main')}}"><p>Role: {{ Auth::user()->role->name_role}}</p></a>
                    @else
                        <p>Role: {{ Auth::user()->role->name_role}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .main-container-list {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .item {
        text-align: center;
        margin-bottom: 20px;
    }

    .item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
    }

    .item h4 {
        margin-top: 10px;
        font-size: 14px;
        color: #c9d427;
    }

    .user-info {
        background-color: #333;
        padding: 15px;
        border-radius: 8px;
        color: white;
    }
</style>
