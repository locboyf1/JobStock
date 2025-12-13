@extends('admin.layout')
@section('title', 'Quản lý ngành thuộc {{ $jobGroup->title }}')
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Quản lý ngành | {{ $jobGroup->title }}</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.job.create', ['id' => $jobGroup->id]) }}" class="btn btn-success mb-3"><i
                            class="fas fa-file-medical"></i> Thêm ngành</a>
                    <a href="{{ route('admin.jobgroup.index') }}" class="btn btn-secondary mb-3"><i
                            class="fas fa-arrow-left"></i> Quay lại</a>
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
                            @forelse ($jobs as $job)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->description ? $job->description : 'Trống' }}</td>
                                    <td class="row">
                                        <form action="{{ route('admin.job.up', ['id' => $job->id]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary"><i
                                                    class="fas fa-arrow-up"></i></button>
                                        </form>
                                        <form action="{{ route('admin.job.down', ['id' => $job->id]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary"><i
                                                    class="fas fa-arrow-down"></i></button>
                                        </form>

                                    </td>
                                    <td>{{ $job->created_at }}</td>
                                    <td>{{ $job->updated_at }}</td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('admin.job.edit', ['id' => $job->id]) }}"
                                                class="btn btn-success"><i class="fa fa-edit"></i> Sửa</a>
                                            <form method="post"
                                                action="{{ route('admin.job.status', ['id' => $job->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="btn {{ $job->is_show ? 'btn-warning' : 'btn-danger' }}"><i
                                                        class="fa {{ $job->is_show ? 'fa-eye' : 'fa-eye-slash' }}"></i>{{ $job->is_show ? 'Đang hiện' : 'Đã ẩn' }}</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Bảng ngành của nhóm ngành {{ $jobGroup->title }}
                                        hiện đang trống</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
