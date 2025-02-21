@include('admin.index')

@include('admin.header')
@include('Error.login')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 style="color: white;" class="heading-section">Tài Khoản</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr>

                            <th>Tên đăng nhập</th>
                            <th>Email</th>
                            <th>Pasworld</th>
                            <th>Quyền hạn</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>*********</td>
                                <td>{{ $user->role->name_role }}</td>

                                <td>{{ $user->created_at }}</td>

                                <td>
                                    <a href="{{ route('account.edit', ['id' => $user->id]) }}">Cập nhật</a>
                                    <form action="{{route('account.delete',$user->id)}}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: red; text-decoration: underline; cursor: pointer;">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @csrf
                </div>
            </div>
        </div>
    </div>
</section>


