
<section class="ftco-section">
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <form action="#" class="searchform order-lg-last" method="POST">
                <div class="form-group d-flex">
                    <input name="searchInput" id="searchInput" class="form-control pl-3" autocomplete = "off" type="text" aria-expanded="false" placeholder="Search" aria-label="Search">
                    <ul style="text-align: center; display: none;" id="livesearch" class="dropdown-menu" aria-labelledby="dropdownMenuButton"></ul>

                    <button type="submit" placeholder="" class="form-control search"><span class="fa fa-search"></span></button>

                </div>
            </form>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item "><a href="{{route('home')}}" class="nav-link">Trang Chủ</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thể Loại</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @foreach($categories as $Category)
                                <a class="dropdown-item text" href="{{route('list',$Category->id)}}">{{$Category->name_category}}</a>
                            @endforeach

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Trạng Thái</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @foreach($status as $statu)
                                <a class="dropdown-item text" href="{{ route('listByStatus', $statu->id) }}">{{ $statu->name_satus }}</a>
                            @endforeach

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Quốc Gia</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @foreach($countries as $country)
                               <a class="dropdown-item text" href="{{ route('listByCountry', $country->id) }}">{{ $country->name_country }}</a>
                            @endforeach

                        </div>
                    </li>
                    @if(session('username'))
                        <li class="nav-item "><a href="{{route('profile')}}" class="nav-link">{{session('username')}}</a></li>
                        <li class="nav-item "><a href="{{route('logout')}}" class="nav-link">Đăng Xuất</a></li>
                    @else
                        <li class="nav-item "><a href="{{ route('login') }}" class="nav-link">Đăng Nhập</a></li>
                        <li class="nav-item "><a href="{{ route('register') }}" class="nav-link">Đăng Ký</a></li>

                    @endif

                </ul>
            </div>
        </div>
    </nav>

</section>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const liveSearch = document.getElementById('livesearch');
        let hideTimeout;

        function handleSearch() {
            const query = searchInput.value;

            if (query.length > 2) {
                fetch(`/search?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        liveSearch.innerHTML = '';
                        data.forEach(movie => {
                            const li = document.createElement('li');
                            li.classList.add('dropdown-item');
                            li.innerHTML = `<a href="/movies/${movie.id}">${movie.name_movie}</a>`;
                            liveSearch.appendChild(li); 
                        });
                        liveSearch.style.display = 'block';
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                liveSearch.innerHTML = '';
                liveSearch.style.display = 'none'; 
            }
        }

        function showLiveSearch() {
            clearTimeout(hideTimeout);
            if (liveSearch.innerHTML !== '') {
                liveSearch.style.display = 'block';
            }
        }

        function hideLiveSearch() {
            hideTimeout = setTimeout(() => {
                liveSearch.style.display = 'none';
            }, 1000); 
        }
        document.querySelector('.searchform').addEventListener('submit', function(event) {
            event.preventDefault(); 
        });

        searchInput.addEventListener('keyup', handleSearch);
        searchInput.addEventListener('focus', showLiveSearch);
        searchInput.addEventListener('mouseenter', showLiveSearch);
        searchInput.addEventListener('mouseleave', hideLiveSearch);
        liveSearch.addEventListener('mouseenter', showLiveSearch);
        liveSearch.addEventListener('mouseleave', hideLiveSearch);
    });
</script>
