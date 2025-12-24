@extends('content.layout')
@section('title', $blog->title)
@section('content')
    <!-- Title Header Start -->
    <section class="inner-header-title" style="background-image:url({{ asset('assets/img/banner-10.jpg') }});">
        <div class="container">
            <h2>{{ $blog->title }}</h2>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- Blog Detail -->
    <section class="section">
        <div class="container">
            <div class="row no-mrg">
                <div class="col-md-8">
                    <article class="blog-news">
                        <div class="full-blog">

                            <figure class="img-holder">
                                <a href="blog-detail.html"><img src="{{ asset('storage/' . $blog->image) }}"
                                        class="img-responsive" alt="News"></a>
                                <div class="blog-post-date">
                                    {{ $blog->created_at->format('H:m - d/m/Y') }}
                                </div>
                            </figure>

                            <div class="full blog-content">
                                <div class="post-meta">Viết bởi: <span class="author">{{ $blog->user->name }}</span> |
                                    {{ $blog->comments->count() }} bình luận
                                </div>
                                <div>
                                    <h2>{{ $blog->title }}</h2>
                                </div>
                                <div class="blog-text">
                                    <p>{!! $blog->content !!}</p>

                                    <div class="post-meta">Danh mục: <span class="category"><a
                                                href="{{ route('blog.index', ['category' => $blog->blog_category_id]) }}">{{ $blog->blog_category->title }}</a></span>
                                    </div>
                                </div>
                                <div class="row no-mrg">
                                    <div class="blog-footer-social">
                                        <span>Share <i class="fa fa-share-alt"></i></span>
                                        <ul class="list-inline social">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </article>
                    <div class="row no-mrg">
                        <div class="comments">
                            <div class="section-title2">
                                <h3>{{ $blog->comments->count() }} bình luận</h3>
                            </div>

                            @foreach ($blog->comments as $comment)
                                <div class="single-comment">
                                    <div class="img-holder">
                                        <img src="{{ asset('storage/' . $comment->user->avatar) }}" class="img-responsive"
                                            alt="{{ $comment->user->name }}">
                                    </div>
                                    <div class="text-holder">
                                        <div class="top">
                                            <div class="name pull-left">
                                                <h4>{{ $comment->user->name }} –
                                                    {{ $comment->created_at->format('H:i - d/m/Y') }}</h4>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <p>{!! $comment->content !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row no-mrg">
                        <div class="comments-form">
                            <div class="section-title2">
                                <h3>Để lại một bình luận</h3>
                            </div>
                            @auth
                                <form action="{{ route('blog.comment', ['blogId' => $blog->id]) }}" method="POST">
                                    @csrf
                                    <div class="col-md-12 col-sm-12">
                                        <textarea class="form-control" placeholder="Nhập bình luận của bạn" name="content"></textarea>
                                    </div>
                                    @error('content')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <button class="thm-btn btn-comment" type="submit">Gửi bình luận</button>
                                </form>
                            @else
                                <h3>Vui lòng <a style="color: #28a745;" href="{{ route('login') }}">đăng nhập</a> để để lại
                                    bình
                                    luận</h3>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Start Sidebar -->
                <div class="col-md-4">
                    <div class="blog-sidebar">

                        <form action="#">
                            <div class="search-form">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Tìm kiếm bài viết">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default">Tìm kiếm</button>
                                    </span>
                                </div>
                            </div>
                        </form>

                        <div class="sidebar-widget">
                            <h4>Các danh mục</h4>
                            <ul class="sidebar-list">
                                <li><a href="{{ route('blog.index') }}">Tất cả</a></li>
                                @foreach ($categories as $category)
                                    <li><a
                                            href="{{ route('blog.index', ['category' => $category->id]) }}">{{ $category->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="sidebar-widget">
                            <h4>Các bài viết nổi bật</h4>
                            @foreach ($popularBlogs as $blogItem)
                                <div class="blog-item">
                                    <div class="post-thumb"><a
                                            href="{{ route('blog.show', ['id' => $blogItem->id, 'alias' => $blogItem->alias]) }}"><img
                                                src="{{ asset('storage/' . $blogItem->image) }}" class="img-responsive"
                                                alt="{{ $blogItem->title }}"></a>
                                    </div>
                                    <div class="blog-detail">
                                        <a
                                            href="{{ route('blog.show', ['id' => $blogItem->id, 'alias' => $blogItem->alias]) }}">
                                            <h4>{{ $blogItem->title }}</h4>
                                        </a>
                                        <div class="post-info">{{ $blogItem->created_at->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if ($similarBlogs->count() > 0)
                            <div class="sidebar-widget">
                                <h4>Bài viết liên quan</h4>
                                @foreach ($similarBlogs as $blogItem)
                                    <div class="blog-item">
                                        <div class="post-thumb"><a
                                                href="{{ route('blog.show', ['id' => $blogItem->id, 'alias' => $blogItem->alias]) }}"><img
                                                    src="{{ asset('storage/' . $blogItem->image) }}" class="img-responsive"
                                                    alt="{{ $blogItem->title }}"></a>
                                        </div>
                                        <div class="blog-detail">
                                            <a
                                                href="{{ route('blog.show', ['id' => $blogItem->id, 'alias' => $blogItem->alias]) }}">
                                                <h4>Enim Ad Minim Veniam, Quis Nostrud Exercitation</h4>
                                            </a>
                                            <div class="post-info">Aug 10 2016</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <!-- End Start Sidebar -->
            </div>
        </div>
    </section>
    <!-- Blog Detail End -->
@endsection
