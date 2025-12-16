@extends('content.layout')

@section('title', $company->title)
@section('content')
    <!-- Title Header Start -->
    <section class="inner-header-title" style="background-image:url({{ asset('assets/img/banner-10.jpg') }});">
        <div class="container">
            <h1>Thông tin công ty</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- Company Detail Start -->
    <section class="detail-desc">
        <div class="container white-shadow">

            <div class="row">
                <div class="detail-pic">
                    <img src="{{ asset('storage/' . $company->logo) }}" class="img" alt="" />
                </div>
            </div>

            <div class="row bottom-mrg">

                <div class="col-md-8 col-sm-8">
                    <div class="detail-desc-caption">
                        <h4>{{ $company->title }}</h4>
                        <p>{{ $company->description }}</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="get-touch">
                        <h4>Liên lạc</h4>
                        <ul>
                            <li><i class="fa fa-map-marker"></i><span>{{ $company->address . ' | ' . $provinceName }}</span>
                            </li>
                            <li><i class="fa fa-envelope"></i><span>{{ $company->email }}</span></li>
                            <li><i class="fa fa-phone"></i><span>{{ $company->phone }}</span></li>
                            @if ($company->website != null)
                                <li><i class="fa fa-globe"></i><span><a
                                            href="{{ $company->website }}">{{ $company->website }}</a></span></li>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>

            <div class="row no-padd">
                <div class="detail pannel-footer">

                    <div class="col-md-5 col-sm-5">
                        <ul class="detail-footer-social">
                            @if ($company->shop != null)
                                <li><a href="{{ $company->shop }}"><i class="fa fa-shopping-bag"></i></a></li>
                            @endif
                            @if ($company->facebook != null)
                                <li><a href="{{ $company->facebook }}"><i class="fa fa-facebook"></i></a></li>
                            @endif
                            @if ($company->pinterest != null)
                                <li><a href="{{ $company->pinterest }}"><i class="fa fa-pinterest"></i></a></li>
                            @endif
                            @if ($company->youtube != null)
                                <li><a href="{{ $company->youtube }}"><i class="fa fa-youtube"></i></a></li>
                            @endif
                            @if ($company->linkedin != null)
                                <li><a href="{{ $company->linkedin }}"><i class="fa fa-linkedin"></i></a></li>
                            @endif
                            @if ($company->wikipedia != null)
                                <li><a href="{{ $company->wikipedia }}"><i class="fa fa-wikipedia-w"></i></a></li>
                            @endif
                        </ul>
                    </div>

                    <div class="col-md-7 col-sm-7">
                        <div class="detail-pannel-footer-btn pull-right">
                            <a href="#" class="footer-btn grn-btn" title="">Yêu thích</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- Company Detail End -->

    @if ($posts->isNotEmpty())
        <section style="padding: 0 !important">
            <div class="container">
                <div class="row">
                    <div class="main-heading">
                        <h2><span>{{ $company->title }}</span> đang tuyển dụng</h2>
                    </div>
                </div>
                <div class="row extra-mrg">
                    @foreach ($posts as $post)
                        <div class="col-md-3 col-sm-6">
                            <div class="grid-view brows-job-list" style="height: 350px">
                                <div class="brows-job-company-img"><img
                                        src="{{ asset('storage/' . $post->company->logo) }}" class="img-responsive"
                                        alt="" /></div>
                                <div class="brows-job-position">
                                    <h4><a href="{{ route('job.show', $post->id) }}">{{ $post->title }}</a></h4>

                                    <p><span>{{ $post->company->title }}</span></p>
                                </div>
                                <div class="job-position"><span class="job-num">Số lượng tuyển:
                                        {{ $post->quantity }}</span>
                                </div>
                                <div class="brows-job-type"><span class="enternship">{{ $post->jobType->name }}</span>
                                </div>
                                <ul class="grid-view-caption" style="position: absolute; bottom: 0px">
                                    <li>
                                        <div class="brows-job-location">
                                            <p><i class="fa fa-map-marker"></i>
                                                {{ functions::getProvinceName($post->company->province_id) }}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <p><span class="brows-job-sallery"><i
                                                    class="fa fa-money"></i>{{ $post->salary_max ? $post->salary_min . ' - ' . $post->salary_max : 'Từ ' . $post->salary_min }}
                                                Triệu</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- company full detail Start -->
    <section class="full-detail-description full-detail">
        <div class="container">
            @foreach ($company->content as $block)
                <div class="row row-bottom">
                    <h2 class="detail-title">{{ $block['title'] }}</h2>
                    <p>{{ $block['description'] }}</p>
                    <ul class="detail-list">
                        @foreach ($block['row_content'] as $row)
                            <li>{{ $row }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </section>
    <!-- company full detail End -->
@endsection
