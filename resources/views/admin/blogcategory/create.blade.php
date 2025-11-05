@extends('admin.layout')
@section('title', 'Thêm danh mục bài viết')
@section('content')
    <section class="section">
        <div class="section-body">
            <form class="card" action="{{ route('admin.blogcategory.store') }}" method="post" novalidate>
                @csrf
                <div class="card-header">
                    <h4>Nhập thông tin danh mục bài viết</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" name="description"></textarea>
                        @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="d-block">Tùy chọn</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" name="is_show">
                            <label class="form-check-label" for="defaultCheck1">
                                Hiển thị
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Lưu</button>
                    <a href="{{ route('admin.blogcategory.index') }}" class="btn btn-secondary">Quay về</a>
                </div>
            </form>
        </div>
    </section>
@endsection
