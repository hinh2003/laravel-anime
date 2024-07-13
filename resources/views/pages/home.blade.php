@include('index')
@include('header')
<body>


<div class="menu-conten" >
    <div class="main-container-title">
        <div class="title">
            <h2 class="title-text">Anime mới cập nhập</h2>
        </div>
        <div class="tab">
            <a class="btn btn-secondary" href="#" type="button">Tất cả</a>
            <a class="btn btn-secondary" href="#" type="button">Mùa Này</a>
            <a class="btn btn-secondary" href="#" type="button">Mùa trước</a>
            <a class="btn btn-secondary" href="#" type="button">Bộ Hay</a>
        </div>
    </div>
    <div class="main-container-list">
        <div class="list">
            @foreach($moviesAnime as $movieAnime)
            <div class="iteam">
                <a href="{{ route('movies.info', $movieAnime->id) }}">
                <img src="{{ url('frontend/' . $movieAnime->pic) }}" alt="{{ $movieAnime->name_movie }}">
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
                <div class="list">
                    @foreach($moviesOr as $movieOr)
                        <div class="iteam">
                            <a href="{{route('movies.info',$movieOr->id)}}">
                            <img  src="{{ url('frontend/' . $movieOr->pic) }}" alt="{{ $movieOr->name_movie }}">
                            <h4>{{$movieOr->name_movie}}</h4> </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="title-last">
        <a class="xem-them" href="{{route('list.contry',3)}}" title="PHim nguoi dong">Xem thêm...</a>
    </div>
</div>
</div>

<div class="footer" style="background-color: black;">
    <div  class="footer-sub" >

        <address class="addres">
            <p><b>Thiết kế bởi : <strong>Nguyễn Văn Tuấn Hinh</strong></b></p>
            <p><i>Email : Muvodich@gmail.com</i></a></p><br>
        </address>
        <a href=""><img class="logo-end" src="/images/Logo-main.png" alt=""></a>
    </div>
</div>
</body>
</html>
