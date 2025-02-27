@include('index')
@include('header')

<div class="video-move">

    @if (isset($selected_chapter))
        <iframe width="80%" height="600px"  src="{{$selected_chapter->link_chap}}"
                title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
        </iframe>
    @elseif (isset($default_chapter))
        <iframe width="80%" height="600px"  src="{{$default_chapter->link_chap}}"
                title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
        </iframe>
    @else
        <p>Không có tập phim để hiển thị.</p>
    @endif

    <div class="chap-move">
        <h3>Số Tập</h3>
        <div  class="chap-move-iteam">
            @forelse ($chapters as $chapter)
                <a class="btn btn-secondary" href="{{ route('movies.chapter', ['movie' => $movie->id, 'chapter' => $chapter->id]) }}" type="button">{{ $chapter->name_chap }}</a>
            @empty
                <p>Không có tập phim.</p>
            @endforelse
        </div>
    </div>
</div>
