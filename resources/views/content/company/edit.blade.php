@extends('content.layout')

@section('title', 'Sửa thông tin Tài khoản Công ty')

@section('content')

    <div class="simple-banner" style="background-image:url('{{ asset('assets/img/banner-10.jpg') }}'); height: 500px;">
        <div class="container">
            <div class="simple-banner-caption">
                <div class="col-md-12 col-sm-12 banner-text">
                    <h2 style="color: white; text-align: center; padding: 40px 0;">Sửa thông tin công ty
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
                            <h3 class="panel-title"><i class="fa fa-file-text-o"></i> Điều khoản & Xác minh thay đổi
                            </h3>
                        </div>

                        <div class="panel-body">

                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-triangle"></i> <strong>Lưu ý quan trọng:</strong>
                                <p>Việc thay đổi thông tin sẽ cần <strong>được jobstock xét duyệt</strong>. Công ty sẽ không
                                    thể có động thái mới trong một thời gian.
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

                            <form action="{{ route('company.update', ['id' => $company->id]) }}" method="POST" enctype="multipart/form-data"
                                novalidate>
                                @csrf
                                @method('PUT')

                                <h4>2. Thông tin xác minh</h4>
                                <p class="text-muted">Vui lòng cung cấp thông tin chính xác để quá trình duyệt diễn ra nhanh
                                    chóng.</p>

                                <div class="form-group @error('tax_code') has-error @enderror">
                                    <label for="tax_code">Mã số thuế (MST) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tax_code"
                                        placeholder="Ví dụ: 0101234567" value="{{ $company->tax_code }}">
                                    @error('tax_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('confirm_updated_image') has-error @enderror">
                                    <label for="confirm_updated_image">Ảnh chụp Giấy tờ chứng minh thông tin doanh nghiệp đã
                                        được thay đổi<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="confirm_updated_image"
                                        name="confirm_updated_image" accept="image/*" required>
                                    @error('confirm_updated_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr>

                                <h4>3. Thông tin công ty</h4>

                                <div class="form-group @error('title') has-error @enderror">
                                    <label for="title">Tên công ty <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title"
                                        placeholder="Ví dụ: Công ty TNHH Tạ Quang Lộc" value="{{ $company->title }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('description') has-error @enderror">
                                    <label for="description">Mô tả hoặc lời giới thiệu <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" type="text" class="form-control" name="description"
                                        placeholder="Ví dụ: Công ty TNHH Tạ Quang Lộc chuyên cung cấp dịch vụ ..., đạt thành tích ..., xin chào mừng các ứng viên."
                                        required>{{ $company->description }}</textarea>
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
                                        placeholder="Ví dụ: quangloc@fgc.vn" value="{{ $company->email }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('phone') has-error @enderror">
                                    <label for="phone">Hotline <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone"
                                        placeholder="Ví dụ: 0123456789" value="{{ $company->phone }}">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('province_id') has-error @enderror">
                                    <label>Tỉnh / Thành phố <span class="text-danger">*</span></label>

                                    <select class="form-control" name="province_id" required>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province['code'] }}"
                                                {{ $company->province_id == $province['code'] ? 'selected' : '' }}>
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
                                        value="{{ $company->address }}">
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_show" {{ $company->is_show ? 'checked' : '' }}>
                                        Hiển
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
                                        placeholder="Ví dụ: taquangloc.com" value="{{ $company->website }}">
                                    @error('website')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('shop') has-error @enderror">
                                    <label for="shop">Website cửa hàng</label>
                                    <input type="text" class="form-control" name="shop"
                                        placeholder="Ví dụ: taquangloc.com/shop" value="{{ $company->shop }}">
                                    @error('shop')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('facebook') has-error @enderror">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" name="facebook"
                                        placeholder="Ví dụ: https://www.facebook.com/daihocvinh182leduan"
                                        value="{{ $company->facebook }}">
                                    @error('facebook')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('pinterest') has-error @enderror">
                                    <label for="pinterest">Pinterest</label>
                                    <input type="text" class="form-control" name="pinterest"
                                        placeholder="Ví dụ: https://www.pinterest.com/taquangloc123"
                                        value="{{ $company->pinterest }}">
                                    @error('pinterest')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('youtube') has-error @enderror">
                                    <label for="youtube">Youtube</label>
                                    <input type="text" class="form-control" name="youtube"
                                        placeholder="Ví dụ: https://www.youtube.com/@taquangloc"
                                        value="{{ $company->youtube }}">
                                    @error('youtube')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group @error('wikipedia') has-error @enderror">
                                    <label for="wikipedia">Wikipedia</label>
                                    <input type="text" class="form-control" name="wikipedia"
                                        placeholder="Ví dụ: https://vi.wikipedia.org/wiki/congtytaquangloc"
                                        value="{{ $company->wikipedia }}">
                                    @error('wikipedia')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('linkedin') has-error @enderror">
                                    <label for="linkedin">LinkedIn</label>
                                    <input type="text" class="form-control" name="linkedin"
                                        placeholder="Ví dụ: https://www.linkedin.com/company/taquangloc/"
                                        value="{{ $company->linkedin }}">
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
        window.companyContentData = @json($company->content);
    </script>

    <script src="{{ asset('assets/js/termsData.js') }}"></script>
@endsection
