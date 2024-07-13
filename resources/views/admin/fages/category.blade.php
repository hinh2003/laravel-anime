@include('admin.index')
@include('admin.header')

<section class="ftco-section">
    <div class="container">
        <form id="themtheloai" method="post" enctype="multipart/form-data" action="{{ route('movies.category.store') }}">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 style="color: white;" class="heading-section">Thêm Thể Loại</h2><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Tên Thể Loại</td>
                                <th><input type="text" name="name_category" id="name_category"></th>
                            </tr>
                            <tr>
                                <td>Miêu tả</td>
                                <th><input type="text" id="description" name="description"></th>
                            </tr>
                            </tbody>
                        </table>
                        <p style="color: red;" id="resultthemtheloai"></p>
                        <input type="submit" id="themtheloai" name="themtheloai" value="Thêm">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
    <br>
    @include('Error.login')

</section>
