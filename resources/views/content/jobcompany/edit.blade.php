@extends('content.layout')

@section('content')
    <section class="inner-header-title blank">
        <div class="container">
            <h1>Sửa tin tuyển dụng</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Header Title End -->
    <form action="{{ route('company.job.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="job_id" value="{{ $post->job_company_id }}">
        <input type="hidden" name="job_type_id" value="{{ $post->job_type_id }}">
        <!-- General Detail Start -->
        <div class="detail-desc section">
            <div class="container white-shadow">

                <div class="row">
                    <div class="detail-pic js">
                        <div class="box">
                            <img src="{{ asset('storage/' . $post->company->logo) }}" alt="">
                        </div>
                    </div>
                </div>

                <div class="row bottom-mrg">
                    <div class="add-feild">
                        <div class="col-md-12 col-sm-12">
                            <div class="input-group">
                                <input type="text" name="title" class="form-control" value="{{ $post->title }}"
                                    placeholder="Tiêu đề">
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <textarea name="description" class="form-control" placeholder="Mô tả">{{ $post->description }}</textarea>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- General Detail End -->
        <!-- Basic Full Detail Form Start -->
        <section class="full-detail">
            <div class="container">
                <div class="row bottom-mrg extra-mrg">
                    <div>
                        <h2 class="detail-title">Company Information</h2>

                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <input type="number" class="form-control" placeholder="Số lượng tuyển" name="quantity"
                                    value="{{ $post->quantity }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                <input type="text" class="form-control" name="tags" value="{{ $tags }}"
                                    placeholder="Nhãn (Cách nhau bởi dấu phẩy)">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="number" class="form-control" name="salary_min"
                                    value="{{ $post->salary_min }}" placeholder="Lương tối thiểu (Đơn vị: triệu VND)">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-chevron-circle-up"></i></span>
                                <input type="number" class="form-control" name="experience"
                                    value="{{ $post->experience }}" placeholder="Năm kinh nghiệm">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="number" value="{{ $post->salary_max }}" name="salary_max"
                                    class="form-control" placeholder="Lương tối đa (Đơn vị: triệu VND, có thể trống)">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                <input type="text" id="company-dob" data-lang="vi" data-large-mode="true"
                                    data-theme="my-style" class="form-control" readonly="" name="expired_time"
                                    value="{{ \Carbon\Carbon::parse($post->expired_time)->format('m/d/Y') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @error('quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @error('salary_min')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @error('salary_max')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @error('expired_time')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @error('experience')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row bottom-mrg extra-mrg">
                    <div>
                        <h2 class="detail-title">Nội dung bài tuyển dụng</h2>
                        <div id="content-list"></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <a href="#" id="btn-add-section" class="btn btn-primary">Thêm khối nội dung</a>
                        </div>
                    </div>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row bottom-mrg extra-mrg">
                    <div class="col-md-12 col-sm-12">
                        <button class="btn btn-success btn-primary small-btn">Đăng tải bài tuyển dụng</button>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <!-- Basic Full Detail Form End -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#company-dob').dateDropper({
                format: 'd/m/Y',
                lang: 'vi'
            });
        });
    </script>
    <script>
        window.jobContentData = @json($post->content);
    </script>
    <script src="{{ asset('assets/js/jobCompanyCreate.js') }}"></script>
@endsection
