@extends('content.layout')

@section('title', 'Tìm việc')

@section('content')
    <!-- Title Header Start -->
    <section class="inner-header-title" style="background-image:url(assets/img/banner-10.jpg);">
        <div class="container">
            <h1>Browse Jobs</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- ========== Begin: Brows job Category ===============  -->
    <section class="brows-job-category">
        <div class="container">
            <!-- Company Searrch Filter Start -->
            <div class="row extra-mrg bottom-search-form">
                <div class="wrap-search-filter">
                    <form class="bt-form" action="{{ route('job.index') }}" method="get">
                        <div class="col-md-4 col-sm-6"><input type="text" class="form-control"
                                placeholder="Từ khóa tìm kiếm" name="keyword" value="{{ $keyword }}">
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <select class="form-control" id="job-group-select" name="job_group_id">
                                <option value="">Chọn nhóm ngành</option>
                                @foreach ($job_groups as $job_group)
                                    <option value="{{ $job_group->id }}"
                                        {{ $job_group_id == $job_group->id ? 'selected' : '' }}>{{ $job_group->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <select class="form-control" name="job_type_id">
                                <option value="">Chọn hình thức làm việc</option>
                                @foreach ($job_types as $job_type)
                                    <option value="{{ $job_type->id }}"
                                        {{ $job_type_id == $job_type->id ? 'selected' : '' }}>{{ $job_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <select id="choose-city" class="form-control" name="province_id">
                                <option value="">Chọn tỉnh/thành phố</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province['code'] }}"
                                        {{ $province_id == $province['code'] ? 'selected' : '' }}>{{ $province['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <select class="form-control" id="job-select" name="job_id">
                                <option value="">Chọn ngành nghề</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Company Searrch Filter End -->

            <!--Browse Job In Grid-->
            <div class="row extra-mrg">
                @foreach ($posts as $post)
                    <div class="col-md-4 col-sm-6">
                        <div class="grid-view brows-job-list">
                            <div class="brows-job-company-img">
                                <img src="{{ asset('storage/' . $post->company->logo) }}" class="img-responsive"
                                    alt="" />
                            </div>
                            <div class="brows-job-position">
                                <h3><a href="{{ route('job.show', $post->id) }}">{{ $post->title }}</a></h3>
                                <p><span>{{ $post->company->title }}</span></p>
                            </div>
                            <div class="job-position">
                                <span class="job-num">Số lượng tuyển: {{ $post->quantity }}</span>
                            </div>
                            <div class="brows-job-type">
                                <span class="full-time">{{ $post->jobType->name }}</span>
                            </div>
                            <ul class="grid-view-caption">
                                <li>
                                    <div class="brows-job-location">
                                        <p><i
                                                class="fa fa-map-marker"></i>{{ functions::getProvinceName($post->company->province_id) }}
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <p><span class="brows-job-sallery"><i
                                                class="fa fa-money"></i>{{ $post->salary_max ? $post->salary_min . ' - ' . $post->salary_max . ' triệu' : 'Từ ' . $post->salary_min . ' triệu' }}</span>
                                    </p>
                                </li>
                            </ul>
                            {{-- <span class="tg-themetag tg-featuretag">Premium</span> --}}
                        </div>
                    </div>
                @endforeach
            </div>
            <!--/.Browse Job In Grid-->

            <div class="row">
                <ul class="pagination">
                    <li><a href="#">&laquo;</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#"><i class="fa fa-ellipsis-h"></i></a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>

        </div>
    </section>
    <!-- ========== Begin: Brows job Category End ===============  -->
@endsection

@section('scripts')
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
@endsection
