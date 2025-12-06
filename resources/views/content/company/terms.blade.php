@extends('content.layout')

@section('title', 'Luật Đăng ký Tài khoản Công ty')

@section('content')

    <div class="simple-banner" style="background-image:url('{{ asset('assets/img/banner-10.jpg') }}'); height: 500px;">
        <div class="container">
            <div class="simple-banner-caption">
                <div class="col-md-12 col-sm-12 banner-text">
                    <h2 style="color: white; text-align: center; padding: 40px 0;">Nâng cấp thành tài khoản Nhà tuyển dụng
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <section style="padding: 60px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-file-text-o"></i> Điều khoản & Xác minh doanh nghiệp
                            </h3>
                        </div>

                        <div class="panel-body">

                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-triangle"></i> <strong>Lưu ý quan trọng:</strong>
                                <p>Việc chuyển đổi từ Tài khoản Cá nhân sang Tài khoản Công ty là <strong>không thể đảo
                                        ngược</strong>. Bạn sẽ không thể quay lại làm ứng viên tìm việc với tài khoản này.
                                </p>
                            </div>

                            <h4>1. Quy định chung</h4>
                            <ul style="list-style-type: circle; padding-left: 20px; line-height: 1.6;">
                                <li>
                                    <strong>Thời gian duyệt:</strong> Sau khi gửi yêu cầu, chúng tôi cần <strong>2 - 3 ngày
                                        làm việc</strong> để xác thực thông tin doanh nghiệp của bạn. Trong thời gian này,
                                    bạn chưa thể đăng tin tuyển dụng.
                                </li>
                                <li>
                                    <strong>Tài khoản đăng nhập:</strong> Bạn vẫn sử dụng email và mật khẩu hiện tại để đăng
                                    nhập.
                                </li>
                                <li>
                                    <strong>Thông tin liên hệ:</strong> Số điện thoại và Email bạn điền trong hồ sơ công ty
                                    sẽ được <strong>công khai</strong> để ứng viên liên lạc. Vui lòng dùng email/SĐT phòng
                                    nhân sự, tránh dùng thông tin cá nhân riêng tư.
                                </li>
                                <li>
                                    <strong>Trách nhiệm nội dung:</strong> Công ty cam kết mọi thông tin đăng tuyển là chính
                                    xác, không lừa đảo, không thu phí ứng viên trái pháp luật. Mọi tranh chấp lao động thuộc
                                    về trách nhiệm của doanh nghiệp.
                                </li>
                                <li>
                                    <strong>Nghiêm cấm:</strong> Nghiêm cấm đăng tuyển các công việc vi phạm pháp luật, đồi
                                    trụy hoặc các hình thức đa cấp biến tướng.
                                </li>
                            </ul>

                            <hr>

                            <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data"
                                novalidate>
                                @csrf

                                <h4>2. Thông tin xác minh</h4>
                                <p class="text-muted">Vui lòng cung cấp thông tin chính xác để quá trình duyệt diễn ra nhanh
                                    chóng.</p>

                                <div class="form-group @error('tax_code') has-error @enderror">
                                    <label for="tax_code">Mã số thuế (MST) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tax_code"
                                        placeholder="Ví dụ: 0101234567" value="{{ old('tax_code') }}">
                                    @error('tax_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('confirm_image') has-error @enderror">
                                    <label for="confirm_image">Ảnh chụp Giấy phép kinh doanh / Giấy tờ chứng minh bạn có
                                        quyền sử dụng thông tin của doanh nghiệp này<span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="confirm_image" name="confirm_image"
                                        accept="image/*" required>
                                    @error('confirm_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr>

                                <h4>3. Thông tin công ty</h4>

                                <div class="form-group @error('title') has-error @enderror">
                                    <label for="title">Tên công ty <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title"
                                        placeholder="Ví dụ: Công ty TNHH Tạ Quang Lộc" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('description') has-error @enderror">
                                    <label for="description">Mô tả hoặc lời giới thiệu <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" type="text" class="form-control" name="description"
                                        placeholder="Ví dụ: Công ty TNHH Tạ Quang Lộc chuyên cung cấp dịch vụ ..., đạt thành tích ..., xin chào mừng các ứng viên."
                                        required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="logo">Logo công ty <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="logo" accept="image/*" required>
                                    @error('logo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('email') has-error @enderror">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Ví dụ: quangloc@fgc.vn" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('phone') has-error @enderror">
                                    <label for="phone">Hotline <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone"
                                        placeholder="Ví dụ: 0123456789" value="{{ old(key: 'phone') }}">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('province_id') has-error @enderror">
                                    <label>Tỉnh / Thành phố <span class="text-danger">*</span></label>

                                    <select class="form-control" name="province_id" required>
                                        <option value="">-- Chọn tỉnh thành --</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province['code'] }}"
                                                {{ old('province_id') == $province['code'] ? 'selected' : '' }}>
                                                {{ $province['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('province_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('address') has-error @enderror">
                                    <label for="address">Địa chỉ chi tiết <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address"
                                        placeholder="Ví dụ: Xã ..., đường ..., khu nhà ..., số ..."
                                        value="{{ old('address') }}">
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_show" {{ old('is_show') ? 'checked' : '' }}> Hiển
                                        thị
                                    </label>
                                </div>

                                <hr>

                                <h4>4. Nội dung chi tiết (Tùy chỉnh)</h4>
                                <p class="text-muted">Thêm các khối nội dung như: "Về chúng tôi", "Tầm nhìn", "Sứ mệnh",
                                    "Quyền lợi nhân viên"...</p>

                                <div id="content-list"></div>

                                <div class="form-group">
                                    <button type="button" class="btn btn-success btn-sm" id="btn-add-section">
                                        <i class="fa fa-plus-circle"></i> Thêm khối nội dung mới
                                    </button>
                                    @error('content')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr>

                                <h4>5. Các liên kết</h4>
                                <div class="form-group @error('website') has-error @enderror">
                                    <label for="website">Website</label>
                                    <input type="text" class="form-control" name="website"
                                        placeholder="Ví dụ: taquangloc.com" value="{{ old('website') }}">
                                    @error('website')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('shop') has-error @enderror">
                                    <label for="shop">Website cửa hàng</label>
                                    <input type="text" class="form-control" name="shop"
                                        placeholder="Ví dụ: taquangloc.com/shop" value="{{ old('shop') }}">
                                    @error('shop')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('facebook') has-error @enderror">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" name="facebook"
                                        placeholder="Ví dụ: https://www.facebook.com/daihocvinh182leduan"
                                        value="{{ old('facebook') }}">
                                    @error('facebook')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('pinterest') has-error @enderror">
                                    <label for="pinterest">Pinterest</label>
                                    <input type="text" class="form-control" name="pinterest"
                                        placeholder="Ví dụ: https://www.pinterest.com/taquangloc123"
                                        value="{{ old('pinterest') }}">
                                    @error('pinterest')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('youtube') has-error @enderror">
                                    <label for="youtube">Youtube</label>
                                    <input type="text" class="form-control" name="youtube"
                                        placeholder="Ví dụ: https://www.youtube.com/@taquangloc"
                                        value="{{ old('youtube') }}">
                                    @error('youtube')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group @error('wikipedia') has-error @enderror">
                                    <label for="wikipedia">Wikipedia</label>
                                    <input type="text" class="form-control" name="wikipedia"
                                        placeholder="Ví dụ: https://vi.wikipedia.org/wiki/congtytaquangloc"
                                        value="{{ old('wikipedia') }}">
                                    @error('wikipedia')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('linkedin') has-error @enderror">
                                    <label for="linkedin">LinkedIn</label>
                                    <input type="text" class="form-control" name="linkedin"
                                        placeholder="Ví dụ: https://www.linkedin.com/company/taquangloc/"
                                        value="{{ old('linkedin') }}">
                                    @error('linkedin')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="accept" value="1"> Tôi cam kết tôi là đại diện
                                        hợp
                                        pháp của doanh
                                        nghiệp này và đồng ý với các điều khoản trên.
                                    </label>
                                    @error('accept')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <br>

                                <div class="text-center">
                                    <a href="{{ route('home') }}" class="btn btn-default btn-lg">Hủy bỏ</a>
                                    <button type="submit" class="btn btn-primary btn-lg">Gửi hồ sơ & Nâng cấp</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
        window.companyContentData = @json(old('content', []));
    </script>

    <script src="{{ asset('assets/js/termsData.js') }}"></script>
@endsection
