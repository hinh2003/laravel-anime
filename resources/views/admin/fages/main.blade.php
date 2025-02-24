@include('admin.index')

@include('admin.header')
@include('Error.login')

<div class="container mt-4">
    <form id="search-form" class="mb-3">
        <div class="input-group">
            <input type="text" id="search" name="search" class="form-control" placeholder="Tìm kiếm phim...">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>

    <div id="movies-table">
        @include('admin.layout.movies_table')
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#search-form').on('submit', function (e) {
            e.preventDefault();

            let query = $('#search').val();
            $.ajax({
                url: "{{ route('movies.search') }}",
                method: "GET",
                data: {search: query},
                success: function (response) {
                    $('#movies-table').html(response.html);
                }
            });
        });

        $('#search').on('keyup', function () {
            let query = $(this).val();
            $.ajax({
                url: "{{ route('movies.search') }}",
                method: "GET",
                data: {search: query},
                success: function (response) {
                    $('#movies-table').html(response.html);
                }
            });
        });
    });

</script>


