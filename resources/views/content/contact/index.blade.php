@extends('content.layout')
@section('title', 'Liên hệ')
@section('content')
    <section class="inner-header-title" style="background-image:url(assets/img/banner-10.jpg);">
        <div class="container">
            <h1>Liên hệ</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- Contact Page Section Start -->
    <section class="contact-page">
        <div class="container">
            <h2>Liên hệ với chúng tôi</h2>

            <div class="col-md-4 col-sm-4">
                <div class="contact-box">
                    <i class="fa fa-map-marker"></i>
                    <p>#Street 2122, Near New Market<br>London Uk (122546)</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="contact-box">
                    <i class="fa fa-envelope"></i>
                    <p>careerdesk12@gmail.com<br>support@careerdesk.com</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="contact-box">
                    <i class="fa fa-phone"></i>
                    <p>UK: 01 123 456 7895<br>Ind: +91 123 546 8758</p>
                </div>
            </div>

        </div>
    </section>
    <!-- contact section End -->

    <!-- contact form -->
    <section class="contact-form">
        <div class="container">
            <h2>Liên hệ</h2>
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="col-md-6 col-sm-6">
                    <input type="text" class="form-control" name="name" placeholder="Tên của bạn">
                </div>

                <div class="col-md-6 col-sm-6">
                    <input type="email" class="form-control" name="email" placeholder="Email của bạn">
                </div>

                <div class="col-md-6 col-sm-6">
                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại">
                </div>

                <div class="col-md-6 col-sm-6">
                    <input type="text" class="form-control" name="subject" placeholder="Tiêu đề">
                </div>

                <div class="col-md-12 col-sm-12">
                    <textarea class="form-control" name="message" placeholder="Nội dung"></textarea>
                </div>

                <div class="col-md-12 col-sm-12">
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </div>
            </form>
        </div>
    </section>
    <!-- Contact form End -->

@endsection
