@extends('content.layout')
@section('title', 'Quản lý tuyển dụng công ty')

@section('content')
    <!-- Title Header Start -->
    <section class="inner-header-title" style="background-image:url({{ asset('assets/img/banner-10.jpg') }});">
        <div class="container">
            <h1>Danh sách lần tuyển dụng</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- Manage Resume 2 List Start -->
    <section class="manage-resume gray">
        <div class="container">

            <!-- search filter -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="search-filter">

                        <div class="col-md-4 col-sm-5">
                            <div class="filter-form">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search…">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default">Go</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-7">
                            <div class="short-by pull-right">
                                <a href="{{ route('company.job.create') }}" class="btn btn-primary">Thêm mới</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- search filter End -->

            <div class="row">
                @foreach ($jobs as $job)
                    <div class="col-md-6 col-sm-6">
                        <div class="manage-resume-box">
                            <div class="col-md-11 col-sm-11">
                                <h4>{{ $job->title }}</h4>
                                <hr>
                                <p>{{ $job->description }}</p>
                                <p>{{ $job->address }}</p>
                                <p>{{ $job->jobType->name }}</p>
                            </div>
                            <div class="col-md-1 col-sm-1">
                                <a href="{{ route('company.job.edit', $job->id) }}"><i class="fa fa-pencil"
                                        aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

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
    <!-- Manage Resume 2 List End -->
@endsection
