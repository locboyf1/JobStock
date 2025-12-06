@extends('admin.layout')
@section('title', 'Sửa loại công việc')
@section('content')
    <section class="section">
        <div class="section-body">
            <form class="card" action="{{ route('admin.jobtype.update', ['id' => $jobType->id]) }}" method="post"
                novalidate>
                @csrf
                @METHOD('PUT')
                <div class="card-header">
                    <h4>Nhập thông tin loại công việc</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên loại công việc</label>
                        <input type="text" class="form-control @error('name')is-invalid @enderror" name="name"
                            value="{{ $jobType->name }}">
                        @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control @error('description')is-invalid @enderror" name="description">{{ $jobType->description }}</textarea>
                        @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="d-block">Tùy chọn</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" name="is_active"
                                {{ $jobType->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="defaultCheck1">
                                Hiển thị
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Lưu</button>
                    <a href="{{ route('admin.jobtype.index') }}" class="btn btn-secondary">Quay về</a>
                </div>
            </form>
        </div>
    </section>
@endsection
