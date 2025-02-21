@include('index')
@include('header')

<div class="menu-conten" >
    <div class="login-page">
        <div class="form">
            <h3>Đăng Ký</h3>
            <form id="formdangky" class="login-form"  action="{{route('register.store')}}" method="post" >
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Nhập tên đăng nhập" autocomplete = "off">
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="Nhập Email " autocomplete = "off">
                <input type="password" id="password" name="password" class="form-control" required placeholder="Nhập Mật khẩu" autocomplete = "off">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Nhập lại mật khẩu" autocomplete = "off">
                <button type="submit" name="dangnhap" id="dangnhap">Đăng Ký</button>
                <p id="result"></p>
                @csrf
            </form>
            @include('Error.login')
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('#dangnhap').addEventListener('click', function (event) {
            let isValid = checkvalidate();
            if (!isValid) {
                event.preventDefault();
            }
        });

    });
    function checkvalidate() {
        let isCheck = true;
        let username = document.querySelector('#ten').value;
        let password = document.querySelector('#password').value;
        let rpassword = document.querySelector('#r-password').value;

        if (username === "") {
            document.querySelector('#result').innerHTML = "Tên đăng nhập không để trống";
            document.querySelector('#ten').focus();
            return false;
        } else if (username.length <= 6) {
            document.querySelector('#result').innerHTML = "Tên đăng nhập phải hơn 6 ký tự";
            document.querySelector('#ten').focus();
            return false;
        }else if(username.includes(' ')){
            document.querySelector('#result').innerHTML = "Tên đăng nhập không được chứa khoảng trắng";
            document.querySelector('#ten').focus();
            return false;
        }else if (document.querySelector('#email').value === "") {
            document.querySelector('#result').innerHTML = "Nhập email";
            document.querySelector('#email').focus();
            return false;
        } else {
            var email = document.querySelector("#email").value;
            var regExp = /\S+@\S+\.\S+/;
            if (!regExp.test(email)) {
                document.querySelector('#result').innerHTML = "Email không hợp lệ!";
                document.querySelector('#email').focus();
                return false;
            }
        }
        if (password === "") {
            // Kiểm tra mật khẩu không để trống
            document.querySelector('#result').innerHTML = "Password không để trống";
            document.querySelector('#password').focus();
            return false;
        } else if (password.length < 6) {
            // Kiểm tra độ dài mật khẩu (hơn 6 ký tự)
            document.querySelector('#result').innerHTML = "Mật khẩu phải có ít nhất 6 ký tự";
            document.querySelector('#password').focus();
            return false;
        } else if (!/[A-Z]/.test(password)) {
            // Kiểm tra xem mật khẩu có chứa ít nhất một chữ in hoa hay không
            document.querySelector('#result').innerHTML = "Mật khẩu phải chứa ít nhất một chữ in hoa";
            document.querySelector('#password').focus();
            return false;
        } else if (rpassword === "") {
            // Kiểm tra xác nhận mật khẩu không để trống
            document.querySelector('#result').innerHTML = "Nhập lại mật khẩu";
            document.querySelector('#r-password').focus();
            return false;
        } else if (password !== rpassword) {
            // Kiểm tra xem mật khẩu và xác nhận mật khẩu có trùng khớp không
            document.querySelector('#result').innerHTML = "Mật khẩu không trùng nhau";
            return false;
        }
        return isCheck;

    }

</script>
