<div class="comment-section">
    <h3>Bình luận</h3>

    @if(Auth::check())
        <form id="commentForm">
            @csrf
            <textarea name="content" id="commentContent" class="form-control" placeholder="Nhập bình luận..." required></textarea>
            <button type="submit" class="btn btn-success mt-2">Gửi</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Đăng nhập</a> để bình luận.</p>
    @endif

    <div id="commentsList" data-movie-id="{{ $movie->id }}">
        @if($comments->count() > 0)
            @foreach($comments as $comment)
                <div class="comment">
                    <strong>{{ $comment->user->name }}</strong> - {{ $comment->created_at->diffForHumans() }}
                    <p>{{ $comment->content }}</p>
                </div>
            @endforeach
        @else
            <p>Chưa có bình luận nào.</p>
        @endif
    </div>
</div>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("🔄 Listening to 'comment' channel...");

        Echo.channel('comment')
            .listen('.CommentPost', (event) => {
                console.log('🔥 Received event:', event);
            })
            .error((error) => {
                console.error('❌ Echo error:', error);
            });
    });


    {{--$(document).ready(function() {--}}
    {{--    $('#commentForm').submit(function(e) {--}}
    {{--        e.preventDefault();--}}

    {{--        let content = $('#commentContent').val();--}}
    {{--        let movieId = $('#commentsList').data('movie-id');--}}

    {{--        $.ajax({--}}
    {{--            url: "/movies/" + movieId + "/comments",--}}
    {{--            type: "POST",--}}
    {{--            data: {--}}
    {{--                _token: "{{ csrf_token() }}",--}}
    {{--                content: content--}}
    {{--            },--}}
    {{--            success: function(response) {--}}
    {{--                if(response.success) {--}}
    {{--                    $('#commentContent').val('');--}}
    {{--                    loadComments();--}}
    {{--                }--}}
    {{--            },--}}
    {{--            error: function(xhr) {--}}
    {{--                console.log(xhr.responseText);--}}
    {{--            }--}}
    {{--        });--}}
    {{--    });--}}

    {{--    function loadComments() {--}}
    {{--        let movieId = "{{ $movie->id }}";--}}

    {{--        $.ajax({--}}
    {{--            url: "/movies/" + movieId + "/comments/list",--}}
    {{--            type: "GET",--}}
    {{--            success: function(response) {--}}
    {{--                if (response.success) {--}}
    {{--                    let commentsHtml = "";--}}
    {{--                    response.comments.forEach(comment => {--}}
    {{--                        commentsHtml += `--}}
    {{--                    <div class="comment">--}}
    {{--                        <strong>${comment.user}</strong> - ${comment.created_at}--}}
    {{--                        <p>${comment.content}</p>--}}
    {{--                    </div>--}}
    {{--                `;--}}
    {{--                    });--}}
    {{--                    $('#commentsList').html(commentsHtml);--}}
    {{--                }--}}
    {{--            },--}}
    {{--            error: function(xhr) {--}}
    {{--                console.log(xhr.responseText);--}}
    {{--            }--}}
    {{--        });--}}
    {{--    }--}}
    {{--});--}}

</script>
