@extends('content.layout')
@section('title', 'Trang chủ')
@section('content')
    <div class="simple-banner" style="background-image:url({{ asset('assets/img/simple-banner.jpg') }});">
        <div class="container">
            <div class="simple-banner-caption">
                <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1 banner-text">
                    <h3>Không sợ không có việc, chỉ sợ bạn không làm</h3>

                    <h1>Job <span>Stock</span></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <section class="bottom-search-form">
        <div class="container">
            <form class="bt-form" action="{{ route('job.index') }}" method="get">
                <div class="col-md-4 col-sm-6"><input type="text" class="form-control" placeholder="Từ khóa tìm kiếm"
                        name="keyword">
                </div>

                <div class="col-md-4 col-sm-6">
                    <select class="form-control" id="job-group-select" name="job_group_id">
                        <option value="">Chọn nhóm ngành</option>
                        @foreach ($job_groups as $job_group)
                            <option value="{{ $job_group->id }}">{{ $job_group->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-sm-6">
                    <select class="form-control" name="job_type_id">
                        <option value="">Chọn hình thức làm việc</option>
                        @foreach ($job_types as $job_type)
                            <option value="{{ $job_type->id }}">{{ $job_type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-sm-6">
                    <select id="choose-city" class="form-control" name="province_id">
                        <option value="">Chọn tỉnh/thành phố</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province['code'] }}">{{ $province['name'] }}</option>
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
    </section>
    <div class="clearfix"></div>
    <section>
        <div class="container">
            <div class="row">
                <div class="main-heading">
                    <p>Những công việc mới nhất</p>

                    <h2><span>Mới</span> và <span>còn slot </span>cho bạn</h2>
                </div>
            </div>
            <div class="row extra-mrg">
                @foreach ($posts as $post)
                    <div class="col-md-3 col-sm-6">
                        <div class="grid-view brows-job-list" style="height: 350px">
                            <div class="brows-job-company-img"><img src="{{ asset('storage/' . $post->company->logo) }}"
                                    class="img-responsive" alt="" /></div>
                            <div class="brows-job-position">
                                <h4><a href="{{ route('job.show', $post->id) }}">{{ $post->title }}</a></h4>

                                <p><span>{{ $post->company->title }}</span></p>
                            </div>
                            <div class="job-position"><span class="job-num">Số lượng tuyển: {{ $post->quantity }}</span>
                            </div>
                            <div class="brows-job-type"><span class="enternship">{{ $post->jobType->name }}</span></div>
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
    <div class="clearfix"></div>
    <section class="video-sec dark" id="video"
        style="background-image:url('{{ asset('assets/img/banner-10.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="main-heading">
                    <p>Best For Your Projects</p>

                    <h2>Watch Our <span>video</span></h2>
                </div>
            </div>
            <div class="video-part"><a href="#" data-toggle="modal" data-target="#my-video" class="video-btn"><i
                        class="fa fa-play"></i></a></div>
        </div>
    </section>
    <div class="clearfix"></div>
    <section class="how-it-works">
        <div class="container">
            <div class="row" data-aos="fade-up">
                <div class="col-md-12">
                    <div class="main-heading">
                        <p>Working Process</p>

                        <h2>How It <span>Works</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="working-process">
                        <span class="process-img"><img src="{{ asset('assets/img/step-1.png') }}" class="img-responsive"
                                alt="" /><span class="process-num">01</span></span>
                        <h4>Create An Account</h4>

                        <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers
                            find place best.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="working-process">
                        <span class="process-img"><img src="{{ asset('assets/img/step-2.png') }}" class="img-responsive"
                                alt="" /><span class="process-num">02</span></span>
                        <h4>Search Jobs</h4>

                        <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers
                            find place best.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="working-process">
                        <span class="process-img"><img src="{{ asset('assets/img/step-3.png') }}" class="img-responsive"
                                alt="" /><span class="process-num">03</span></span>
                        <h4>Save & Apply</h4>

                        <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers
                            find place best.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <section class="testimonial" id="testimonial">
        <div class="container">
            <div class="row">
                <div class="main-heading">
                    <p>What Say Our Client</p>

                    <h2>Our Success <span>Stories</span></h2>
                </div>
            </div>
            <div class="row">
                <div id="client-testimonial-slider" class="owl-carousel">
                    <div class="client-testimonial">
                        <div class="pic"><img src="{{ asset('assets/img/client-1.jpg') }}" alt=""></div>
                        <p class="client-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor et dolore magna aliqua.</p>

                        <h3 class="client-testimonial-title">Lacky Mole</h3>
                        <ul class="client-testimonial-rating">
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star"></li>
                        </ul>
                    </div>
                    <div class="client-testimonial">
                        <div class="pic"><img src="{{ asset('assets/img/client-2.jpg') }}" alt=""></div>
                        <p class="client-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor et dolore magna aliqua.</p>

                        <h3 class="client-testimonial-title">Karan Wessi</h3>
                        <ul class="client-testimonial-rating">
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                        </ul>
                    </div>
                    <div class="client-testimonial">
                        <div class="pic"><img src="{{ asset('assets/img/client-3.jpg') }}" alt=""></div>
                        <p class="client-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor et dolore magna aliqua.</p>

                        <h3 class="client-testimonial-title">Roul Pinchai</h3>
                        <ul class="client-testimonial-rating">
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star"></li>
                        </ul>
                    </div>
                    <div class="client-testimonial">
                        <div class="pic"><img src="{{ asset('assets/img/client-1.jpg') }}" alt=""></div>
                        <p class="client-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor et dolore magna aliqua.</p>

                        <h3 class="client-testimonial-title">Adam Jinna</h3>
                        <ul class="client-testimonial-rating">
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pricing">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-heading">
                        <p>Top Freelancer</p>

                        <h2>Hire Expert <span>Freelancer</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="freelance-container style-2">
                        <div class="freelance-box">
                            <span class="freelance-status">Available</span>
                            <h4 class="flc-rate">$17/hr</h4>

                            <div class="freelance-inner-box">
                                <div class="freelance-box-thumb"><img src="{{ asset('assets/img/can-5.jpg') }}"
                                        class="img-responsive img-circle" alt="" /></div>
                                <div class="freelance-box-detail">
                                    <h4>Agustin L. Smith</h4>
                                    <span class="location">Australia</span>
                                </div>
                                <div class="rattings"><i class="fa fa-star fill"></i><i class="fa fa-star fill"></i><i
                                        class="fa fa-star fill"></i><i class="fa fa-star-half fill"></i><i
                                        class="fa fa-star"></i></div>
                            </div>
                            <div class="freelance-box-extra">
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui.</p>
                                <ul>
                                    <li>Php</li>
                                    <li>Android</li>
                                    <li>Html</li>
                                    <li class="more-skill bg-primary">+3</li>
                                </ul>
                            </div>
                            <a href="freelancer-detail.html" class="btn btn-freelance-two bg-default">View Detail</a><a
                                href="freelancer-detail.html" class="btn btn-freelance-two bg-info">View Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="freelance-container style-2">
                        <div class="freelance-box">
                            <span class="freelance-status bg-warning">At Work</span>
                            <h4 class="flc-rate">$22/hr</h4>

                            <div class="freelance-inner-box">
                                <div class="freelance-box-thumb"><img src="{{ asset('assets/img/can-5.jpg') }}"
                                        class="img-responsive img-circle" alt="" /></div>
                                <div class="freelance-box-detail">
                                    <h4>Delores R. Williams</h4>
                                    <span class="location">United States</span>
                                </div>
                                <div class="rattings"><i class="fa fa-star fill"></i><i class="fa fa-star fill"></i><i
                                        class="fa fa-star fill"></i><i class="fa fa-star-half fill"></i><i
                                        class="fa fa-star"></i></div>
                            </div>
                            <div class="freelance-box-extra">
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui.</p>
                                <ul>
                                    <li>Php</li>
                                    <li>Android</li>
                                    <li>Html</li>
                                    <li class="more-skill bg-primary">+3</li>
                                </ul>
                            </div>
                            <a href="freelancer-detail.html" class="btn btn-freelance-two bg-default">View Detail</a><a
                                href="freelancer-detail.html" class="btn btn-freelance-two bg-info">View Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="freelance-container style-2">
                        <div class="freelance-box">
                            <span class="freelance-status">Available</span>
                            <h4 class="flc-rate">$19/hr</h4>

                            <div class="freelance-inner-box">
                                <div class="freelance-box-thumb"><img src="{{ asset('assets/img/can-5.jpg') }}"
                                        class="img-responsive img-circle" alt="" /></div>
                                <div class="freelance-box-detail">
                                    <h4>Daniel Disroyer</h4>
                                    <span class="location">Bangladesh</span>
                                </div>
                                <div class="rattings"><i class="fa fa-star fill"></i><i class="fa fa-star fill"></i><i
                                        class="fa fa-star fill"></i><i class="fa fa-star-half fill"></i><i
                                        class="fa fa-star"></i></div>
                            </div>
                            <div class="freelance-box-extra">
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui.</p>
                                <ul>
                                    <li>Php</li>
                                    <li>Android</li>
                                    <li>Html</li>
                                    <li class="more-skill bg-primary">+3</li>
                                </ul>
                            </div>
                            <a href="freelancer-detail.html" class="btn btn-freelance-two bg-default">View Detail</a><a
                                href="freelancer-detail.html" class="btn btn-freelance-two bg-info">View Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="text-center"><a href="freelancers-2.html" class="btn btn-primary">Load More</a></div>
                </div>
            </div>
        </div>
    </section>
    <section class="download-app" style="background-image:url('{{ asset('assets/img/banner-7.jpg') }}');">
        <div class="container">
            <div class="col-md-5 col-sm-5 hidden-xs"><img src="{{ asset('assets/img/iphone.png') }}" alt="iphone"
                    class="img-responsive" /></div>
            <div class="col-md-7 col-sm-7">
                <div class="app-content">
                    <h2>Download Our Best Apps</h2>
                    <h4>Best oppertunity in your hand</h4>

                    <p>Aliquam vestibulum cursus felis. In iaculis iaculis sapien ac condimentum. Vestibulum congue
                        posuere lacus, id tincidunt nisi porta sit amet. Suspendisse et sapien varius, pellentesque dui
                        non, semper orci. Curabitur blandit, diam ut ornare ultricies.</p>
                    <a href="#" class="btn call-btn"><i class="fa fa-apple"></i>Download</a><a href="#"
                        class="btn call-btn"><i class="fa fa-android"></i>Download</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const jobs = @json($jobs);
            const jobGroupSelect = document.getElementById('job-group-select');
            const jobSelect = document.getElementById('job-select');

            jobGroupSelect.addEventListener('change', function() {
                const jobGroupId = jobGroupSelect.value;
                jobSelect.innerHTML = '<option value="">Chọn ngành nghề</option>';
                for (const job of jobs) {
                    if (job.job_group_id == jobGroupId) {
                        jobSelect.innerHTML += `<option value="${job.id}">${job.title}</option>`;
                    }
                }
            });
        })
    </script>
@endsection
