@extends('content.layout')

@section('content')
    <section class="inner-header-title blank">
        <div class="container">
            <h1>Đăng tin tuyển dụng</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Header Title End -->
    <form action="{{ route('company.job.store') }}" method="POST">
        @csrf
        <!-- General Detail Start -->
        <div class="detail-desc section">
            <div class="container white-shadow">

                <div class="row">
                    <div class="detail-pic js">
                        <div class="box">
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="">
                        </div>
                    </div>
                </div>

                <div class="row bottom-mrg">
                    <div class="add-feild">
                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                    placeholder="Tiêu đề">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <select class="form-control input-lg" id="job-group-select" name="job_group_id">
                                    <option value="">Nhóm ngành</option>
                                    @foreach ($job_groups as $job_group)
                                        <option value="{{ $job_group->id }}"
                                            {{ old('job_group_id') == $job_group->id ? 'selected' : '' }}>
                                            {{ $job_group->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <select class="form-control input-lg" name="job_type_id">
                                    <option value="">Loại hình tuyển dụng</option>
                                    @foreach ($job_types as $job_type)
                                        <option value="{{ $job_type->id }}"
                                            {{ old('job_type_id') == $job_type->id ? 'selected' : '' }}>
                                            {{ $job_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <select class="form-control input-lg" id="job-select" name="job_id">
                                    <option value="">Ngành tuyển dụng</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <textarea name="description" class="form-control" placeholder="Mô tả">{{ old('description') }}</textarea>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('job_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('job_type_id')
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
                                    value="{{ old('quantity') }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                <input type="text" class="form-control" name="tags" value="{{ old('tags') }}"
                                    placeholder="Nhãn (Cách nhau bởi dấu phẩy)">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="number" class="form-control" name="salary_min"
                                    value="{{ old('salary_min') }}" placeholder="Lương tối thiểu (Đơn vị: triệu VND)">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-chevron-circle-up"></i></span>
                                <input type="number" class="form-control" name="experience"
                                    value="{{ old('experience') }}" placeholder="Năm kinh nghiệm">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="number" value="{{ old('salary_max') }}" name="salary_max"
                                    class="form-control" placeholder="Lương tối đa (Đơn vị: triệu VND, có thể trống)">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                <input type="text" id="company-dob" data-lang="vi" data-large-mode="true"
                                    data-theme="my-style" class="form-control" readonly="" name="expiredTime"
                                    value="{{ old('expiredTime') }}">
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
                    @error('expiredTime')
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
        document.addEventListener('DOMContentLoaded', function() {
            const jobId = {{ old('job_id') ? old('job_id') : 'null' }};

            const jobs = @json($jobs);
            const jobGroupSelect = document.getElementById('job-group-select');
            const jobSelect = document.getElementById('job-select');

            jobGroupSelect.addEventListener('change', function() {
                const jobGroupId = jobGroupSelect.value;
                jobSelect.innerHTML =
                    '<option value="">Chọn ngành nghề</option>';
                for (const job of jobs) {
                    if (job.job_group_id == jobGroupId) {
                        jobSelect.innerHTML +=
                            `<option value="${job.id}" ${job.id == jobId ? 'selected' : ''}>${job.title}</option>`;
                    }
                }
            });
            jobGroupSelect.dispatchEvent(new Event('change'));
        })
    </script>
    <script>
        window.jobContentData = @json(old('content', []));
    </script>
    <script src="{{ asset('assets/js/jobCompanyCreate.js') }}"></script>
@endsection
