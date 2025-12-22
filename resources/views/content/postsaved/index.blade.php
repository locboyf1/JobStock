@extends('content.layout')

@section('title', 'Danh sách bài tuyển dụng đã lưu')
@section('content')
    <section class="inner-header-title" style="background-image:url({{ asset('assets/img/banner-10.jpg') }});">
        <div class="container">
            <h2>Danh sách bài tuyển dụng đã lưu</h2>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- ========== Begin: Brows job Category ===============  -->
    <section class="brows-job-category">
        <div class="container">
            @foreach ($savedPosts as $savedPost)
                <div class="item-click">
                    <article>
                        <div class="brows-job-list">
                            <div class="col-md-1 col-sm-2 small-padding">
                                <div class="brows-job-company-img">
                                    <a href="job-detail.html"><img
                                            src="{{ asset('storage/' . $savedPost->jobPost->company->logo) }}"
                                            class="img-responsive" alt="" /></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-5">
                                <div class="brows-job-position">
                                    <a
                                        href="{{ route('job.show', ['id' => $savedPost->jobPost->id, 'alias' => $savedPost->jobPost->alias]) }}">
                                        <h3>{{ $savedPost->jobPost->title }}</h3>
                                    </a>
                                    <p>
                                        <span>{{ $savedPost->jobPost->company->title }}</span><span
                                            class="brows-job-sallery"><i
                                                class="fa fa-money"></i>{{ $savedPost->jobPost->salary_max ? $savedPost->jobPost->salary_min . ' - ' . $savedPost->jobPost->salary_max . ' triệu VNĐ' : 'Từ ' . $savedPost->jobPost->salary_min . ' triệu VNĐ' }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="brows-job-location">
                                    <p><i
                                            class="fa fa-flask"></i>{{ $savedPost->jobPost->experience ? $savedPost->jobPost->experience . ' năm kinh nghiệm' : 'Không yêu cầu' }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="brows-job-link">
                                    <form action="{{ route('jobpostsaved.destroy', ['id' => $savedPost->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Bỏ lưu</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <span class="tg-themetag tg-featuretag">{{ $savedPost->jobPost->jobType->name }}</span>
                    </article>
                </div>
            @endforeach

            <!--row-->
            @if ($savedPosts->count() == 0)
                <h3>Không có bài đăng đã lưu</h3>
            @else
                <div class="row">
                    <ul class="pagination">
                        @if ($savedPosts->currentPage() > 1)
                            <li><a href="{{ $savedPosts->url(1) }}">&laquo;</a></li>
                        @endif
                        @for ($i = 1; $i <= $savedPosts->lastPage(); $i++)
                            @if ($savedPosts->currentPage() == $i)
                                <li class="active"><a href="{{ $savedPosts->url($i) }}">{{ $i }}</a></li>
                            @elseif($savedPosts->currentPage() + 1 == $i || $savedPosts->currentPage() - 1 == $i)
                                <li><a href="{{ $savedPosts->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endfor
                        @if ($savedPosts->currentPage() < $savedPosts->lastPage())
                            <li><a href="{{ $savedPosts->url($savedPosts->lastPage()) }}">&raquo;</a></li>
                        @endif
                    </ul>
                </div>
                <!-- /.row-->
            @endif
        </div>
    </section>
    <!-- ========== Begin: Brows job Category End ===============  -->

@endsection
