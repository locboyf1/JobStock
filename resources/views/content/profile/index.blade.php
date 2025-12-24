@extends('content.layout')
@section('title', 'Thông tin tài khoản')
@section('content')
    <!-- Title Header Start -->
    <section class="inner-header-title" style="background-image:url(assets/img/banner-10.jpg);">
        <div class="container">
            <h1>Thông tin tài khoản</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- Candidate Profile Start -->


    <section class="full-detail-description full-detail gray-bg">
        <div class="container">
            <div class="col-md-12 col-sm-12">
                <div class="full-card">
                    <div class="deatil-tab-employ tool-tab">
                        <ul class="nav simple nav-tabs" id="simple-design-tab">
                            <li class="active"><a href="#settings">Sửa thông tin</a></li>
                            <li><a href="#changepassword" id="change-password-btn">Đổi mật khẩu</a></li>
                        </ul>

                        <!-- Start All Sec -->
                        <div class="tab-content">
                            <div id="settings" class="tab-pane fade in active">
                                <div class="row no-mrg">
                                    <h3>Sửa thông tin</h3>
                                    <form class="edit-pro" action="{{ route('profile.update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-6 col-sm-6">
                                            <label>Họ tên</label>
                                            <input type="text" class="form-control" placeholder="Nhập họ và tên của bạn"
                                                value="{{ $user->name }}" name="name">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>Số điện thoại</label>
                                            <input type="text" class="form-control" name="phone"
                                                placeholder="Nhập số điện thoại của bạn" value="{{ $user->phone }}">
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>Đổi ảnh đại diện</label>
                                            <input type="file" name="avatar" accept="image/*" />
                                            @error('avatar')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>Ảnh đại diện đang dùng</label>
                                            <img src="{{ asset('storage/' . $user->avatarPath) }}" name="avatar"
                                                width="150px" height="150px" alt="Ảnh đại diện">
                                        </div>
                                        <div class="col-sm-12">
                                            <button type="submit" class="update-btn">Lưu lại</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End About Sec -->

                            <!-- Start Settings -->
                            <div id="changepassword" class="tab-pane fade">
                                <form class="row no-mrg" action="{{ route('profile.change-password') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <h3>Đổi mật khẩu</h3>
                                    <div class="edit-pro">
                                        <div class="col-md-4 col-sm-6">
                                            <label>Mật khẩu cũ</label>
                                            <input type="password" class="form-control" placeholder="*********"
                                                name="old_password">
                                            @error('old_password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label>Mật khẩu mới</label>
                                            <input type="password" class="form-control" placeholder="*********"
                                                name="password">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label>Xác nhận mật khẩu</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="*********">
                                            @error('password_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12">
                                            <button type="submit" class="update-btn">Đổi ngay</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End Settings -->
                        </div>
                        <!-- Start All Sec -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Candidate Profile End -->

    @if ($errors->has('password') || $errors->has('password_confirmation') || $errors->has('old_password'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const changePasswordBtn = document.getElementById('change-password-btn');
                changePasswordBtn.click();
            });
        </script>
    @endif

@endsection
