@extends('content.layout')

@section('title', 'Thông báo tài khoản')

@section('content')
    <section class="accordion">
        <div class="container">
            <div class="col-md-8 col-md-offset-2" style="padding-top: 80px;">

                <div class="panel panel-primary">

                    <div class="panel-heading">
                        <h3 class="panel-title" style="font-size: 20px; font-weight: bold;">
                            <i class="fa fa-info-circle"></i> Bạn có một lựa chọn mới
                        </h3>
                    </div>

                    <div class="panel-body" style="font-size: 16px; line-height: 1.8;">
                        <p>Bạn hiện đang sử dụng <strong>Tài khoản Cá nhân</strong>, tài khoản này được tối ưu cho việc tìm
                            kiếm và ứng tuyển việc làm.</p>

                        <hr style="margin: 20px 0;">

                        <p>Bạn có muốn nâng cấp lên <strong>Tài khoản Công ty (Nhà tuyển dụng)</strong> để bắt đầu đăng tin
                            tuyển dụng và tìm kiếm ứng viên tiềm năng không?</p>
                    </div>

                    <div class="panel-footer" style="background-color: #f9f9f9;">
                        <div class="text-right"> <a href="{{ url('/') }}" class="btn btn-default"
                                style="margin-right: 10px;">
                                <i class="fa fa-home"></i> Về trang chủ
                            </a>

                            <a href="{{ url('/company/terms') }}" class="btn btn-primary">
                                <i class="fa fa-building-o"></i> Tìm hiểu & Mở tài khoản Công ty
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    @endsection
