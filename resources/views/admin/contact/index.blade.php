@extends('admin.layout')

@section('title', 'Danh sách liên hệ')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Danh sách liên hệ</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $contact)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>
                                        @if ($contact->is_processed)
                                            <span class="badge badge-success">Đã xử lý</span>
                                        @else
                                            <span class="badge badge-warning">Chờ xử lý</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row">

                                            <a href="{{ route('admin.contact.show', $contact->id) }}"
                                                class="btn btn-info"><i class="fa fa-eye"></i> Xem</a>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Bảng liên hệ hiện đang trống</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
