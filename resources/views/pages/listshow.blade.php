@include('index')
@include('header')

<div class="menu-conten" >
    @if(isset($name_category))
        <h3 style="color: #c9d427">{{$name_category->name_category}}</h3>
    @elseif(isset($name_status))
        <h3 style="color: #c9d427">{{$name_status->name_satus}}</h3>
    @elseif(isset($name_country))
        <h3 style="color: #c9d427">{{$name_country->name_country}}</h3>
    @endif
    <div class="main-container-list">
        <div class="list">
            @foreach($movies as $movie)
                <div class="iteam">
                    <a href="{{ route('movies.info', $movie->id) }}">

                    <img src="{{ url('frontend/' . $movie->pic) }}" alt="{{ $movie->name_movie }}">
                    <h4>{{$movie->name_movie}}</h4> </a>
                </div>
            @endforeach

        </div>
    </div>
</div>
