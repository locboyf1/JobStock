@extends('admin.layout')
@section('title', 'Sửa ')
@section('content')
    <section class="section">
        <div class="section-body">
            <form class="card" action="{{ route('admin.jobgroup.update', ['id' => $jobGroup->id]) }}" method="post" novalidate>
                @csrf
                @method('PUT')
                <div class="card-header">
                    <h4>Nhập thông tin nhóm ngành</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên nhóm ngành</label>
                        <input type="text" class="form-control @error('title')is-invalid @enderror" name="title" value="{{ $jobGroup->title }}">
                        @error('title')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control @error('description')is-invalid @enderror" name="description">{{ $jobGroup->description }}</textarea>
                        @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="d-block">Tùy chọn</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" name="is_show" {{ $jobGroup->is_show ? 'checked' : ''}}>
                            <label class="form-check-label" for="defaultCheck1">
                                Hiển thị
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Lưu</button>
                    <a href="{{ route('admin.jobgroup.index') }}" class="btn btn-secondary">Quay về</a>
                </div>
            </form>
        </div>
    </section>
@endsection
