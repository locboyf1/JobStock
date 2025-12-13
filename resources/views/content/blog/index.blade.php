@extends('content.layout')

@section('title', 'Bài viết')
@section('content')
    <!-- Title Header Start -->
    <section class="inner-header-title" style="background-image:url({{ asset('assets/img/banner-10.jpg') }});">
        <div class="container">
            <h1>Bài viết</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- All blog List Start -->
    <section class="section">
        <div class="container">
            <div class="row .no-mrg">
                <!-- Start Blogs -->
                <div class="col-md-8">
                    @foreach ($blogs as $blog)
                        <article class="blog-news">
                            <div class="short-blog">
                                <figure class="img-holder">
                                    <a href="{{ route('blog.show', [$blog->id, $blog->alias]) }}"><img
                                            src="{{ asset('storage/' . $blog->image) }}" class="img-responsive"
                                            alt="News"></a>
                                    <div class="blog-post-date">
                                        {{ $blog->created_at->format('H:i - d/m/Y') }}
                                    </div>
                                </figure>
                                <div class="blog-content">
                                    <div class="post-meta">Đăng bởi: <span class="author">{{ $blog->user->name }}</span> |
                                        {{ $blog->comments->count() }} bình luận</div>
                                    <a href="{{ route('blog.show', ['id' => $blog->id, 'alias' => $blog->alias]) }}">
                                        <h2>{{ $blog->title }}</h2>
                                    </a>
                                    <div class="blog-text">
                                        <p>{{ $blog->description }}</p>
                                        <div class="post-meta">Danh mục: <span class="category"><a
                                                    href="#">{{ $blog->blog_category->title }}</a></span></div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <!-- End Blogs -->

                <!-- Sidebar Start -->
                <div class="col-md-4">
                    <div class="blog-sidebar">

                        <form action="{{ route('blog.index') }}">
                            <div class="search-form">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control"
                                        placeholder="Tìm kiếm bài viết" value="{{ $keyword }}">
                                    <input type="hidden" name="category" value="{{ $category_id }}">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">Tìm kiếm</button>
                                    </span>
                                </div>
                            </div>
                        </form>

                        <div class="sidebar-widget">
                            <h4>Các danh mục</h4>
                            <ul class="sidebar-list">
                                <li><a href="{{ route('blog.index', ['category' => null, 'keyword' => $keyword]) }}">
                                        @if (request('category') == null)
                                            <strong>Tất cả</strong>
                                        @else
                                            Tất cả
                                        @endif
                                    </a>
                                </li>
                                @foreach ($categories as $category)
                                    <li><a
                                            href="{{ route('blog.index', ['category' => $category->id, 'keyword' => $keyword]) }}">
                                            @if ($category_id == $category->id)
                                                <strong>{{ $category->title }}</strong>
                                            @else
                                                {{ $category->title }}
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="sidebar-widget">
                            <h4>Các bài viết nổi tiếng</h4>
                            @foreach ($popularBlogs as $blog)
                                <div class="blog-item">
                                    <div class="post-thumb"><a href="blog-detail.html"><img
                                                src="{{ asset('storage/' . $blog->image) }}" class="img-responsive"
                                                alt="{{ $blog->title }}"></a></div>
                                    <div class="blog-detail">
                                        <a href="{{ route('blog.show', ['id' => $blog->id, 'alias' => $blog->alias]) }}">
                                            <h4>{{ $blog->title }}</h4>
                                        </a>
                                        <div class="post-info">{{ $blog->created_at->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- End Sidebar Start -->
            </div>
            <div class="row">
                <ul class="pagination">
                    @if ($blogs->currentPage() > 1)
                        <li><a href="{{ $blogs->url(1) }}">&laquo;</a></li>
                    @endif
                    @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                        @if ($blogs->currentPage() == $i)
                            <li class="active"><a href="{{ $blogs->url($i) }}">{{ $i }}</a></li>
                        @elseif($blogs->currentPage() + 1 == $i)
                            <li><a href="{{ $blogs->url($i) }}">{{ $i }}</a></li>
                        @elseif($blogs->currentPage() - 1 == $i)
                            <li><a href="{{ $blogs->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    @if ($blogs->currentPage() < $blogs->lastPage())
                        <li><a href="{{ $blogs->url($blogs->lastPage()) }}">&raquo;</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </section>
    <!-- All Blog List End -->
@endsection
