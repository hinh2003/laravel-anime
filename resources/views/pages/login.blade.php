
@include('index')
@include('header')

<body>
<div class="menu-conten" >

    <script src="{{asset('frontend/js.js.js')}}"></script>
    <div class="login-page">
        <div class="form">
            <h3>Đăng Nhập</h3>
            <form id="formdangnhap" action="/login/store" method="post">
                <input type="text" id="name" name="name" placeholder="Tên đăng nhập" autocomplete = "off"/>
                <input type="password" id="password" name="password" placeholder="password"  />
                <button type="submit"name="dangnhap" id="dangnhap">Sign In</button>
                <p id="resultketqua"></p>
                @include('Error.login')
                <p class="message">Not registered? <a href="">Create an account</a>
                </p>
                @csrf
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector("#dangnhap").addEventListener('click', function (event) {
                let check = checkvalidateLogin();
                if (!check) {
                    event.preventDefault();
                }
            })

        });
        function checkvalidateLogin() {
            let username = document.querySelector('#name').value;
            let password = document.querySelector('#password').value;
            if (username === "") {
                document.querySelector('#resultketqua').innerHTML = "Tên đăng nhập không để trống";
                document.querySelector('#name').focus();
                return false;
            }
            if (password === "") {
                document.querySelector('#resultketqua').innerHTML = "Password không để trống";
                document.querySelector('#password').focus();
                return false;
            }
            return true;
        }

    </script>
</div>


