@include('admin.index')
@include('admin.header')
<section class="ftco-section">
    <div class="container">
        <form id="formsuathongtin" action="{{route('account.update',$users->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 style="color: white;" class="heading-section">Cập nhập thông tin</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Tên Đăng nhập</td>
                                <th><input readonly id="tendangnhap" type="text" name="tendangnhap"
                                           value="{{$users->name}}"></th>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <th><input id="email" type="text" name="email" value="{{$users->email}}">
                                </th>
                                <input id="idnguoidung" value="100" type="hidden">
                            </tr>
                            <tr>
                                <td>Password</td>
                                <th><input id="passwordField" type="password" name="password" value=""><br>
                                    <input type="checkbox" id="showPassword">
                                    <label for="showPassword">Hiển thị mật khẩu</label>
                                </th>
                            </tr>
                            <tr>
                                <td>Quyền hạn</td>
                                <th>
                                    <select id="ten_quyen" name="ten_quyen">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $users->role_id == $role->id ? 'selected' : '' }}>{{$role->name_role}}</option>
                                            @endforeach
                                    </select>
                                </th>
                            </tr>

                            </tbody>
                        </table>
                        <p id="resultsua" style="color:red;"></p>
                        <input id="suanguoidung" type="submit" name="suanguoidung" value="Cập Nhập">
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('Error.login')

</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        showPass();

    });

    function showPass(){
        const passwordField = document.querySelector('#passwordField');
        const showPassword = document.querySelector('#showPassword');

        showPassword.addEventListener('change', function () {
            if (showPassword.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    }
</script>
