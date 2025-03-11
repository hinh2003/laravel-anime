@include('index')
@include('header')
<body>
@include('Client/Banner/index')

<div class="menu-conten" >
    <div class="main-container-title">
        <div class="title">
            <h2 class="title-text">Anime mới cập nhập</h2>
        </div>

    </div>
    <div class="main-container-list">
        <div class="list">
            @foreach($moviesAnime as $movieAnime)
            <div class="iteam">
                <a href="{{ route('movies.info', !empty($movieAnime->slug) ? $movieAnime->slug : $movieAnime->id) }}">
                <img class="card-img-top" src="{{ url('frontend/' . $movieAnime->pic) }}" alt="{{ $movieAnime->name_movie }}">
                    <h4>{{$movieAnime->name_movie}}</h4> </a>
            </div>
                @endforeach
        </div>
    </div>
    <div class="xem-them"><a  href="{{route('list.contry',2)}}" title="PHim nguoi dong">Xem thêm...</a></div>
    <div class="title-mid">
        <div class="title">
            <h2 class="title-text">Phim Hoạt hình Trung Quốc</h2>
        </div>
    </div>
    <div class="main-container-list">
        <div class="main-container-list-mid">
            <div class="list">
                    @foreach($moviesOr as $movieOr)
                        <div class="iteam">
                            <a href="{{route('movies.info',!empty($movieOr->slug) ? $movieOr->slug : $movieOr->id)}}">
                            <img class="card-img-top" src="{{ url('frontend/' . $movieOr->pic) }}" alt="{{ $movieOr->name_movie }}">
                            <h4>{{$movieOr->name_movie}}</h4> </a>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
    <div class="title-last">
        <a class="xem-them" href="{{route('list.contry',3)}}" title="PHim nguoi dong">Xem thêm...</a>
    </div>
</div>
</div>

@include('footer')
</body>
