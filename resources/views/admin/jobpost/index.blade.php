@extends('admin.layout')
@section('title', 'Xét duyệt bài đăng tuyển dụng')
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Xét duyệt bài đăng tuyển dụng</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên bài đăng</th>
                                <th scope="col">Công ty đăng</th>
                                <th scope="col">Thời gian đăng</th>
                                <th class="col-2" scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jobPosts as $jobPost)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $jobPost->title }}</td>
                                    <td>{{ $jobPost->company->title }}</td>
                                    <td>{{ $jobPost->created_at }}</td>
                                    <td>
                                        <div class="row">

                                            <a href="{{ route('admin.jobpost.show', ['id' => $jobPost->id]) }}"
                                                class="btn btn-success"><i class="fa fa-eye"></i> Xem</a>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Bảng nhóm ngành hiện đang trống</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
