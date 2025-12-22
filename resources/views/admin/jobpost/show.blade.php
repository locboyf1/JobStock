@extends('admin.layout')
@section('title', 'Bài đăng tuyển: ' . $jobPost->title)
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Thông tin bài đăng tuyển</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-4 col-4 b-r">
                            <strong>Công ty đăng bài</strong>
                            <br>
                            <p class="text-muted">{{ $jobPost->company->title }}</p>
                        </div>
                        <div class="row ml-1 mr-1">
                            <div class="col-md-4 col-4 b-r">
                                <strong>Nhóm công việc</strong>
                                <br>
                                <p class="text-muted">{{ $jobPost->jobCompany->job_group->title }}</p>
                            </div>
                            <div class="col-md-4 col-4 b-r">
                                <strong>Công việc</strong>
                                <br>
                                <p class="text-muted">{{ $jobPost->jobCompany->title }}</p>
                            </div>
                            <div class="col-md-4 col-4 b-r">
                                <strong>Loại hình công việc</strong>
                                <br>
                                <p class="text-muted">{{ $jobPost->jobType->name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row ml-1 mr-1">
                            <div class="col-md-3 col-3 b-r">
                                <strong>Lương tối thiểu</strong>
                                <br>
                                <p class="text-muted">{{ $jobPost->salary_min }}</p>
                            </div>
                            <div class="col-md-3 col-3 b-r">
                                <strong>Lương tối đa</strong>
                                <br>
                                <p class="text-muted">
                                    {{ $jobPost->salary_max ? $jobPost->salary_max : 'Không có' }}
                                </p>
                            </div>
                            <div class="col-md-3 col-3 b-r">
                                <strong>Yêu cầu kinh nghiệm</strong>
                                <br>
                                <p class="text-muted">
                                    {{ $jobPost->experience != 0 ? $jobPost->experience : 'Không yêu cầu' }}
                                    năm</p>
                            </div>
                            <div class="col-md-3 col-3 b-r">
                                <strong>Số lượng tuyển</strong>
                                <br>
                                <p class="text-muted">
                                    {{ $jobPost->quantity }} người</p>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 col-12 b-r">
                            <strong>Tên bài tuyển</strong>
                            <br>
                            <p class="text-muted">{{ $jobPost->title }}</p>
                        </div>
                        <div class="col-md-12 col-12 b-r">
                            <strong>Mô tả</strong>
                            <br>
                            <p class="text-muted">{{ $jobPost->description }}</p>
                        </div>
                        @foreach ($jobPost->content as $content)
                            <div class="col-md-12 col-12 b-r">
                                <strong>{{ $content['title'] }}</strong>
                                <br>
                                <p class="text-muted">{{ $content['description'] }}</p>
                                @foreach ($content['row_content'] as $row)
                                    <p class="text-muted"> - {{ $row }}</p>
                                @endforeach
                            </div>
                        @endforeach
                        <div class="float-right mt-3">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Từ
                                chối</button>
                            <form action="{{ route('admin.jobpost.approve', ['id' => $jobPost->id]) }}"
                                style="display: inline-block;" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Duyệt</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Từ chối</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="" action="{{ route('admin.jobpost.unapprove', ['id' => $jobPost->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Lý do</label>
                            <textarea name="reason" class="form-control">{{ $jobPost->reason }}</textarea>
                        </div>
                        @error('reason')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                $('#exampleModal').modal('show');
            @endif
        });
    </script>
@endsection
