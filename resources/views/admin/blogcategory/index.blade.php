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
                    <a href="{{ route('admin.blogcategory.create') }}" class="btn btn-success mb-3"><i class="
fas fa-file-medical" ></i> Thêm danh mục</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Vị trí</th>
                                <th scope="col">Thời gian tạo</th>
                                <th scope="col">Lần sửa gần nhất</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                    <a href="" class="btn btn-secondary"><i class="fas fa-arrow-up"></i></a>
                                     <a href="" class="btn btn-secondary"><i class="fas fa-arrow-down"></i></a>
                                    </td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>{{ $category->updated_at }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning"><i class="fa fa-edit"></i> Sửa</a>
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
