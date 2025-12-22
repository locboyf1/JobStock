@extends('admin.layout')
@section('title', 'Quản lý bài viết')
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Quản lý bài viết</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.blog.create') }}" class="btn btn-success mb-3"><i class="fas fa-file-medical"></i>
                        Thêm bài viết</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên bài viết</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Thời gian tạo</th>
                                <th scope="col">Lần sửa gần nhất</th>
                                <th class="col-2" scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blogs as $blog)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->blog_category->title }}</td>
                                    <td><img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                            width="100" height="70" /></td>
                                    <td>{{ $blog->created_at }}</td>
                                    <td>{{ $blog->updated_at }}</td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('admin.blog.edit', ['id' => $blog->id]) }}"
                                                class="btn btn-success"><i class="fa fa-edit"></i> Sửa</a>
                                            <form method="post"
                                                action="{{ route('admin.blog.status', ['id' => $blog->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="btn {{ $blog->is_show ? 'btn-warning' : 'btn-danger' }}"><i
                                                        class="fa {{ $blog->is_show ? 'fa-eye' : 'fa-eye-slash' }}"></i>{{ $blog->is_show ? 'Đang hiện' : 'Đã ẩn' }}</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Bảng bài viết hiện đang trống</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if ($blogs->currentPage() > 1)
                                <li class="page-item"><a class="page-link" href="{{ $blogs->url(1) }}">Trang đầu</a></li>
                            @endif
                            @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                                @if ($blogs->currentPage() == $i)
                                    <li class="page-item active"><a class="page-link"
                                            href="{{ $blogs->url($i) }}">{{ $i }}</a></li>
                                @elseif ($blogs->currentPage() == $i + 1 || $blogs->currentPage() == $i - 1)
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $blogs->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endfor
                            @if ($blogs->currentPage() < $blogs->lastPage())
                                <li class="page-item"><a class="page-link"
                                        href="{{ $blogs->url($blogs->lastPage()) }}">Trang cuối</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
