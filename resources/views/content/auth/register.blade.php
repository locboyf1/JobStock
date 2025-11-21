<!doctype html>
<html lang="en">

<!-- signup42:17-->

<head>
    <title>Job Stock - Đăng ký</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('assets/plugins/css/plugins.css') }}">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" id="jssDefault" href="{{ asset('assets/css/colors/green-style.css') }}">

</head>

<body class="simple-bg-screen" style="background-image:url(assets/img/banner-10.jpg);">
    <div class="Loader"></div>
    <div class="wrapper">

        <!-- Title Header Start -->
        <section class="signup-screen-sec">
            <div class="container">
                <div class="signup-screen">
                    <a href="{{route('home')}}"><img src="{{ asset('assets/img/logo.png') }}" class="img-responsive"
                            alt=""></a>
                    <form action="{{ route('postRegister') }}" method="post" novalidate>
                        @csrf
                        <input type="text" class="form-control" placeholder="Tên bạn" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="email" class="form-control" placeholder="Email đăng nhập" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
						<input type="text" class="form-control" placeholder="Số điện thoại" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu">
                        <button class="btn btn-login" type="submit">Đăng ký</button>
                        <span>Bạn đã có tài khoản? <a href="{{ route('login') }}"> Đăng nhập</a></span>
                    </form>
                </div>
            </div>
        </section>


        <!-- Scripts
   ================================================== -->
        <script type="text/javascript" src="assets/plugins/js/jquery.min.js"></script>
        <script type="text/javascript" src="assets/plugins/js/viewportchecker.js"></script>
        <script type="text/javascript" src="assets/plugins/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/plugins/js/bootsnav.js"></script>
        <script type="text/javascript" src="assets/plugins/js/select2.min.js"></script>
        <script type="text/javascript" src="assets/plugins/js/wysihtml5-0.3.0.js"></script>
        <script type="text/javascript" src="assets/plugins/js/bootstrap-wysihtml5.js"></script>
        <script type="text/javascript" src="assets/plugins/js/datedropper.min.js"></script>
        <script type="text/javascript" src="assets/plugins/js/dropzone.js"></script>
        <script type="text/javascript" src="assets/plugins/js/loader.js"></script>
        <script type="text/javascript" src="assets/plugins/js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="assets/plugins/js/slick.min.js"></script>
        <script type="text/javascript" src="assets/plugins/js/gmap3.min.js"></script>
        <script type="text/javascript" src="assets/plugins/js/jquery.easy-autocomplete.min.js"></script>
    </div>
</body>

<!-- signup42:17-->

</html>
