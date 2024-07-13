<div class="heder">
    <nav class="navbar navbar-expand bg-dark menu-conten-boder">
        <a class="navbar-brand" href="#"></a></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="">
            <img src="{{asset('frontend/images/Logo-main.ico')}}" alt="logo" width="130" height="50" >
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav maginn">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('home')}}">Trang chủ </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                        Thể loại
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach($categories as $Category)
                            <li><a class="dropdown-item text" href="{{route('list',$Category->id)}}">{{$Category->name_category}}</a></li>

                        @endforeach


                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                        Thể loại
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach($status as $statu)
                            <li><a class="dropdown-item text" href="{{ route('listByStatus', $statu->id) }}">{{ $statu->name_satus }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                        Quốc gia
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach($countries as $country)
                            <li><a class="dropdown-item text" href="{{ route('listByCountry', $country->id) }}">{{ $country->name_country }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>



            <form action="" method="POST" class="form-inline my-2 my-lg-0 maginnf dropdown">
                <div class="title-mid">
                    <div class="dropdown">
                        <input name="searchInput" id="searchInput" class="form-control mr-sm-2 search-edit dropdown-toggle" autocomplete = "off" type="text" aria-expanded="false" placeholder="Search" aria-label="Search">
                        <ul style="text-align: center; display: none;" id="livesearch" class="dropdown-menu" aria-labelledby="dropdownMenuButton"></ul>
                    </div>
                </div>
            </form>

        @if(session('username'))
                <div class="login">
                    <a class="btn btn-outline-success my-2 my-sm-0 size" href="{{route('profile')}}">{{ session('username') }}</a>
                    <a class="btn btn-outline-success my-2 my-sm-0 size" href="{{ route('logout') }}">Đăng Xuất</a>
                </div>
            @else
                <div class="login">
                    <a class="btn btn-outline-success my-2 my-sm-0 size" href="{{ route('login') }}">Đăng Nhập</a>
                    <a class="btn btn-outline-success my-2 my-sm-0 size" href="{{ route('register') }}">Đăng Ký</a>
                </div>
            @endif


        </div>
    </nav>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const liveSearch = document.getElementById('livesearch');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value;

            if (query.length > 2) { // Chỉ tìm kiếm khi chuỗi dài hơn 2 ký tự
                fetch(`/search?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        liveSearch.innerHTML = ''; // Xóa kết quả cũ
                        data.forEach(movie => {
                            const li = document.createElement('li');
                            li.classList.add('dropdown-item');
                            li.innerHTML = `<a href="/movies/${movie.id}">${movie.name_movie}</a>`;
                            liveSearch.appendChild(li);
                        });
                        liveSearch.style.display = 'block'; // Hiển thị menu thả xuống
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                liveSearch.innerHTML = '';
                liveSearch.style.display = 'none'; // Ẩn menu thả xuống nếu không có kết quả
            }
        });
    });

</script>
