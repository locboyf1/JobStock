@extends('admin.layout')
@section('title', 'Báo cáo vi phạm')
@section('content')
    <style>
        .report-content img {
            max-width: 100% !important;
            height: auto !important;
        }
    </style>
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box">
                        <div class="card-body">
                            <div class="author-box-center">
                                <img alt="image" src="{{ asset('storage/' . $report->jobPost->company->logo) }}"
                                    class="rounded-circle author-box-picture" height="100" width="100">
                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <a href="#">{{ $report->jobPost->company->title }}</a>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="author-box-description">
                                    <p>
                                        {{ $report->jobPost->company->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card">
                        <div class="padding-20">
                            <div class="tab-bordered">
                                <div class="tab-pane fade show active">
                                    <h5>Thông tin tố cáo</h5>
                                    <strong>Tiêu đề tố cáo</strong>
                                    <br>
                                    <p>{{ $report->title }}</p>
                                    <div class="row">
                                        <div class="col-md-4 col-4 b-r">
                                            <strong>Tên người tố cáo</strong>
                                            <br>
                                            <p class="text-muted">{{ $report->name }}</p>
                                        </div>
                                        <div class="col-md-4 col-4 b-r">
                                            <strong>Email tố cáo</strong>
                                            <br>
                                            <p class="text-muted">{{ $report->email }}</p>
                                        </div>
                                        <div class="col-md-4 col-4 b-r">
                                            <strong>Thời gian tố cáo</strong>
                                            <br>
                                            <p class="text-muted">{{ $report->created_at->format('H:i:s d/m/Y') }}</p>
                                        </div>
                                    </div>
                                    <strong>Nội dung tố cáo</strong>
                                    <hr>
                                    <div class="report-content">{!! $report->content !!}</div>
                                    <hr>
                                    <h5>Thông tin bài đăng tuyển</h5>
                                    <div class="row">
                                        <div class="col-md-4 col-4 b-r">
                                            <strong>Nhóm công việc</strong>
                                            <br>
                                            <p class="text-muted">{{ $report->jobPost->jobCompany->job_group->title }}</p>
                                        </div>
                                        <div class="col-md-4 col-4 b-r">
                                            <strong>Công việc</strong>
                                            <br>
                                            <p class="text-muted">{{ $report->jobPost->jobCompany->title }}</p>
                                        </div>
                                        <div class="col-md-4 col-4 b-r">
                                            <strong>Loại hình công việc</strong>
                                            <br>
                                            <p class="text-muted">{{ $report->jobPost->jobType->name }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-3 b-r">
                                            <strong>Lương tối thiểu</strong>
                                            <br>
                                            <p class="text-muted">{{ $report->jobPost->salary_min }}</p>
                                        </div>
                                        <div class="col-md-3 col-3 b-r">
                                            <strong>Lương tối đa</strong>
                                            <br>
                                            <p class="text-muted">
                                                {{ $report->jobPost->salary_max ? $report->jobPost->salary_max : 'Không có' }}
                                            </p>
                                        </div>
                                        <div class="col-md-3 col-3 b-r">
                                            <strong>Yêu cầu kinh nghiệm</strong>
                                            <br>
                                            <p class="text-muted">
                                                {{ $report->jobPost->experience != 0 ? $report->jobPost->experience : 'Không yêu cầu' }}
                                                năm</p>
                                        </div>
                                        <div class="col-md-3 col-3 b-r">
                                            <strong>Số lượng tuyển</strong>
                                            <br>
                                            <p class="text-muted">
                                                {{ $report->jobPost->quantity }} người</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12 b-r">
                                        <strong>Tên bài tuyển</strong>
                                        <br>
                                        <p class="text-muted">{{ $report->jobPost->title }}</p>
                                    </div>
                                    <div class="col-md-12 col-12 b-r">
                                        <strong>Mô tả</strong>
                                        <br>
                                        <p class="text-muted">{{ $report->jobPost->description }}</p>
                                    </div>
                                    @foreach ($report->jobPost->content as $content)
                                        <div class="col-md-12 col-12 b-r">
                                            <strong>{{ $content['title'] }}</strong>
                                            <br>
                                            <p class="text-muted">{{ $content['description'] }}</p>
                                            @foreach ($content['row_content'] as $row)
                                                <p class="text-muted"> - {{ $row }}</p>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <div class="float-right mt-3">
                                    <form action="{{ route('admin.jobpostreport.unapprove', ['id' => $report->id]) }}"
                                        style="display: inline-block;" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger">Từ chối</button>
                                    </form>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">Xử lý vi phạm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Xử lý vi phạm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="" action="{{ route('admin.jobpostreport.approve', ['id' => $report->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="d-block">Chọn cách xử lý</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="process" id="xuly1"
                                    value="close_job_post" checked>
                                <label class="form-check-label" for="xuly1">
                                    Đóng bài đăng
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="process" id="xuly2"
                                    value="lock_user">
                                <label class="form-check-label" for="xuly2">
                                    Khóa tài khoản
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Xử lý</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
