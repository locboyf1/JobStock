@extends('admin.layout')
@section('title', 'Thêm bài viết')
@section('content')
    <section class="section">
        <div class="section-body">
            <form class="card" action="{{ route('admin.blog.store') }}" method="post" novalidate
                enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h4>Nhập thông tin bài viết</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên bài viết</label>
                        <input type="text" class="form-control @error('title')is-invalid @enderror" name="title"
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Danh mục</label>

                        <select class="custom-select @error('blog_category_id')is-invalid @enderror"
                            name="blog_category_id">
                            @foreach ($categories as $category)
                                <option {{ $category->id == old('blog_category_id') ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>

                        @error('blog_category_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control @error('description')is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea class="summernote form-control @error('content')is-invalid @enderror" name="content">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Ảnh</label>

                        <div class=" custom-file">
                            <input type="file" class="custom-file-input @error('image')is-invalid @enderror"
                                name="image" accept="image/**" />
                            <label class="custom-file-label" for="image">Chọn tệp ảnh</label>
                        </div>
                        @error('image')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label class="d-block">Tùy chọn</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" name="is_show"
                                {{ old('is_show') ? 'checked' : '' }}>
                            <label class="form-check-label" for="defaultCheck1">
                                Hiển thị
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Lưu</button>
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Quay về</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
