@extends('admin.layout')
@section('title', 'Quản lý tố cáo')
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Quản lý tố cáo</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Thời gian</th>
                                <th scope="col">Tên bài đăng</th>
                                <th scope="col">Người tố cáo</th>
                                <th class="col-2" scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $report)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $report->title }}</td>
                                    <td>{{ $report->created_at }}</td>
                                    <td>{{ $report->jobPost->title }}</td>
                                    <td>{{ $report->name }}</td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('admin.jobpostreport.show', $report->id) }}"
                                                class="btn btn-primary">Xem</a>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Bảng tố cáo hiện đang trống</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
