<!doctype html>
<html lang="en">

<head>
    <title>Job Stock - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('assets/plugins/css/plugins.css') }}">

    <link rel="stylesheet" href="{{ asset('admins/assets/bundles/izitoast/css/iziToast.min.css') }}">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" id="jssDefault" href="{{ asset('assets/css/colors/green-style.css') }}">

</head>

<body class="simple-bg-screen" style="background-image:url('{{ asset('assets/img/banner-10.jpg') }}');">
    <div class="Loader"></div>
    <div class="wrapper">

        <section class="login-screen-sec">
            <div class="container">
                @yield('content')
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
        <script src="{{ asset('assets/bundles/izitoast/js/iziToast.min.js') }}"></script>

        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="{{ asset('assets/js/jQuery.style.switcher.js') }}"></script>

        <script>
            @if (session()->has('success'))
                iziToast.success({
                    title: 'Thành công',
                    message: '{{ session()->get('success') }}',
                    position: 'topRight'
                });
            @endif

            @if (session()->has('error'))
                iziToast.error({
                    title: 'Thất bại',
                    message: '{{ session()->get('error') }}',
                    position: 'topRight'
                });
            @endif

            @if (session()->has('warning'))
                iziToast.warning({
                    title: 'Cảnh báo',
                    message: '{{ session()->get('warning') }}',
                    position: 'topRight'
                });
            @endif

            @if (session()->has('info'))
                iziToast.info({
                    title: 'Thông báo',
                    message: '{{ session()->get('info') }}',
                    position: 'topRight'
                });
            @endif
        </script>
    </div>
</body>

</html>
