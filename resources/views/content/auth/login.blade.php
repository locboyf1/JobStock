<!doctype html>
<html lang="en">

<head>
    <title>Job Stock - Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('assets/plugins/css/plugins.css') }}">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" id="jssDefault" href="{{ asset('assets/css/colors/green-style.css') }}">

</head>

<body class="simple-bg-screen" style="background-image:url('{{ asset('assets/img/banner-10.jpg') }}');">
    <div class="Loader"></div>
    <div class="wrapper">

        <section class="login-screen-sec">
            <div class="container">
                <div class="login-screen">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" class="img-responsive"
                            alt=""></a>
                    <form action="{{ route('postLogin') }}" method="post" novalidate>
                        @csrf
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <button class="btn btn-login" type="submit">Đăng nhập</button>
                        <span>Bạn chưa có tài khoản? <a href="{{ route('register') }}"> Tạo mới ngay</a></span>
                        <span><a href="lost-password.html"> Forget Password</a></span>
                    </form>
                </div>
            </div>
        </section>

        <script type="text/javascript" src="{{ asset('assets/plugins/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/js/viewportchecker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/js/bootsnav.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/js/select2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/js/wysihtml5-0.3.0.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/js/bootstrap-wysihtml5.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/js/datedropper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/js/dropzone.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/js/loader.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/js/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/js/slick.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/js/gmap3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/js/jquery.easy-autocomplete.min.js') }}"></script>

        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="{{ asset('assets/js/jQuery.style.switcher.js') }}"></script>
    </div>
</body>

</html>
