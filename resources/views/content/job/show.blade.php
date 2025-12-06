@extends('content.layout')
@section('title', $post->title)

@section('content')
    <div class="clearfix"></div>

    <!-- Title Header Start -->
    <section class="inner-header-title" style="background-image:url({{ asset('assets/img/banner-10.jpg') }});">
        <div class="container">
            <h1>Job Detail</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- Job Detail Start -->
    <section class="detail-desc">
        <div class="container white-shadow">

            <div class="row">

                <div class="detail-pic">
                    <img src="{{ asset('storage/' . $post->company->logo) }}" class="img" alt="" />
                </div>

                <div class="detail-status">
                    <span>2 Days Ago</span>
                </div>

            </div>

            <div class="row bottom-mrg">
                <div class="col-md-8 col-sm-8">
                    <div class="detail-desc-caption">
                        <h4>{{ $post->title }}</a></h4>
                        <span class="designation">Công ty: {{ $post->company->title }}</span>
                        <p>{{ $post->description }}</p>
                        <ul>
                            <li><i class="fa fa-briefcase"></i><span>{{ $post->jobType->name }}</span></li>
                            <li><i
                                    class="fa fa-flask"></i><span>{{ $post->experience == 0 ? 'Không yêu cầu kinh nghiệm' : $post->experience . ' năm kinh nghiệm' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="get-touch">
                        <h4>Liên lạc</h4>
                        <ul>
                            <li><i class="fa fa-map-marker"></i><span>{{ $post->company->address }}</span></li>
                            <li><i class="fa fa-envelope"></i><span>{{ $post->company->email }}</span></li>
                            @if ($post->company->website != null)
                                <li><a href="{{ $post->company->website }}"><i
                                            class="fa fa-globe"></i><span>{{ $post->company->website }}</span></a></li>
                            @endif
                            <li><i class="fa fa-phone"></i><span>{{ $post->company->phone }}</span></li>
                            <li><i
                                    class="fa fa-money"></i><span>{{ $post->salary_max ? $post->salary_min . ' - ' . $post->salary_max . ' triệu' : 'Từ ' . $post->salary_min . ' triệu' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="row no-padd">
                <div class="detail pannel-footer">
                    <div class="col-md-5 col-sm-5">
                        <ul class="detail-footer-social">
                            @if ($post->company->facebook != null)
                                <li><a href="{{ $post->company->facebook }}"><i class="fa fa-facebook"></i></a></li>
                            @endif
                            @if ($post->company->twitter != null)
                                <li><a href="{{ $post->company->twitter }}"><i class="fa fa-twitter"></i></a></li>
                            @endif
                            @if ($post->company->instagram != null)
                                <li><a href="{{ $post->company->instagram }}"><i class="fa fa-instagram"></i></a></li>
                            @endif
                            @if ($post->company->linkedin != null)
                                <li><a href="{{ $post->company->linkedin }}"><i class="fa fa-linkedin"></i></a></li>
                            @endif
                            @if ($post->company->wikipedia != null)
                                <li><a href="{{ $post->company->wikipedia }}"><i class="fa fa-wikipedia-w"></i></a></li>
                            @endif
                        </ul>
                    </div>

                    <div class="col-md-7 col-sm-7">
                        <div class="detail-pannel-footer-btn pull-right">
                            @if (Auth::check() && Auth::user()->role->alias == config('account.ROLE_USER'))
                                <a href="#" class="footer-btn grn-btn" title="">Ứng tuyển</a>
                            @endif
                            <a href="#" class="footer-btn btn-danger" title="">Tố cáo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Job Detail End -->

    <!-- Job full detail Start -->
    <section class="full-detail-description full-detail">
        <div class="container">
            @foreach ($post->content as $block)
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
    <!-- Job full detail End -->

@endsection
