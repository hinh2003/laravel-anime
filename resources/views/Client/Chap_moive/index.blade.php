@include('index')
@include('header')

<div class="container text-white py-4">
    <div class="text-center mb-3">
        <button onclick="switchServer('link_chap')" class="btn btn-primary">Server Chính</button>
        <button onclick="switchServer('link_aws')" class="btn btn-secondary">Server Dự Phòng</button>
    </div>
    <div class="d-flex justify-content-center">
        <div class="w-75">
            <iframe id="videoPlayer" width="100%" height="500px"
                    src="{{ $selected_chapter->link_chap ?? $default_chapter->link_chap }}"
                    data-link-chap="{{ $selected_chapter->link_chap ?? $default_chapter->link_chap }}"
                    data-link-aws="{{ $selected_chapter->aws_link ?? $default_chapter->aws_link }}"
                    class="rounded shadow" allowfullscreen>
            </iframe>
        </div>
    </div>
    <div class="mt-4">
        <h3 class="text-warning text-center">Số Tập</h3>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            @forelse ($chapters as $chapter)
                <a href="{{ route('movies.chapter', ['movie' => $movie->id, 'chapter' => $chapter->id]) }}"
                   class="btn px-3 py-2 rounded-pill
                   {{ request()->route('chapter') == $chapter->id ? 'btn-warning text-dark fw-bold' : 'btn-dark' }}">
                    {{ $chapter->name_chap }}
                </a>
            @empty
                <p class="text-center text-muted">Không có tập phim.</p>
            @endforelse
        </div>
    </div>
</div>

