@extends('content.layout')

@section('title', 'Danh sách công ty yêu thích')
@section('content')
    <section class="inner-header-title" style="background-image:url({{ asset('assets/img/banner-10.jpg') }});">
        <div class="container">
            <h2>Danh sách công ty yêu thích</h2>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- ========== Begin: Brows job Category ===============  -->
    <section class="brows-job-category">
        <div class="container">
            @foreach ($favorites as $favorite)
                <div class="item-click">
                    <article>
                        <div class="brows-job-list">
                            <div class="col-md-1 col-sm-2 small-padding">
                                <div class="brows-job-company-img">
                                    <a href="job-detail.html"><img src="{{ asset('storage/' . $favorite->company->logo) }}"
                                            class="img-responsive" alt="" /></a>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-8">
                                <div class="brows-job-position">
                                    <a
                                        href="{{ route('companies.show', ['id' => $favorite->company->id, 'alias' => $favorite->company->alias]) }}">
                                        <h3>{{ $favorite->company->title }}</h3>
                                    </a>
                                    <p>
                                        <span>{{ $favorite->company->title }}</span><span class="brows-job-sallery"><i
                                                class="fa fa-address"></i>{{ $favorite->company->address . ' | ' . $favorite->company->provinceName }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="brows-job-link">
                                    <form action="{{ route('companyfavorite.destroy', ['id' => $favorite->id]) }}"
                                        method="POST" class="form-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Bỏ thích</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach

            <!--row-->
            @if ($favorites->count() == 0)
                <h3>Không có công ty yêu thích</h3>
            @else
                <div class="row">
                    <ul class="pagination">
                        @if ($favorites->currentPage() > 1)
                            <li><a href="{{ $favorites->url(1) }}">&laquo;</a></li>
                        @endif
                        @for ($i = 1; $i <= $favorites->lastPage(); $i++)
                            @if ($favorites->currentPage() == $i)
                                <li class="active"><a href="{{ $favorites->url($i) }}">{{ $i }}</a></li>
                            @elseif($favorites->currentPage() + 1 == $i || $favorites->currentPage() - 1 == $i)
                                <li><a href="{{ $favorites->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endfor
                        @if ($favorites->currentPage() < $favorites->lastPage())
                            <li><a href="{{ $favorites->url($favorites->lastPage()) }}">&raquo;</a></li>
                        @endif
                    </ul>
                </div>
                <!-- /.row-->
            @endif
        </div>
    </section>
    <!-- ========== Begin: Brows job Category End ===============  -->

@endsection
