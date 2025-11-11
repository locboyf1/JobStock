@extends('admin.layout')
@section('title', 'Thêm ngành thuộc {{ $jobGroup->title }}')
@section('content')
    <section class="section">
        <div class="section-body">
            <form class="card" action="{{ route('admin.job.store', ['id' => $jobGroup->id]) }}" method="post" novalidate>
                @csrf
                <div class="card-header">
                    <h4>Nhập thông tin ngành | {{ $jobGroup->title  }}</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên ngành</label>
                        <input type="text" class="form-control @error('title')is-invalid @enderror" name="title"
                            value="{{ old('title') }}">
                        @error('title')
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
                    <a href="{{ route('admin.job.index', ['id' => $jobGroup->id]) }}" class="btn btn-secondary">Quay về</a>
                </div>
            </form>
        </div>
    </section>
@endsection
