@extends('admin.layout')
@section('title', 'Quản lý danh mục bài viết')
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Quản lý danh mục bài viết</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.blogcategory.create') }}" class="btn btn-success mb-3"><i
                            class="
fas fa-file-medical"></i> Thêm danh mục</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Mô tả</th>
                                <th class="col-1" scope="col">Vị trí</th>
                                <th scope="col">Thời gian tạo</th>
                                <th scope="col">Lần sửa gần nhất</th>
                                <th class="col-2" scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td class="row">
                                        <form action="{{ route('admin.blogcategory.up', ['id' => $category->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary"><i
                                                    class="fas fa-arrow-up"></i></button>
                                        </form>
                                        <form action="{{ route('admin.blogcategory.down', ['id' => $category->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary"><i
                                                    class="fas fa-arrow-down"></i></button>
                                        </form>

                                    </td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>{{ $category->updated_at }}</td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('admin.blogcategory.edit', ['id' => $category->id]) }}"
                                                class="btn btn-success"><i class="fa fa-edit"></i> Sửa</a>
                                            <form method="post"
                                                action="{{ route('admin.blogcategory.status', ['id' => $category->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="btn {{ $category->is_show ? 'btn-warning' : 'btn-danger' }}"><i
                                                        class="fa {{ $category->is_show ? 'fa-eye' : 'fa-eye-slash' }}"></i>{{ $category->is_show ? 'Đang hiện' : 'Đã ẩn' }}</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Bảng danh mục bài viết hiện đang trống</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
