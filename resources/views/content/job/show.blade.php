@extends('content.layout')
@section('title', $post->title)

@section('content')
    <div class="clearfix"></div>

    <!-- Title Header Start -->
    <section class="inner-header-title" style="background-image:url({{ asset('assets/img/banner-10.jpg') }});">
        <div class="container">
            <h1>Tin tuyển dụng</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- Job Detail Start -->
    <section class="detail-desc">
        <div class="container white-shadow">

            <div class="row">

                <div class="detail-pic">
                    <a href="{{ route('companies.show', ['id' => $post->company->id]) }}">
                        <img src="{{ asset('storage/' . $post->company->logo) }}" class="img" alt="" />
                    </a>
                </div>

                <div class="detail-status">
                    <form action="" class="form-inline">
                        <button class="btn" style="border: 1px gray solid;"><i class="fa fa-heart"></i></button>
                    </form>
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
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#reportModal"
                                class="footer-btn btn-danger">Tố cáo</a>
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

    <section style="padding: 0 !important">
        <div class="container">
            <div class="row">
                <div class="main-heading">
                    <h2><span>Những tin tuyển dụng</span> liên quan</h2>
                </div>
            </div>
            <div class="row extra-mrg">
                @foreach ($postSimilars as $postSimilar)
                    <div class="col-md-3 col-sm-6">
                        <div class="grid-view brows-job-list" style="height: 350px">
                            <div class="brows-job-company-img"><img
                                    src="{{ asset('storage/' . $postSimilar->company->logo) }}" class="img-responsive"
                                    alt="" /></div>
                            <div class="brows-job-position">
                                <h4><a href="{{ route('job.show', $postSimilar->id) }}">{{ $postSimilar->title }}</a></h4>

                                <p><span>{{ $postSimilar->company->title }}</span></p>
                            </div>
                            <div class="job-position"><span class="job-num">Số lượng tuyển:
                                    {{ $postSimilar->quantity }}</span>
                            </div>
                            <div class="brows-job-type"><span class="enternship">{{ $postSimilar->jobType->name }}</span>
                            </div>
                            <ul class="grid-view-caption" style="position: absolute; bottom: 0px">
                                <li>
                                    <div class="brows-job-location">
                                        <p><i class="fa fa-map-marker"></i>
                                            {{ functions::getProvinceName($postSimilar->company->province_id) }}</p>
                                    </div>
                                </li>
                                <li>
                                    <p><span class="brows-job-sallery"><i
                                                class="fa fa-money"></i>{{ $postSimilar->salary_max ? $postSimilar->salary_min . ' - ' . $postSimilar->salary_max : 'Từ ' . $postSimilar->salary_min }}
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
    <!-- Job full detail End -->

    <div class="modal fade" id="reportModal" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="tab">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active" style="width: 100%;"><a>Nhập thông tin tố cáo</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content" id="myModalLabel2">
                            <div role="tabpanel" class="tab-pane fade in active" id="login">
                                <div class="subscribe wow fadeInUp">
                                    <form action="{{ route('report', ['id' => $post->id]) }}" method="post" novalidate>
                                        @csrf
                                        <div class="col-sm-12">
                                            <div class="form-group">

                                                <h5>Bài đăng: {{ $post->title }}</h5>
                                                <h5>Công ty: {{ $post->company->title }}</h5>
                                                <label for="email">Email</label>
                                                <input type="email" name="email" value="{{ old('email') }}"
                                                    class="form-control" placeholder="Nhập email của bạn" required="">
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <label for="name">Tên</label>
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                    class="form-control" placeholder="Tên của bạn" required="">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <label for="title">Tiêu đề tố cáo</label>
                                                <input type="text" name="title" value="{{ old('title') }}"
                                                    class="form-control" placeholder="Tiêu đề tố cáo" required="">
                                                @error('title')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <label for="content">Nội dung tố cáo</label>
                                                <textarea name="content" id="content" class="summernote" placeholder="Nội dung tố cáo" required="">{{ old('content') }}</textarea>
                                                @error('content')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="center">
                                                    <button type="submit" id="login-btn" class="submit-btn"> Gửi tố cáo
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.summernote').summernote({
                dialogsInBody: true,
                minHeight: 200,
                toolbar: [
                    ["style", ["bold", "italic", "underline"]],
                    ['insert', ['link', 'picture', 'video']],
                    ['table', ['table']],
                ]
            });
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                $('#reportModal').modal('show');
            @endif
        })
    </script>
@endsection
