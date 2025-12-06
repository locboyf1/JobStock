@extends('admin.layout')
@section('title', 'Quản lý loại công việc')
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Quản lý loại công việc</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.jobtype.create') }}" class="btn btn-success mb-3"><i
                            class="fas fa-file-medical"></i>
                        Thêm loại công việc</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên loại công việc</th>
                                <th scope="col">Mô tả</th>
                                <th class="col-1" scope="col">Vị trí</th>
                                <th class="col-2" scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jobTypes as $jobType)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $jobType->name }}</td>
                                    <td>{{ $jobType->description }}</td>
                                    <td class="row">
                                        <form action="{{ route('admin.jobtype.up', ['id' => $jobType->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary"><i
                                                    class="fas fa-arrow-up"></i></button>
                                        </form>
                                        <form action="{{ route('admin.jobtype.down', ['id' => $jobType->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary"><i
                                                    class="fas fa-arrow-down"></i></button>
                                        </form>

                                    </td>
                                    <td>
                                        <div class="row">

                                            <a href="{{ route('admin.jobtype.edit', ['id' => $jobType->id]) }}"
                                                class="btn btn-success"><i class="fa fa-edit"></i> Sửa</a>
                                            <form method="post"
                                                action="{{ route('admin.jobtype.status', ['id' => $jobType->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="btn {{ $jobType->is_active ? 'btn-warning' : 'btn-danger' }}"><i
                                                        class="fa {{ $jobType->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>{{ $jobType->is_active ? ' Hiển thị' : 'Ẩn' }}</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Bảng loại hình công việc hiện đang trống</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
