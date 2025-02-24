<div class="heder">
    <nav class="navbar navbar-expand bg-dark menu-conten-boder" >
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/admin/action/main">Thống kê </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/admin/action/movies/add">Thêm phim</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('movies.addchap')}}">Thêm Tập</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/action/movies/category">Thêm thể loại</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/action/account">Tài Khoản</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="btn btn-outline-success my-2 my-sm-0" type="submit" href="/admin/logout">Đăng Xuất</a>
                <a class="btn btn-outline-success my-2 my-sm-0" type="submit" href="">{{Auth::user()->name }}</a>
            </form>
        </div>
    </nav>
</div>
@yield('header')
